<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Student;
use App\User;
use File;
use App\Projects;
use Session;
use Hashids;
use Validator;

class ProjectController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['sentinel.auth', 'history']);
        $this->middleware('sentinel.role:user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::where('user_id', Sentinel::getUser()->id)->first()->toArray();
        $project = Projects::where('student_id', $student['id'])->first();
        return view('user.viewProject', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $student = Student::where('user_id', Sentinel::getUser()->id)->first()->toArray();
        $project = Projects::where('student_id', $student['id'])->first();
        return view('user.createProject', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = Student::where('user_id', Sentinel::getUser()->id)->first();
        $input = $request->all();
        $filepath = 'uploads/projects';
        if($student->project()->count())
        {
            //update project & delete existing file
            $validator = Validator::make($request->all(), [
                        'topic' => 'required',
                        'description' => 'required',
                        'project' => 'mimes:pdf,doc,docx'

                    ]);
            if ($validator->fails()) 
            {
                return redirect(route('project.create'))->withErrors($validator)->withInput();
            }
            $project_id = $student->project()->first();
            if($request->hasFile('project'))
            {
                File::delete($filepath.'/'.$project_id->project);
                $project = $request->file('project');
                $extension = $project->getClientOriginalExtension();
                $filename = str_slug($request->get('topic'), "-").'-'.$student['name'].'-'.time().'.'.$extension;
                $input['project'] = $filename;
                $request->file('project')->move($filepath, $filename);
            }
            else
            {
                $ext = explode('.', $project_id->project);
                $extension = $ext[1];
                $filename = str_slug($request->get('topic'), "-").'-'.$student['name'].'-'.time().'.'.$extension;   
                $input['project'] = $filename;
            }
            $project = Projects::find($project_id->id)->first();
            $project->update($input);
            Session::flash('success','Project Updated Successfully');
        }
        else
        {   
            $validator = Validator::make($request->all(), [
                        'topic' => 'required',
                        'description' => 'required',
                        'project' => 'required|mimes:pdf,doc,docx'

                    ]);
            if ($validator->fails()) 
            {
                return redirect(route('project.create'))->withErrors($validator)->withInput();
            }
            //create project
            $input['batch'] = $student['batch'];
            $input['student_id'] = $student['id'];
            $input['course_id'] = $student['course'];
            if($request->hasFile('project'))
            {
                $project = $request->file('project');
                $extension = $project->getClientOriginalExtension();
                $filename = str_slug($request->get('topic'), "-").'-'.$student['name'].'-'.time().'.'.$extension;
                $input['project'] = $filename;
                
                if(!(FILE::exists($filepath)))
                {
                    File::makeDirectory($filepath, 0775, true);
                }            
                $request->file('project')->move($filepath, $filename);
            }
            $project = Projects::create($input);
            Session::flash('success','Project Added Successfully'); 
        }
        
        return redirect(route('project.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
