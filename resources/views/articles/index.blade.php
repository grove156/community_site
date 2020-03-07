@extends('layouts.app')

@section('content')
  <div class="page-header">
    <h4>forum<small> /article lists</small></h4>
  </div>
  <div class="text-right">
    <a href="{{ route('articles.create') }}" class="btn btn-primary">
      <i class="fa fa-plus-circle"></i> Writing article</a>
  </div>
  <div class="col-md-3">
    <aside>
      @include('tags.partial.index')
    </aside>
  </div>
  <div class="col-md-9">
    <article>
      @forelse($articles as $article)
        @include('articles.partial.article', compact('article'))
      @empty
      <p class="text-center text-danger">Opps, No articles!</p>
      @endforelse
    </article>
  </div>
  @if($articles->count())
    <div class="text-center">
      {!! $articles->appends(Request::except('page'))->render() !!}
    </div>
  @endif
@stop
