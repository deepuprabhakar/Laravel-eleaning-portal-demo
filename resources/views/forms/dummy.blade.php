{!! Form::open(['url' => 'createUnit', 'autocomplete' => 'off', 'id' => 'unit-form']) !!}
            <div class="box-body">
              {{ Form::textarea('content', $subject['unit']['content'], ['class'=>'form-control', 'id' => 'content', 'placeholder' => 'Enter Unit Content Here']) }}
              {!! Form::hidden('subject_id', $subject['hashid'], ['id' => 'subjectid']) !!}
              <div id="response" style="display: none;"></div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary news-button" id="unit">Create</button>
            </div>
            <!-- /.box-body -->
            {{ Form::close() }}