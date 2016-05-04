<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DiscussionPromptRequest;
use App\Http\Controllers\Controller;
use App\DiscussionPrompt;
use Hashids;

class DiscussionPromptController extends Controller
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
    
    public function create(DiscussionPromptRequest $request)
    {
        if($request->ajax())
        {
            $discussion = DiscussionPrompt::find(Hashids::connection('subject')->decode($request->get('subject_id')))->first();
            if($discussion)
            {
                $discussion->update($request->all());
            }
            else
            {
                DiscussionPrompt::create($request->all());
            }
            $response['success'] = 'Saved Successfully';
            return $response;
        }
    }
}
