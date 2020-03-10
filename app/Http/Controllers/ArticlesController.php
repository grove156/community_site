<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Article;
class ArticlesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null)
    {
        $query = $slug ? \App\Tag::whereSlug($slug)->firstOrFail()->articles() : new \App\Article;
        $articles = $query->latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $article = new Article;
        return view('articles.create', compact('article'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\ArticlesRequest $request, Article $article)
    {

        //$article = $user->articles()->create(
        //    $request->getPayload()
        //  );
        if(! $article){
          flash()->error(
            trans('forum.article.error_writing')
          );
          return back()->withInput();
        }

//        if($request->hasFile('files')){
//          $files = $request->file('files');
//
//          foreach($files as $file)
//          {
//            $filename = Str::random(). filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
//            $file->move(attachments_path(), $filename);
//            $article->attachments()->create([
//              'filename' => $filename,
//              'bytes'=> $file->getSize();
//              'mime'=> $file->getClientMimeType();
//            ]);
//          }
//        }

        // 태그 싱크
        $article = $request->user()->articles()->create($request->all());
        $article->tags()->sync($request->input('tags'));
      //  $article->save();

      //  return redirect('articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Article $article)
    {
        //
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ArticlesRequest $request, \App\Article $article)
    {
        $article->update($request->all());
        $article->tags()->sync($request->input('tags'));
        flash()->success('Saved your article!');

        return redirect(route('articles.show', $article->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Article $article)
    {
        //
        $this->authrize('delete', $article);
        $article->delete();
        return response()->json([], 204);
    }
}
