@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Profile</title>
@stop
@section('style')
<!-- for DatePicker css-->
      {{ Html::style('plugins/datepicker/datepicker3.css') }}
@stop

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ route('admin.students.index') }}">Students</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Basic Info</a></li>
                      </ul>
                  <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                             <div class="box box-widget widget-user">
                                      <div class="widget-user-header bg-aqua-active">
                                        <h3 class="widget-user-username">{{ $students['name'] }}</h3>
                                        <h5 class="widget-user-desc">{{ $course['title'] }}</h5>
                                      </div>
                                      <div class="widget-user-image">
                                      @if($students['image'] == "")
                                        <img class="img-circle" src="{{ asset('dist/img/default-160x160.jpg') }}" alt="User Avatar">
                                      @else
                                      <img class="img-circle" src="{{ asset('uploads/profile/'.$students['image']) }}" alt="User Avatar">
                                      @endif
                                      </div>
                                  <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header">{{ $students['address'] }}</h5>
                                            <span class="description-text">Address</span>
                                          </div>
                                          <!-- /.description-block -->
                                        </div>  
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                          <div class="description-block">
                                            <h5 class="description-header">{{ $students['admission'] }}</h5>
                                            <span class="description-text">Admission Number</span>
                                          </div>
                                          <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4">
                                          <div class="description-block">
                                            <h5 class="description-header">{{ $students['phone'] }}</h5>
                                            <span class="description-text">Phone</span>
                                          </div>
                                          <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                 
                                  </div>
                                </div>
                              </div>
                          </div>
                        
                      </div>
                  </div>
            </div>
        </div>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
 
@stop

@section('script')

    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}
    <!-- Datepicker -->
    {{ Html::script('plugins/datepicker/bootstrap-datepicker.js') }}
    {{ Html::script('dist/js/custom/profile.js') }}
    <script>
      $.ajaxSetup({
         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
    </script>
    
@stop