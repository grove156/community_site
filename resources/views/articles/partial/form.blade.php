<div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
  <label for="title">title</label>
  <input type="text" name="title" id="title" value="{{ old('title', $article->title ?? '') }}" class="form-control"/>
  {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
  <label for="content">content</label>
  <textarea name="content" id="content" rows="10" class="form-control">{{old('content', $article->content ?? '')}}</textarea>
  {!! $errors->first('content','<span class="form-error">:message</span>') !!}
</div>
