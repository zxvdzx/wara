<?php

namespace App\Repositories\Entities;

use Illuminate\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cartalyst\Sentinel\Users\EloquentUser as Model;

use Sentinel;
use DB;
use Mail;
use Reminder;
use Carbon\Carbon;
use App\Models\AuthLog;

use GuzzleHttp\Client;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * Default password.
     *
     * @var string
     */
    const DEFAULT_PASSWORD = '12345678';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'email', 
        'password', 
        'permissions', 
        'username', 
        'first_name', 
        'last_name', 
        'avatar', 
        'is_admin', 
        'phone', 
        'address',
        'place_of_birth',
        'date_of_birth',
        'gender',
    ];

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password',
    ];

    public function RoleUsers(){
        return $this->belongsToMany('App\Repositories\Entities\Role','role_users','user_id');
    }

    public function createNewUser($data,$type = null,$role = null)
    {
        DB::beginTransaction();//begin transaction
        try{

            $credentials = [
                'email'    => $data['email'],
                'password' => $data['password'],
            ];

            $user = Sentinel::register($credentials);

            if(empty($role)) {
                $role = 'user';
            }

            Sentinel::findRoleBySlug($role)->users()->attach(Sentinel::findById($user->id));

            $activation = \Activation::create($user);

            $updateUser = $this->find($user->id);
            $updateUser->username = $data['username'];

            if($type == 'from_admin') {
                \Activation::complete($user, $activation->code);
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>'');


            } else {
                //send email verification
                $data_email = array('id'=>$updateUser->id,
                                    'email'=>$updateUser->email,
                                    'username'=>$updateUser->username,
                                    'password'=>$data['password'],
                                    'subject_email'=>trans('general.subject_verification_email'),
                                    'activation_code'=>$activation->code);
            }

            $this->sendEmailVerifcation($data_email);

        }catch(\Exception $e){
            DB::rollback();

            $user = array();
            $status = array('code' => '400','status' => 'error','message' => $e->getMessage(),'data'=>$user);
            return $status;

        }
        DB::commit();//commit transactions
        \Log::info('model insert user');
        $status = array('code' => '200','status' => 'success','data'=>$updateUser);
        return $status;
    }

    public function sendEmailVerifcation($data)
    {
        $mail = Mail::queue('email.verification', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });

    }

    public function resetPassword($credentials)
    {
        try
        {
            $findUser = Sentinel::findByCredentials($credentials);
            if(!empty($findUser)) {

                ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
                $data_email = array('id'=>$findUser->id,
                                    'email'=>$findUser->email,
                                    'username'=>$findUser->username,
                                    'subject_email'=>trans('general.subject_reset_password'),
                                    'activation_code'=>$reminder->code);
                $this->sendEmailResetPassword($data_email);

                $status = array('code'=>200,'status'=>'success','message'=>trans('general.reset_password_success'));
                return $status;

            } else {
                $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.trans('general.user_not_found'));
                return $status;
            }

        }catch(\Exception $e){

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.reset_password_error').'. '.$e->getMessage());
            return $status;

        }

    }

    public function UpdatePasswordByID($id,$password)
    {
        try
        {

            $findUser = Sentinel::findById($id);
            ($reminder = Reminder::exists($findUser)) || ($reminder = Reminder::create($findUser));
            Reminder::complete($findUser, $reminder->code, $password);

            $data_email = array('id'=>$findUser->id,
                                'email'=>$findUser->email,
                                'username'=>$findUser->username,
                                'subject_email'=>trans('general.subject_change_password'),
                                'password' => $password,
                                'activation_code' => '',
                                'text_message'=>trans('general.text_update_password'));

                $data['user_id'] = $findUser->id;
                $data['description'] = 'Have change password';

                $this->sendEmailVerifcation($data_email);

            return $findUser;

        } catch (\Exception $e) {

            return false;

        }

    }

    public function verifyCodeResetPassword($user_id, $code)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            if (Reminder::exists($user, $code)) {
                $user->code = $code;
                $status = array('code'=>200,'status'=>'success','message'=>trans('general.please_change_password'),'data'=>$user);
                return $status;

            } else {

                $status = array('code'=>400,'status'=>'error','message'=>trans('general.not_have_reset_password'),'data'=>array());
                return $status;

            }

        } else {

            $status = array('code'=>400,'status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }
    }

    public function sendEmailResetPassword($data)
    {
        $mail = Mail::queue('email.reset_password', $data,
            function($message) use($data) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
                $message->to($data['email'], $data['email'])->subject($data['subject_email']);
            });
    }


    public function setLoginUser($param){
        $credentials = [
            'email'    => $param['email'],
            'password' => $param['password'],
        ];

        try{

            $auth = Sentinel::authenticate($credentials);

            if(!empty($auth)){
                $status = array('code'=>'200','status'=>'success','data'=>$auth);
            } else {
                $status = array('code'=>'400','status'=>'error','message'=>trans('general.invalid_login'),'data'=>array());
            }
            return $status;

        }catch(\Exception $e){

            $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
            return $status;

        }
    }

    public function checkUserByEmail($email)
    {
        $user = $this->where(['email'=>$email])->first();
        if (count($user) > 0) {
            return $user;
        } else {
            return false;
        }
    }

    public function changePassword($user_id,$code,$password)
    {
        $user = Sentinel::findById($user_id);
        if(!empty($user)) {

            try
            {
                Reminder::complete($user, $code, $password);
                $status = array('code'=>'200','status'=>'success','message'=>trans('general.change_password_success'),'data'=>$user);
                return $status;
            }catch(\Exception $e){
                $status = array('code'=>'400','status'=>'error','message'=>$e->getMessage(),'data'=>array());
                return $status;
            }
        } else {

            $status = array('code'=>'400','status'=>'error','message'=>trans('general.user_not_found'),'data'=>array());
            return $status;

        }

    }
}
