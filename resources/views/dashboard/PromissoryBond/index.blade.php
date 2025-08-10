@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard/finance_trans.title')}}</h4>
                <span>/{{__('dashboard/finance_trans.promissory_bond_title')}}</span>
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
                                    <a href="{{route('dashboard.finance_promissory.create')}}" 
                                    class="btn btn-primary" role="button" aria-pressed="true">
                                    {{trans('dashboard/finance_trans.add_promissory_bound')}}</a>
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
                                                <th class="wd-10p border-bottom-0">#</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/finance_trans.patient_name') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/finance_trans.debit') }}</th>
                                                <th class="wd-25p border-bottom-0">{{ __('dashboard/finance_trans.notes') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/finance_trans.created_at') }}</th>
                                                <th class="wd-15p border-bottom-0">{{ __('dashboard/finance_trans.updated_at') }}</th>
                                                <th class="wd-10p border-bottom-0">{{ __('dashboard/finance_trans.processes') }}</th>
                                            </tr>
                                        </thead>

										<tbody>
                                            @foreach ($recieptAccounts as $receipt)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>{{ $receipt->patient->name ?? $receipt->patient->translations()->first()->name }}</td>

                                                    <td>
                                                        <span class="badge bg-success text-white">
                                                            {{ number_format($receipt->debit, 2) }}
                                                        </span>
                                                    </td>

                                                    <td>{{ $receipt->notes ?? '-' }}</td>

                                                    <td>{{ $receipt->created_at->diffForHumans() }}</td>

                                                    <td>{{ $receipt->updated_at->diffForHumans() }}</td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $receipt->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {{ __('dashboard/finance_trans.processes') }}
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $receipt->id }}">
                                                                <a class="dropdown-item text-info" href="{{ route('dashboard.finance_promissory.edit' , [$receipt->id]) }}">
                                                                    <i class="las la-pen"></i> {{ __('dashboard/finance_trans.edit') }}
                                                                </a>

                                                                <a class="dropdown-item text-danger" data-toggle="modal" 
                                                                href="#delete{{ $receipt->id }}">
                                                                <i class="las la-trash"></i> {{ __('dashboard/finance_trans.delete') }}
                                                                </a>

                                                                <a class="dropdown-item text-secondary" href="{{ route('dashboard.finance_promissory.show' , [$receipt->id]) }}">
                                                                    <i class="las la-print"></i> {{ __('dashboard/finance_trans.print') }}
                                                                </a>
                                                               
                                                            </div>
                                                        </div>
                                                    </td>

                                                    {{-- Include modals if needed --}}
                                                    @include('dashboard.PromissoryBond.delete')
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