
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

<!-- row -->
<div class="row row-sm main-content-app mb-4">
    <div class="col-xl-4 col-lg-5">
        <div class="card">
            <div class="main-content-left main-content-left-chat">
                <nav class="nav main-nav-line main-nav-line-chat">
                    <a class="nav-link active" data-toggle="tab" href="">المحادثات الاخيرة</a>
                </nav>
                @livewire('chat.chatlist')
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <a class="main-header-arrow" href="" id="ChatBodyHide"><i class="icon ion-md-arrow-back"></i></a>
            @livewire('chat.chatbox')
            
        </div>
    </div>
</div>

@section('js')
<!--Internal  lightslider js -->
<script src="{{URL::asset('dashboard/plugins/lightslider/js/lightslider.min.js')}}"></script>
<!--Internal  Chat js -->
<script src="{{URL::asset('dashboard/js/chat.js')}}"></script>
@endsection
