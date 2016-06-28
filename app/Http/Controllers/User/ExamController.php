<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TestQuestion;
use App\SetQuestion;
use App\Student;
use App\ExamResult;
use Sentinel;
use Hashids;

class ExamController extends Controller
{
    public function exam()
    {
    	$questions = TestQuestion::get();
    	//dd($questions);
    	$setquestion = SetQuestion::get()->first()->toArray();
    	//dd($setquestion);
    	$user = Sentinel::getUser();
    	$student = Student::where('user_id', $user->id)->get()->first();
    	$examResult =ExamResult::where('student_id', $student->id)->first();
    	return view('user.viewExam', compact('questions','setquestion','examResult'));
    }
    public function store(Request $request)
    {
    	$input = $request->all();
    	//dd($input);
        $count = count($input)-2;
    	$score = $i = 0;
    	if($count>2)
    	{
    		foreach ($input as $key => $value) 
    		{
    			if($i>1)
    			{
    				$id = Hashids::connection('question')->decode($key);
    				//dd($id);
    				if(TestQuestion::where('id', $id)->where('answer', $input[$key])->first())
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
    	$data['attended'] = $count;
    	$data['score'] = $score;
    	ExamResult::create($data);
    	return $response;
    }
   
}
