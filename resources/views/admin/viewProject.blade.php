@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - List of Projects</title>
@stop

@section('style')
<!-- DataTables -->
    {!! Html::style('plugins/datatables/media/css/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
    {!! Html::style('plugins/select2/select2.min.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Projects
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li class="active">View Projects</li>
    </ol>
  </section>

  <!-- Main content --> 
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List of Projects</h3>
          </div><!-- /.box-header -->
            <div class="box-body">
            <div id="response-project" style="display: none;"></div>
            <div class="row">
              <div class="col-sm-6 form-group">
                {!! Form::label('course', 'Course') !!}
                {!! Form::select('course', [null => 'Select Course']+$courses, null, ['id' => 'courses', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
              </div>
              <div class="col-sm-6 form-group">
                {!! Form::label('batch', 'Batch') !!}
                {!! Form::select('batch', [null => 'Select Batch'], null, ['id' => 'batch', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
              </div>
            </div>
            
            <table id="project-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width: 20px;">No.</th>
                  <th>Student Name</th>
                  <th>Project Topic</th>
                  <th class="text-center">File</th>
                  <th class="text-center">Score</th>
                  <th class="text-center">Remarks</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                
                
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </section><!-- ./section -->  
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- DataTables -->
    {!! Html::script('plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/media/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js') !!}
    <!-- SlimScroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- Select 2 -->
    {!! Html::script('plugins/select2/select2.full.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    {!! Html::script('dist/js/custom/project.js') !!}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    <script>
      var old = "{{ old('batch') }}";
    </script>
  @stop