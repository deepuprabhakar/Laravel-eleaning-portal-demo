@extends('app')

@section('meta')
<meta name="_token" content="{!! csrf_token() !!}"/>
<meta name="description" content="Your description">
<meta name="keywords" content="Your keywords">
<meta name="author" content="Your name">
<meta name="format-detection" content="telephone=no"/>
<title>E-learning - Dashboard</title>
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
    </ol>
  </section>
  <section class="content-header">
    <div class="callout callout-success">
      <h4>{{ ucwords(Sentinel::getUser()->first_name) }}</h4>
      <p>Logged in as User!!</p>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    
    
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