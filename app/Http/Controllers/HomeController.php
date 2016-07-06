<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Sentinel;

use App\Course;

class HomeController extends Controller
{
	/**
	 * Contructor
	 */
	public function __construct()
    {
        // Middleware
        $this->middleware(['sentinel.auth', 'history']);
    }

	/**
	 * Index Function - Dashboard Management
	 */
	public function index()
	{
	    if(Sentinel::check())
	    {
	    	if(Sentinel::inRole('administrator'))
	    		return view('centaur.dashboard');
	    	else if(Sentinel::inRole('admin'))
	    		return view('admin.home');
	    	else if(Sentinel::inRole('user'))
	    		return view('user.home');
	    	else if(Sentinel::inRole('teacher'))
	    		return view('teacher.home');
	    }
	    else
	    	return redirect('/login');
	}
}
