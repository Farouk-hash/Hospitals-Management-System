
@section('css')
@endsection
@section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex"><h4 class="content-title mb-0 my-auto">{{__('chat/chatlist.chatlist-title')}}</h4>
                    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('chat/chatlist.chatlist-last-conversations')}}</span>
                
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
@endsection
@section('content')

<div>
    @if(!$selectedChat)
        @livewire('chat.create')
    @else
        <div class="row row-sm main-content-app mb-4">
        <!-- Chatlist column -->
        <div class="col-xl-4 col-lg-5">
            @livewire('chat.chatlist',['highlightConversationId' => $selectedConversationId])
        </div>
        
        <!-- Chatbox column -->
        <div class="col-xl-8 col-lg-7">
            @livewire('chat.chatbox',['highlightConversationId' => $selectedConversationId])
        </div>
    </div>
    @endif
</div>

@section('js')

    {{-- FOR ECHO DUBGGING  --}}
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

    {{-- FOR ECHO USER-STATUS USER ENTER CHATBOX , USER LEAVE CHATBOX  --}}
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        console.log('Setting up Echo listener for online status...');
        const channelName = 'userStatus.{{ class_basename(auth()->user())}}.{{auth()->id()}}';
        console.log('Channel name:', channelName);
        
         // Handle page unload (navigation, close, refresh)
            window.addEventListener('beforeunload', function(e) {
                console.log('🔴 User leaving page - setting offline');
                // Send offline status via Livewire
                @this.call('setUserOffline'); 
            });
            
            // Handle visibility change (tab switch, minimize)
            document.addEventListener('visibilitychange', function() {
                if (document.hidden) {
                    console.log('🟡 Page hidden - setting offline');
                    @this.call('setUserOffline');
                } else {
                    console.log('🟢 Page visible - setting online');
                    @this.call('setUserOnline');
                }
            });
            
            // Handle focus/blur events
            window.addEventListener('blur', function() {
                console.log('🟡 Window lost focus - setting offline');
                @this.call('setUserOffline');
            });
            
            window.addEventListener('focus', function() {
                console.log('🟢 Window gained focus - setting online');
                @this.call('setUserOnline');
            });

        window.Echo.private(channelName)
        .listen('.status-changed', (e) => {
            console.log('🔄 Chat partner is', e.status);
            console.log('Partner ID:', e.user_id);
            console.log('Partner class:', e.user_class);
            
            // Target the specific conversation by ID
            const conversationId = `conversation-${e.user_class}-${e.user_id}`;
            const statusIndicator = document.querySelector(`#${conversationId} .status-indicator`);
            
            if (statusIndicator) {
                // Smooth color transition
                statusIndicator.style.transition = 'background-color 0.3s ease';
                statusIndicator.style.backgroundColor = e.status === 'online' ? 'green' : 'red';
                console.log(`✅ Updated ${e.user_class} ${e.user_id} to ${e.status}`);
                
                // Optional: Add a brief animation to draw attention
                statusIndicator.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    statusIndicator.style.transform = 'scale(1)';
                }, 200);
            } else {
                console.log('⚠️ Status indicator not found for user:', e.user_id);
            }
        });
    });
    </script>

    {{-- FOR ECHO REALTIME MESSAGES  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function(){
        window.Echo.private(`chat.{{ class_basename(auth()->user()) }}.{{ auth()->id() }}`)
        .listen('.message.sent', (e) => {
            console.log('livewire listening');
            console.log('Livewire received' , e);
            // FOR SPECIFIF VIEW [WHEN WE WERE CALLING IT AT CHATBOX VIEW]
            // @this.call('receiveMessage', e);
            // Use global dispatch instead of finding specific component
            Livewire.dispatch('message-received-global', [e]);
        });
        });

    </script>
 

@endsection
