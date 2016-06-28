@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - View Project</title>
@stop


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Project
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li class="active">Project</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 600px;">
  <div class="row">
  <div class="col-md-12">
      @if(!$project)
         @include('errors.empty', ['item' => $project, 'title' => 'project'])
      @else
        <div class="box box-success box-solid">
          <div class="box-header with-border">
              <h3 class="box-title">Project</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Topic</th>
                    <th class="text-center">Score</th>
                    <th class="text-center">Remarks</th>
                  </tr>
                </thead>
                <tbody>
                  @if(empty($project))
                  <tr>
                    <td colspan="3" class="text-center">No data available!</td>
                  </tr>
                  @else
                  <tr>
                    <td>{{ $project->topic }}</td>
                    @if($project->score == 0 && $project->remarks =='')
                    <td class="text-center">Not yet checked!</td>
                    <td class="text-center">Not yet checked!</td>
                    @else
                    <td class="text-center">{{ $project->score }}</td>
                    <td class="text-center">{{ $project->remarks }}</td>
                    @endif
                  </tr>
                  @endif
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
        @endif
      </div><!-- /.box-body -->
      </div>
    </div>
    </div><!-- /.box -->
  </section><!-- ./section -->  
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- SlimScroll -->
    {!! Html::script('plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
  @stop