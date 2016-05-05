<ul class="menu">
  @foreach($latest as $message)
    @if($message['status'] == 0)
      <li class="message"><!-- start message -->
        @if(Sentinel::inRole('admin'))
          <a href="{{ route('admin.messages.show', $message['hashid']) }}">
        @else
          <a href="{{ route('messages.show', $message['hashid']) }}">
        @endif
          <div class="pull-left">
            <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="img-circle" alt="User Image">
          </div>
          <h4>
            {{ $message['user']['first_name'] }}
            <small><i class="fa fa-clock-o"></i> {{ $message['time'] }}</small>
          </h4>
          <p>{!! str_limit($message['message'], 30) !!}</p>
        </a>
      </li><!-- end message -->
      @else
        <li><!-- start message -->
        @if(Sentinel::inRole('admin'))
          <a href="{{ route('admin.messages.show', $message['hashid']) }}">
        @else
          <a href="{{ route('messages.show', $message['hashid']) }}">
        @endif
          <div class="pull-left">
            <img src="{{ asset('dist/img/default-160x160.jpg') }}" class="img-circle" alt="User Image">
          </div>
          <h4>
            {{ $message['user']['first_name'] }}
            <small><i class="fa fa-clock-o"></i>{{ $message['time'] }}</small>
          </h4>
          <p>{!! str_limit($message['message'], 30) !!}</p>
        </a>
      </li><!-- end message -->
      @endif
  @endforeach
</ul>