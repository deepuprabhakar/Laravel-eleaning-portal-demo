<div class="box-body">
  @include('errors.list')
  <div id="response-unit" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('title', 'Unit Title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Unit Title']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('video', 'Unit Video Link') !!}
    {!! Form::text('video', null, ['class' => 'form-control', 'id' => 'video', 'placeholder' => 'Enter Unit Video']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('content', 'Content') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content', 'placeholder' => 'Enter Unit Content']) !!}

  </div>
</div><!-- /.box-body -->
<div class="box-footer">
  <button type="submit" class="btn btn-primary subject-button" id="create-unit">{{ $button }}</button>
</div>