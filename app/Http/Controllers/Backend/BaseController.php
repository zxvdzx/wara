<?php

namespace App\Http\Controllers\Backend;

use DB;
use Closure;
use Exception;
use Sentinel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

abstract class BaseController extends Controller
{
    /**
     * The model associated with the controller.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    public $currentUser;

    /**
     * Create a new controller instance.
     *
     * @param  null|\Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;

        $lang = env('APP_LANG');
        \App::setLocale($lang);

        $this->currentUser = '';
        // $currentUserLogin = \Sentinel::getUser();
        $currentUserLogin = '';
        if($currentUserLogin){
            $this->currentUser = $currentUserLogin;
        } else {
            $currentUserLogin ='';
        }
    }

    protected function getClassAndMethodRoute($method = null)
    {
        $class =  str_replace('App\Http\Controllers\\', '', static::class);
        
        if (is_string($method)) {
            return $class.'@'.$method;
        }

        return $class;
    }

    /**
     * Prepare data for createEdit().
     *
     * @param  array|object  $dataToBind
     * @param  int           $id
     * @return array
     */
    protected function prepareCreateEdit($dataToBind, $id = 0)
    {
        $data = [
            'title' => ucfirst(ahloo_form_title($id)),
            'form' => [
                'url' => action($this->getClassAndMethodRoute('store')),
                'files' => true,
            ],
            'data' => $dataToBind,
            'back' => action($this->getClassAndMethodRoute('index')),
        ];

        if ($id) {
            $data['form']['url'] = action($this->getClassAndMethodRoute('update'), $id);
            $data['form']['method'] = 'PUT';
        }

        return $data;
    }

    /**
     * Execute callback in a database transaction.
     *
     * @param  \Closure $callback
     * @param  bool     $isDelete
     * @return \Illuminate\Http\Response
     */
    protected function transaction(Closure $callback, $isDelete = false)
    {
        DB::beginTransaction();

        try {
            $callback($this->model);

            DB::commit();

            if ($isDelete) {
                flash()->success(trans('papermark.delete_success'));
            } else {
                flash()->success(trans('papermark.save_success'));
            }
        } catch (Exception $e) {
            DB::rollBack();

            if ($isDelete) {
                flash()->error(trans('papermark.delete_fail'));
            } else {
                flash()->error(trans('papermark.save_fail'));
            }
        }

        return redirect()->action($this->getClassAndMethodRoute('index'));
    }
}
