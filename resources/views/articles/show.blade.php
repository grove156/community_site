@extends('layouts.app')
@section('content')
  <div class="page-header">
    <h4>Forum<small> /{{ $article->title }}</small></h4>
  </div>
  <article data-id="{{ $article->id }}">
    @include('articles.partial.article', compact('article'))

    <p>{{$article->content}}</p>
  </article>
  <div class="text-center action__article">
    @can('update', $article)
    <a href="{{ route('articles.edit',$article->id) }}" class="btn btn-info">
      <i class="fa fa-pencil"></i> Edit article
    </a>
    @endcan
    @can('delete', $article)
    <button class="btn btn-danger button__delete">
      <i class="fa fa-trash-o"></i> Delete
    </button>
    @endcan
    <a href="{{ route('articles.index') }}" class="btn btn-default">
      <i class="fa fa-list"></i> Article List
    </a>
  </div>
@stop

@section('script')
<script>
  $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('contnet')
    }
  });

  $('.button__delete').on('click',function(e) {
    var articleId = $('article').data('id');

    if (confirm('delete article.')){
      $.ajax({
        type: 'DELETE',
        url: '/articles/' + articleId
      }).then(function(){
        window.location.href = '/articles';
      });
    }
  });
</script>
@stop
