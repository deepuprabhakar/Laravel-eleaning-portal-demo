<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\QuizRequest;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Subject;
use Hashids;
use Response;
use Session;

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
        $this->middleware('sentinel.role:admin');
    }
    
    public function index($slug)
    {
        $subject = Subject::findBySlug($slug);
        $quizzes = $subject->quiz->toArray();
        return view('admin.viewQuiz')->with(['quizzes' => $quizzes, 'subject' => $subject]);
    }
    public function create(QuizRequest $request)
    {
        
    	if($request->ajax())
    	{
    		if(1)
            {
                Quiz::create($request->all());
                $response['success'] = 'Created Successfully';
                return $response;
            }
            else
            {
                $response['errors'] = 'Only 10 Questions be allowed!';
                return Response::json($response, 422);
            }
            
    	}

    }

    public function destroy($id)
    {
        $id = Hashids::connection('quiz')->decode($id);
        Quiz::destroy($id);
        return redirect()->back()->with('success', 'Quiz deleted succesfully');
        //$subject = Subject::find($id)->first()->toArray();
        //return redirect()->route('admin.quiz.index',$subject['slug'])->with('success', 'Quiz deleted succesfully');
    } 

    public function edit($id)
    {
        $id = Hashids::connection('quiz')->decode($id);
        $quiz = Quiz::with('subject')->where('id', $id)->first()->toArray();
        $subject = Subject::find($id)->first();
        return view('admin.editQuiz')->with(['quiz' => $quiz]);
    }

    public function update($id, QuizRequest $request)
    {
        $id = Hashids::connection('quiz')->decode($id);
        $quiz = Quiz::find($id)->first();
        $data = $quiz->update($request->all());
        if($request->ajax())
        {
            $response['success'] = 'Updated Successfully';
            return $response;
        }
        else
        {
            Session::flash('success','Quiz Updated Successfully');
            return redirect()->route('admin.quiz.edit', $quiz['hashid'])->with('success', 'Quiz Updated Successfully');
        }
    }
    
}
