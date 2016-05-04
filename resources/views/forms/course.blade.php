<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('title', 'Course Title') !!}
  @if($flag)
    <span class="label label-danger">Course title cannot be altered!</span>
    <div class="form-control ">
      {{ $course->title }}
    </div>
  @else
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter course title']) !!}
  @endif
  </div>
  <div class="form-group">
    {!! Form::label('semester', 'Number of Semesters') !!}
    {!! Form::text('semester', null, ['class' => 'form-control', 'id' => 'semester', 'placeholder' => 'Enter number of semesters']) !!}
  </div>
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary course-button">{{ $button }}</button>
</div>