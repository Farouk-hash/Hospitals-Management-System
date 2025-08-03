
<div>
@if($showTable)
    @include('livewire.group-services-table')
@else
        <h3>Create Service Group</h3>
        <div style="margin-bottom: 10px;">
            <label>Group Name:</label>
            <input type="text" wire:model.defer="groupName" class="form-control" 
            >
        </div>

        <div style="margin-bottom: 10px;">
            <label>Group Notes:</label>
            <textarea wire:model.defer="groupNotes" class="form-control" rows="3" 
               >
            </textarea>
        </div>

        

        <!-- Discount and Taxes Section -->
        <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
            <h5>Pricing Details</h5>
            <div style="display: flex; gap: 15px; margin-bottom: 10px;">
                <div style="flex: 1;">
                    <label>Discount (%):</label>
                    <input type="number" step="0.01" wire:model.lazy="discount" class="form-control" placeholder="0.00" min="0" max="100">
                </div>
                <div style="flex: 1;">
                    <label>Tax Rate (%):</label>
                    <input type="number" step="0.01" wire:model.lazy="taxRate" class="form-control" placeholder="0.00" min="0">
                </div>
            </div>
        </div>

        @if($showTable)
        <button wire:click="toggleAddService" class="btn btn-primary" style="margin-top: 15px;">
            {{ $showAddService ? 'Cancel Adding Services' : 'Add Services' }}
        </button>
        @endif
        @if($showAddService)
            <hr>
            <h4>Select a Service</h4>
            
            <!-- Available Services -->
            <div style="margin-bottom: 15px;">
                @foreach($availableServices as $service)
                    <button 
                        wire:click="selectService({{ $service['id'] }})"
                        class="btn btn-sm {{ $selectedService == $service['id'] ? 'btn-success' : 'btn-outline-secondary' }}"
                        style="margin: 2px;">
                        {{ $service['name'] ?? $service['translations'][0]['name']}}
                    </button>
                @endforeach
            </div>

            @if($selectedService)
                <div style="margin-top: 15px; padding: 15px; background: #e8f5e8; border: 1px solid #c3e6cb; border-radius: 5px;">
                    <h5>Service Details (Service ID: {{ $selectedService }})</h5>
                    
                    <div style="margin-bottom: 10px;">
                        <label>Price:</label>
                        <input type="number" wire:model.defer="servicePrice" class="form-control" placeholder="Enter service price" readonly>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label>Quantity:</label>
                        <input type="number" wire:model.defer="serviceQuantity" class="form-control" min="1" placeholder="Enter quantity">
                    </div>

                    <button wire:click="addServiceToGroup" class="btn btn-success" style="margin-top: 10px;">
                        Confirm Service
                    </button>
                </div>
            @endif

            <!-- Redo Section for removed services -->
            @if(count($removedServices) > 0)
                <div style="margin-top: 15px; padding: 15px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px;">
                    <h5>Add Back Services</h5>
                    <p>Click to add these services back to the available list:</p>
                    <div>
                        @foreach($removedServices as $service)
                            <button 
                                wire:click="redoService({{ $service['id'] }})" 
                                class="btn btn-sm btn-warning" 
                                style="margin: 2px;">
                                ↺ {{ $service['name'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif

        @if(count($addedServices) > 0)
            <hr>
            <h4>Added Services ({{ count($addedServices) }}):</h4>
            @foreach($addedServices as $index => $service)
                <div style="padding: 10px; margin-bottom: 10px; background: #e9ecef; border-radius: 5px; position: relative;">
                    <strong>{{ $service['name'] }}</strong><br>
                    <small>Price: ${{ number_format($service['price'], 2) }} | Qty: {{ $service['quantity'] }} | Total: ${{ number_format($service['price'] * $service['quantity'], 2) }}</small>
                    <button wire:click="removeService({{ $index }})" class="btn btn-sm btn-danger" style="float: right;">
                        Remove
                    </button>
                </div>
            @endforeach

            <!-- Total Summary -->
            <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; border-radius: 5px; margin-top: 15px;">
                <h5>Summary</h5>
                <div><strong>Subtotal: ${{ number_format($this->subtotal, 2) }}</strong></div>
                <div>Discount ({{ $discount }}%): -${{ number_format($this->discountAmount, 2) }}</div>
                <div>Tax ({{ $taxRate }}%): +${{ number_format($this->taxAmount, 2) }}</div>
                <div style="font-size: 18px; margin-top: 10px;">
                    <strong>Total: ${{ number_format($this->finalTotal, 2) }}</strong>
                </div>
            </div>

            <button wire:click="confirm" class="btn btn-sm btn-primary" style="margin-top: 15px;">
                {{$service_id ? 'Update':'Confirm'}}
            </button>
        @endif
@endif
</div>