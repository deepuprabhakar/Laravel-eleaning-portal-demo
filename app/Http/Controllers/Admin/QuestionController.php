<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TestQuestionRequest;
use App\Http\Controllers\Controller;
use App\TestQuestion;
use Session;
use Hashids;

class QuestionController extends Controller
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

    public function index()
    {
    	$questions = TestQuestion::get()->toArray();
        return view('admin.viewTestQuestion')->with(['questions' => $questions]);

    }

    public function create()
    {
    	return view('admin.createTestQuestion');
    }

    public function store(TestQuestionRequest $request)
    {

    	TestQuestion::create($request->all());
    	Session::flash('success', 'Question Added Successfully.');
    	return redirect(route('admin.test.createquestion'));
    }

    public function edit($slug)
    {
    	$question = TestQuestion::findBySlug($slug);
    	if($question)
    	{
    		$question->hash = Hashids::connection('question')->encode($question->id);
    		return view('admin.editTestQuestion',compact('question'));
    	}
    	else
            abort(404);
    }
    public function update(TestQuestionRequest $request, $hash)
    {
    	 $id = Hashids::connection('question')->decode($hash);
    	 $question = TestQuestion::find($id)->first();
    	 $question->update($request->all());
    	 Session::flash('success', 'Question Updated Successfully.');
    	 return redirect()->route('admin.test.editquestion',$question->slug);
    }

    public function destroy($id)
    {
        $id = Hashids::connection('question')->decode($id);
        TestQuestion::destroy($id);
        Session::flash('success', 'Question deleted!');
        return redirect()->route('admin.test.category');
    }
}
