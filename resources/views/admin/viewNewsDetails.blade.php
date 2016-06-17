@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - List of News</title>
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
      <li><a href="{{ route('admin.news.index') }}">News</a></li>
      <li class="active">View News</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="box-tools pull-right">
              <a href="{{ route('admin.news.edit', $news['slug']) }}" class="btn btn-primary btn-sm" title="Edit">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
              </a>
            </div>
            <div class="user-block">
              <img class="img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User Image">
              <span class="news-edit"></span>
              <span class="username"><a href="" onclick="return false;">Admin</a></span>
              <span class="description">{{ $news['publish']->diffForHumans() }}</span>
            </div>
            <!-- /.user-block -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <!-- post text -->
            <h4>{{ ucfirst($news['title']) }}</h4>

            @if($news['image'] != "")
              {{ Html::image("uploads/news/".$news['image'], str_slug($news['title']), ['class' => 'img-responsive', 'style' => 'width: 100%;']) }}
            @endif
            
            <!-- News Content -->
            <p>{!! Purifier::clean(ucfirst($news['content'])) !!}</p>
               
            </div>
          </div>
        </div><!-- ./col-md-8 -->
        <div class="col-md-4">
          @include('includes.sideNews')
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