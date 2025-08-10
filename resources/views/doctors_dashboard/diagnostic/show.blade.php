@extends('doctors_dashboard.layouts.master-doctor')
@section('css')
@endsection
@section('page-header')

	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">{{__('dashboard/doctors_trans.diagnostic')}}</h4>
				<span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard/doctors_trans.all_diagnostics')}}</span>
			</div>
		</div>
	</div>

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
                                                        <li><a href="#tab3" class="nav-link active" data-toggle="tab">{{__('dashboard/patient_trans.patient_data_details')}}</a></li>
														<li><a href="#tab4" class="nav-link" data-toggle="tab">{{__('doctors/invoices_trans.title')}}</a></li>
                                                    	<li><a href="#tab5" class="nav-link" data-toggle="tab">{{__('doctors/invoices_trans.x_ray')}}</a></li>
                                                    	<li><a href="#tab6" class="nav-link" data-toggle="tab">{{__('doctors/invoices_trans.lab')}}</a></li>

													</ul>
												</div>
											</div>
											
                                            <div class="panel-body tabs-menu-body main-content-body-right border">
												<div class="tab-content">
													
                                                    {{-- PATIENT-DETAILS --}}
                                                    <div class="tab-pane active" id="tab3">
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


                                                    {{-- DIAGNOSTICS-DETAILS --}}
                                                    <div class="tab-pane" id="tab4">
                                                        <div class="row row-sm">
        
                                                            <div class="col-xl-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        @if($diagnostics)
                                                                            <div class="vtimeline">
                                                                            @foreach($diagnostics as $diagnostic)

                                                                                <div class="timeline-wrapper 
                                                                                {{ $loop->iteration % 2 == 0 ? '' : 'timeline-inverted' }} timeline-wrapper-primary">

                                                                                    <div class="timeline-badge"><i class="las la-check-circle"></i></div>
                                                                                    <div class="timeline-panel">
                                                                                        <div class="timeline-heading">
                                                                                            <h6 class="timeline-title">{{$diagnostic->diagnostic}}</h6>
                                                                                        </div>
                                                                                        <div class="timeline-body">
                                                                                            <p>{{$diagnostic->drugs}}</p>
                                                                                        </div>

                                                                                        <div class="timeline-footer d-flex align-items-start flex-wrap w-100">

                                                                                            <div class="w-100 mb-1">
                                                                                                <i class="fas fa-user-md"></i>&nbsp;
                                                                                                <span>{{ $diagnostic->invoice->doctor->name ?? $diagnostic->invoice->doctor->translations()->first()->name }}</span>
                                                                                            </div>

                                                                                            @if($diagnostic->Reviews && $diagnostic->Reviews->count() > 0)
                                                                                                <div class="diagnostic-reviews mt-2 w-100">
                                                                                                    <h6 class="mb-1 text-info">
                                                                                                        <i class="fas fa-comments"></i> {{ __('doctors/invoices_trans.reviews') }}
                                                                                                    </h6>
                                                                                                    <ul class="list-unstyled mb-0">
                                                                                                        @foreach ($diagnostic->Reviews as $review)
                                                                                                            <li class="mb-1 border-bottom pb-1">
                                                                                                                <strong>{{ $review->notes }}</strong>
                                                                                                                <small class="text-muted d-block">
                                                                                                                    <i class="fe fe-calendar"></i>
                                                                                                                    {{ $review->created_at->diffForHumans() }}
                                                                                                                </small>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                </div>
                                                                                            @else
                                                                                                <span class="text-muted w-100">{{ __('dashboard/doctors_trans.no_reviews') }}</span>
                                                                                            @endif

                                                                                            <div class="w-100 mt-2">
                                                                                                <i class="fe fe-calendar text-muted mr-1"></i>
                                                                                                {{ $diagnostic->created_at->format('Y-m-d') }}
                                                                                            </div>

                                                                                        </div>


                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        @else 
                                                                            {{__('dashboard/doctors_trans.no_diagnostic')}}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                        <!-- row closed -->
                                                    </div>

                                                    {{-- X-RAYS-DETAILS --}}
                                                    <div class="tab-pane" id="tab5">
                                                        <div class="row row-sm">
        
                                                            <div class="col-xl-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        X-RAY

                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>
                                                        <!-- row closed -->
                                                    </div>

                                                    {{-- LABS --}}
                                                    <div class="tab-pane" id="tab6">
                                                        <div class="row row-sm">
        
                                                            <div class="col-xl-12">
                                                                 <div class="col-xl-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        @if($labs)
                                                                            <div class="vtimeline">
                                                                            @foreach($labs as $lab)

                                                                                <div class="timeline-wrapper 
                                                                                {{ $loop->iteration % 2 == 0 ? '' : 'timeline-inverted' }} timeline-wrapper-primary">

                                                                                    <div class="timeline-badge"><i class="las la-check-circle"></i></div>
                                                                                    <div class="timeline-panel">
                                                                                        <div class="timeline-heading">
                                                                                            <h6 class="timeline-title">{{$lab->notes}}</h6>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        @else 
                                                                            {{__('dashboard/doctors_trans.no_diagnostic')}}
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>

                                                    </div>
                                                        <!-- row closed -->
                                                    </div>
                                                </div>
		
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