<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\TestCategoryRequest;
use App\Http\Controllers\Controller;
use App\TestCategory;
use Session;
use Hashids;

class TestController extends Controller
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
    	$categories = TestCategory::get()->toArray();
    	return view('admin.viewTestCategory')->with(['categories' => $categories]);

    }

    public function create()
    {
    	return view('admin.createTestCategory');
    }

    public function store(TestCategoryRequest $request)
    {
    	TestCategory::create($request->all());
    	Session::flash('success', 'Category Added Successfully.');
    	return redirect(route('admin.test.createcategory'));
    }

    public function edit($slug)
    {
    	$category = TestCategory::findBySlug($slug);
    	if($category)
    	{
    		$category->hash = Hashids::connection('category')->encode($category->id);
    		return view('admin.editTestCategory',compact('category'));
    	}
    	else
            abort(404);
    }
    public function update(TestCategoryRequest $request, $hash)
    {
    	 $id = Hashids::connection('category')->decode($hash);
    	 $category = TestCategory::find($id)->first();
    	 $category->update($request->all());
    	 Session::flash('success', 'Category Updated Successfully.');
    	 return redirect()->route('admin.test.editcategory',$category->slug);
    }

    public function destroy($id)
    {
        $id = Hashids::connection('category')->decode($id);
        TestCategory::destroy($id);
        Session::flash('success', 'Category deleted!');
        return redirect()->route('admin.test.category');
    }
}
