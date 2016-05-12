@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - Progress</title>
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
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Progress</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
          @foreach($subject as $subjects)
           <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $subjects->name }}</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="">Discussion <span class="pull-right badge bg-aqua">
                  Proceed to Discussion
                </span></a></li>
                <li><a href="">Quiz <span class="pull-right badge bg-green">Proceed to Quiz</span></a></li>
                <li><a href="">Assignment<span class="pull-right badge bg-red">Submit Assignment </span></a></li>
              </ul>
            </div>
            </div>
            </div>
          @endforeach
          </div>
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
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
@stop