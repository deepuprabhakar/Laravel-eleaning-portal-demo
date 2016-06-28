@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Article - {{ ucfirst($article['title']) }}</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Article - {{ str_limit(ucfirst($article['title']), 50) }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('articles.index') }}">Articles</a></li>
      <li class="active">{{ str_limit(ucfirst($article['title']), 20) }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-8">
            <div class="box box-widget">
            <div class="box-header with-border">
            @if($article->student_id == Sentinel::getUser()->id)
              <div class="box-tools pull-right">
                <a href="{{ route('articles.edit', $article['slug']) }}" class="btn btn-primary btn-sm" title="Edit">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                </a>
              </div>
            @endif
              <div class="user-block">
              @if(is_null($student))
                <img class="img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User Image">
              @else
                @if($student->image != "")
                  <img class="img-circle" src="{{ url('uploads/profile', $student->image) }}" alt="User Image">
                @else
                  <img class="img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User Image">
                @endif
              @endif
                <span class="username"><a href="#">{{ $article['author']['first_name'] }}</a></span>
                <span class="description">{{ $article['publish']->diffForHumans() }}</span>
              </div>
              <!-- /.user-block -->
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- post text -->
              <b>{{ $article['title'] }}</b>
              <!-- News Content -->
              <p>{!! $article['content'] !!}</p>
              @if($article['article'] != "")
                <a href="{{ url('uploads/articles', $article['article']) }}" class="btn btn-primary" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
              @endif
          </div>
          </div>
        </div>
        <div class="col-md-4">
          @include('includes.sideArticles')
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