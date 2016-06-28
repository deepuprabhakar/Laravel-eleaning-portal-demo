<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserDiscussionPromptRequest;
use App\Http\Requests\AssignmentRequest;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Unit;
use App\DiscussionPrompt;
use App\Student;
use App\ReplyDiscussion;
use App\QuizResult;
use App\Assignment;
use Sentinel;
use Hashids;

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
        $student = Student::where('user_id', Sentinel::getUser()->id)->get()->first();
        $subjects = Subject::with('course')->where('semester', $semester)->where('course', $student->course)->where('batch', $student->batch)->get()->toArray();
        return view('user.viewSubjects', compact('subjects', 'semester'));

        $student = Student::where('user_id' , Sentinel::getUser()->id)->get()->first();
        $subjects = Subject::with('course')->where('semester', $semester)->where('course', $student->course)->where('batch', $student->batch)->get()->toArray();
       return view('user.viewSubjects', compact('subjects', 'semester'));

    }

    public function show($sem, $slug)
    {
    	if($subject = Subject::findBySlug($slug))
        {
            $course = $subject->course()->first();
            $units = $subject->unit;
            foreach ($units as  $unit) {
                $link = explode('/' ,$unit->video);
                $unit->video =$link[3];

            }
            $discussion = $subject->discussionprompt;
            $quizCount = $subject->quiz()->count();
            if($quizCount >= 5)
                $quiz = $subject->quiz()->get()->random(5)->toArray();
            else
                $quiz = NULL;
            $user = Sentinel::getUser();
            $student = Student::where('user_id', $user->id)->get()->first();
            $quizResult = $subject->quizresult()->where('student_id', $student->id)->first();
            $discussions = ReplyDiscussion::with('student')->latest()->get();
            $assignment = $student->assignment()->where('subject_id', $subject->id)->first();
            return view('user.viewSubjectDetails', compact('units', 'discussion', 'subject', 'course','student','discussions','assignment', 'quiz', 'quizResult'));
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
