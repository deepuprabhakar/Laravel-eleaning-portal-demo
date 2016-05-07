<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AssignmentRequest;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Student;
use App\Assignment;
use Sentinel;
use File;
use Hashids;

class AssignmentsController extends Controller
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

    public function createAssignment(AssignmentRequest $request)
    {
        if($request->ajax())
        {
            $input = $request->all();
            $filepath = 'uploads/assignments';
            $extension = $request->file('file')->getClientOriginalExtension();
            $newFilename = str_slug($request->get('title'), "-").'.'.$extension;
            if(!(File::exists($filepath)))
            {
                File::makeDirectory($filepath, 0775, true);
            }            
            $request->file('file')->move($filepath, $newFilename);
            $input['file'] = $newFilename;
            Assignment::create($input);
            $response['data']['success'] = 'Saved Successfully';
            return $response;
        }
        
    }

    public function fetch(Request $request)
    {
        $subject = Hashids::connection('subject')->decode($request->get('subject'));
        $subject = Subject::find($subject)->first();
        $student = Student::where('user_id', Sentinel::getUser()->id)->first();
        $assignment = $subject->assignment()->where('student_id', $student->id)->get();
        $response = [];
        foreach ($assignment as $key => $value) {
            $response[$key]['no'] = $key+1;
            $response[$key]['title'] = $value->title;
            $response[$key]['score'] = $value->mark;
            $response[$key]['remarks'] = $value->remark;
            $id = Hashids::connection('assignment')->encode($value->id);
            $response[$key]['action'] = 
                '<div class="text-center"><form action="/assignment/'.$id.'" method="POST">'.csrf_field().'
                    <button type="submit" class="btn btn-danger btn-xs btn-flat btn-delete" id="deleteAssignment">Delete</button>          
                </form></div>';
        }
        $data['data'] = $response;
        return response()->json($data, 200);
    }
    public function destroy(Request $request, $id)
    {
        $id = Hashids::connection('assignment')->decode($id);
        $assignment = Assignment::find($id)->first();
        if($assignment->file != "")
        {
           if(File::exists('uploads/assignments/'.$assignment->file))
            {
            File::delete('uploads/assignments/'.$assignment->file);
            } 
        }
        if($request->ajax())
        {
            
             Assignment::destroy($id);
             $response['success'] = 'Assignment Deleted Successfully';
             return $response;   
        }

    }
}
