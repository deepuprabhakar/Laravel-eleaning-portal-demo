@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>Coheart E-learning - Mailbox</title>
@stop

@section('style')
    {!! Html::style('plugins/iCheck/all.css') !!}
    {!! Html::style('plugins/iCheck/flat/blue.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
        Mailbox
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.messages.index') }}"> Messages</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ route('admin.messages.create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                @if($count != 0)
                  <li class="active"><a href="{{ route('admin.messages.index') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $count }}</span></a></li>
                @else
                  <li class="active"><a href="{{ route('admin.messages.index') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
                @endif
                <li><a href="{{ route('admin.messages.sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="">
                  {!! Form::open(['id' => 'search-mail-form']) !!}
                  <input type="text" name="search" id="search-mail" class="form-control input-sm" placeholder="Search Mail.." autocomplete="off">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                  {!! Form::submit('search-submit', ['style' => 'display: none', 'id' => 'search-button' ]) !!}
                  {!! Form::close() !!}
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            {!! Form::open(['route' => ['admin.messages.destroyMany'], 'class' => 'message-destroy-form']) !!}
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="submit" class="btn btn-default btn-sm" id="delete"><i class="fa fa-trash-o"></i></button>
                </div>
                <!-- /.btn-group -->
                <div class="pull-right">
                  @if($messages->hasPages())
                      <div class="btn-group">
                        {!! (new App\Pagination($messages))->render() !!}
                      </div>
                  @endif
                  <!-- <div class="btn-group">
                    <a href="" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></a>
                    <a href="" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                  </div> -->
                  
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="mail-table">
                  <tbody>
                    <tr><td colspan="4" class="text-muted text-center">Loading...</td></tr>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div><!-- end of mailbox body-->
            {!! Form::close() !!}
            @include('errors.success')
      </div>
      <!-- /.row -->
    </section><!-- ./section -->  
</div><!-- ./Content Wrapper -->  
@stop

@section('script')
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    {!! Html::script('dist/js/custom/inbox.js') !!}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>

@stop