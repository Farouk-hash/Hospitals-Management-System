@extends('dashboard.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@section('title')
    {{ __('dashboard/finance_trans.add_payment_account') }}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('dashboard/finance_trans.title') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('dashboard/finance_trans.add_payment_account') }}
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
                    <form action="{{ route('dashboard.finance_payment_account.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            {{-- Patient Dropdown --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.patient_name') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <select name="patient_id" id="patient_select" class="form-control @error('patient_id') is-invalid @enderror">
                                        <option value="" disabled selected>-- {{ __('dashboard/finance_trans.patient_name') }} --</option>
                                        @foreach ($singleInvoicesPromissories as $singleInvoicesPromissory)
                                            <option value="{{ $singleInvoicesPromissory->patient->id }}" 
                                                    data-credit="{{ $singleInvoicesPromissory->remaningAmountForPatient }}">
                                                {{ $singleInvoicesPromissory->patient->name ?? $singleInvoicesPromissory->patient->translations->first()->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            {{-- Credit Remaining Field + Credit Field --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-6 d-flex align-items-center">
                                    <label class="mb-0 me-2">
                                        {{ __('dashboard/finance_trans.credit_remaning') }}
                                    </label>
                                    <input type="number" step="0.01" name="credit_remaning" id="credit_remaining" 
                                        class="form-control text-success" value="0.00" readonly>
                                </div>
                          
                                {{-- Credit Field --}}
                                <div class="col-md-6 d-flex align-items-center">
                                    <label class="mb-0 me-2" >
                                        {{ __('dashboard/finance_trans.credit') }}
                                    </label>
                                    <div class="flex-grow-1">
                                        <input type="number" step="0.01" name="credit"
                                            class="form-control @error('credit') is-invalid @enderror"
                                            value="{{ old('credit') }}">
                                        @error('credit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            {{-- Notes Field --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.notes') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <textarea name="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                                {{ __('dashboard/finance_trans.add_payment_account') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
$(document).ready(function() {
    //  credit remaining field when a patient is selected
    $('#patient_select').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var creditRemaining = selectedOption.data('credit') || '0.00';
        $('#credit_remaining').val(parseFloat(creditRemaining).toFixed(2));
    })
    });
</script>
@endsection
