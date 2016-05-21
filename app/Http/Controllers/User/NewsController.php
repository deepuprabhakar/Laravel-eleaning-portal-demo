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
    public function newsView(Request $request)
    {
    	date_default_timezone_set('Asia/Kolkata');
    	$user = User::find(Sentinel::getUser()->id);
    	$student = $user->student->toArray();
        $news = News::orderBy('publish', 'desc')->where('audience', 'all')->orWhere('course', $student['course'])->where('batch', $student['batch'])->active()->Paginate(3);

        foreach($news as $item)
        {
            $item->date = $item->publish->format('d M, Y');
            $item->time = $item->publish->diffForHumans();
        }

        if($request->ajax()) {
            return [
                'news' => view('includes.news')->with(compact('news'))->render(),
                'next_page' => $news->nextPageUrl()
            ];
        }

        return view('user.news', compact('news'));
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

        