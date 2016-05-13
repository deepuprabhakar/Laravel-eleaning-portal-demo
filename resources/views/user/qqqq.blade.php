  <!-- quiz -->
            <div class="tab-pane fade" id="tab_3">
              @if(is_null($quizResult))
                @if(is_null($quiz))
                  <div class="question">
                    <div class="callout callout-info" style="margin: 15px 0">
                      <p>Will be updated soon...</p>
                    </div>
                  </div>
                @else
                  <div id="quiz-content">
                    <p class="text-center">Please note quiz can be taken only once.<br>
                    Click on start button to begin the Quiz....</p>
                    <div class="text-center">
                      <button class="btn btn-primary btn-flat" style="width: 150px;" id="quiz-start">Start</button>
                    </div>
                  </div>
                  <div id="response" style="display: none;" class="text-center"></div>
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div id="quiz-questions" style="display: none;">
                        <!-- <div class="bg-red timer-holder">
                          <span id="timer-countdown"></span>
                          <i class="fa fa-clock-o"></i>
                        </div> -->
                        <div class="timer-holder bg-red">
                          <div id="countdown"></div>
                          <i class="fa fa-clock-o"></i>
                        </div>
                        {!! Form::open(['url' => route('quiz.store'), 'id' => 'quiz-form']) !!}
                        {!! Form::hidden('subject', $subject->slug, []) !!}
                        @foreach ($quiz as $key => $question)
                          <div id="{{ $key }}">
                            <div class="question">
                              <div class="callout callout-success" style="margin: 15px 0">
                                <p>Question: {{ ucfirst($question['question']) }}</p>
                              </div>
                            </div>
                            <div class="answers">
                              <div style="margin: 5px 0;">
                              {!! Form::radio($question['hashid'], 'A', false, ['class' => 'flat-red', 'id' => 'radio-1-'.$key]) !!}
                              <label for="radio-1-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['A']) }}</label>&nbsp;&nbsp;
                              </div>
                              <div style="margin: 5px 0;">
                              {!! Form::radio($question['hashid'], 'B', false, ['class' => 'flat-red', 'id' => 'radio-2-'.$key]) !!}
                              <label for="radio-2-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['B']) }}</label>&nbsp;&nbsp;
                              </div>
                              <div style="margin: 5px 0;">
                              {!! Form::radio($question['hashid'], 'C', false, ['class' => 'flat-red', 'id' => 'radio-3-'.$key]) !!}
                              <label for="radio-3-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['C']) }}</label>&nbsp;&nbsp;
                              </div>
                              <div style="margin: 5px 0;">
                              {!! Form::radio($question['hashid'], 'D', false, ['class' => 'flat-red', 'id' => 'radio-4-'.$key]) !!}
                              <label for="radio-4-{{ $key }}" style="cursor: pointer;"> {{ ucfirst($question['D']) }}</label>&nbsp;&nbsp;
                              </div>
                            </div>
                          </div>
                        @endforeach
                        <div class="form-group text-center">
                          {!! Form::button('Finish', ['class' => 'btn btn-success', 'style' => 'width: 150px; display: none;', 'id' => 'quiz-finish']) !!}
                        </div>

                      </div>
                    </div>
                  </div><!-- ./row-->
                @endif
              @else
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="callout callout-success text-center">
                      <p style="font-size: 15px;">Attended: {{ $quizResult->attended }}/5</p style="font-size: 15px;">
                      <h4>Your score: {{ $quizResult->score }}/5</h4>
                    </div>
                  </div>
                </div>
              @endif
            </div><!-- ./quiz -->