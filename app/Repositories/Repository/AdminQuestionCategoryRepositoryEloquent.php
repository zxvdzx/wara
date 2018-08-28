<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminQuestionCategoryRepository;
use App\Repositories\Entities\QuestionCategory;
use App\Repositories\Entities\AuditrailLog;

use DB;
use Request;

/**
 * Class AdminQuestionCategoryRepositoryEloquent
 * @package namespace App\Repositories\Repository;
 */
class AdminQuestionCategoryRepositoryEloquent extends BaseRepository implements AdminQuestionCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return QuestionCategory::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * index page in Sentinel format.
     *
     * @return mixed
     */
    public function getIndex()
    {
        try
        {   
            return view('backend.questionCategory.index');
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * process data.
     *
     * @return mixed
     */
    public function processData($type,$attributes)
    {
        try
        {
            $response = array();
            
            if($type == 'get-data'){
                $data = QuestionCategory::find($attributes['id']);
                $response['category'] = $data->category;
            }else if($type <> 'delete'){
                DB::beginTransaction();
                try{
                    if($attributes['action'] == 'create'){
                        $data   = new QuestionCategory;
                    }else{
                        $data = QuestionCategory::find($attributes['id']);
                    }

                    if($attributes['action'] == 'create'){
                        $data->setAttributesFromJson($attributes);
                        $data->save();
                        AuditrailLog::saveData(user_info('email'),'create','question_category',[],$attributes);
                        
                        $response['notification'] = 'Success Create Data';
                        $response['status'] = 'success';
                    }else if($attributes['action'] == 'update'){
                        $temp_data = [
                            'id' => $data->id, 
                            'category' => $data->category, 
                        ];
                        $old_data = json_encode($temp_data);
                        
                        $data->setAttributesFromJson($attributes);
                        $data->save();
                        
                        AuditrailLog::saveData(user_info('email'),'update','question_category',$old_data,$attributes);

                        $response['notification'] = 'Success Update Data';
                        $response['status'] = 'success';
                    }
                    DB::commit();
                }
                catch (\Exception $e)
                {
                    DB::rollback();
                    errorLog($e);
                    throw new \Exception($e->getMessage());
                }
            }else{
                $data = QuestionCategory::find($attributes['id']);
                $temp_data = [
                    'id' => $data->id, 
                    'category' => $data->category, 
                ];
                $old_data = json_encode($temp_data);
                AuditrailLog::saveData(user_info('email'),'delete','question_category',$old_data,[]);
                if( $data->delete() ){
                    $response['notification'] = 'Delete Data Success';
                    $response['status'] = 'success';
                }else{
                    $response['notification'] = 'Delete Data Failed';
                    $response['status'] = 'failed';
                }
                DB::commit();
            }

            return json_encode($response);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
    
    /**
     * get datatables.
     *
     * @return mixed
     */
    public function getDatatables()
    {
        try
        {   
            $datatables = datatables(QuestionCategory::all())
                ->addColumn('action', function ($data) {
                    $action = "";
                    $quote = "'";
                    $action = '
                        <a onclick="javascript:show_form_update('.$quote.$data->id.$quote.')" class="btn btn-warning btn-xs" title="Update"><i class="fa fa-pencil-square-o fa-fw"></i></a>
                        <a onclick="javascript:show_form_delete('.$quote.$data->id.$quote.')" class="btn btn-danger btn-xs actDelete" title="Delete"><i class="fa fa-trash-o fa-fw"></i></a>';
                    
                    return $action;
                })
                ->make(true);
            
            return $datatables;
        }
        catch (\Exception $e)
        {
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}
