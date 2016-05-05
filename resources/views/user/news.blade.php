@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - News</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      News
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('news') }}">News</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        @include('errors.empty', ['item' => $news, 'title' => 'news'])
          <!-- The time line -->
          <ul class="timeline">
            @foreach($news as $content)
              <!-- timeline time label -->
              <li class="time-label">
                  <span class="bg-red">
                    {{ $content['date'] }}
                  </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <i class="fa fa-newspaper-o bg-blue"></i>
                <div class="timeline-item">
                  <span class="time">
                    <i class="fa fa-clock-o"></i> 
                    {{ $content['time'] }}
                  </span>
                      <h3 class="timeline-header"><a href="{{ route('news.show', $content['slug']) }}">{{ $content['title'] }}</a></h3>
                  <div class="timeline-body" style="overflow: auto;">
                  @if($content['image'] != "")
                    {{ Html::image("uploads/news/thumbs/".$content['image'], 'image', ['class' => 'img-responsive pull-right float-img']) }}
                  @endif
                    <div class="">
                      {!! str_limit((Purifier::clean($content['content'])), 200) !!}
                    </p>
                  </div>
                  <div class="timeline-footer" style="padding-top: 0;">
                    <a class="btn btn-primary btn-xs btn-flat" href="{{ route('news.show', $content['slug']) }}">Read more</a>
                  </div>
                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
            @endforeach
          </ul>
          <!-- <div class="overlay text-center">
            <i class="fa fa-refresh fa-spin"></i>
          </div> -->
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