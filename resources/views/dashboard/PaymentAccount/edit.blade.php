@extends('dashboard.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@section('title')
    {{ __('dashboard/finance_trans.update_payment_account') }}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('dashboard/finance_trans.title') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('dashboard/finance_trans.update_payment_account') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.finance_payment_account.update') }}" method="post" autocomplete="off">
                        {{method_field('put')}}
                        @csrf
                        <input type="hidden" name='id' value={{$paymentAccount->id}}>
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                    
                            {{-- Credit Field --}}
                            <div class="row row-xs align-items-center mb-3">
                                {{-- Patient Name --}}
                                <div class="col-md-4">
                                    <label>{{ __('dashboard/finance_trans.patient_name') }}</label>
                                    <input type="text" 
                                        class="form-control"
                                        value="{{ $paymentAccount->patient->name ?? $paymentAccount->patient->translations->first()->name }}"
                                        readonly>
                                    <input type="hidden" value="{{ $paymentAccount->patient_id }}" name="patient_id">                            
                                </div>

                                {{-- Credit Remaining --}}
                                <div class="col-md-4">
                                    <label>{{ __('dashboard/finance_trans.credit_remaning') }}</label>
                                    <input type="number" 
                                        name="credit_remaning" 
                                        id="credit_remaining" 
                                        class="form-control text-success" 
                                        value="{{ $paymentAccount->remaningAmountForPatient }}" 
                                        readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>{{ __('dashboard/finance_trans.credit_updating_allowed') }}</label>
                                    <input type="number" 
                                        name="credit_allowed" 
                                        id="credit_allowed" 
                                        class="form-control text-success" 
                                        value="{{ $paymentAccount->credit }}" 
                                        readonly>
                                </div>

                                {{-- Credit Field --}}
                                <div class="col-md-4">
                                    <label>{{ __('dashboard/finance_trans.credit') }}</label>
                                    <input type="number" 
                                        step="0.01" 
                                        name="credit"
                                        class="form-control @error('credit') is-invalid @enderror"
                                        value="{{ old('credit')??$paymentAccount->credit }}"
                                        required    >
                                    @error('credit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>



                            {{-- Notes Field --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.notes') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <textarea name="notes" rows="3" 
                                    class="form-control @error('notes') is-invalid @enderror">
                                    {{ old('notes') ?? $paymentAccount->notes }}
                                    </textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                                {{ __('dashboard/finance_trans.update_payment_account') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
