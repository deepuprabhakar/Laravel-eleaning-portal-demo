@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - List of Modules</title>
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
      Semester {{ $semester }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('course.index',$semester) }}">Course</a></li>
      <li class="active">Semester {{$semester }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    <div class="row">
      <div class="col-md-12">
        @if(!$subjects)
                @include('errors.empty', ['item' => $subjects, 'title' => 'subjects'])
        @else
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Subject Table</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <table class="table table-bordered">
                  <tbody>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Subject</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach($subjects as $key=>$subject )
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $subject['name'] }}</td>
                    <td class="text-center table-actions">
                      <a class="btn bg-purple btn-xs btn-flat" href="{{ route('course.show', [$subject['semester'], $subject['slug']]) }}">View</a>
                      <a href="{{ url('uploads/subjects', $subject['file']) }}" class="btn bg-blue btn-xs btn-flat" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
           @endif
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
    
@stop