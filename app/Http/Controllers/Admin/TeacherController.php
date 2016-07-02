<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Teacher;
use Sentinel;
use Session;
use Mail;
use Hash;
use Hashids;
use File;
use Form;

class TeacherController extends Controller
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
        $teachers = Teacher::get()->toArray();
        return view('admin.viewTeacher')->with(['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addTeacher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        $data = $request->all();
        $password = str_random(8);
        $credentials = [
            'email'    => $data['email'],
            'password' => $password,
            'first_name' => $data['firstname']
        ];
        $user = Sentinel::registerAndActivate($credentials);
        $role = Sentinel::findRoleByName('teacher');
        $role->users()->attach($user);
        $data['random'] = $password;
        Mail::send('emails.test', ['data' => $data], function ($m) use ($data) {
            $m->from('eltest@coheart.ac.in', 'E-Learning - Coheart');
            $m->to($data['email'], $data['firstname'])->subject('E-Learning Password');
        });
        $data['user_id'] = $user->id;
        $data = Teacher::create($data);
        Session::flash('success', 'Teacher details added!');
        return redirect(route('admin.teachers.create'));
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
        $teacher = Teacher::findBySlug($id)->toArray();
        if($teacher)
        {
            return view('admin.editTeacher', compact('teacher'));
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
    public function update(TeacherRequest $request, $id)
    {
        $id = Hashids::connection('teacher')->decode($id);
        $teacher = Teacher::find($id)->first();
        $data = $teacher->update($request->all());
        $user = Sentinel::findById($teacher->user_id);
        $user = Sentinel::update($user, ['first_name' => $teacher->firstname]);

        if($request->ajax())
        {
            $response['success'] = "Teacher details updated successfully.";
            return $response;
        }
        else
        {
            Session::flash('success', 'Teacher details updated successfully');
            return redirect()->route('admin.teachers.edit', $teacher->slug);
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
        $id = Hashids::connection('teacher')->decode($id);
        $teacher = Teacher::find($id)->first();
        $user = Sentinel::findById($teacher->user_id);
        $user->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher details deleted succesfully');  
    }
}
