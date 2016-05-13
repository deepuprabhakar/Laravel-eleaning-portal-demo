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
    	$student = Student::with('assignment', 'replyDiscussion', 'quizresult')->where('user_id', Sentinel::getUser()->id)->get()->first()->toArray();
    	$subject = Subject::where('course', $student['course'])->where('batch', $student['batch'])->where('semester', $semester)->get();
    	return view('user.progress',compact('subject','student'));
    }
}
