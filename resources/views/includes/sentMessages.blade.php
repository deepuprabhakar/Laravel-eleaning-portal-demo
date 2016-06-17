<div class="mailbox-controls">
  <!-- Check all button -->
  <button type="button" class="btn btn-default btn-sm checkbox-toggle" style="width: 33px;"><i class="fa fa-square-o"></i>
  </button>
  <div class="btn-group">
    <button type="submit" class="btn btn-default btn-sm" id="delete"><i class="fa fa-trash-o"></i></button>
  </div>
  <!-- /.btn-group -->
  @if($messages->hasPages())
  <div class="pull-right pages">
  	<span class="text-muted">
  		{{ $pages['from'] }}-{{ $pages['to'] }}/{{ $pages['total'] }}
  </span>
  	{!! $messages->appends(['search' => 'de'])->render(new App\Pagination($messages)) !!}
  </div>
  <!-- /.pull-right -->
  @endif
</div>
<div class="table-responsive mailbox-messages">
  <table class="table table-hover table-striped" id="mail-table">
    <tbody>
    @if(!empty($pages['data']))
		@foreach ($pages['data'] as $message)
			<tr>
				<td>
					<input type="checkbox" class="message-check" name="message-check[]" value="{{ $message['hashid'] }}">
				</td>
				<td>
					<a href="{{ route('admin.messages.show', $message['hashid']) }}">
						{{ $message['receiver']['first_name'] }}
					</a>
				</td>
				<td>{{ $message['subject'] }}</td>
				<td>{{ $message['time'] }}</td>
			</tr>
		@endforeach
	@else
		<tr>
			<td colspan="4" class="text-muted text-center">No records found!</td>
		</tr>
    @endif
    </tbody>
  </table>
  <!-- /.table -->
</div>
<!-- /.mail-box-messages -->

