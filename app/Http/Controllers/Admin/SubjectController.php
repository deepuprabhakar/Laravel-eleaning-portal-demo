<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SubjectRequest;
use App\Course;
use App\Subject;
use App\Unit;
use App\Assignment;
use Session;
use Hashids;

class SubjectController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('course')->orderBy('name')->get()->toArray();
        return view('admin.viewSubjects')->with(['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createSubject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectRequest $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        Subject::create($request->all());
        Session::flash('success', 'Subject added successfully.');
        return redirect(route('admin.subjects.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::with('course')->with('discussionprompt')->where('slug', $id)->first()->toArray();
        $units = Unit::with('subject')->where('subject_id', $subject['id'])->get()->toArray();
        $assignments = Assignment::with('subject','student')->where('subject_id', $subject['id'])->get()->toArray();
        return view('admin.viewSubjectDetails', compact('subject','units', 'assignments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::findBySlug($id);
        if($subject)
        {
            $subject = $subject->toArray();
            return view('admin.editSubject', compact('subject'));
        }
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectRequest $request, $id)
    {
        $id = Hashids::connection('subject')->decode($id);
        $subject = Subject::find($id)->first();
        $subject->update($request->all());
        return redirect()->route('admin.subjects.edit', $subject->slug)->with('success', 'Subject updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::connection('subject')->decode($id);
        Subject::destroy($id);
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted succesfully');
    }

    /**
     * Fetch Semesters on Ajax
     */
    public function fetchSem(Request $request)
    {
        if($request->ajax())
        {
            $id = Hashids::connection('course')->decode($request->get('course'));
            return Course::where('id', $request->get('course'))->lists('semester');
        }
    }
}
