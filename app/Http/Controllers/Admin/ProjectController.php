<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Projects;
use App\Student;
use Hashids;

class ProjectController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware(['sentinel.auth', 'history']);
        $this->middleware('sentinel.role:admin');
    }

    /**
     * 
     * view projects
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function viewProjects()
    {
    	return view('admin.viewProject');
    }

    /**
     * fetch projects
     *
     * @param      Request  $request  (description)
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public function fetchProjects(Request $request)
    {
        $course = $request->get('course');
        $batch = $request->get('batch');
        $students = Student::with('project')->where('course', $course)->where('batch', $batch)->get();
        $response = [];
        foreach ($students as $key => $value) {
            if(!is_null($value->project)){
                $response[$key]['no'] = $key+1;
                $response[$key]['name'] = $value->name;
                $response[$key]['topic'] = str_limit($value['project']['topic'],40);
                $response[$key]['project'] = '<div class="text-center"><a href="/uploads/projects/'.$value['project']['project'].'" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i> Download</a></div>';
                $id = Hashids::connection('project')->encode($value['project']['id']);
                $response[$key]['score'] = '<input type="hidden" name="project'.$key.'" value="'.$id.'"><div class="text-center"><input type="text" class=" text-center form-control score" name="score-'.$key.'" value="'.$value['project']['score'].'"></div>';
                $response[$key]['remarks'] ='<input type="text" class="form-control remarks" name="remarks-'.$key.'" value="'.$value['project']['remarks'].'">';
                $response[$key]['action'] = '<div class="text-center"><button type="submit" class="btn bg-blue btn-sm btn-flat save-button">Save</button></div>';
            }
        }
        $data['data'] = $response;
        return response()->json($data, 200);
    }

    /**
     * save score and remarks
     *
     * @param      <type>  $id     (description)
     */
    public function saveMarks(Request $request)
    {
        if($request->ajax())
        {
            $id = Hashids::connection('project')->decode($request->get('project'));
            $project = Projects::find($id)->first();
            $project['score'] = $request->get('score');
            $project['remarks'] = $request->get('remarks');
            $project->save();
            $response['data']['success'] = 'Marks Added Successfully';
            return $response;
        }
    }
    
}
