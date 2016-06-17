<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('title', 'News Title') !!}
     {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter news title']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('content', 'News Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content', 'placeholder' => 'Enter News Content']) !!}
  </div>
   <div class="form-group">
    {!! Form::label('publish', 'Publish Date') !!}
    <div class="input-group date">
      <div class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </div>
      @if($flag == true)
      {!! Form::text('publish', $publish, ['class' => 'form-control', 'id' => 'publish', 'placeholder' => 'Enter Publish Date']) !!}
      @else
      {!! Form::text('publish', date('m/d/Y'), ['class' => 'form-control', 'id' => 'publish', 'placeholder' => 'Enter Publish Date']) !!}
      @endif
    </div>
  </div>
  <div class="form-group">
    {!! Form::label('course', 'Audience') !!}
    {!! Form::select('course', [null => 'Select Course', '0' => 'All']+$courses, null, ['id' => 'courses', 'class' => 'form-control ', 'style' => 'width: 100%' ]) !!}
    {!! Form::hidden('audience', null, ['id' => 'audience']) !!}
  </div>
  <div class="form-group">
    {!! Form::select('batch', [null => 'Select Batch'], null, ['id' => 'batches', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('image', 'Image') !!}
    {!! Form::file('image', ['class' => 'form-control', 'id' => 'image', 'placeholder' => 'Upload Image']) !!}<br>

    @if($flag && $news['image'] != "")
     <div class="img-wrap" style="position: relative; display: inline-block;">
        {{ Html::image("uploads/news/thumbs/".$news['image'], 'image', ['class' => 'attachment-img']) }}
        <a href="{{ route('deleteImage', $news['hashid']) }}" class="btn bg-maroon margin delete-news-image">
          <i class="fa fa-close"></i>
        </a>
      </div>
    @endif 

  </div>
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary news-button">{{ $button }}</button>
</div>
