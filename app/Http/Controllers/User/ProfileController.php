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

            $img->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });

            $img->save($filepath . $filename);
            if($user->image != "")
                File::delete($filepath . $user->image);
            $data = [];
            $data['image'] = '<img src="'.url($filepath . $filename).'">';
            $user->image = $filename;
            $user->save();
        }
        else
            $data['image'] = "";

        return $data;

    }

    public function cropImage(Request $request)
    {   
        $user = Student::where('user_id', Sentinel::getUser()->id)->first();
        $image = $request->get('image');
        $img = Image::make('uploads/profile/'.$user->image);
        $ext = explode('.', $user->image);
        $ext = end($ext);
        $filename = $user->slug . '-' . time() . '.' . $ext;
        $img->crop($image['width'], $image['height'], $image['x'], $image['y']);
        File::delete('uploads/profile/'.$user->image);
        $img->save('uploads/profile/'.$filename);
        $user->image = $filename;
        $user->save();
        
        $data['image'] = '<img src="'.url('uploads/profile/' . $filename).'">';
        $data['path'] = url('uploads/profile/' . $filename);
        return $data;
    }
}
