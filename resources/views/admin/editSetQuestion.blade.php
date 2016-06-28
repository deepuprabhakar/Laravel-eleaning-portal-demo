@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - {{ $setquestion->title }}</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit {{ $setquestion->title }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.test.viewsetquestion') }}">Test </a></li>
      <li class="active">Edit Set Question</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Set Question Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::model($setquestion, ['url' => route('admin.test.updatesetquestion', $setquestion->hash), 'autocomplete' => 'off', 'id' => 'setquestion-form', 'method' => 'PATCH']) !!}
            @include('forms.setquestion', ['button' => 'Update Set Question', 'flag' => true])
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
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
@stop