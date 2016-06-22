@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Set Question Paper</title>
@stop
@section('style')
    {!! Html::style('plugins/select2/select2.min.css') !!}
@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Set Question paper
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="#">Test</a></li>
      <li class="active">Set Question paper </li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Set Question Paper Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          {!! Form::open(['url' => route('admin.test.setquestionstore'), 'autocomplete' => 'off', 'id' => 'setquestion-form']) !!}
            @include('forms.setquestion', ['button' => 'Set Question Paper', 'flag' => false])
          {!! Form::close() !!}<!-- /.Form ends -->
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
    <!-- Select 2 -->
    {!! Html::script('plugins/select2/select2.full.min.js') !!}

    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    <script>
     $(function(){
        $('#category').select2({
          placeholder: 'Select Category'
        });
    });
      $('#add').click(function(e){
        e.preventDefault();
        $('#adddetails').fadeIn('slow');
      });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){


      $('#cat-form').submit(function(e){
          e.preventDefault();
          var data = $(this).serializeArray();
          console.log(data );
          var url = $(this).attr('action');
          $.ajax({
            'url' : url,
            'data':data,
            'type':'POST',
            'dataType':'json',
            success: function(response)
            {
              
            },
            error: function(response)
            {
              
            },
            complete: function()
            {
              
            }
          });
  
});
       });
    </script>
    
@stop