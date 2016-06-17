@foreach($news as $key => $content)
  <!-- timeline time label -->
  <li class="time-label">
      <span class="bg-red">
        {{ $content['date'] }}
      </span>
  </li>
  <!-- /.timeline-label -->
  <!-- timeline item -->
  <li>
    <i class="fa fa-newspaper-o bg-blue"></i>
    <div class="timeline-item">
      <span class="time">
        <i class="fa fa-clock-o"></i> 
        {{ $content['time'] }}
      </span>
          <h3 class="timeline-header"><a href="{{ route('news.show', $content['slug']) }}">{{ str_limit($content['title'], 100) }}</a></h3>
      <div class="timeline-body" style="overflow: auto;">
      <div class="">
        {!! str_limit((Purifier::clean($content['content'])), 300) !!}
      </div>
      </div>
      <div class="timeline-footer" style="padding-top: 0;">
        <a class="btn btn-primary btn-xs btn-flat" href="{{ route('news.show', $content['slug']) }}">Read more</a>
      </div>
    </div>
  </li>
  <!-- END timeline item -->
  <!-- timeline item -->
@endforeach