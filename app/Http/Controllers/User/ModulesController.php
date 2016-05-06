<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserDiscussionPromptRequest;
use App\Http\Controllers\Controller;
use Sentinel;
use App\Subject;
use App\Unit;
use App\DiscussionPrompt;
use App\Student;
use Hashids;
use App\ReplyDiscussion;

class ModulesController extends Controller
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
    
     
     public function index($id)
    {
        $semester = $id;
        $subjects = Subject::with('course')->where('semester', $semester)->get()->toArray();
        return view('user.viewSubjects', compact('subjects', 'semester'));
    }

    public function show($sem, $slug)
    {
    	if($subject = Subject::findBySlug($slug))
        {
            $course = $subject->course()->first();
            $units = $subject->unit;
            $discussion = $subject->discussionprompt;
            $quiz = $subject->quiz()->get()->random(5)->toArray();
            $user = Sentinel::getUser();
            $student = Student::where('user_id', $user->id)->get()->first();
            $discussions = ReplyDiscussion::with('student')->latest()->get();
            return view('user.viewSubjectDetails', compact('units', 'discussion', 'subject', 'course','student','discussions', 'quiz'));
        }
        else
            abort(404);
    }
    
    public function store($sem,$slug,  UserDiscussionPromptRequest $request)
    {
        ReplyDiscussion::create($request->all());
        if($request->ajax())
        {
            $response['data']['replies'] = ReplyDiscussion::with('student')->latest()->get()->toArray();
            $response['data']['success'] = 'Saved Successfully';
            return $response;
        }
        else
        {
            return redirect()->back()->with(['success' => 'Saved Successfully']);
        }
    }
}
