<?php

namespace App\Repositories\Repository;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AdminQuestionRepository;

use App\Repositories\Entities\Question;
use App\Repositories\Entities\MultipleChoice;
use App\Repositories\Entities\QuestionCategory;
use App\Repositories\Entities\Answer;
use App\Repositories\Entities\AuditrailLog;

use DB;
use Input;

/**
 * Class AdminQuestionRepositoryEloquent
 * @package namespace App\Repositories\Repository;
 */
class AdminQuestionRepositoryEloquent extends BaseRepository implements AdminQuestionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * index page.
     *
     * @return mixed
     */
    public function getIndex()
    {
        try
        {   
            $categories = QuestionCategory::getCategoryList();
            
            return view('backend.question.index')->with('categories',$categories);
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
                $data   = Question::find($attributes['id']);
                $ans    = Answer::where('question_id', $data->id)->first();
                $mc     = MultipleChoice::where('question_id', $data->id)->orderBy('id','asc')->get();
                
                $mcs = [];
                foreach($mc as $key => $value){
                    $cb = MultipleChoice::where('question_id', $data->id)
                                        ->where('id', $ans->mc_id)->first();

                    if($value['id'] == $cb->id){
                        $response['cb'] = 'cb'.($key+1);
                    }
                    array_push($mcs, $value['choice']);
                }
                $categories = QuestionCategory::getCategoryList();
                $qName = QuestionCategory::find($data->category_id);
                $categoryName = $qName ? $qName->category : "";
                $response['category_name'] = $data->category_id;
                $response['question']      = $data->question;
                $response['point']         = $data->point;
                $response['is_file']       = $data->is_file;
                $response['category']      = $categoryName;
                $response['categories']    = $categories;
                $response['file_path']     = !empty($data->file_path) ? base_url($data->file_path) : "";
                $response['mc'] = $mcs;
            }else if($type <> 'delete'){
                DB::beginTransaction();
                try{
                    if($attributes['action'] == 'create'){
                        $data   = new Question;
                        $answer = new Answer;

                        $data->setAttributesFromJson($attributes);
                        if(isset($attributes['is_file']) && !empty($attributes['file_name'])) {
                            createdirYmd('public/storage/listening/');
                            $file = Input::file('file_name');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $data->file_path = 'public/storage/listening/'.date("Y")."/".date("m")."/".date("d")."/".$name;
                            $data->is_file   = TRUE;
                            $path = public_path('storage/listening/'.date("Y")."/".date("m")."/".date("d")."/");
                            $file->move($path,$name);
                        }
                        $data->save();
                        
                        $ans = "";
                        $attributes['question_id'] = $data->id;
                        
                        foreach($attributes['mc'] as $key => $value){
                            $setData = [
                                'question_id' => $data->id,
                                'choice'      => $value
                            ];
                            $mc = new MultipleChoice;
                            $mc->setAttributesFromJson($setData);
                            $mc->save();
                            if(isset($attributes['cb'][$key])){
                                $ans = $mc->id;
                            }
                        }

                        $attributes['mc_id'] = $ans;
                        $answer->setAttributesFromJson($attributes);
                        $answer->save();
                        AuditrailLog::saveData(user_info('email'),'create','questions | multiple choices | answers',[],$attributes);
                        
                        $response['notification'] = 'Create Data Successfully';
                        $response['status'] = 'success';
                    }else if($attributes['action'] == 'update'){
                        $data   = Question::find($attributes['id']);
                        
                        $data->setAttributesFromJson($attributes);
                        if(isset($attributes['is_file']) && !empty($attributes['file_name'])) {
                            if($data->file_path <> ""){
                                $file_path = base_path($data->file_path);
                                if(file_exists($file_path))
                                    unlink($file_path);
                            }
                            createdirYmd('public/storage/listening/');
                            $file = Input::file('file_name');
                            $name = str_random(20). '-' .$file->getClientOriginalName();
                            $data->file_path = 'public/storage/listening/'.date("Y")."/".date("m")."/".date("d")."/".$name;
                            $data->is_file   = TRUE;
                            $path = public_path('storage/listening/'.date("Y")."/".date("m")."/".date("d")."/");
                            $file->move($path,$name);
                        }else if(!isset($attributes['is_file'])){
                            if($data->file_path <> ""){
                                $file_path = base_path($data->file_path); 
                                if(file_exists($file_path))
                                    unlink($file_path);
                                    $data->file_path = NULL;
                                    $data->is_file = FALSE;
                            }
                        }
                        $data->save();
                        
                        $mc = MultipleChoice::where('question_id',$data->id)->delete();
                        $ans = "";
                        $attributes['question_id'] = $data->id;
                        
                        foreach($attributes['mc'] as $key => $value){
                            $setData = [
                                'question_id' => $data->id,
                                'choice'      => $value
                            ];
                            $mc = new MultipleChoice;
                            $mc->setAttributesFromJson($setData);
                            $mc->save();
                            if(isset($attributes['cb'][$key])){
                                $ans = $mc->id;
                            }
                        }
                        Answer::where('question_id',$data->id)->delete();
                        $answer = new Answer;
                        $attributes['mc_id'] = $ans;
                        $answer->setAttributesFromJson($attributes);
                        $answer->save();
                        
                        $temp_data = [
                            'question_id' => $data->id, 
                            'category_id' => $data->category_id, 
                            'point'       => $data->point, 
                            'answer_id'   => $answer->id, 
                        ];
                        $old_data = json_encode($temp_data);

                        AuditrailLog::saveData(user_info('email'),'update','questions | multiple choices | answers',$old_data,$attributes);

                        $response['notification'] = 'Update Data Successfully';
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
                $data   = Question::find($attributes['id']);
                $mc     = MultipleChoice::where('question_id',$data->id)->delete();
                $answer = Answer::where('question_id',$data->id)->first();
                
                $temp_data = [
                    'question_id' => $data->id, 
                    'category_id' => $data->category_id, 
                    'point'       => $data->point, 
                    'answer_id'   => $answer->id, 
                ];

                if($data->file_path <> ""){
                    $file_path = base_path($data->file_path);
                    if(file_exists($file_path))
                        unlink($file_path);
                }
                
                $old_data = json_encode($temp_data);
                AuditrailLog::saveData(user_info('email'),'delete','questions | multiple choices | answers',$old_data,[]);
                if( $data->delete() ){
                    $answer->delete();
                    $response['notification'] = 'Delete Data Successfully';
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
            errorLog($e);
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    /**
     * get datatable.
     *
     * @return mixed
     */
    public function getDatatables()
    {
        try
        {   
            $datatables = datatables(Question::getDatatables())
                ->addColumn('action', function ($data) {
                    $action = "";
                    $quote = "'";
                    $action = '
                        <a onclick="javascript:show_form_detail('.$quote.$data->id.$quote.')" class="btn btn-info btn-xs" title="View"><i class="fa fa-eye fa-fw"></i></a>
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
