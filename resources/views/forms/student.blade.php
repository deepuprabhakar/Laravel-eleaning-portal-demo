<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="row">
    <div class="col-sm-6 form-group">
      {!! Form::label('name', 'Name') !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter student name']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('email', 'Email') !!}
      @if($flag)
        <span class="label label-danger">Email cannot be altered!</span>
        <div class="form-control">
          {{ $student['email'] }}
        </div>
       
      @else
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter email']) !!}
      @endif
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('gender', 'Gender') !!}
      <div>
        {!! Form::radio('gender', 'male', true, ['class' => 'flat-red', 'id' => 'male']) !!}
        <label for="male" style="cursor: pointer;"> Male</label>&nbsp;&nbsp;
        {!! Form::radio('gender', 'female', false, ['class' => 'flat-red', 'id' => 'female']) !!} 
        <label for="female" style="cursor: pointer;"> Female</label>
      </div>
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('admission', 'Admission number') !!}
      @if($flag)
        <span class="label label-danger">Admission number cannot be altered!</span>
        <div class="form-control">
          {{ $student['admission'] }}
        </div>

      @else
        {!! Form::text('admission', null, ['class' => 'form-control', 'id' => 'admission', 'placeholder' => 'Enter admission number']) !!}
      @endif
    </div>
    
    <div class="col-sm-6 form-group">
      {!! Form::label('course', 'Course') !!}
      {!! Form::select('course', [null => 'Select Course']+$courses, null, ['id' => 'courses', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('batch', 'Batch') !!}
      {!! Form::select('batch', [null => 'Select Batch'], null, ['id' => 'batch', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('dob', 'Date of Birth') !!}
      {!! Form::text('dob', null, ['id' => 'datepicker', 'class' => 'form-control', 'placeholder' => 'Enter date of birth']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('phone', 'Phone') !!}
      {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Enter phone number']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('address', 'Address') !!}
      {!! Form::textarea('address', null, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Enter address']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('qualification', 'Qualifications') !!}
      {!! Form::textarea('qualification', null, ['id' => 'qualification', 'class' => 'form-control', 'placeholder' => 'Enter qualification']) !!}
    </div>
  </div>
 </div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary student-button">{{ $button }}</button>
</div>