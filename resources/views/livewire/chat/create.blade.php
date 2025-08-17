<div wire:ignore>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                            
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('chat/chatlist.'.$title) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> <button 
                                        type="button" 
                                        class="btn btn-primary btn-sm"
                                        wire:click="createConversation({{ $user->id }})"
                                    >
                                        {{ $user->name ?? $user->translations()->first()->name }}
                                    </button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>
</div>
