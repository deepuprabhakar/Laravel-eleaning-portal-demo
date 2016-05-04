<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\GalleryRequest;
use App\Http\Controllers\Controller;
use Validator;
use File;
use Storage;
use App\Gallery;
use App\User;

class GalleryController extends Controller
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
    	$images = Gallery::latest()->take(15)->get();
    	return view('admin.gallery', compact('images'));
    }

    public function upload(Request $request)
    {
    	$files = $request->file('images');
    	$file_count = count($files);
    	$uploadcount = 0;

    	foreach($files as $file) {
    		$rules = ['file' => 'image'];
    		$messages = ['file.image' => 'Please select only images!'];
    		$validator = Validator::make(array('file'=> $file), $rules, $messages);
    		if($validator->passes()){
    			$destination = 'uploads/gallery';
    			if(!(Storage::exists($destination)))
    				$folder = Storage::makeDirectory($destination, 0775, true);
    			$filename = $file->getClientOriginalName();
    			$ext = $file->getClientOriginalExtension();
    			$filename = pathinfo($filename, PATHINFO_FILENAME).'-'.time().'.'.$ext;
    			$uploaded = $file->move($destination, $filename);
    			if($uploaded)
    			{
    				Gallery::create(['image' => $filename]);
    			}
    		}
    		else
    		{
    			return $validator->errors();
    		}
    	}
    	if($uploaded)
    	{
    		return Gallery::latest()->take(15)->get();
    	}
    }

    /**
     * Search through gallery
     */
    
    public function search(Request $request)
    {
        return Gallery::search($request->get('search'))->latest()->take(15)->get();
    }
}
