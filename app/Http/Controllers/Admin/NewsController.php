<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\NewsRequest;
use App\News;
use App\Course;
use Session;
use Image;
use Hashids;
use File;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware(['sentinel.auth', 'history']);
        $this->middleware('sentinel.role:admin');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Kolkata');
        $news = News::orderBy('publish', 'desc')->get();
        foreach($news as $item)
        {
            $item->date = $item->publish->format('d M, Y');
            $item->time = $item->publish->diffForHumans();
        }
        $news = $news->toArray();
        return view('admin.viewNews', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createNews');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {

        date_default_timezone_set('Asia/Kolkata');
        $image = $request->file('image');
        if($request->hasFile('image'))
        {
            $extension = $image->getClientOriginalExtension();
            $filename = str_slug($request->get('title'), "-").'-'.time().'.'.$extension;
            $filepath = 'uploads/news/';

            $img = Image::make($image);
            // Save Original Image
            $img->resize(770, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            if(!(FILE::exists($filepath)))
            {
                File::makeDirectory($filepath,  0775, true);
            }
            $img->save($filepath.$filename);

            // Generate thumbnail
            $img->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $file_new_path = $filepath.'thumbs/';
            
            if(!(FILE::exists($file_new_path)))
            {
                File::makeDirectory($file_new_path,  0775, true);
            }
            $img->save($file_new_path.$filename);
            
            $input = $request->all();
            $input['image'] = $filename;
            $news = News::create($input);
        }
        else{
            News::create($request->all());
        }
        Session::flash('success','News Added Successfully');
        return redirect(route('admin.news.create'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $news = News::findBySlug($id);
       return view('admin.viewNewsDetails',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $news = News::findBySlug($id);
       if($news)
       {
            $news = $news->toArray();
            $publish = new Carbon($news['publish']);
            $publish = $publish->format('m/d/Y');
            return view('admin.editNews',compact('news', 'publish'));
       }
       else
       {
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
    public function update(NewsRequest $request, $id)
    {
        date_default_timezone_set('Asia/Kolkata');
        $id = Hashids::connection('news')->decode($id);
        $news = News::find($id)->first();
        $image = $request->file('image');
        if($request->hasFile('image'))
        {
           $extension = $image->getClientOriginalExtension();
           $filename = str_slug($request->get('title'), "-").'-'.time().'.'.$extension;
           $filepath = 'uploads/news';

            $img = Image::make($image);
            // Save Original Image
            $img->resize(770, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($filepath.'/'.$filename);

            // Generate thumbnail
            $img->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($filepath.'/thumbs/'.$filename);
            $input = $request->all();
            $input['image'] = $filename;
            File::delete($filepath.'/thumbs/'.$news['image']);
            File::delete($filepath.'/'.$news['image']);
            $news->update($input);
        }
        else
        {
           $news = News::find($id)->first();
           $news->update($request->all());
        }

        return redirect()->route('admin.news.edit', $news->slug)->with('success', 'News updated succesfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::connection('news')->decode($id);
        $news = News::find($id)->first();
        if($news->image != "")
            if(File::exists('uploads/news/'.$news->image))
            {
                File::delete('uploads/news/thumbs/'.$news->image);
                File::delete('uploads/news/'.$news->image);
            }
        $news->delete();
        Session::flash('success', 'News deleted!');
        return redirect()->route('admin.news.index');
    }

    /**
     * Fetch Batch by Ajax
     */
    
    public function fetchBatch(Request $request)
    {
        if($request->ajax())
        {
            $subject = Course::find($request->get('course'));
            return $subject->subject()->lists('batch', 'batch');
        }
    }

    /**
     * to remove file in edit
     *
     * @param      <type>  $id     (description)
     */
    public function deleteImage($id)
    {
        $id = Hashids::connection('news')->decode($id);
        $news = News::find($id)->first();
        $filename = $news->image;
        $filepath = 'uploads/news';
        File::delete($filepath.'/'.$news['image']);
        $news->image = '';
        $news->save();
        return redirect()->back();
    }
}
