<div id="messages">
  <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-envelope fa-fw"></i>
    <!-- Counter - Messages -->
    @if( count(Helper::messageList()) > 5) <span data-count="5" class="count badge badge-danger badge-counter">5+</span> @else <span class="count badge badge-danger badge-counter" data-count="{{count(Helper::messageList())}}">{{count(Helper::messageList())}}</span> @endif
  </a>
  <!-- Dropdown - Messages -->
  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">
      Message Center
    </h6>

    <div id="message-items">
    @foreach ( Helper::messageList() as $message)
      <a class="dropdown-item d-flex align-items-center message-item" href="{{route('admin.message.show', $message->id)}}">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="{{ Helper::get_gravatar($message->email,60) }}" alt="{{ $message->name }}">
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate">{{ $message->subject }}.</div>
          <div class="small text-gray-500">{{ $message->name }} · {{$message->created_at->format('F d, Y h:i A')}}</div>
        </div>
      </a>
      @if($loop->index +1==5) @php break; @endphp  @endif
    @endforeach
    </div>


    <a class="dropdown-item text-center small text-gray-500" href="{{route('admin.message.index')}}">Read More Messages</a>
  </div>
</div>

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {

    Echo.channel('message')
      .listen('MessageEvent', (e) => {

      const message_container = $('#message-items');
      const message_counter_area = $('#messages .count');
      const message_counter = parseInt( $(message_counter_area).attr('data-count') ) + 1;
      const message_length = parseInt( $('#message-items>.dropdown-item').length );
      $(message_counter_area).attr('data-count', message_counter);

      const data = `
      <a class="dropdown-item d-flex align-items-center message-item" href="${e.message.url}">
        <div class="dropdown-list-image mr-3">
          <img class="rounded-circle" src="${e.message.image}" alt="${e.message.name}">
        </div>
        <div class="font-weight-bold">
          <div class="text-truncate">${e.message.subject}</div>
          <div class="small text-gray-500">${e.message.name} · ${e.message.date}</div>
        </div>
      </a>
      `;

      $(message_container).prepend(data);

      if(message_counter<=5){
        $(message_counter_area).text( message_counter );
      }else{ 
        $(message_counter_area).text('5+');
      };

      if(message_length>=5) $(message_container).find('.message-item').last().remove();

    });

  });
</script>
@endpush