@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - List of Teachers</title>
@stop

@section('style')
<!-- DataTables -->
    {!! Html::style('plugins/datatables/media/css/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}
<!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}    
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Teachers
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.subjects.index') }}">Teachers</a></li>
      <li class="active">View Teachers</li>
    </ol>
  </section>

  <!-- Main content --> 
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">List of Teachers</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            @include('errors.success')
            <table id="course-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width: 20px;">No.</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th class="text-center">Date of Join</th>
                  <th class="text-center">Salary</th>
                  <th class="text-center" style="width: 200px;">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($teachers as $key => $teacher)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $teacher['firstname'] }} {{ $teacher['lastname'] }}</td>
                  <td>{{ $teacher['email'] }}</td>
                  <td class="text-center">{{ $teacher['join'] }}</td>
                  <td class="text-center">{{ $teacher['salary'] }}</td>
                  <td class="text-center table-actions">
                    <a class="btn bg-purple btn-xs btn-flat" href="{{ route('admin.teachers.show', $teacher['slug']) }}">View</a>
                    <a class="btn bg-olive btn-xs btn-flat" href="{{ route('admin.teachers.edit', $teacher['slug']) }}" style="margin: 0 3px 0 2px;">Edit</a>
                    {!! Form::open(['route' => ['admin.teachers.destroy', $teacher['hashid']], 'method' => 'DELETE', 'class' => 'delete-form']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs btn-flat btn-delete']) !!}
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
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
    <!-- jQuery Confirm -->
    {!! Html::script('plugins/confirm/jquery-confirm.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    {!! Html::script('dist/js/custom/subjects.js') !!}
@stop