@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard/patient_trans.title')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard/patient_trans.patient_details')}}</span>

            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<!-- div -->
						<div class="card mg-b-20" id="tabs-style2">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									{{__('dashboard/patient_trans.patient_details')}}
								</div>
								<div class="text-wrap">
									<div class="example">
										<div class="panel panel-primary tabs-style-2">
											<div class=" tab-menu-heading">
												<div class="tabs-menu1">
													<!-- Tabs -->
													<ul class="nav panel-tabs main-nav-line">
														<li><a href="#tab4" class="nav-link active" data-toggle="tab">{{__('dashboard/patient_trans.patient_data_details')}}</a></li>
														<li><a href="#tab5" class="nav-link" data-toggle="tab">{{__('dashboard/patient_trans.patient_invoices')}}</a></li>                                                        
                                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">{{__('dashboard/finance_trans.account_statment')}}</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body tabs-menu-body main-content-body-right border">
												<div class="tab-content">
													
                                                    {{-- PATIENT-DETAILS --}}
                                                    <div class="tab-pane active" id="tab4">
                                                        <table class="table text-md-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.name') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.notes') }}</th>
                                                                    <th class="wd-10p border-bottom-0">{{ __('dashboard/patient_trans.gender') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.email') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.birth_date') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.phone_number') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.created_at') }}</th>
                                                                    <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.updated_at') }}</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                    <tr>
                                                                        <td>{{$patient->name ?? $patient->translations->first()->name}}</td>
                                                                        <td>{{$patient->notes ?? $patient->translations->first()->notes}}</td>
                                                                        <td>{{
                                                                            $patient->translate(App::getLocale())->gender->name ?? 
                                                                            $patient->translations->first()->gender->translations->first()->name
                                                                            }}
                                                                        </td>

                                                                        <td>{{$patient->email}}</td>
                                                                    

                                                                        <td>{{$patient->birth_date}}</td>
                                                                        <td>{{$patient->phone_number}}</td>
                                                                        <td>{{$patient->created_at->diffForHumans()}}</td>
                                                                        <td>{{$patient->updated_at->diffForHumans()}}</td>
                                                                        
                                                                    </tr>
                                                                
                                                            </tbody>
                                                        </table>
													</div>

                                                    {{-- INVOICES-DETAILS --}}
													<div class="tab-pane" id="tab5">
														<table class="table text-md-nowrap" id="example1">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('dashboard/invoices_trans.service_price') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.discount') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.subtotal') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.tax_rate') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.tax_amount') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.Total_price') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.service_name') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.Doctors') }}</th>
                                                                    <th>{{ __('dashboard/invoices_trans.section') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($patient->singleInvoices as $singleInvoice)
                                                                    <tr>
                                                                        <td>{{$singleInvoice->service_price}}</td>
                                                                        <td>{{$singleInvoice->discount}}</td>
                                                                        <td>{{$singleInvoice->subtotal}}</td>
                                                                        <td>{{$singleInvoice->tax_rate}}%</td>
                                                                        <td>{{$singleInvoice->tax_amount}}</td>
                                                                        <td>{{$singleInvoice->total_price}}</td>
                                                                        <td>{{$singleInvoice->service->name ?? $singleInvoice->service->translations->first()->name}}</td>
                                                                        <td>{{$singleInvoice->doctor->name ?? $singleInvoice->doctor->translations->first()->name}}</td>
                                                                        <td>{{$singleInvoice->section->name ?? $singleInvoice->section->translations->first()->name}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
													</div>
                                                    
                                                    {{-- ACCOUNT STATMENT DETAILS  --}}
													<div class="tab-pane" id="tab6">
														<table class="table text-md-nowrap" id="example1">
                                                            <thead>
                                                                <tr>
                                                                    <th>{{ __('dashboard/finance_trans.transaction_type') }}</th>
                                                                    <th>{{ __('dashboard/finance_trans.transaction_notes') }}</th>
                                                                    <th>{{ __('dashboard/finance_trans.transaction_created_at') }}</th>
                                                                    <th>{{ __('dashboard/finance_trans.transaction_debit') }}</th>
                                                                    <th>{{ __('dashboard/finance_trans.transaction_credit') }}</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($allTransactions as $transaction)
                                                                    <tr>
                                                                       
                                                                        <td>{{__('dashboard/finance_trans.'.$transaction['type'])}}</td>
                                                                        <td>{{$transaction['notes']}}</td>
                                                                        <td>{{$transaction['created_at']->format('d M Y')}}</td>
                                                                        @if($transaction['type'] != 'promissory_bond_title')
                                                                            <td>{{$transaction['amount']}}</td>
                                                                            <td>0.00</td>
                                                                        @else
                                                                            <td>0.00</td>
                                                                            <td>{{$transaction['amount']}}</td>
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
								
								</div>
							</div>
						</div>
					</div>
					<!-- /div -->

					<!--/div-->
		        </div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection