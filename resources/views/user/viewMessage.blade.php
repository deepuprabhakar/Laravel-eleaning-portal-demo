@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Mailbox</title>
@stop

@section('style')
    {!! Html::style('plugins/select2/select2.min.css') !!}
    {!! Html::style('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}
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
        <li><a href="{{ route('messages.index') }}"> Messages</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

  <!-- Main content -->
  <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ route('messages.create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>
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
                  <li class="active"><a href="{{ route('messages.index') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $count }}</span></a></li>
                @else
                  <li class="active"><a href="{{ route('messages.index') }}"><i class="fa fa-inbox"></i> Inbox</a></li>
                @endif
                <li><a href="{{ route('messages.sent') }}"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
              {!! Form::open(['route' => ['messages.destroy', $messages['hashid']], 'method' => 'DELETE', 'class' => 'message-destroy-form']) !!}
              <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="submit" class="btn btn-default" id="delete"><i class="fa fa-trash-o"></i></button>
                  <a href="" class="btn btn-default reply" id="reply"><i class="fa fa-reply"></i></a>
                </div>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                {!! $messages['message'] !!}
              </div>
              <!-- /.mailbox-read-message -->
              <!-- /.box-footer -->
                <div class="box-footer">
                  <div class="pull-right">
                    <a href="" class="btn btn-default reply" id="reply"><i class="fa fa-reply"></i> Reply</a>
                  </div>
                    <button type="submit" class="btn btn-default btn-sm" id="delete"><i class="fa fa-trash-o"></i></button>
                </div>
                {!! Form::close() !!}
              </div>
              @include('errors.success')
            </div>
          </div>
          <!--reply form -->
            {!! Form::open(['url' => route('messages.reply'), 'autocomplete' => 'off', 'id' => 'reply-form', 'style' => 'display:none']) !!}
              <div class="col-md-offset-3 col-md-9">
               <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Reply Message</h3>
                </div>
                 <div class="box-body">
                    @include('errors.list')
                  <div id="response" style="display: none;"></div>
                    @include('errors.success')
                    <div class="form-group">
                      To: {{ $user['first_name'] }}
                      {!! Form::hidden('to', $user['hashid']) !!}
                    </div>
                    <div class="form-group">
                      {!! Form::text('subject', $messages['subject'], ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Subject:']) !!}
                    </div>
                    <div class="form-group">
                      <textarea name="message" id="body" class="form-control" placeholder="Enter message here" >{!!$messages['message'] !!}</textarea>
                    </div>
                  </div>
                  <div class="box-footer">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-primary message-button"><i class="fa fa-envelope-o"></i> Send</button>
                    </div>
                    <button type="reset" class="btn btn-default" id="message-reset"><i class="fa fa-times"></i> Discard</button>
                  </div>
                {!! Form::close() !!}
               </div>
              </div><!--reply form-->
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
    {!! Html::script('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
    {!! Html::script('dist/js/custom/reply.js') !!}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    <script>
      $('.reply').click(function(e){
        e.preventDefault();
        $('#reply-form').fadeIn('slow');
      });
    </script>
@stop