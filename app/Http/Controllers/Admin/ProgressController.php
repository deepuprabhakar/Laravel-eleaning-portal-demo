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
        return $subjects->lists('name', 'id');
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
        $students = Student::where('course', $course)->where('batch', $batch)->select('id', 'name')->get();
        $response = [];
        foreach ($students as $key => $student) {
            $response[$key]['no'] = $key+1;
            $response[$key]['name'] = $student->name;

            // Discussion result
            $discussion = $student->replyDiscussion()->where('subject_id', $subject)->select('id', 'created_at')->first();
            if(is_null($discussion))
                $response[$key]['discussion'] = '<div class="text-center">Not added yet!</div>';
            else
                $response[$key]['discussion'] = '<div class="text-center">5</div>';

            // Quiz
            $quizResult = $student->quizresult()->where('subject_id', $subject)->select('id', 'score')->first();
            if(is_null($quizResult))
                $response[$key]['quiz'] = '<div class="text-center">Not attended yet!</div>';
            else
            {
                $response[$key]['quiz'] = '<div class="text-center">'.$quizResult->score.'</div>';
            }

            // Assignment
            $assignment = $student->assignment()->where('subject_id', $subject)->select('id', 'mark')->first();
            if(is_null($assignment))
                $response[$key]['assignment'] = '<div class="text-center">Not added yet!</div>';
            else
            {
                if($assignment->mark == 0)
                    $response[$key]['assignment'] = '<div class="text-center">Added but not reviewed!</div>';
                else
                    $response[$key]['assignment'] = '<div class="text-center">'.$assignment->mark.'</div>';
            }

        }
        $data['data'] = $response;
        return response()->json($data, 200);
    }

}
