@extends('doctors_dashboard.layouts.master-doctor')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                    {{ __('doctors/index_trans.welcome_title') }}
                </h2>
                <p class="mg-b-0">{{ __('doctors/index_trans.welcome_subtitle') }}</p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <h6 class="mb-3 tx-12 text-white">{{ __('doctors/index_trans.completed_invoices') }}</h6>
                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$invoicesStates['completed']}}</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <h6 class="mb-3 tx-12 text-white">{{ __('doctors/index_trans.uncompleted_invoices') }}</h6>
                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$invoicesStates['uncompleted']}}</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <h6 class="mb-3 tx-12 text-white">{{ __('doctors/index_trans.cash_invoices') }}</h6>
                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$invoicesStates['cash']}}</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <h6 class="mb-3 tx-12 text-white">{{ __('doctors/index_trans.promissory_invoices') }}</h6>
                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$invoicesStates['promissory']}}</h4>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-info-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <h6 class="mb-3 tx-12 text-white">{{ __('doctors/index_trans.review_invoices') }}</h6>
                <h4 class="tx-20 font-weight-bold mb-1 text-white">{{$invoicesStates['review']}}</h4>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
@endsection
