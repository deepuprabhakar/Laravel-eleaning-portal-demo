<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Student;
use Sentinel;
use App\Subject;

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
        $this->middleware('sentinel.role:user');
    }
    /**
     * progress view
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index($id)
    {
        $semester = $id;
        $student = Student::where('user_id', Sentinel::getUser()->id)->select('id', 'name')->first();
    	$subjects = Subject::where('semester', $semester)->get();
        foreach ($subjects as $key => $subject) {
            $subject->discussion = $student->replyDiscussion()->where('subject_id', $subject->id)->select('id', 'created_at')->first();
            $subject->quizresult = $student->quizresult()->where('subject_id', $subject->id)->select('id', 'score')->first();
            $subject->assignment = $student->assignment()->where('subject_id', $subject->id)->select('id', 'mark')->first();
        }
        return view('user.progress', compact('subjects', 'semester'));
    }
}
