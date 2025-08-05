<div>
    @if($showTable)
        @include('livewire.single-invoices.single-invoices-table')
    @else
        <form wire:submit.prevent="submit">
            {{-- patient-id , doctor , section-related  --}}
           <div class="form-group mb-4 row align-items-end">
                {{-- Patient Section --}}
                <div class="col-md-3">
                    <label for="patient_id" class="form-label">{{ __('dashboard/invoices_trans.Patient_Name') }}</label>
                    <select 
                        id="patient_id" 
                        class="form-control @error('patient_id') is-invalid @enderror" 
                        wire:model.live="patient_id"
                        {{$this->updated ? 'disabled':''}}

                    >
                        <option value="">-- {{ __('dashboard/invoices_trans.Patient_Name') }} --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">
                                {{ $patient->name ?? $patient->translations->first()->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    
                    
                </div>

                {{-- Doctor Dropdown --}}
                <div class="col-md-3">
                    <label for="doctor_id" class="form-label">{{ __('dashboard/invoices_trans.Doctors') }}</label>
                    <select 
                        id="doctor_id" 
                        class="form-control @error('doctor_id') is-invalid @enderror" 
                        wire:model.live="doctor_id"
                        wire:change="doctorChanged"
                        {{$this->updated ? 'disabled':''}}

                    >
                        <option value="">-- {{ __('dashboard/invoices_trans.Doctors') }} --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">
                                {{ $doctor->name ?? $doctor->translations->first()->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>

                {{-- Section Field --}}
                <div class="col-md-3">
                    <label for="section" class="form-label">{{ __('dashboard/invoices_trans.section') }}</label>
                    <input 
                        type="text" 
                        id="section" 
                        class="form-control @error('section_variable') is-invalid @enderror" 
                        wire:model="section_variable" 
                        readonly
                        placeholder="Section will appear here..."
                    >
                   
                </div>

                {{-- PaymentType Section --}}
                <div class="col-md-3">
                    <label for="payment_type_id" class="form-label">{{ __('dashboard/invoices_trans.payment_type') }}</label>
                    <select 
                        id="payment_type_id" 
                        class="form-control @error('payment_type_id') is-invalid @enderror" 
                        wire:model.live="payment_type_id"
                        {{$this->updated ? 'disabled':''}}
                    >
                        <option value="">-- {{ __('dashboard/invoices_trans.payment_type') }} --</option>
                        @foreach($paymentsTypes as $paymentsType)
                            <option value="{{ $paymentsType->id }}">
                                {{ $paymentsType->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    
                </div>
            </div>

                        
            {{-- Service Selection and Price Calculation --}}
            <div class="form-group mb-3">
                <div class="row align-items-end">
                    {{-- Services Dropdown --}}
                    <div class="col-md-6">
                        <label for="service_id" class="form-label">{{ __('dashboard/invoices_trans.Services') }}</label>
                        <select 
                            id="service_id" 
                            class="form-control @error('service_id') is-invalid @enderror" 
                            wire:model.live="service_id"
                            wire:change="serviceSelected"
                            {{$this->updated ? 'disabled':''}}
                        >
                            <option value="">-- {{ __('dashboard/invoices_trans.Services') }} --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ $service->name ?? $service->translations->first()->name ?? '' }} - ${{ number_format($service->price, 2) }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    {{-- Service Price --}}
                    <div class="col-md-6">
                        <label for="service_price" class="form-label">{{ __('dashboard/invoices_trans.service_price') }}</label>
                        <input 
                            type="number" 
                            id="service_price"
                            class="form-control" 
                            wire:model="service_price" 
                            readonly
                            step="0.01"
                            placeholder="0.00"
                        >
                    </div>
                    </div>
                </div>

                {{-- Price Breakdown --}}
                <div class="form-group mb-3">
                    <div class="row">
                        {{-- Discount --}}
                        <div class="col-md-3">
                            <label for="discount" class="form-label">
                                {{ __('dashboard/invoices_trans.discount') }}
                                <small class="text-muted">(Amount)</small>
                            </label>
                            <input 
                                type="number" 
                                id="discount"
                                class="form-control @error('discount') is-invalid @enderror" 
                                wire:model.live="discount" 
                                step="0.01"
                                min="0"
                                max="{{ $service_price }}"
                                placeholder="0.00"
                            >
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        {{-- Subtotal (After Discount) --}}
                        <div class="col-md-3">
                            <label for="subtotal" class="form-label">
                                {{ __('dashboard/invoices_trans.subtotal') }}
                            </label>
                            <input 
                                type="number" 
                                id="subtotal"
                                class="form-control bg-light" 
                                wire:model="subtotal" 
                                readonly
                                step="0.01"
                                placeholder="0.00"
                            >
                        </div>
                        
                        {{-- Tax Rate --}}
                        <div class="col-md-3">
                            <label for="tax_rate" class="form-label">
                                {{ __('dashboard/invoices_trans.tax_rate') }}
                                <small class="text-muted">(%)</small>
                            </label>
                            <input 
                                type="number" 
                                id="tax_rate"
                                class="form-control @error('tax_rate') is-invalid @enderror" 
                                wire:model.live="tax_rate" 
                                step="0.01"
                                min="0"
                                max="100"
                                placeholder="14.00"
                            >
                            @error('tax_rate')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        {{-- Tax Amount --}}
                        <div class="col-md-3">
                            <label for="tax_amount" class="form-label">
                                {{ __('dashboard/invoices_trans.tax_amount') }}
                            </label>
                            <input 
                                type="number" 
                                id="tax_amount"
                                class="form-control bg-light" 
                                wire:model="tax_amount" 
                                readonly
                                step="0.01"
                                placeholder="0.00"
                            >
                        </div>
                    </div>
                </div>

            {{-- Final Total --}}
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <label for="total_price" class="form-label fw-bold fs-5">
                            {{ __('dashboard/invoices_trans.Total_price') }}
                        </label>
                        <input 
                            type="number" 
                            id="total_price"
                            class="form-control form-control-lg bg-success text-white fw-bold" 
                            wire:model="total_price" 
                            readonly
                            step="0.01"
                            placeholder="0.00"
                        >
                    </div>
                </div>
            </div>





            <button type="submit" class="btn btn-primary">
                {{ __('dashboard/invoices_trans.submit') }}
            </button>
        </form>
    @endif
</div>