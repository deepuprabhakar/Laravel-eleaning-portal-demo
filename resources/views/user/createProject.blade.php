@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    @if($project)
      <title>Coheart E-learning - Edit {{ str_limit($project->topic, 20) }}</title>
    @else
      <title>Coheart E-learning - Create Project</title>
    @endif
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    @if($project)
      Edit {{ str_limit($project->topic, 20) }}
    @else
      Create Project  
    @endif
    </h1>
    
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('project.index') }}">Project</a></li>
      @if($project)
        <li class="active">Edit {{ str_limit($project->topic, 20) }}</li>
      @else
        <li class="active">Create Project</li>
      @endif
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Project Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url' => route('project.store'), 'autocomplete' => 'off', 'id' => 'project-form', 'files' => true]) !!}
            @include('forms.project', ['button' => 'Save'])
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
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    
@stop