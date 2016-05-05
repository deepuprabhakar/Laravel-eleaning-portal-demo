@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - Articles</title>
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
      Articles
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('articles.index') }}">Articles</a></li>
      <li class="active">View Article</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" >
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
          <!-- The time line -->
          <ul class="timeline">
            @foreach($articles as $content)
              <!-- timeline time label -->
              <li class="time-label">
                  <span class="bg-red">
                    {{ $content['date'] }}
                  </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-file-text-o bg-blue"></i>
                <div class="timeline-item">
                  <span class="time">
                    <i class="fa fa-clock-o"></i> 
                    {{ $content['time'] }}
                  </span>
                      <h3 class="timeline-header"><a href="{{ route('articles.show', $content['slug']) }}">{{ str_limit($content['title'], 60) }}</a></h3>
                  <div class="timeline-body" style="overflow: auto;">
                    <p>{!! str_limit($content['content'], 200) !!}</p>
                  </div>
                  <div class="timeline-footer" style="padding-top: 0;">
                    <a class="btn btn-primary btn-xs btn-flat" href="{{ route('articles.show', $content['slug']) }}">Read more</a>
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
            @endforeach
          </ul>
          <div class="overlay text-center">
            <i class="fa fa-refresh fa-spin"></i>
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
    {!! Html::script('dist/js/custom/articles.js') !!}
@stop