<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('name', 'Subject Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter subject name']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('batch', 'Batch') !!}
    @if($flag)
      <span class="label label-danger">Batch cannot be altered!</span>
      <div class="form-control ">
        {{ $subject['batch'] }}
      </div>
    @else
      {!! Form::text('batch', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter batch number']) !!}
    @endif
  </div>
  <div class="form-group">
    {!! Form::label('course', 'Course') !!}
    {!! Form::select('course', [null => 'Select Course']+$courses, null, ['id' => 'courses', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('semester', 'Semester') !!}
    {!! Form::select('semester', [null => 'Select Semester'], null, ['id' => 'semester', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('file', 'Subject File') !!}
    {!! Form::file('file', ['class' => 'form-control', 'id' => 'file', 'placeholder' => 'Upload File']) !!}<br>
    @if($flag && $subject['file'] != "")
        <a href="{{ url('uploads/subjects', $subject['file']) }}" class="btn btn-primary btn-sm" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  {{ $subject['file'] }}</a>
   @endif
  </div>
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary subject-button">{{ $button }}</button>
</div>