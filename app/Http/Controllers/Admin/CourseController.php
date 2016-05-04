<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseInfoRequest;
use App\Course;
use App\CourseInfo;
use Session;
use Hashids;

class CourseController extends Controller
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
        $courses = Course::orderBy('title')->get();
        foreach ($courses as $course) {
            $course->hash = Hashids::connection('course')->encode($course->id);
        }
        return view('admin.viewCourses', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createCourse');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        date_default_timezone_set('Asia/Kolkata');
        if($request->ajax())
        {
            Course::create($request->all());
            $response['success'] = "Course added successfully.";
            return $response;
        }
        else
        {
            Course::create($request->all());
            Session::flash('success', 'Course added successfully.');
            return redirect(route('admin.courses.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findBySlug($id);
        $courseInfo = $course->courseinfo;
        return view('admin.courseInfo', compact('course', 'courseInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $course = Course::findBySlug($slug);
        if($course)
        {
            $course->hash = Hashids::connection('course')->encode($course->id);
            return view('admin.editCourse', compact('course'));
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
    public function update($hash, CourseRequest $request)
    {   
        date_default_timezone_set('Asia/Kolkata');
        $id = Hashids::connection('course')->decode($hash);
        if($request->ajax())
        {
            $course = Course::find($id)->first();
            $data = $course->update($request->all());
            $response['success'] = "Course updated successfully.";
            return $response;
        }
        else
        {
            $course = Course::find($id)->first();
            $data = $course->update($request->all());
            Session::flash('success', 'Course updated successfully');
            return redirect()->route('admin.courses.edit', $course->slug);
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
        $id = Hashids::connection('course')->decode($id);
        Course::destroy($id);
        Session::flash('success', 'Course deleted!');
        return redirect()->route('admin.courses.index');
    }

    /**
     *  store course information
     *
     * @param      <type>  $id     (description)
     */
    public function storeInfo(CourseInfoRequest $request, $id)
    {
        $course = Course::findBySlug($id);
        $courseInfo = $course->courseinfo;
        if($courseInfo)
        { 
            $data = $courseInfo->update($request->all());
            Session::flash('success', 'Course Info updated successfully.');
            return redirect()->back();    
        }
        else
        {
            $input = $request->all();
            $input['course_id'] = $course['id'];
            CourseInfo::create($input);
            Session::flash('success', 'Course Info added successfully.');
            return redirect()->back();   
        }
        
    }

}
