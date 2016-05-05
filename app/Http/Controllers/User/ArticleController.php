<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Articles;
use Auth;
use Session;
use Image;
use Carbon\Carbon;
use Hashids;
use sentinel;
use File;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['sentinel.auth', 'history']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser()->id;
        date_default_timezone_set('Asia/Kolkata');
        $articles = Articles::active()->get();
        foreach($articles as $item)
        {
            $item->date = $item->publish->format('d M. Y');
            $item->time = $item->publish->diffForHumans();
        }
        $articles = $articles->toArray();
        return view('user.viewArticles', compact('articles', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.createArticle');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = $request->file('article');
        $input = $request->all();
        $input['student_id'] = Sentinel::getUser()->id;
        if($request->hasFile('article')) 
        {
            $extension = $article->getClientOriginalExtension();
            $filename = str_slug($request->get('title'), "-").'-'.time().'.'.$extension;
            $filepath = 'uploads/articles';
            if(!(FILE::exists($filepath)))
            {
                File::makeDirectory($filepath, 0775, true);
            }            
            $request->file('article')->move($filepath, $filename);
            $input['article'] = $filename;
            $article = Articles::create($input);
        }
        else{
            Articles::create($input);
        }
        Session::flash('success','Article Added Successfully');
        return redirect(route('articles.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $article = Articles::with('author')->where('slug', $id)->first();
       return view('user.viewArticleDetails',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Articles::findBySlug($slug);
        if($article)
        {
            $article->hash = Hashids::connection('article')->encode($article->id);
            return view('user.editArticle', compact('article'));
        }
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($hash, ArticleRequest $request)
    {   
        date_default_timezone_set('Asia/Kolkata');
        $id = Hashids::connection('article')->decode($hash);
        $articles = Articles::find($id)->first();
        $article = $request->file('article');
        $input = $request->all();
        if($request->hasFile('article'))
        {
            $extension = $article->getClientOriginalExtension();
            $filename = str_slug($request->get('title'), "-").'-'.time().'.'.$extension;
            $filepath = 'uploads/articles';
            $request->file('article')->move($filepath, $filename);
            $input['article'] = $filename;
            File::delete($filepath.'/'.$articles['article']);
            $articles->update($input);
        }
        else
        {
           $articles = Articles::find($id)->first();
           $articles->update($input);
        }

        return redirect()->route('articles.edit', $articles->slug)->with('success', 'News updated succesfully'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Hashids::connection('article')->decode($id);
        $articles = Articles::find($id)->first();
        $filepath = 'uploads/articles';
        File::delete($filepath.'/'.$articles['article']);
        Articles::destroy($id);
        Session::flash('success', 'Article deleted!');
        return redirect()->route('articles.index');
    }
    /**
     * to remove file in edit
     *
     * @param      <type>  $id     (description)
     */
    public function deleteFile($id)
    {
        $id = Hashids::connection('article')->decode($id);
        $article = Articles::find($id)->first();
        $filename = $article->article;
        $filepath = 'uploads/articles';
        File::delete($filepath.'/'.$article['article']);
        $article->article = '';
        $article->save();
        return redirect()->back();
    }
        
}
