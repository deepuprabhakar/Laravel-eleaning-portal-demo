<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UnitRequest;
use App\Http\Controllers\Controller;
use Hashids;
use Session;
use App\Unit;
use App\Subject;
use App\Gallery;


class UnitsController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug, $hash)
    {
        $data = array('hashid' => $hash, 'slug' => $slug);
        $images = Gallery::latest()->take(15)->get();
        return view('admin.createUnit', compact('data', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {

        if($request->ajax())
        {
            $data = array('hashid' => $request->subject_id);
            Unit::create($request->all());
            $response['success'] = "Unit added successfully.";
            return $response;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::findBySlug($id);
        $subject = $unit->subject;
        return view('admin.unitview', compact('unit','subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::findBySlug($id);
        if($unit)
        {
            $subject = $unit->subject;
            $unit = $unit->toArray();
            return view('admin.editUnit', compact('unit', 'subject'));
        }
        else{

            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        $id = Hashids::connection('unit')->decode($id);

        $unit = Unit::find($id)->first();
        $data = $unit->update($request->all());

        
        if($request->ajax())
        {
            $response['success'] = "Unit updated successfully.";
            return $response;
        }
        else
        {
            Session::flash('success', 'Unit updated successfully.');
            return redirect()->route('admin.units.edit', $unit->slug);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
       $id = Hashids::connection('unit')->decode($id);
       $unit = Unit::find($id);
       if($request->ajax())
       {
            unit::destroy($id);
            $response['success'] = "Unit deleted successfully.";
            return $response;
       }
       else
        {
            Unit::destroy($id);
            Session::flash('success','Unit Deleted Successfully');
            return redirect()->back();
        }
       


    }
}
