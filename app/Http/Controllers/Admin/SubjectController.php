<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SubjectRequest;
use App\Course;
use App\Subject;
use App\Student;
use App\Unit;
use App\Assignment;
use Session;
use Hashids;
use File;

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
        $subjectfile = $request->file('file');
        $input = $request->all();
        if($request->hasFile('file')) 
        {
            $extension = $subjectfile->getClientOriginalExtension();
            $filename = str_slug($request->get('name'), "-").'-'.time().'.'.$extension;
            $filepath = 'uploads/subjects';
            if(!(File::exists($filepath)))
            {
                File::makeDirectory($filepath, 0775, true);
            }            
            $request->file('file')->move($filepath, $filename);
            $input['file'] = $filename;
            $subject = Subject::create($input);
        }
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
        $subject = Subject::with('course')->with('discussionprompt','assignment')->where('slug', $id)->first()->toArray();
        $students = Student::where('course', $subject['course']['id'])->where('batch', $subject['batch'])->get()->first();
        $units = Unit::with('subject')->where('subject_id', $subject['id'])->get()->toArray();
        $assignments = Assignment::with('subject','student')->where('subject_id', $subject['id'])->get();
        return view('admin.viewSubjectDetails', compact('subject','units', 'assignments', 'students'));
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
        $subjectFile = $subject->file;
        $input = $request->all();
        $filepath = 'uploads/subjects';
            if($request->hasFile('file'))
            {
                File::delete($filepath.'/'.$subjectFile);
                $subjectfile = $request->file('file');
                $extension = $subjectfile->getClientOriginalExtension();
                $filename = str_slug($request->get('name'), "-").'-'.time().'.'.$extension;
                $input['file'] = $filename;
                $request->file('file')->move($filepath, $filename);
            }
            else
            {
                $ext = explode('.', $subject->file);
                $extension = $ext[1];
                $filename = str_slug($request->get('name'), "-").'-'.time().'.'.$extension;   
                $input['file'] = $filename;
            }
            $subject->update($input);
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
        $subject = Subject::find($id)->first();
        $filepath = 'uploads/subjects';
        File::delete($filepath.'/'.$subject['file']);
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
