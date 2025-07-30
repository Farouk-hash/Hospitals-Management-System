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
                                    <a href="{{route('dashboard.doctors.create')}}" class="btn btn-primary" role="button" aria-pressed="true">{{trans('dashboard/doctors_trans.add_Doctor')}}</a>
                                </div>
                            </div>
                            <div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.ID')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.doctor_image')}}</th>

                                                <th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.name_doctor')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.email_doctor')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.phone_doctor')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.status_doctor')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.section')}}</th>
                                                <th class="wd-20p border-bottom-0">{{__('dashboard/doctors_trans.created_at')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/doctors_trans.updated_at')}}</th>
												<th class="wd-10p border-bottom-0">{{__('dashboard/doctors_trans.Processes')}}</th>
											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($doctors as $doctor)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        @if($doctor->image)
                                                            <img style="border-radius:50%" width="50px" height="50px" src="{{ asset('dashboard/img/Doctors/' . $doctor->image->url) }}" alt="img">
                                                        @else
                                                            <img style="border-radius:50%" width="50px" height="50px" src="{{ asset('dashboard/img/Doctors/Default.png') }}" alt="img">

                                                        @endif
                                                    </td>

                                                    <td>{{$doctor->name ?? $doctor->translation->first()->name}}</td>
                                                    <td>{{ substr($doctor->email, 0, 5)}}</td>
                                                    <td>{{$doctor->phone}}</td>
                                                    <td>
                                                        <div class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
                                                        {{$doctor->status == 1 ? trans('dashboard/doctors_trans.Enabled'):trans('dashboard/doctors_trans.Not_enabled')}}
                                                    </td>

                                                    <td>{{$doctor->section->name ?? $doctor->section->translation->first()->name}}</td>
                                                    <td>{{$doctor->created_at->diffForHumans()}}</td>
                                                    <td>{{$doctor->updated_at->diffForHumans()}}</td>

                                                    <td>
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$doctor->id}}"><i class="las la-pen"></i></a>
                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$doctor->id}}"><i class="las la-trash"></i></a>
                                                    </td>
                                                    @include('dashboard.doctors.delete')
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