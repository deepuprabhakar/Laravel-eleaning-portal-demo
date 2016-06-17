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
      <li><a href="{{ route('articles.index') }}" class="active">Articles</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" >
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        @include('errors.empty', ['item' => $articles, 'title' => 'articles'])
          <!-- The time line -->
          @if($articles->count() > 0)
              <ul class="timeline article" data-next-page="{{ $articles->nextPageUrl() }}">
                
              </ul>
          @endif
      </div>     
            <div class="col-md-10 col-md-offset-1">
                <div class="overlay text-center text-muted" style="display: none;">
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
    {!! Html::script('dist/js/custom/loadArticle.js') !!}
@stop