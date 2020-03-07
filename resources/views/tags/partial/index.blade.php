<p class="lead"> <i class="fa fa-tags"></i>Tags</p>
<ul class="list-unstyled">
  @foreach($allTags as $tag)
    <li {!! Str::contains(request()->path(), $tag->slug) ? 'class="active"':'' !!}>
      <a href="{{ route('tags.articles.index', $tag->slug) }}">
          {{ $tag->slug }}
          @if($count = $tag->articles->count())
              <span class="badge badge-default">{{$count}}</span>
          @endif
      </a>
    </li>
  @endforeach
</ul>
