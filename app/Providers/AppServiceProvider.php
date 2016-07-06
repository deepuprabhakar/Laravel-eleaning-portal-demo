<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Course;
use App\News;
use Carbon\Carbon;
use Sentinel;
use App\User;
use App\Articles;
use App\Student;
use App\TestCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('forms.subject', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });

        view()->composer('forms.news', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });

        view()->composer('forms.student', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });

        view()->composer('forms.teacher', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });

        view()->composer('admin.viewProject', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });
        view()->composer('admin.viewStudent', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });
        view()->composer('admin.progress', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });
        view()->composer('teacher.attendance', function($view)
        {
            $courses = Course::all()->lists('title', 'id')->toArray();
            asort($courses);
            $view->with('courses', $courses);
        });
        view()->composer('forms.articles', function($view)
        {
            $articles = Articles::all()->lists('title', 'id')->toArray();
            asort($articles);
            $view->with('courses', $articles);
        });
        view()->composer('forms.testquestion', function($view)
        {
            $category = TestCategory::all()->lists('name', 'id')->toArray();
            asort($category);
            $view->with('category', $category);
        });
         view()->composer('forms.setquestion', function($view)
        {
            $category = TestCategory::all()->lists('name', 'id')->toArray();
            asort($category);
            $view->with('category', $category);
        });
        view()->composer('includes.sideNews', function($view)
        {
            $latest = News::published()->orderBy('publish', 'desc')->take(5)->get();
            $view->with('latest', $latest);
        });
         view()->composer('includes.sideArticles', function($view)
        {
            $latest = Articles::published()->orderBy('publish', 'desc')->take(5)->get();
            $view->with('latest', $latest);
        });
        view()->composer('includes.sideNewsUser', function($view)
        {
            $user = User::find(Sentinel::getUser()->id);
            $student = $user->student->toArray();
            $latest = News::published()->orderBy('publish', 'desc')->where('audience', 'all')->orWhere('course', $student['course'])->where('batch', $student['batch'])->take(5)->get();
            $view->with('latest', $latest);
        });
        view()->composer('includes.sidebar', function($view)
        {
            $user = Sentinel::getUser();
            $count = User::find($user->id)->messages()->where('status', 0)->count();
            $view->with('count', $count);
        });
        view()->composer('includes.header', function($view)
        {
            $user = Sentinel::getUser();
            $student = Student::where('user_id', $user->id)->first();
            $latest = User::find($user->id)->messages()->with('user')->latest()->take(5)->get()->toArray();
            $count = User::find($user->id)->messages()->where('status', 0)->count();
            $view->with(['count' => $count, 'latest' => $latest, 'student' => $student]);
        });
        view()->composer('includes.userSidebar', function($view)
        {
            $student = Student::where('user_id', Sentinel::getUser()->id)->first();
            $course = $student->course()->select('semester','slug')->first();
            $user = Sentinel::getUser();
            $count = User::find($user->id)->messages()->where('status', 0)->count();
            $view->with(['course' => $course, 'count' => $count, 'student' => $student]);
        });

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
