@extends('doctors_dashboard.layouts.master-doctor')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{__('doctors//invoices_trans.title')}}</h4>
				<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard/invoices_trans.single_invoice_title')}}</span>
			</div>
		</div>
	</div>

@endsection
@section('content')
<div class="row row-sm">
        
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                                
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('dashboard/invoices_trans.Patient_Name') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.service_name') }}</th>

                                    <th>{{ __('dashboard/invoices_trans.service_price') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.discount') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.subtotal') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.tax_rate') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.tax_amount') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.Total_price') }}</th>

                                    <th>{{ __('dashboard/invoices_trans.payment_type') }}</th>

                                    <th>{{ __('dashboard/invoices_trans.Created_At') }}</th>
                                    <th>{{ __('dashboard/invoices_trans.Updated_At') }}</th>
                                    
                                    <th>{{ __('dashboard/invoices_trans.status') }}</th>

                                    <th>{{ __('dashboard/invoices_trans.Actions') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href={{route('doctors_dashboard.diagnostic.show' , [$invoice->patient->id])}}>
                                            {{ $invoice->patient->name ?? $invoice->patient->translations->first()->name}}
                                        </td>
                                        <td>{{ $invoice->service->name ?? $invoice->service->translations->first()->name}}</td>

                                        <td>{{ $invoice->service_price }}</td>
                                        <td>{{ $invoice->discount }}</td>
                                        <td>{{ $invoice->subtotal }}</td>
                                        <td>{{ $invoice->tax_rate }}%</td>
                                        <td>{{ $invoice->tax_amount }}</td>
                                        <td>{{ $invoice->total_price }}</td>
                                        <td>{{ $invoice->payment_type->name }}</td>

                                        <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                        <td>{{ $invoice->updated_at->diffForHumans() }}</td>

                                        <td>{{ 
                    
                                        $invoice->invoiceStatus->translation ?  $invoice->invoiceStatus->translation->name :
                                        $invoice->invoiceStatus->translations()->first()->name
                                        
                                        }}</td>

                                        @if($invoice->doctor->id == Auth::id())
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $invoice->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ __('dashboard/doctors_trans.Processes') }}
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $invoice->id }}">
                                                    <a class="dropdown-item modal-effect text-primary" 
                                                    data-effect="effect-scale"  
                                                    data-toggle="modal" href="#add{{$invoice->id}}">
                                                        
                                                    <i class="las la-pen"></i> {{ __('dashboard/doctors_trans.diagnostic') }}
                                                    </a>

                                                    <a class="dropdown-item modal-effect text-warning" data-effect="effect-scale"
                                                    data-toggle="modal"
                                                    href="#addreview{{$invoice->id}}">
                                                        <i class="las la-pen"></i> {{ __('doctors/invoices_trans.diagnostic_review') }}
                                                    </a>

                                                    <a class="dropdown-item modal-effect text-secondary" data-effect="effect-scale"
                                                    data-toggle="modal"
                                                    href="#addlab{{$invoice->id}}">
                                                        <i class="las la-pen"></i> {{ __('doctors/invoices_trans.lab') }}
                                                    </a>
                                                    
                                                </div>
                                                @include('doctors_dashboard.Invoices.create_diagnostic')
                                                @include('doctors_dashboard.Invoices.create_diagnostic_review')
                                                @include('doctors_dashboard.Invoices.create_lab')


                                            </div>    
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
		
@endsection
@section('js')
@endsection