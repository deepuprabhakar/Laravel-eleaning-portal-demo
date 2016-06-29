<div class="box-body">

    @include('errors.success')
    @include('errors.list')
    <div class="form-group">
        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter Question Title']) }}
    </div>
    <div class="form-group col-sm-6">
      {{ Form::text('timehr',null,['class'=> 'form-control', 'id' => 'time','placeholder' => 'Enter Total Hr of Exam']) }}
    </div>
    <div class="form-group col-md-6">
      {{ Form::text('timemin',null,['class'=> 'form-control', 'id' => 'time','placeholder' => 'Enter Total Min of Exam']) }}
    </div>
    <table id="category-table" class="table table-bordered table-hover display dt-responsive nowrap" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="width: 20px;">No.</th>
                          <th>Category Name</th>
                          <th>Number Of Questions</th>
                          <th>Mark</th>
                          <th>Negative Mark</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($categories as $key => $value)
                        <tr>
                          <td>{{ ++$key }}</td>
                          <td> {!! Form::select('category[]', [null => 'Select Category']+$category, null, ['id' => 'category', 'class' => 'form-control', 'style' => 'width: 100%']) !!}</td>
                           <td>{{ Form::text('noofquestion[]', null, ['id' => 'mark','class' => 'form-control', 'placeholder' => ' Number Of Questions']) }}</td>
                           <td>{{ Form::text('mark[]', null, ['class' => 'form-control', 'id' => 'remark', 'placeholder' => 'Enter Mark']) }}</td>
                           <td>{{ Form::text('negativemark[]', null, ['class' => 'form-control', 'id' => 'remark', 'placeholder' => 'Negative Mark']) }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                </table>
</div>

<div class="box-footer">
    <button type="submit" class="btn btn-primary set-button" id="setquestion">{{ $button }}</button>
</div>


