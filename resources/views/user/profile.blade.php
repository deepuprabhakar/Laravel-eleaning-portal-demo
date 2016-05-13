@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - Profile</title>
@stop
@section('style')
<!-- for DatePicker css-->
      {{ Html::style('plugins/datepicker/datepicker3.css') }}
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
                  <img class="profile-user-img img-responsive img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User profile picture">
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
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 
@stop

@section('script')

    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    <!-- Datepicker -->
    {{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}
    {{ Html::script('dist/js/custom/profile.js') }}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    
@stop