@extends('app')

@section('meta')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your keywords">
    <meta name="author" content="Your name">
    <meta name="format-detection" content="telephone=no"/>
    <title>E-learning - Create New Unit</title>
@stop

@section('style')
  

@stop

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Create Unit
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
      <li><a href="{{ route('admin.subjects.show', $data['slug']) }}">Units</a></li>
      <li class="active">Create Unit</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content" style="min-height: 700px;">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Unit Form</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          
          {!! Form::open(['url' => route('admin.units.store'), 'autocomplete' => 'off', 'id' => 'unit-form']) !!}
            @include('forms.unit', ['button' => 'Create Unit', 'flag' => false])
            {!! Form::hidden('subject_id', $data['hashid'], ['id' => 'subjectid']) !!}
          {!! Form::close() !!}<!-- /.Form ends -->
          </div><!-- /.box -->
          <br>
          <!-- Default box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Gallery</h3>
          </div>
          <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              {!! Form::open(array('url' => 'admin/uploadImages', 'files'=>true, 'id' => 'gallery-form')) !!}
              <a class="btn btn-primary btn-flat" id="add-images"><i class="fa fa-file-image-o" aria-hidden="true"></i> Add Images</a>
              {!! Form::file('images[]', ['id' => 'images', 'style' =>'display:none;', 'multiple' => true]) !!}
              {!! Form::submit('Upload ', ['class' => 'btn btn-success btn-flat upload', 'style' => 'display: none;']) !!}
              {!! Form::close() !!}
            </div>
            <div class="col-md-6">
              <div class="">
                {!! Form::open(['id' => 'search-image-form']) !!}
                  <input type="text" name="search" id="search-image" class="form-control" placeholder="Search..." autocomplete="off">
                  {!! Form::submit('search-submit', ['style' => 'display: none', 'id' => 'search-button' ]) !!}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
          </div><!-- /.box-body -->
          <div class="box-footer" style="position: relative;">
            <div id="response" style="display: none;"></div>
            <div class="container-fluid masonry">
              <div class="row">
              @foreach ($images as $image)
                <div class="item">
                  <div class="well"> 
                    <img src="{{ url('uploads/gallery/thumbs', $image->image) }}" alt="" class="img-responsive">
                    <div class="img-path">
                      {{ url('uploads/gallery/thumbs', $image->image) }}
                    </div>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
            <div class="overlay" style="display: none;">
              <i class="fa fa-refresh fa-spin"></i>
            </div>
          </div><!-- /.box-footer-->
        </div><!-- /.box -->
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
      var url = "{{ url('uploads/gallery/') }}";
      var base_url = "{{ url('admin') }}";
    </script>  
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- App -->
    {!! Html::script('dist/js/app.min.js') !!}
    {!! Html::script('dist/js/script.js') !!}

    <!--Tinymc-->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    
    {!! Html::script('dist/js/custom/unit.js') !!}
    {!! Html::script('dist/js/custom/gallery.js') !!}
     
@stop