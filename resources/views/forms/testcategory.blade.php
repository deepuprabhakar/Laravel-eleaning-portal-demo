<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::label('name', 'Category Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Enter Category Name']) !!}
    
  </div>
  
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary course-button">{{ $button }}</button>
</div>