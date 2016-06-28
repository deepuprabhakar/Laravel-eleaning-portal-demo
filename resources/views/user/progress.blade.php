@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Progress</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Progress
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Progress</li>
      </ol>
    </section>
   <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        @if($subjects->count() == 0)
            @include('errors.empty', ['item' => $subjects, 'title' => 'data'])
        @else
          <div class="box-header with-border">
            </div><!-- /.box-header -->
            <div class="box-body">
              @foreach($subjects as $subject)
                 <div class="box box-success box-solid">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{ $subject->name }}</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="box-body">
                  <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                      <li>
                        @if(is_null($subject->discussion))
                        <a href="{{ route('modules.show', [$semester, $subject->slug]) }}">Discussion 
                          <span class="pull-right badge bg-aqua">
                          Proceed to Discussion
                          </span>
                        </a>
                        @else
                        <a href="">Discussion
                          <span class="pull-right badge bg-aqua">
                          5
                          </span>
                        </a>
                        @endif
                      </li>
                      <li>
                        @if(is_null($subject->quizresult))
                        <a href="{{ route('modules.show', [$semester, $subject->slug]) }}">Quiz 
                          <span class="pull-right badge bg-aqua">
                          Proceed to Quiz
                          </span>
                        </a>
                        @else
                        <a href="">Quiz
                          <span class="pull-right badge bg-aqua">
                          {{ $subject->quizresult->score }}
                          </span>
                        </a>
                        @endif
                      </li>
                      <li>
                        @if(is_null($subject->assignment))
                        <a href="{{ route('modules.show', [$semester, $subject->slug]) }}">Assignment 
                          <span class="pull-right badge bg-aqua">
                          Proceed to Assignment 
                          </span>
                        </a>
                        @else
                            @if($subject->assignment->mark == 0)
                            <a href="">Assignment 
                              <span class="pull-right badge bg-aqua">
                                 Added but not reviewed!
                              </span>
                            </a>
                            @else
                            <a href="">Assignment 
                              <span class="pull-right badge bg-aqua">
                              {{ $subject->assignment->mark }}
                              </span>
                            </a>
                            @endif
                        @endif
                      </li>
                    </ul>
                  </div>
                  </div>
                  </div>
                @endforeach
            @endif
            </div>
          <!-- /.box -->
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