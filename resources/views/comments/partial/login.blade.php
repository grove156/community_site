<div class="media link__login__comment">
  <div class="media-body">
    <h4 class="media-heading text-center">
      {!! trans('forum.comments.ask_login', ['url' => route('sessions.create', ['return' => urlencode($currentUser)])]) !!}
    </h4>
  </div>
</div>
