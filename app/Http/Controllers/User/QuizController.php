<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Student;
use App\Subject;
use App\QuizResult;
use Hashids;
use Sentinel;

class QuizController extends Controller
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
    
    public function quiz()
    {
    	$quiz = Quiz::with('subject')->get();
    	return view('user.quiz', compact('quiz'));
    }

    public function store(Request $request)
    {
    	$input = $request->all();
        $count = count($input)-2;
    	$score = $i = 0;
    	if($count>2)
    	{
    		foreach ($input as $key => $value) 
    		{
    			if($i>1)
    			{
    				$id = Hashids::connection('quiz')->decode($key);
    				if(Quiz::where('id', $id)->where('answer', $input[$key])->first())
    					$score++;
    			}
    			$i++;
    		}
    	}
    	$response['result'] = '<div class="row"><div class="col-md-8 col-md-offset-2">
    							<div class="callout callout-success">
			                    <p style="font-size: 15px;">Attended: '.$count.'/5</p style="font-size: 15px;">
			                    <h4>Your score: '.$score.'/5</h4>
			                  </div></div></div>';
    	$data['student_id'] = Student::select('id')->where('user_id', Sentinel::getUser()->id)->first()->id;
    	$data['subject_id'] = Subject::select('id')->where('slug', $input['subject'])->first()->id;
    	$data['attended'] = $count;
    	$data['score'] = $score;
    	QuizResult::create($data);
    	return $response;
    }
}
