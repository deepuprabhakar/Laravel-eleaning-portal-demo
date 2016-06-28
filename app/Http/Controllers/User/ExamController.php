<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TestQuestion;
use App\SetQuestion;
class ExamController extends Controller
{
    public function exam()
    {
    	$questions = TestQuestion::get();
    	$setquestion = SetQuestion::get();
    	return view('user.viewExam', compact('questions'));
    }
}
