<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use App\User;
use App\Course;
use App\News;
use Sentinel;


class NewsController extends Controller
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
	 * to view news
	 */
    public function newsView()
    {
    	date_default_timezone_set('Asia/Kolkata');
    	$user = User::find(Sentinel::getUser()->id);
    	$student = $user->student->toArray();
        $news = News::orderBy('publish', 'desc')->where('audience', 'all')->orWhere('course', $student['course'])->where('batch', $student['batch'])->active()->get();

    	foreach($news as $item)
        {
            $item->date = $item->publish->format('d M, Y');
            $item->time = $item->publish->diffForHumans();
        }
        $news = $news->toArray();
    	return view('user.news',compact('news'));
    }

    /**
     * to view individual news
     */
    public function newsShow($id)
    {
    	$news = News::findBySlug($id);
        return view('user.viewNews',compact('news'));
    }
}

        