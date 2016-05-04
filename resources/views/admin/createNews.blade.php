@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - Create News</title>
@stop

@section('style')

	<!-- for DatePicker css-->
      {{ Html::style('plugins/datepicker/datepicker3.css') }}
  <!-- for select2 css -->    
      {!! Html::style('plugins/select2/select2.min.css') !!}

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Create News
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.news.index') }}">News</a></li>
      <li class="active">Create News</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">News Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url' => route('admin.news.store'), 'autocomplete' => 'off', 'id' => 'news-form', 'files' => true]) !!}
            @include('forms.news', ['button' => 'Create News', 'flag' => false])
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
    <!--Select 2-->
    {!! Html::script('plugins/select2/select2.full.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    <!-- Datepicker -->
    {{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}

    <!--Tinymc-->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
  
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    <script>
      var old = "{{ old('batch') }}";
    </script>
    {!! Html::script('dist/js/custom/createNews.js') !!}

    
@stop