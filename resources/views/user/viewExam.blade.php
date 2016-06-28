@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - List of Modules</title>
@stop

@section('style')
<!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}    
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Exam 
    </h1>
    
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-12">
                  <div id="quiz-content">
                      <p class="text-center">Please note exam can be taken only once.<br>
                      Click on start button to begin the Exam....</p>
                      <div class="text-center">
                        <button class="btn btn-primary btn-flat" style="width: 150px;" id="quiz-start">Start</button>
                      </div>
                  </div>
                   <div class="row"><div class="col-md-10 col-md-offset-1">
                    <div id="quiz-questions" style="display: none;">
                     <div class="timer-holder bg-red">
                        <div id="countdown"></div>
                        <i class="fa fa-clock-o"></i>
                     </div>
                     {!! Form::open(['url' => route('exam.store'), 'id' => 'quiz-form']) !!}
                     
                     @foreach ($questions as $key => $question)
                        <div id="{{ $key }}">
                          <div class="question">
                            <div class="callout callout-success" style="margin: 15px 0">
                              <p>Question: {{ ucfirst($question['question']) }}</p>
                            </div>
                          </div>
                          <div class="answers">
                            <div style="margin: 5px 0;">
                            {!! Form::radio($question['hashid'], 'A', false, ['class' => 'flat-red', 'id' => 'radio-1-'.$key]) !!}
                            <label for="radio-1-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['A']) }}</label>&nbsp;&nbsp;
                            </div>
                            <div style="margin: 5px 0;">
                            {!! Form::radio($question['hashid'], 'B', false, ['class' => 'flat-red', 'id' => 'radio-2-'.$key]) !!}
                            <label for="radio-2-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['B']) }}</label>&nbsp;&nbsp;
                            </div>
                            <div style="margin: 5px 0;">
                            {!! Form::radio($question['hashid'], 'C', false, ['class' => 'flat-red', 'id' => 'radio-3-'.$key]) !!}
                            <label for="radio-3-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['C']) }}</label>&nbsp;&nbsp;
                            </div>
                            <div style="margin: 5px 0;">
                            {!! Form::radio($question['hashid'], 'D', false, ['class' => 'flat-red', 'id' => 'radio-4-'.$key]) !!}
                            <label for="radio-4-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['D']) }}</label>&nbsp;&nbsp;
                            </div>
                          </div>
                        </div>
                      @endforeach
                    <div class="form-group text-center">
                      {!! Form::button('Finish', ['class' => 'btn btn-success', 'style' => 'width: 150px; display: none;', 'id' => 'quiz-finish']) !!}
                    </div>
                    {!! Form::close() !!}
                    </div>
                    </div>
                  </div><!-- ./row-->
      </div>
    </div>
    </div>
  </section><!-- ./section -->  
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- SlimScroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- jQuery Confirm -->
    {!! Html::script('plugins/confirm/jquery-confirm.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    
@stop