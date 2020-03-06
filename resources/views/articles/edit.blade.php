@extends('layouts.app')

@section('content')
  <div class="page-header">
    <h4>Forum <small>/edit article/ {{ $article->title }}</small></h4>
  </div>

  <form action="{{ route('articles.update', $article->id) }}" method="POST">
    {!! csrf_field() !!}
    {!! method_field('PUT') !!}

    @include('articles.partial.form')
    <div class="form-group">
      <button type="submit" class="btn btn-primary">{{ trans('forum.articles.update') }}</button>
    </div>
  </form>
@stop
