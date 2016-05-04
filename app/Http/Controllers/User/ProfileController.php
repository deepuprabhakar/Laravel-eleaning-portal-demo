<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use App\User;
use App\Http\Requests\ProfileRequest;
use Hashids;
use App\Student;
use App\Course;

class ProfileController extends Controller
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
    /**
     * profile view
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function profileView()
    {
        $user = User::find(Sentinel::getUser()->id);
    	$student = $user->student->toArray();
        $course = Course::find($student['course'])->toArray();
        return view('user.profile',compact('student', 'course'));
    }

    public function update(ProfileRequest $request, $id)
    {
        $user = User::find(Sentinel::getUser()->id);
        $id = Hashids::connection('student')->decode($id);
    	$student = Student::find($id)->first();
        $input = $request->all();
        $data = $student->update($input);
        $user['first_name'] = $input['name'];
        $user->save();
    	return redirect()->route('profile')->with('success', 'Profile updated succesfully!');
    }
}
