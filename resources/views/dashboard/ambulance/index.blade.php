@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard/ambulance_trans.title')}}</h4>
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
                                   
                                    <a href="{{route('dashboard.ambulance.create')}}" 
                                    class="btn btn-primary" role="button" aria-pressed="true">
                                    {{trans('dashboard/ambulance_trans.add_ambulance')}}</a>

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
                                                <th class="wd-10p border-bottom-0">{{ __('dashboard/ambulance_trans.car_number') }}</th>
                                                <th class="wd-10p border-bottom-0">{{ __('dashboard/ambulance_trans.car_model') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.driver_name') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.notes') }}</th>
                                                <th class="wd-10p border-bottom-0">{{ __('dashboard/ambulance_trans.car_type') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.published_at') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.phone_number') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.licence_car_number') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.created_at') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/ambulance_trans.updated_at') }}</th>
                                                <th class="wd-10p border-bottom-0 text-center">{{ __('dashboard/ambulance_trans.Processes') }}</th>

											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($ambulances as $ambulance)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    
                                                    <td>{{$ambulance->car_number}}</td>
                                                    <td>{{$ambulance->car_model}}</td>
                                                    <td>{{$ambulance->driver_name ?? $ambulance->translations->first()->driver_name}}</td>
                                                    <td>{{$ambulance->notes ?? $ambulance->translations->first()->notes}}</td>
                                                    <td>
                                                        {{$ambulance->translate(app()->getLocale())->carType->name 
                                                        ?? 
                                                        optional($ambulance->translations->first()->carType)->name
                                                        }}                                                    
                                                    </td>

                                                    <td>{{$ambulance->published_at}}</td>
                                                    <td>{{$ambulance->phone_number}}</td>
                                                    <td>{{$ambulance->licence_car_number}}</td>
                                                    <td>{{$ambulance->created_at->diffForHumans()}}</td>
                                                    <td>{{$ambulance->updated_at->diffForHumans()}}</td>
                                                    
                                                    <td>
                                                        <div style="display: flex; justify-content: center; gap: 2px;">
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-toggle="modal" href="#edit{{$ambulance->id}}">
                                                                <i class="las la-pen"></i>
                                                            </a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-toggle="modal" href="#delete{{$ambulance->id}}">
                                                                <i class="las la-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    
                                                    {{-- modal-forms --}}
                                                    @include('dashboard.ambulance.delete') 
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