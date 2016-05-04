<div class="box-body">
  @include('errors.list')
<div id="response" style="display: none;"></div>
  @include('errors.success')
  <div class="form-group">
    {!! Form::select('to', [null => 'Select Name']+$names, null, ['id' => 'to', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
  </div>
  <div class="form-group">
    {!! Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Subject:']) !!}
  </div>
  <div class="form-group">
    
    <textarea name="message" id="body" class="form-control">{{ old('message') }}</textarea>
  </div>
</div>
<div class="box-footer">
  <div class="pull-right">
    <button type="submit" class="btn btn-primary message-button"><i class="fa fa-envelope"></i> Send</button>
  </div>
  <button type="reset" class="btn btn-default" id="message-reset"><i class="fa fa-times"></i> Discard</button>
</div>