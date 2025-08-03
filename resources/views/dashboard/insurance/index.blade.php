@extends('dashboard.layouts.master')
@section('css')

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Insurance</h4>
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
                                            {{trans('dashboard/insurance_trans.add_insurance')}}
                                        </button>
                                    <button type="button"
                                    class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
                                    onclick="window.history.back();">
                                    {{ trans('dashboard/doctors_trans.back') }}
                                    </button>
                                    
                                </div>
                            </div>
                            @include('dashboard.insurance.add')
                            
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

                                                <th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.insurance_code')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.insurance_name')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.insurance_notes')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.patient_discount')}}</th>
                                                <th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.insurance_discount')}}</th>
                                                <th class="wd-20p border-bottom-0">{{__('dashboard/insurance_trans.created_at')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/insurance_trans.updated_at')}}</th>
												<th class="wd-10p border-bottom-0">{{__('dashboard/insurance_trans.Processes')}}</th>
											</tr>
										</thead>
										<tbody>
											
                                            @foreach ($insurances as $insurance)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    

                                                    <td>{{$insurance->insurance_code}}</td>
                                                    <td>{{$insurance->name}}</td>
                                                    <td>{{ substr($insurance->notes, 0, 5)}}</td>
                                                    <td>{{$insurance->patient_discount}}</td>
                                                    <td>{{$insurance->insurance_discount}}</td>
                                                    <td>{{$insurance->created_at->diffForHumans()}}</td>
                                                    <td>{{$insurance->updated_at->diffForHumans()}}</td>
                                                    
                                                    <td>
                                                        <div style="display: flex; justify-content: center; gap: 2px;">
                                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-toggle="modal" href="#edit{{$insurance->id}}">
                                                                <i class="las la-pen"></i>
                                                            </a>
                                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-toggle="modal" href="#delete{{$insurance->id}}">
                                                                <i class="las la-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>

                                                    
                                                    {{-- modal-forms --}}
                                                    @include('dashboard.insurance.delete') 
                                                    @include('dashboard.insurance.edit')

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