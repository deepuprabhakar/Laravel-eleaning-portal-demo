<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Subject;
use App\Student;
use App\User;
use App\Http\Requests\StudentRequest;
use Sentinel;
use Session;
use Mail;
use Hash;
use Hashids;

class StudentController extends Controller
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
        $students = Student::with('course')->get()->toArray();
        return view('admin.viewStudent')->with(['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addStudent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $data = $request->all();
        $password = str_random(8);
        $credentials = [
            'email'    => $data['email'],
            'password' => $password,
            'first_name' => $data['name']
        ];
        $user = Sentinel::registerAndActivate($credentials);
        $role = Sentinel::findRoleByName('user');
        $role->users()->attach($user);
        $data['random'] = $password;
        Mail::send('emails.test', ['data' => $data], function ($m) use ($data) {
            $m->from('lincyv@aidersolutions.in', 'Test');
            $m->to($data['email'], $data['name'])->subject('Testing');
        });
        $data['user_id'] = $user->id;
        $data = Student::create($data);
        Session::flash('success', 'Student details added!');
        return redirect(route('admin.students.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findBySlug($id)->toArray();
        if($student)
        {
            return view('admin.editStudent', compact('student'));
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
    public function update(StudentRequest $request, $hash)
    {
        $id = Hashids::connection('student')->decode($hash);
        $student = Student::find($id)->first();
        $data = $student->update($request->all());
        $user = Sentinel::findById($student->user_id);
        $user = Sentinel::update($user, ['first_name' => $student->name]);

        if($request->ajax())
        {
            $response['success'] = "Student details updated successfully.";
            return $response;
        }
        else
        {
            Session::flash('success', 'Student details updated successfully');
            return redirect()->route('admin.students.edit', $student->slug);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::connection('student')->decode($id);
        $student = Student::find($id)->first();
        $user = Sentinel::findById($student->user_id);
        $user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student details deleted succesfully');
    }
    /*
    List batch based on courses
    */
    
    public function fetchBatch(Request $request)
    {
        if($request->ajax())
        {
            $subject = Course::find($request->get('course'));
            return $subject->subject()->lists('batch', 'batch');
        }
    }
}
