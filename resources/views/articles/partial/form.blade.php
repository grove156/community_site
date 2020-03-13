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

<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
  <label for="tags">태그</label>
  <select class="form-control" name="tags[]" id="tags" multiple="multiple">
    @foreach($allTags as $tag)
      <option value="{{ $tag->id }}" {{ $article->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
        {{ $tag->name }}
      </option>
    @endforeach
  </select>
  {!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
</div>

{{-- <div class="form-group {{$errors->has('files') ? 'has-error' : ''}}">
  <label for="files">file</label>
  <input type="file" name="files[]" id="files" class="form-control" multiple="multiple">
  {!! $errors->first('files.0', '<span class="form-error">:message</span>') !!}
</div> --}}
<div class="form-group">
  <label for="my-dropzone">파일</label>
    <div id="my-dropzone" class="dropzone"></div>
</div>
@section('script')
  @parent
  <script>
      $("#tags").select2({
        placeholder: 'Please, select Tags(max:3)',
        maximumSelectionLength: 3
      });

      var form = $('form').first();
      Dropzone.autoDiscover = false;

      /* dropzone new instance*/
      var myDropzone = new Dropzone("div#my-dropzone",{
        url: '/attachments',
        paramName: 'files',
        maxFilesize: 3,
        acceptedFiles: '.jpg,.png,.zip,.tar',
        uploadMultiple: true,
        params:{
          _token: $('meta[name="csrf-token"]').attr('content'),
          article_id: '{{ $article->id }}'
        },
        dictDefaultMessage: '<div class="text-center text-muted">' +
        '<h2>Drag and Drop your file!</h2>' +
        '<p>(Or you can click here)</p></div>',
        dicFileToobig: 'Max file size is 3MB.',
        dictInvalidFileType: 'Only jpg, png, zip, tar types available.'
      });

      //dropzone event listener
      myDropzone.on('successmultiple', function(file, data){
        for(var i = 0, len=data.length; i<len; i++){
          $("<input>",{
            type:"hidden",
            name:"attachments[]",
            value: data[i].id
          }).appendTo(form);
        }
      });
  </script>
@stop
