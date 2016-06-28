<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\SetQuestionRequest;
use App\Http\Controllers\Controller;
use App\SetQuestion;
use Session;
use Hashids;

class SetQuestionController extends Controller
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
    	$setquestions = SetQuestion::get()->toArray();
        return view('admin.viewSetQuestion')->with(['setquestions' => $setquestions]);

    }

    public function create()
    {
    	return view('admin.setQuestion');
    }

    public function store(Request $request)
    {
    	SetQuestion::create($request->all());
    	Session::flash('success', 'Question Settings Added Successfully.');
    	return redirect(route('admin.test.setquestion'));
    }

    public function edit($slug)
    {
    	$setquestion = SetQuestion::findBySlug($slug);
    	if($setquestion)
    	{
    		$setquestion->hash = Hashids::connection('setquestion')->encode($setquestion->id);
    		return view('admin.editSetQuestion',compact('setquestion'));
    	}
    	else
            abort(404);
    }
    public function update(Request $request, $hash)
    {
    	 $id = Hashids::connection('setquestion')->decode($hash);
    	 $setquestion = SetQuestion::find($id)->first();
    	 $setquestion->update($request->all());
    	 Session::flash('success', 'Question Settings Updated Successfully.');
    	 return redirect()->route('admin.test.editsetquestion',$setquestion->slug);
    }

    public function destroy($id)
    {
        $id = Hashids::connection('setquestion')->decode($id);
        SetQuestion::destroy($id);
        Session::flash('success', 'Set Question deleted!');
        return redirect()->route('admin.test.viewsetquestion');
    }
}
