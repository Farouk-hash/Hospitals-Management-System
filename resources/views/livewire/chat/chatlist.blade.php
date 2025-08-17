<div >
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
                <div class="media new" wire:click="chatSelected({{$conversation->id}})">
                    <div class="main-img-user online">
                        <img alt="" src="{{URL::asset('dashboard/img/'.$conversation->otherPartyImageUrl)}}"> 
                        <span>{{$conversation->unReadmessagesCount}}</span>
                    </div>

                    <div class="media-body">
                        <div class="media-contact-name">
                            <span>{{$conversation->otherParty->name ?? $conversation->otherParty->translations()->first()->name}}</span> 
                            <span>{{$conversation->created_at_human}}</span>
                        </div>
                        <p>{{$conversation->lastMessage() ? $conversation->lastMessage()->body : '....' }}</p>
                    </div>
                </div> 
                @endforeach

        </div><!-- main-chat-list -->

    </div>
</div>