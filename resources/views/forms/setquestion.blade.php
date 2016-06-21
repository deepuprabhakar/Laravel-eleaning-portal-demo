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
    <button class="btn btn-block btn-info btn-lg" id ="add">Add Category Details</button><br>
    <div class="form-group" id="adddetails" style="display:none">
     {!! Form::open(['url' => route('admin.test.setquestionstore'), 'autocomplete' => 'off', 'id' => 'cat-form']) !!}
        <div class="form-group">
        {!! Form::select('category', [null => 'Select Category']+$category, null, ['id' => 'category', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
      </div>
       <div class="form-group">
          {{ Form::text('number',null,['class'=> 'form-control', 'id' => 'number','placeholder' => 'Enter Number of Questions']) }}
        </div>
        <div class="form-group">
          {{ Form::text('mark',null,['class'=> 'form-control', 'id' => 'mark','placeholder' => 'Enter Mark For One Question']) }}
        </div>
        <div class="form-group">
          {{ Form::text('negativemark',null,['class'=> 'form-control', 'id' => 'negativemark','placeholder' => 'Enter Negative Mark For One Question']) }}
        </div>
         <button class="btn btn-block btn-info btn-lg" id = "adddata" style>Add</button>
        {!! Form::close() !!}
      </div>
    
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary news-button" id="quiz">{{ $button }}</button>
</div>
