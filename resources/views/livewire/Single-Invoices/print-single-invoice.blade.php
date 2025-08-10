@extends('dashboard.layouts.master')

@section('css')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('dashboard/invoices_trans.title') }}</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard/invoices_trans.print_invoice') }}</span>
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
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.service_price') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('service_price') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.discount') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('discount') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.subtotal') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('subtotal') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.tax_rate') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('tax_rate') }}%</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.tax_amount') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('tax_amount') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.Total_price') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('total_price') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.Patient_Name') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('patient') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.service_name') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('service') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.Doctors') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('doctor') }}</p>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"><strong>{{ __('dashboard/invoices_trans.section') }}:</strong></label>
                            <p class="form-control-plaintext">{{ Request::get('section') }}</p>
                        </div>
                    </form>
                </div>

                <!-- Print Button -->
                <div class="mt-4 text-center">
                    <button onclick="print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> {{ __('dashboard/invoices_trans.print_invoice') }}
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
