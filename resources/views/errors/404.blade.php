@extends('app')

@section('meta')
<meta name="_token" content="{!! csrf_token() !!}"/>
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<meta name="format-detection" content="telephone=no"/>
<title>Coheart E-learning - 404</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      404
      <small>Not Found!</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="callout callout-danger">
      <h4><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h4>
      <p>We could not find the page you were looking for. Meanwhile, you may return to <a href="{{ url('dashboard') }}" style="text-decoration: none;">dashboard</a>.</p>
    </div>
  </section><!-- /.content -->  

</div><!-- /.content-wrapper -->	
@stop

@section('script')
    <!-- Slimscroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
@stop