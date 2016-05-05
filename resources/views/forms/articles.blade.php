<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('title', 'Article Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter article title']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('content', 'Article Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content', 'placeholder' => 'Enter Unit Content']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('publish', 'Publish') !!}
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
    {!! Form::label('article', 'Article') !!}
    {!! Form::file('article', ['class' => 'form-control', 'id' => 'article']) !!}<br>
    @if($flag && $article['article'] != "")
        <a href="{{ url('uploads/articles', $article['article']) }}" class="btn btn-primary btn-sm" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  {{ $article['article'] }}</a>
        <a href="{{ route('deleteFile', $article->hash) }}" class="btn btn-primary btn-sm"><i class="fa fa-times"></i></a>
      @endif
  </div>
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary news-button">{{ $button }}</button>
</div>
