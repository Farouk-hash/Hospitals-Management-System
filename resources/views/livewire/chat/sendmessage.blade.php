<div class="main-chat-footer">
    <nav class="nav">
        <a class="nav-link" data-toggle="tooltip"  title="Add Photo"><i class="fas fa-camera"></i></a> 
        <a class="nav-link" data-toggle="tooltip"  title="Attach a File"><i class="fas fa-paperclip"></i></a> 
        <a class="nav-link" data-toggle="tooltip"  title="Add Emoticons"><i class="far fa-smile"></i></a> 
        <a class="nav-link" href=""><i class="fas fa-ellipsis-v"></i></a>
    </nav>
    <input class="form-control" placeholder="Type your message here..." type="text" wire:model="message"> 
    <a class="main-msg-send" wire:click="submit" data-toggle="tooltip" title="Send Message">
        <i class="far fa-paper-plane" ></i>
    </a>
</div>