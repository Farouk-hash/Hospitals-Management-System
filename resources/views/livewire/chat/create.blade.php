<div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                @if(!$selectedType)
                    {{-- Dropdown for selecting chat type --}}
                    <div class="mb-3">
                         <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary" wire:click="loadUsersByType('doctor')">
                                {{ __('chat/chatlist.chatlist-doctors') }}
                            </button>
                            <button type="button" class="btn btn-outline-primary" wire:click="loadUsersByType('admin')">
                                {{ __('chat/chatlist.chatlist-admins') }}
                            </button>
                            <button type="button" class="btn btn-outline-primary" wire:click="loadUsersByType('ray_employee')">
                                {{ __('chat/chatlist.chatlist-xray-employee') }}
                            </button>
                        </div>
                    </div>
                @else
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
                                        <td>
                                            <button
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
                @endif
            </div>
        </div>
    </div>
</div>