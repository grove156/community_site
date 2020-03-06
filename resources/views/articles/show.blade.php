@extends('layouts.app')
@section('content')
  <div class="page-header">
    <h4>Forum<small> /{{ $article->title }}</small></h4>
  </div>
  <article>
    @include('articles.partial.article', compact('article'))
    <p>{!! markdown($article->content) !!}</p>
  </article>
  <div class="text-center action__article">
    <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-info">
      <i class="fa fa-pencil"></i> Edit article
    </a>

    <button class="btn btn-danger">
      <i class="fa fa-trash-o"></i> Delete
    </button>

    <a href="{{ route('articles.index') }}" class="btn btn-default">
      <i class="fa fa-list"></i> Article List
    </a>
  </div>
@stop
