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
        $student = Student::where('user_id', Sentinel::getUser()->id)->first();
        $input = $request->all();
        $filepath = 'uploads/assignments';
        $assignment = $student->assignment()->first();
        if($student->assignment()->count())
        {
            if($request->hasFile('file'))
            {
                File::delete($filepath.'/'.$assignment->file);
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename =  str_slug($request->get('title'), "-").'.'.$extension;
                $input['file'] = $filename;
                $request->file('file')->move($filepath, $filename);
            }
            else
            {
                $ext = explode('.', $assignment->file);
                $extension = $ext[1];
                $filename = str_slug($request->get('title'), "-").'.'.$extension;   
                $input['file'] = $filename;
            }
            $assignment = Assignment::find($assignment->id)->first();
            $assignment->update($input);
            $response['data']['success'] = 'Assignment Created Successfully';
            return $response;
        }
        else
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
            $response['data']['success'] = 'Assignment Updated Successfully';
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
            
        }
        $data['data'] = $response;
        return response()->json($data, 200);
    }
   
}
