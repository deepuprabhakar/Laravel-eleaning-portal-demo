@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Edit Article</title>
@stop

@section('style')
<!-- for DatePicker css-->
      {{ Html::style('plugins/datepicker/datepicker3.css') }}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit - {{ str_limit(ucfirst($article['title']), 50) }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('listArticles') }}">Articles</a></li>
      <li class="active">{{ str_limit(ucfirst($article['title']), 20) }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Article</h3>
            @if($article->student_id == Sentinel::getUser()->id)
            <div class="box-tools pull-right">
              <a href="{{ route('articles.show', $article['slug']) }}" class="btn btn-primary btn-sm" title="Edit">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> Preview
              </a>
            </div>
            @endif
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::model($article, ['url' => route('articles.update', $article->hash), 'autocomplete' => 'off', 'id' => 'articles-form', 'method' => 'PATCH', 'files' => true]) !!}
            @include('forms.articles', ['button' => 'Update Article', 'flag' => true])
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
    <!-- Datepicker -->
    {{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}
    <!--Tinymc-->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    {!! Html::script('dist/js/custom/articles.js') !!}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    
@stop