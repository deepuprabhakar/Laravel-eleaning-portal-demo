@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Mailbox</title>
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
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('admin.messages.sent') }}"> Messages</a></li>
        <li class="active">Sent</li>
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
                  <li><a href="{{ route('admin.messages.index') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $count }}</span></a></li>
                @else
                  <li><a href="{{ route('admin.messages.index') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
                @endif
                <li class="active"><a href="{{ route('admin.messages.sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>{{ $messages['subject'] }}</h3>
                <h5>From: {{ $user['email'] }} 
                  <span class="mailbox-read-time pull-right">{{ $messages['create']}}</span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              {!! Form::open(['route' => ['admin.messages.destroySent', $messages['hashid']], 'method' => 'DELETE', 'class' => 'message-destroy-form']) !!}
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="submit" class="btn btn-default btn-sm" id="delete"><i class="fa fa-trash-o"></i></button>
                  </div>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                {!! $messages['message'] !!}
              </div>
              <!-- /.mailbox-read-message -->
              <!-- /.box-footer -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-default btn-sm" id="delete"><i class="fa fa-trash-o"></i></button>
                </div>
              {!! Form::close() !!}
              </div>
      </section>
</div>
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