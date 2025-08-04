@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between">
			<div class="my-auto">
				<div class="d-flex">
					<h4 class="content-title mb-0 my-auto">{{__('dashboard/sections_trans.section_title')}}</h4>
				</div>
			</div>
		
		</div>
		<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!--div-->
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
                                            {{trans('dashboard/sections_trans.add_sections')}}
                                        </button>
                                    </div>
                            </div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example2">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">{{__('dashboard/sections_trans.ID')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/sections_trans.name_sections')}}</th>
												<th class="wd-15p border-bottom-0">{{__('dashboard/sections_trans.description')}}</th>

												<th class="wd-20p border-bottom-0">{{__('dashboard/sections_trans.created_at')}}</th>
												<th class="wd-20p border-bottom-0">{{__('dashboard/sections_trans.updated_at')}}</th>

												<th class="wd-15p border-bottom-0">{{__('dashboard/sections_trans.Processes')}}</th>
												

											</tr>

										</thead>
										<tbody>
											@foreach ($sections as $section)
												<tr>
													<td>{{$loop->iteration}}</td>
													<td>
														<a href="{{route('dashboard.sections.show',[$section->id])}}">
														
														{{$section->name ?? $section->translations->first()->name}}
													</td>
													
													<td>{{Str::limit($section->description ,10) ?? 
														Str::limit($section->translations->first()->description,10)}}
													</td>

													<td>{{$section->created_at->diffForHumans()}}</td>
													<td>{{$section->updated_at->diffForHumans()}}</td>

													<td>
                                                       <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$section->id}}"><i class="las la-pen"></i></a>
                                                       <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$section->id}}"><i class="las la-trash"></i></a>
                                                   	</td>
													@include('dashboard.sections.edit')
													@include('dashboard.sections.delete')
													<td></td>
												</tr>
											@endforeach
											
											
											{{-- add button --}}
											@include('dashboard.sections.add')
										</tbody>
									</table>

									
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
		
@endsection
@section('js')
@endsection