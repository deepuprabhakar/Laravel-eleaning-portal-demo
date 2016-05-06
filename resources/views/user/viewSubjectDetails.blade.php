@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-Learning - {{ $subject->name }}</title>
@stop
    
@section('style')
    <!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}
    {!! Html::style('plugins/countdown/jquery.countdown.css') !!}
    {!! Html::style('plugins/iCheck/all.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       View Subject details
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('modules.index',$subject->semester) }}">Subjects</a></li>
      <li class="active">View Subject</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Subject</span>
              <span class="info-box-number">{{ $subject->name }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Batch</span>
              <span class="info-box-number">{{ $subject->batch}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Course</span>
              <span class="info-box-number">{{ $course->title}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Semester</span>
              <span class="info-box-number">{{ $subject->semester }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
  </div>
  <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Units</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Discussion Prompt</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Quiz</a></li>
              
                  <li class="pull-right"><a href="#" class="text-muted"></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab_1">
                  @if($units->count() == 0)
                    @include('errors.empty', ['item' => $units, 'title' => 'units'])
                  @else
                      @foreach($units as $key=>$unit)
                        <b>{{ $unit->title }}</b>
                        <p>{!! $unit->content!!}</p>
                      @endforeach
                  @endif
                  </div>
                  <!-- /.tab-pane for unit-->
                  <div class="tab-pane fade" id="tab_2">
                  @if(empty($discussion))
                    @include('errors.empty', ['item' => $discussion, 'title' => 'discussion'])
                  @else
                      <blockquote>
                        <p>{{ $discussion['question'] }}</p>
                      </blockquote>
                      {!! Form::open(['url' => route('modules.store',[$subject->semester,$subject->slug]), 'autocomplete' => 'off', 'id' => 'discussion-form' ]) !!}
                      {!! Form::textarea('answer', null, ['class' => 'form-control', 'id' => 'answer', 'placeholder' => 'Enter Your Answer Here!!!']) !!}
                      {!! Form::hidden('subject_id', $subject['id'], ['id' => 'subjectid']) !!}
                      {!! Form::hidden('student_id', $student['id'], ['id' => 'studentid']) !!}
                      <div id="response-discussion" style="display: none;"></div>
                      <button type="submit" class="btn btn-primary news-button" id="discussionprompt" style="width: 150px; margin-top: 5px;">Reply</button>
                      {{ Form::close() }}
                      <br>
                      <div id="post-list">
                        @foreach($discussions as $key=>$discussion)
                        <div class="post">
                          <div class="user-block">
                            <img class="img-circle img-bordered-sm" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="user image">
                                <span class="username">
                                  <a href="#">{{ $discussion['student']['name'] }}</a>
                                 </span>
                            <span class="description">{{ $discussion['created_at']->diffForHumans() }}</span>
                          </div>
                          <!-- /.user-block -->
                          <p>
                            {!! $discussion->answer !!}
                          </p>
                        </div>
                        @endforeach
                      </div>
                  @endif
                  </div>
                <!-- /.tab-pane -->
                <div class="tab-pane fade" id="tab_3">
                  <h3><div class="text-center">Quiz</div></h3>
                    <div id="quiz-content">
                      <p class="text-center">Please note quiz can be taken only once.<br>
                      Click on start button to begin the Quiz....</p>
                      <div class="text-center">
                        <button class="btn btn-primary btn-flat" style="width: 150px;" id="quiz-start">Start</button>
                      </div>
                    </div>
                    <div id="response" style="display: none;" class="text-center"></div>
                    <div class="row"><div class="col-md-10 col-md-offset-1">
                    <div id="quiz-questions" style="display: none;">
                      <!-- <div class="bg-red timer-holder">
                        <span id="timer-countdown"></span>
                        <i class="fa fa-clock-o"></i>
                      </div> -->
                      <div class="timer-holder bg-red">
                        <div id="countdown"></div>
                        <i class="fa fa-clock-o"></i>
                      </div>
                      {!! Form::open(['url' => route('quiz.store'), 'id' => 'quiz-form']) !!}
                      {!! Form::hidden('subject', $subject->slug, []) !!}
                      @foreach ($quiz as $key => $question)
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
                    </div>
                </div>
               
              </div>
              <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div> 
    <!-- /.row -->

  </section>
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    <script>
      var url_img = "{{ url('dist/img') }}";
    </script>
    <!--Countdown -->
    {!! Html::script('plugins/countdown/jquery.plugin.js') !!}
    {!! Html::script('plugins/countdown/jquery.countdown.js') !!}
    <!--iCheck -->
    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    <!-- jQuery Confirm -->
    {!! Html::script('plugins/confirm/jquery-confirm.js') !!}
    {!! Html::script('dist/js/custom/user_create_discussion.js') !!}
    {!! Html::script('dist/js/custom/userQuiz.js') !!}
@stop