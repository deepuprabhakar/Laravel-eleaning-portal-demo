@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Profile</title>
@stop
@section('style')
  <!-- for DatePicker css-->
  {{ Html::style('plugins/datepicker/datepicker3.css') }}
  <!-- Croppie -->
  {{ Html::style('plugins/jCrop/css/jquery.Jcrop.css') }}
@stop

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">

                @if($student['image'] == "")
                  <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="profile-user-img img-responsive img-circle side-profile-pic" alt="User profile picture">
                @else
                  <img src="{{ asset('uploads/profile/'.$student['image']) }}" class="profile-user-img img-responsive img-circle side-profile-pic" alt="User profile picture">
                @endif

                  <h3 class="profile-username text-center">{{ $student['name'] }}</h3>
                  <p class="text-muted text-center">{{ $course['title'] }}</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
            <!-- /.box -->
            </div><!-- /.col -->
            
          
          <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                  <li class=""><a href="#profile-photo" data-toggle="tab">Profile Photo</a></li>
                  <li class=""><a href="#change-password" data-toggle="tab">Change Password</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="settings">
                  {!! Form::open(['url' => route('profile.update', $student['hashid']), 'autocomplete' => 'off', 'method' => 'PATCH']) !!}
                    <div class="box-body">
                        @include('errors.list')
                        <div id="response" style="display: none;"></div>
                        @include('errors.success')
                        <div class="form-group">
                          {!! Form::label('name', 'Name') !!}
                          {!! Form::text('name', $student['name'], ['class' => 'form-control', 'id' => 'name']) !!}
                        </div>
                        <div class="form-group">
                          {!! Form::label('address', 'Address') !!}
                          {!! Form::textarea('address', $student['address'], ['class' => 'form-control', 'id' => 'address']) !!}
                        </div>
                        <div class="form-group">
                          {!! Form::label('phone', 'Phone') !!}
                          {!! Form::text('phone', $student['phone'], ['class' => 'form-control', 'id' => 'phone']) !!}
                        </div>
                        <div class="form-group">
                          {!! Form::label('dob', 'Date of Birth') !!}
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            {!! Form::text('dob', $student['dob'], ['class' => 'form-control', 'id' => 'dob']) !!}
                          </div>
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary news-button">Update</button>
                      </div>
                  {{ Form::close() }}
                  </div><!-- /.tab-pane -->

                  <div class="tab-pane" id="profile-photo">
                    <div class="box box-success box-solid">
                      <div class="box-header">
                        <h4 class="box-title">Upload Your Profile Photo</h4>
                      </div>
                      <div class="box-body">
                        <div class="profile-pic-upload">
                          <a href="" class="btn btn-primary btn-flat" style="width: 100px;">
                            <i class="fa fa-upload" aria-hidden="true"></i>&nbsp;
                            Upload
                            {!! Form::open(['id' => 'profile-pic-form']) !!}
                              {!! Form::file('profilePic', ['id' => 'profile-input', 'style' => 'curson: pointer;']) !!}
                            {!! Form::close() !!}
                          </a>
                        </div>
                        @if($student['image'] != "")
                        <div id="preview-image-container" style="margin-top: 10px">
                          <img src="{{ url('uploads/profile', $student['image']) }}" alt="" id="preview-image">
                          <div>
                            <button type="button" value="{{ $student['image'] }}" class="btn btn-danger btn-flat btn-xs" id="remove-profile-photo">Remove Profile Photo</button>
                          </div>
                        </div>
                        @else
                        <div id="preview-image-container" style="display: none; margin-top: 10px"></div>
                        @endif
                        {!! Form::open(['id' => 'profile-pic-save']) !!}
                          {!! Form::hidden('x', null, ['id' => 'x']) !!}
                          {!! Form::hidden('y', null, ['id' => 'y']) !!}
                          {!! Form::hidden('w', null, ['id' => 'w']) !!}
                          {!! Form::hidden('h', null, ['id' => 'h']) !!}
                        {!! Form::close() !!}
                        <button type="button"  class="btn btn-success btn-flat" style="display: none; margin-top: 10px;" id="save-image">Save</button>
                      </div><!-- /.box-body -->
                      <!-- Loading (remove the following to stop the loading)-->
                      <div class="overlay" style="display: none;">
                        <i class="fa fa-refresh fa-spin"></i>
                      </div>
                      <!-- end loading -->
                    </div>
                  </div><!-- /.tab-pane -->
                  <!--change password tab-->
                  <div class="tab-pane" id="change-password">
                    <div class="box-body">
                      {!! Form::open(['url' => route('profile.changePassword'), 'id' => 'password_form']) !!}
                      <div id="response-password" style="display: none;"></div>
                      <div class="form-group">
                        {!! Form::label('current_password', 'Current Password') !!}
                        {!! Form::password('current_password', ['class' => 'form-control', 'id' => 'current_password', 'placeholder' => 'Enter current password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('password', 'New Password') !!}
                        {!! Form::password('password', ['class' => 'form-control', 'id' => 'new_password', 'placeholder' => 'Enter new password']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('password_confirmation', 'Confirm Password') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'confirm_password', 'placeholder' => 'Enter new password again']) !!}
                      </div>
                    </div><!--box bod-->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="password">Save</button>
                      </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 
@stop

@section('script')
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
      var url = '{{ url('/uploads/profile/') }}';
    </script>
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    <!-- Datepicker -->
    {{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}
    <!-- Croppie -->
    {{ Html::script('plugins/jCrop/js/jquery.Jcrop.js') }}

    {{ Html::script('dist/js/custom/profile.js') }}
@stop