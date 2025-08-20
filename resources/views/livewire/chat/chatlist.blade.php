
<div class="card">
    <div class="card-header d-flex align-items-center">
        <button type="button" 
                class="btn btn-sm btn-primary rounded-pill px-3" 
                wire:click="goBack">
            <i class="icon ion-md-arrow-back me-1"></i>
            {{ __('chat/chatlist.Back') }}
        </button>
    </div>


    <div class="main-content-left main-content-left-chat"> 
        <div class="main-content-left main-content-left-chat">
            <div class="main-chat-contacts-wrapper">
                <label class="main-content-label main-content-label-sm">Contacts ({{App\Models\Chat\Conversation::ConversationsBetweenParties()->count()}})</label>
                <label class="main-content-label main-content-label-sm">Active Contacts (5)</label>

                {{-- <div class="main-chat-contacts" id="chatActiveContacts">
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/3.jpg')}}"></div><small>Adrian</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/12.jpg')}}"></div><small>John</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/4.jpg')}}"></div><small>Daniel</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/13.jpg')}}"></div><small>Katherine</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/5.jpg')}}"></div><small>Raymart</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/14.jpg')}}"></div><small>Junrisk</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></div><small>George</small>
                    </div>
                    <div>
                        <div class="main-img-user online"><img alt="" src="{{URL::asset('assets/img/faces/15.jpg')}}"></div><small>Maryjane</small>
                    </div>
                    <div>
                        <div class="main-chat-contacts-more">
                            20+
                        </div><small>More</small>
                    </div>
                </div><!-- main-active-contacts --> --}}
            </div>  


            <div class="main-chat-list" id="ChatList">
                

                    @foreach ($conversations as $conversation)
                    <div class="media new d-flex align-items-center
                    {{ $highlightConversationId == $conversation->id ? 'bg-light border-start border-4 border-primary' : '' }}" 

                    wire:click="chatSelected({{$conversation->id}})">
                        
                    <div class="main-img-user-status" style="position: relative;" 
                        id="conversation-{{ class_basename($conversation->otherParty) }}-{{ $conversation->otherParty->id }}">
                        <span>{{$conversation->unReadmessagesCount}}</span>
                        <img alt="" src="{{URL::asset('dashboard/img/'.$conversation->otherPartyImageUrl)}}">                              
                        
                        <span class="status-indicator" style="position: absolute; bottom: 2px; right: 2px; width: 12px; height: 12px; background-color: {{ $conversation->otherParty->is_online ? 'green' : 'red' }}; border-radius: 50%; border: 2px solid white;"></span>
                    </div>

                        <div class="media-body">
                            <div class="media-contact-name">
                                <span>{{$conversation->otherParty->name ?? $conversation->otherParty->translations()->first()->name}}</span> 
                                <span>{{$conversation->created_at_human}}</span>
                            </div>
                            <p>{{$conversation->lastMessage() ? $conversation->lastMessage()->body : '....' }}</p>
                        </div>

                        <!-- Remove button -->
                        <button type="button" 
                                class="btn btn-sm text-danger bg-transparent border-0"
                                wire:click.stop="removeConversation({{$conversation->id}})">
                            <i class="icon ion-md-trash"></i>
                        </button>

                    </div> 
                    @endforeach

            </div><!-- main-chat-list -->

        </div>
    </div>
</div>