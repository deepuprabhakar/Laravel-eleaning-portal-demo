<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AdminAssignmentRequest;
use App\Http\Controllers\Controller;
use App\Assignment;
use Hashids;

class AssignmentController extends Controller
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

    public function create(AdminAssignmentRequest $request, $id)
    {
    	
    	$id = Hashids::connection('assignment')->decode($id);
    	$assignment = Assignment::find($id)->first();
    	$assignment['mark'] = $request->mark;
    	$assignment['remark'] = $request->remark;
    	if($request->ajax())
    	{
    		$assignment->save();
    		$response['success'] = "Assignment Saved successfully.";
            return $response;
    	}

    }
}
