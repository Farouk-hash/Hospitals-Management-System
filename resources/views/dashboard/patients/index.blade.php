@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard/patient_trans.title')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard/patient_trans.all_patients')}}</span>

            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row opened -->
				<div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">

							 <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                   
                                    <a href="{{route('dashboard.patient.create')}}" 
                                    class="btn btn-primary" role="button" aria-pressed="true">
                                    {{trans('dashboard/patient_trans.add_patient')}}</a>

                                    <button type="button"
                                    class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
                                    onclick="window.history.back();">
                                    {{ trans('dashboard/doctors_trans.back') }}
                                    </button>
                                    
                                </div>
                            </div>
                            
                            @if($errors->any())
                                @foreach ($errors->all() as $err)
                                    <span style="red;">{{$err}}</span>
                                @endforeach
                            @endif
                            <div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
                                                <th class="wd-5p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.name') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.notes') }}</th>
                                                <th class="wd-10p border-bottom-0">{{ __('dashboard/patient_trans.gender') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.email') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.birth_date') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.phone_number') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.created_at') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/patient_trans.updated_at') }}</th>
                                                <th class="wd-10p border-bottom-0 text-center">{{ __('dashboard/patient_trans.Processes') }}</th>


											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($patients as $patient)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    
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
                                                    
                                                    <td>
                                                        <div style="display: flex; justify-content: center; gap: 2px;">
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-toggle="modal" href="#edit{{$patient->id}}">
                                                                <i class="las la-pen"></i>
                                                            </a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-toggle="modal" href="#delete{{$patient->id}}">
                                                                <i class="las la-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    
                                                    {{-- modal-forms --}}
                                                    @include('dashboard.patients.delete') 
                                                    {{-- @include('dashboard.insurance.edit') --}}

                                                </tr>
                                            @endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
		        </div>
		<!-- main-content closed -->
@endsection
@section('js')

@endsection