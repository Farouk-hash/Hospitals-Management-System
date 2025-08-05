@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{__('dashboard/invoices_trans.title')}}</h4>
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
					<livewire:single-invoices /> 
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