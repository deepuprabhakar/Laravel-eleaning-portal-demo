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
use Image;
use File;

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

    /**
     * Upload Profile Pic
     *
     * @param      Request  $request  (description)
     */
    public function uploadProfilePic(Request $request)
    {
        if($request->hasFile('profile-pic'))
        {
            $image = $request->file('profile-pic');
            $ext = $image->getClientOriginalExtension();
            $img = Image::make($image);
            $filepath = 'uploads/profile/';
            $user = Student::where('user_id', Sentinel::getUser()->id)->first();
            $filename = $user->slug . '-' . time() . '.' . $ext;

            if(!(File::exists($filepath)))
                File::makeDirectory($filepath, 0775, true);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save($filepath . $filename);
            $data = [];
            $data['image'] = '<img src="'.url($filepath . $filename).'">';
        }
        else
            $data['image'] = "";

        return $data;

    }

    public function cropImage(Request $request)
    {   
        //dd($request->get('path'));
        $image = $request->get('image');
        $img = Image::make(file_get_contents('uploads/profile/deepu-prabhakar-1463150942.jpg'));
        $img->crop(100, 100, 25, 25);
        $img->save('uploads/profile/deepu-prabhakar-1463150942.jpg');
    }
}
