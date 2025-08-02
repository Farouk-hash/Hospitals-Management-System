@extends('dashboard.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Doctors</h4>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                            {{trans('dashboard/services_trans.add_service')}}
                                        </button>                                    
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
												<th class="wd-15p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/services_trans.name')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/services_trans.price')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.status_doctor')}}</th>
                                                <th class="wd-20p border-bottom-0">{{__('dashboard/doctors_trans.created_at')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.updated_at')}}</th>
												<th class="wd-10p border-bottom-0">{{__('dashboard/doctors_trans.Processes')}}</th>
											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($services as $service)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                  

                                                    <td>{{$service->name ?? $service->translations->first()->name}}</td>
                                                    <td>{{$service->price}}</td>

                                                    <td>
                                                        <div class="dot-label bg-{{$service->status == 1 ? 'success':'danger'}} ml-1"></div>
                                                        {{$service->status == 1 ? trans('dashboard/doctors_trans.Enabled'):trans('dashboard/doctors_trans.Not_enabled')}}
                                                    </td>

                                                    <td>{{$service->created_at->diffForHumans()}}</td>
                                                    <td>{{$service->updated_at->diffForHumans()}}</td>
                                                    
                                                    <td style="display: flex; justify-content: center; gap: 2px;">
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                        data-toggle="modal" href="#edit{{ $service->id }}">
                                                            <i class="las la-pen"></i>
                                                        </a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                        data-toggle="modal" href="#delete{{ $service->id }}">
                                                            <i class="las la-trash"></i>
                                                        </a>
                                                    </td>

                                                    
                                                    {{-- modal-forms --}}
                                                    @include('dashboard.Services.Single-Service.edit') 
                                                    @include('dashboard.Services.Single-Service.delete') 

                                                </tr>
                                            @endforeach
											
										</tbody>
									</table>
                                    
                                    @include('dashboard.Services.Single-Service.add')
								</div>
							</div>
						</div>
					</div>
					<!--/div-->
		        </div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('dashboard/js/table-data.js')}}"></script>
@endsection