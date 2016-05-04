<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  @if($courseInfo)
  <div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', $courseInfo->content, ['class' => 'form-control', 'id' => 'content']) !!}
  </div>
  @else
	<div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content', 'placeholder' => 'Enter Content']) !!}
  </div>
  @endif
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary course-button">{{ $button }}</button>
</div>