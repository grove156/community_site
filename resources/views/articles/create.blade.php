@extends('layouts.app')

@section('content')
  <div class="page-header">
    <h4>forum <small>/Create article</small></h4>
  </div>
  <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="form__article">
    {!! csrf_field() !!}
    @include('articles.partial.form')

    <div class="form-group text-center">
      <button type="submit" class="btn btn-primary">
        Save
      </button>
    </div>
  </form>
@stop
