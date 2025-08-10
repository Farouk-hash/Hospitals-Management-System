@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard/employees.xray-title')}}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard/employees.xray-title')}}</span>

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
                                   
                                    <a href="{{route('dashboard.employees.xrays.create')}}" 
                                    class="btn btn-primary" role="button" aria-pressed="true">
                                    {{trans('dashboard/employees.add_employee')}}</a>

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
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/employees.name') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/employees.image') }}</th>

                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/employees.email') }}</th>
                                               
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/doctors_trans.created_at') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/doctors_trans.updated_at') }}</th>
                                                <th class="wd-10p border-bottom-0 text-center">{{ __('dashboard/doctors_trans.Processes') }}</th>


											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($raysEmployees as $raysEmployee)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>

                                                    <td>
                                                        @if($raysEmployee->image)
                                                            <img style="border-radius:50%" width="50px" height="50px" src="{{ asset('dashboard/img/xRayEmployee/' . $raysEmployee->image->url) }}" alt="img">
                                                        @else
                                                            <img style="border-radius:50%" width="50px" height="50px" src="{{ asset('dashboard/img/Doctors/Default.png') }}" alt="img">

                                                        @endif
                                                    </td>

                                                    <td>{{$raysEmployee->name}}</td>
                                                    <td>{{$raysEmployee->email }}</td>
                                                   

                                                  

                                                   
                                                    <td>{{$raysEmployee->created_at->diffForHumans()}}</td>
                                                    <td>{{$raysEmployee->updated_at->diffForHumans()}}</td>
                                                    
                                                    <td>
                                                        <div style="display: flex; justify-content: center; gap: 2px;">
                                                          
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-toggle="modal" href="#edit{{$raysEmployee->id}}">
                                                                <i class="las la-pen"></i>
                                                            </a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-toggle="modal" href="#delete{{$raysEmployee->id}}">
                                                                <i class="las la-trash"></i>
                                                            </a>

                                                        </div>
                                                    </td>

                                                    
                                                    {{-- modal-forms --}}
                                                    {{-- @include('dashboard.patients.delete')  --}}
                                                    @include('dashboard.rays.delete')

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