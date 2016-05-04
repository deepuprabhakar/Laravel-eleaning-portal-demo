@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - List of News</title>
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
      <li class="active">View News</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-8">
            <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User Image">
                <span class="username"><a href="#">Admin</a></span>
                <span class="description">{{ $news['publish']->diffForHumans() }}</span>
              </div>
              <!-- /.user-block -->
              <!--box-tools-->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                  <i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if($news['image'] != "")
                
                  {{ Html::image("uploads/news/".$news['image'], str_slug($news['title']), ['class' => 'img-responsive']) }}
                
              @endif
              <!-- News Title -->
              <b>{{ $news['title'] }}</b>
            
              <!-- News Content -->
              <p>{!! $news['content'] !!}</p>
             
          </div>
          </div>
        </div>
        <div class="col-md-4">
          @include('includes.sideNewsUser')
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
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
@stop