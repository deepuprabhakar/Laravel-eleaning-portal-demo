@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - {{ $quiz['question'] }}</title>
@stop
@section('style')
   {!! Html::style('plugins/iCheck/all.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit {{ str_limit($quiz['question'], 20) }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.quiz.index', $quiz['subject']['slug']) }}">Quiz</a></li>
      <li class="active">Edit Quiz</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Quiz Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::model($quiz, ['url' => route('admin.quiz.update', $quiz['hashid']), 'autocomplete' => 'off', 'id' => 'quiz-form', 'method' => 'PATCH']) !!}
            @include('forms.quiz', ['button' => 'Update Quiz', 'flag' => true])
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

    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('dist/js/custom/createQuiz.js') !!}

@stop