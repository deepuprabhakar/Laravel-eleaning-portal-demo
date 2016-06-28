@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - {{ ucwords($subject['name']) }}</title>
@stop

@section('style')

<!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}
    {!! Html::style('plugins/select2/select2.min.css') !!} 

<!-- DataTables -->
    {!! Html::style('plugins/datatables/media/css/dataTables.bootstrap.css') !!}
    {!! Html::style('plugins/datatables/extensions/Responsive/css/responsive.bootstrap.min.css') !!}  

    {!! Html::style('plugins/iCheck/all.css') !!}

<!-- jQuery Confirm -->
    {!! Html::style('plugins/confirm/jquery-confirm.css') !!}     
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
       {{ $subject['name'] }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.subjects.index') }}">Subjects</a></li>
      <li class="active">View Subject</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
    
    <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Subject</span>
              <span class="info-box-number">{{ $subject['name'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Batch</span>
              <span class="info-box-number">{{ $subject['batch'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-graduation-cap"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Course</span>
              <span class="info-box-number">{{ $subject['course']['title'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Semester</span>
              <span class="info-box-number">{{ $subject['semester'] }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      
    <div class="col-md-12 col-sm-6 col-xs-12">
      <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"> List Units</h3>
            </div>
            <div class="box-footer">
              <a class="btn btn-primary news-button" href="{{ route('admin.units.create', ['id' => $subject['hashid'],$subject['slug']]) }}">Create Unit</a>

            </div>
            <div class="box-body">
            @include('errors.success')
            <table id="unit-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width: 20px;">No.</th>
                  <th> Unit Title</th>
                  <th>Unit Video</th>
                  <th class="text-center" style="width: 200px;">Actions</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($units as $key => $unit)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $unit['title'] }}</td>
                  <td><a href="{{ $unit['video'] }}" target="_blank">{{ $unit['video'] }}</a></td>
                  <td class="text-center table-actions">
                    <a class="btn bg-purple btn-xs btn-flat" href="{{ route('admin.units.show', $unit['slug']) }}">View</a>
                    <a class="btn bg-olive btn-xs btn-flat" href="{{ route('admin.units.edit', $unit['slug']) }}" style="margin: 0 3px 0 2px;">Edit</a>
                    {!! Form::open(['route' => ['admin.units.destroy', $unit['hashid']], 'method' => 'DELETE', 'class' => 'delete-form' ,'id' => 'unit-form']) !!}
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
    <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Discussion Prompt</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            {{ Form::open(['url' => 'createDiscussion', 'autocomplete' => 'off', 'id' => 'discussion-prompt-form']) }}
            <div class="box-body">
              <div id="response-discussion" style="display: none;"></div>
              {{ Form::textarea('question', $subject['discussionprompt']['question'], ['class'=>'form-control', 'id' => 'discussion', 'placeholder' => 'Enter Question For Discussion Here']) }}
              {!! Form::hidden('subject_id', $subject['hashid'], ['id' => 'subjectid']) !!}
              {!! Form::hidden('course_id', $subject['course']['id'], ['id' => 'courseid']) !!}
              
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary news-button" id="discussionprompt">Create</button>
            </div>
            {{ Form::close() }}
            <!-- /.box-body -->
          </div>
    </div>  
     <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Quiz</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
             {{ Form::open(['url' => 'createQuiz', 'autocomplete' =>'off', 'id' => 'quiz-form']) }}
                @include('forms.quiz', ['button' => 'Add', 'flag' => false])
                {!! Form::hidden('subject_id', $subject['hashid'], ['id' => 'subjectid']) !!}
            {{ Form::close() }}
            <!-- /.box-body -->
          </div>
      </div>  

     <div class="col-md-12 col-sm-6 col-xs-12">
     <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Assignment</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                  <table id="assignment-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="width: 20px;">No.</th>
                          <th>Student Name</th>
                          <th> Assignment Title</th>
                          <th>Assignment File</th>
                          <th>Score</th>
                          <th>Remark</th>
                          <th class="text-center" style="width: 200px;">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($assignments as $key => $assignment)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $students['name']}}</td>
                          <td>{{ $assignment['title'] }}</td>
                          <td><a href="{{ url('uploads/assignments', $assignment['file']) }}" class="btn btn-primary" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>
                          
                           {{ Form::open(['url' => route('admin.assignment.create', $assignment['hashid']), 'autocomplete' => 'off', 'class' => 'assignment-form']) }} 
                           <td>{{ Form::text('mark', $assignment['mark'], ['id' => 'mark','class' => 'form-control', 'placeholder' => 'Enter Mark']) }}</td>
                           <td>{{ Form::text('remark', $assignment['remark'], ['class' => 'form-control', 'id' => 'remark', 'placeholder' => 'Enter Remark']) }}</td>
                          <td class="text-center table-actions">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary assignment-button']) !!}
                          </td>
                          {{ Form::close() }}
                        </tr>
                      @endforeach
                      </tbody>
                </table>
                <div id="response-assignment" style="display: none;"></div>
            </div>
            <!-- /.box-body -->
            <div class="overlay">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div>
        </div>
        </div><!-- ./Row -->    
    </section>
     
  </div><!-- ./Content Wrapper -->  
@stop

@section('script')
    
    <!--For Radio Button-->
    
     {!! Html::script('plugins/iCheck/icheck.min.js') !!}

    <!-- SlimScroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- jQuery Confirm -->
    {!! Html::script('plugins/confirm/jquery-confirm.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
   
    <!--Ajax load-->
    {!! Html::script('dist/js/custom/viewUnits.js') !!}
    {!! Html::script('dist/js/custom/createUnit.js') !!}
    

    <!--Ajax Load for Quiz -->
     {!! Html::script('dist/js/custom/createQuiz.js') !!}
     

    <!--Ajax for Discussion Prompt-->
     {!! Html::script('dist/js/custom/discussionPrompt.js') !!}

     <!-- DataTables -->
    {!! Html::script('plugins/datatables/media/js/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/media/js/dataTables.bootstrap.min.js') !!}
    {!! Html::script('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') !!}
    {!! Html::script('dist/js/custom/viewAssignment.js') !!}
@stop