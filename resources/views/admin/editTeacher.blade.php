@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - {{ $teacher['firstname'] }}</title>
@stop

@section('style')
    {!! Html::style('plugins/select2/select2.min.css') !!}
    {!! Html::style('plugins/iCheck/all.css') !!}
    {!! Html::style('plugins/datepicker/datepicker3.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit {{ $teacher['firstname'] }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.teachers.index') }}">Teachers</a></li>
      <li class="active">Edit Teacher</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Teacher Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::model($teacher, ['url' => route('admin.teachers.update', $teacher['hashid']), 'autocomplete' => 'off', 'id' => 'student-form', 'method' => 'PATCH']) !!}
            @include('forms.teacher', ['button' => 'Update Teacher Details', 'flag' => true])
          {!! Form::close() !!}<!-- /.Form ends -->
        </div><!-- /.box -->
      </div>
    </div> 
  </section><!-- ./section -->  
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- Select 2 -->
    {!! Html::script('plugins/select2/select2.full.min.js') !!}
     <!--iCheck -->
    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    <!--Datepicker -->
    {!! Html::script('plugins/datepicker/bootstrap-datepicker.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    {!! Html::script('dist/js/custom/createTeacher.js') !!}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
   
  @stop