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
use Storage;
use Validator;

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
        if($request->hasFile('profilePic'))
        {
            /**
             * Validation
             */
            $rules = [
                'profilePic' => 'required|image|max:3000'
            ];

            $messages = [
                'profilePic.required' => 'Please select an image!',
                'profilePic.image' => 'Please select only image!',
                'profilePic.max' => 'Oops, maximum file size is 3MB!',
            ];

            $v = Validator::make($request->all(), $rules, $messages);

            if($v->fails())
            {
                return response()->json($v->errors(), 422);
            }
            else
            {
                $image = $request->file('profilePic');
                $ext = $image->getClientOriginalExtension();
                $img = Image::make($image);
                $filepath = 'uploads/profile/';
                $user = Student::where('user_id', Sentinel::getUser()->id)->first();
                $filename = $user->slug . '-'. time() .'.' . $ext;

                if(!(File::exists($filepath)))
                    File::makeDirectory($filepath, 0775, true);

                $img->resize(240, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->save($filepath . $filename);
                if($user->image != "")
                    File::delete($filepath . $user->image);
                $data = [];
                $data['image'] = $filename;
                $data['path'] = url('uploads/profile/' . $filename);
                $user->image = $filename;
                $user->save();

                return $data;
            }

            
        }

    }

    /**
     * Crop Profile Pic
     *
     * @param      Request  $request  (description)
     *
     * @return     <json>   ( description_of_the_return_value )
     */
    public function cropImage(Request $request)
    {   
        $user = Student::where('user_id', Sentinel::getUser()->id)->first();
        $image = $request->all();
        $img = Image::make('uploads/profile/'.$user->image);
        $filename = $img->filename . '-' . str_random(6) . '.' . $img->extension;
        $img->crop($image['w'], $image['h'], $image['x'], $image['y']);
        $img->save('uploads/profile/'.$filename);
        File::delete('uploads/profile/'.$user->image);
        $user->image = $filename;
        $user->save();
        
        $data['image'] = '<img src="'.url('uploads/profile/' . $filename).'">';
        $data['link'] = '<div><button type="button" value="' . $filename . '" class="btn btn-danger btn-flat btn-xs" id="remove-profile-photo">Remove Profile Photo</button></div>';
        $data['path'] = url('uploads/profile/' . $filename);
        return $data;
    }

    /**
     * Delete Profile Photo
     *
     * @param      Request  $request  (description)
     *
     * @return     <type>   ( description_of_the_return_value )
     */
    public function deleteProfilePhoto(Request $request)
    {
        $user = Student::where('user_id', Sentinel::getUser()->id)->first();
        $user->image = "";
        $user->save();
        if(File::exists('uploads/profile/'.$request->get('image')))
            File::delete('uploads/profile/'.$request->get('image'));
        $data['image'] = '<img src="' . url('dist/img/default-160x160.jpg') . '">';
        $data['path'] = url('dist/img/default-160x160.jpg');

        return $data;
    }
}
