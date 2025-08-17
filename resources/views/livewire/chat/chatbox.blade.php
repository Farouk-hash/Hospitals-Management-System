<div
    
>@if($conversation)
    <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
    <div class="main-content-body main-content-body-chat">
        <div class="main-chat-header">
            <div class="main-img-user"><img alt="" src="{{URL::asset('dashboard/img/'.$otherPartyInformations['imageUrl'] )}}"></div>
            <div class="main-chat-msg-name">
                <h6>{{$otherPartyInformations['name']}}</h6><small>Last seen: {{$otherPartyInformations['lastSeen']}}</small>
            </div>
        
        </div><!-- main-chat-header -->
        <div class="main-chat-body" id="ChatBody">
            <div class="content-inner">
                
                @php $lastDate=null; @endphp
                @foreach ($otherPartyInformations['messages'] as $message )
                    @php
                        $messageDate = \Carbon\Carbon::parse($message->created_at)->toDateString();
                    @endphp
                    @if ($lastDate !== $messageDate)
                        <label class="main-chat-time">
                            <span>{{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y') }}</span>
                        </label>
                        @php $lastDate = $messageDate; @endphp
                    @endif

                    <div class="media {{$message->isMine() ? 'flex-row-reverse':''}} ">
                        <div class="main-img-user online">
                            <img alt="" 
                            src="{{URL::asset('dashboard/img/'. $message->senderImageUrl )}}"
                            >
                        </div>
                        
                        <div class="media-body">
                            <div style="display: flex; align-items: flex-end; gap: 8px; {{$message->isMine() ? 'flex-direction: row-reverse;' : ''}}">
                                <div class="main-msg-wrapper {{$message->isMine() ? 'right':''}}">
                                    {{$message->body}}
                                </div>
                                <div style="font-size: 11px; color: #999; white-space: nowrap; margin-bottom: 2px;">
                                    <span>{{$message->created_at_human}}</span>
                                    <a href="" style="color: #999; margin-left: 5px;"><i class="icon ion-android-more-horizontal"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                
               
            </div>
        </div>
        
        @livewire('chat.sendmessage')
@endif
</div>

{{-- FOR DUBGGING  --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        console.log('=== Echo Debug ===');
        console.log('Echo available:', typeof window.Echo !== 'undefined');
        console.log('Pusher available:', typeof window.Pusher !== 'undefined');
        console.log('Echo object:', window.Echo);
    }, 1000);
});
</script>
<script>
    document.addEventListener('DOMContentLoaded',function(){
    window.Echo.private(`chat.{{ class_basename(auth()->user()) }}.{{ auth()->id() }}`)
    .listen('.message.sent', (e) => {
        console.log('livewire listening')
        @this.call('receiveMessage', e);
    });
    });

</script>
