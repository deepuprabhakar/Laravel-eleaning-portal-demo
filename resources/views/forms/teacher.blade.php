<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="row">
    <div class="col-sm-6 form-group">
      {!! Form::label('firstname', 'First Name') !!}
      {!! Form::text('firstname', null, ['class' => 'form-control', 'id' => 'firstname', 'placeholder' => 'Enter first name']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('lastname', 'Last Name') !!}
      {!! Form::text('lastname', null, ['class' => 'form-control', 'id' => 'lastname', 'placeholder' => 'Enter last name']) !!}
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
      {!! Form::label('email', 'Email') !!}
      @if($flag)
        <span class="label label-danger">Email cannot be altered!</span>
        <div class="form-control">
          {{ $teacher['email'] }}
        </div>
       
      @else
        {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Enter email']) !!}
      @endif
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('salary', 'Salary') !!}
      {!! Form::text('salary', null, ['class' => 'form-control', 'id' => 'salary', 'placeholder' => 'Enter salary']) !!}
    </div>
    
    <div class="col-sm-6 form-group">
      {!! Form::label('join', 'Date of Joining') !!}
      {!! Form::text('join', null, [ 'class' => 'form-control datepicker', 'placeholder' => 'Enter date of joining']) !!}
    </div>
    <div class="col-sm-6 form-group">
      {!! Form::label('dob', 'Date of Birth') !!}
      {!! Form::text('dob', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter date of birth']) !!}
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