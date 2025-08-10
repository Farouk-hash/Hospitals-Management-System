@extends('dashboard.layouts.master')

@section('css')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('dashboard/finance_trans.promissory_bond_title') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard/finance_trans.print_promissory_bond') }}</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <!-- Invoice Content -->
                <div id="printed-content" class="p-4 border rounded bg-white">
                    <form id="invoice-form" class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/finance_trans.patient_name') }}:</strong></label>
                            <p class="form-control-plaintext">
                                {{ $recieptAccounts->patient->name ?? $recieptAccounts->patient->translations->first()->name }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/finance_trans.debit') }}:</strong></label>
                            <p class="form-control-plaintext">{{ $recieptAccounts->debit }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/finance_trans.notes') }}:</strong></label>
                            <p class="form-control-plaintext">{{ $recieptAccounts->notes }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/finance_trans.created_at') }}:</strong></label>
                            <p class="form-control-plaintext">{{ date('Y/m/d', strtotime($recieptAccounts->created_at)) }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/finance_trans.updated_at') }}:</strong></label>
                            <p class="form-control-plaintext">{{ date('Y/m/d', strtotime($recieptAccounts->updated_at)) }}</p>
                        </div>

                    </form>
                </div>

                <!-- Print Button -->
                <div class="mt-4 text-center">
                    <button onclick="print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> {{ __('dashboard/finance_trans.print') }}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function print() {
        let printContent = document.getElementById('printed-content').innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>
@endsection
