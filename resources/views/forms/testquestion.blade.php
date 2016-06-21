<div class="box-body">

    @include('errors.success')
    @include('errors.list')
    <div class="form-group">
        {{ Form::text('question', null, ['class' => 'form-control', 'id' => 'question', 'placeholder' => 'Enter Question']) }}
    </div>
    <div class="form-group">
      {{ Form::text('A',null,['class'=> 'form-control', 'id' => 'A','placeholder' => 'Enter Option A']) }}
    </div>
    <div class="form-group">
      {{ Form::text('B',null,['class'=> 'form-control', 'id' => 'B','placeholder' => 'Enter Option B']) }}
    </div>
    <div class="form-group">
      {{ Form::text('C',null,['class'=> 'form-control', 'id' => 'C','placeholder' => 'Enter Option C']) }}
    </div>
    <div class="form-group">
      {{ Form::text('D',null,['class'=> 'form-control', 'id' => 'D','placeholder' => 'Enter Option D']) }}
    </div>
    <div class="form-group">
        {!! Form::label('answer', 'Answer') !!}
        <div class="form-group">
            {!! Form::radio('answer', 'A', true, ['class' => 'flat-red', 'id' => 'optionA']) !!}
            <label for="A" style="cursor: pointer;"> A</label>&nbsp;&nbsp;
            {!! Form::radio('answer', 'B', false, ['class' => 'flat-red', 'id' => 'optionB']) !!} 
            <label for="B" style="cursor: pointer;"> B</label>
            {!! Form::radio('answer', 'C', false, ['class' => 'flat-red', 'id' => 'optionC']) !!}
            <label for="C" style="cursor: pointer;"> C</label>&nbsp;&nbsp;
            {!! Form::radio('answer', 'D', false, ['class' => 'flat-red', 'id' => 'optionD']) !!} 
            <label for="D" style="cursor: pointer;"> D</label>
            </div>
    </div>
    <div class="form-group">
    {!! Form::label('category', 'Category') !!}
    {!! Form::select('category', [null => 'Select Category']+$category, null, ['id' => 'category', 'class' => 'form-control', 'style' => 'width: 100%']) !!}
  </div>
    
</div>
<div class="box-footer">
    <button type="submit" class="btn btn-primary news-button" id="quiz">{{ $button }}</button>
</div>