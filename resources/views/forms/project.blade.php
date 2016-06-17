<div class="box-body">
  @include('errors.list')
  <div id="response" style="display: none;"></div>
  @include('errors.success')
  {{ form::hidden('id', $project['id']) }}
  @if($project)
  <div class="form-group">
    {!! Form::label('topic', 'Topic') !!}
    {!! Form::text('topic', $project['topic'], ['class' => 'form-control', 'id' => 'topic', 'placeholder' => 'Enter topic']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', $project['description'], ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter project description']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('project', 'Project') !!}
    {!! Form::file('project', ['class' => 'form-control', 'id' => 'project']) !!}
      
  </div>
  <div class="form-group">
    @if($project['project']!= '')
        <a href="{{ url('uploads/projects', $project['project']) }}" class="btn btn-primary btn-sm" id="download" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  {{ $project['project'] }}</a>
      @endif
  </div>
  @else
    <div class="form-group">
    {!! Form::label('topic', 'Topic') !!}
    {!! Form::text('topic', null, ['class' => 'form-control', 'id' => 'topic', 'placeholder' => 'Enter topic']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Enter project description']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('project', 'Project') !!}
    {!! Form::file('project', ['class' => 'form-control', 'id' => 'project']) !!}
  </div>
  @endif
</div><!-- /.box-body -->

<div class="box-footer">
  <button type="submit" class="btn btn-primary news-button">{{ $button }}</button>
</div>
