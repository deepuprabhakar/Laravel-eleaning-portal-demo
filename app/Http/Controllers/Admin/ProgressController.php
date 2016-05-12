<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Student;
use App\Assignment;
class ProgressController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['sentinel.auth', 'history']);
        $this->middleware('sentinel.role:admin');
    }

    /**
     * 
     * { progress view }
     */
    public function progress()
    {
        return view('admin.progress');
    }

    /**
     * fetch subject
     *
     * @param      Request  $request  (description)
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public function fetchSubjects(Request $request)
    {
        $course = $request->get('course');
        $batch = $request->get('batch');
        $subjects = Subject::where('course', $course)->where('batch', $batch)->get();
        return $subjects->lists('name','name');
    }

    /**
     * fetch progress
     *
     * @param      Request  $request  (description)
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public function fetchProgress(Request $request)
    {
        $course = $request->get('course');
        $batch = $request->get('batch');
        $subject = $request->get('subject');
        $students = Student::with('assignment','replyDiscussion','quizresult')->where('course', $course)->where('batch', $batch)->get();
        $response = [];
        foreach ($students as $key => $value) {
                      
                $response[$key]['no'] = $key+1;
                $response[$key]['name'] = $value->name;
                if(!is_null($value->replyDiscussion))
                $response[$key]['discussion'] = '<div class="text-center">'.'5'.'</div>';
                else
                $response[$key]['discussion'] = '<div class="text-center">'.'Not Added Yet'.'</div>';
                if(!is_null($value->quizresult))
                $response[$key]['quiz'] = '<div class="text-center">'.'Not Added Yet'.'</div>';
                else
                $response[$key]['quiz'] = '<div class="text-center">'.'Not Added Yet'.'</div>';
                if(!is_null($value->assignment))
                $response[$key]['assignment'] = '<div class="text-center">'.'Not Added Yet'.'</div>';
                else
                $response[$key]['assignment'] = '<div class="text-center">'.'Not Added Yet'.'</div>';
                
        }
        $data['data'] = $response;
        return response()->json($data, 200);
    }

}
