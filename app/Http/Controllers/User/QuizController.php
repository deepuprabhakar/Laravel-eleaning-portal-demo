<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;

class QuizController extends Controller
{
    public function quiz()
    {
    	$quiz = Quiz::with('subject')->get();
    	return view('user.quiz', compact('quiz'));
    }
}
