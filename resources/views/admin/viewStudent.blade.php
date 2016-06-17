@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - List of Students</title>
@stop

@section('style')
<!-- DataTables -->
    {!! Html::style('plugins/datatables/media/css/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
<!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}  
    {!! Html::style('plugins/select2/select2.min.css') !!}  
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Students
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.students.index') }}">Students</a></li>
      <li class="active">View Students</li>
    </ol>
  </section>

  <!-- Main content --> 
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List of Students</h3>
          </div><!-- /.box-header -->
            <div class="box-body">
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
            
            <table id="student-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width: 20px;">No.</th>
                  <th>Student Name</th>
                  <th class="text-center">Course</th>
                  <th class="text-center">Batch</th>
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
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    <script>
      var old = "{{ old('batch') }}";
    </script>
    <!-- DataTables -->
    {!! Html::script('plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/media/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('plugins/datatables/extensions/Responsive/js/responsive.bootstrap.min.js') !!}
    <!-- SlimScroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- jQuery Confirm -->
    {!! Html::script('plugins/confirm/jquery-confirm.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    {!! Html::script('dist/js/custom/student.js') !!}
    <!-- Select 2 -->
    {!! Html::script('plugins/select2/select2.full.min.js') !!}
@stop