<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use App\User;
use App\Course;

class CourseInfoController extends Controller
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
     * Display course information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Sentinel::getUser()->id);
        $student = $user->student->toArray();
        $course = Course::find($student['course']);
        $courseInfo = $course->courseinfo;
        return view('user.courseInfo', compact('course', 'courseInfo'));
    }
}
