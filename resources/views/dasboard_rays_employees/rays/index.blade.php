@extends('dasboard_rays_employees.layouts.master-xray-employee')

@section('css')
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ __('doctors/rays_trans.rays_title') }}</h4>
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
                    
                    <button type="button" class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5" onclick="window.history.back();">
                        {{ __('doctors/rays_trans.back') }}
                    </button>
                </div>
            </div>

            @if($errors->any())
                @foreach ($errors->all() as $err)
                    <span class="text-danger">{{ $err }}</span>
                @endforeach
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('doctors/rays_trans.employee') }}</th>
                                <th>{{ __('doctors/rays_trans.doctor') }}</th>
                                <th>{{ __('doctors/rays_trans.status') }}</th>
                                <th>{{ __('doctors/rays_trans.image') }}</th>
                                <th>{{ __('doctors/rays_trans.notes') }}</th>
                                <th>{{ __('doctors/rays_trans.created_at') }}</th>
                                <th>{{ __('doctors/rays_trans.updated_at') }}</th>
                                <th>{{ __('doctors/rays_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rays as $ray)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ray->employee->name ?? __('doctors/rays_trans.no_employee') }}</td>
                                    <td>
                                        {{ $ray->diagnostic->invoice->doctor->name
                                            ?? $ray->diagnostic->invoice->doctor->translations()->first()->name
                                            ?? __('doctors/rays_trans.no_doctor') }}
                                    </td>
                                    <td>{{ $ray->status->translation->name ?? __('doctors/rays_trans.no_status') }}</td>
                                    <td>
                                        @if($ray->image->count())
                                            <img src="{{ asset('dashboard/img/Rays/' . $ray->image->first()->url) }}" width="50" height="50" style="border-radius:5px;">
                                        @else
                                            <img src="{{ asset('dashboard/img/Rays/default.png') }}" width="50" height="50" style="border-radius:5px;">
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($ray->notes,50) }}</td>
                                    <td>{{ $ray->created_at->diffForHumans() }}</td>
                                    <td>{{ $ray->updated_at->diffForHumans() }}</td>

                                    {{-- @if($ray->employee->id == Auth::id()) --}}
                                        <td>
                                            
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $ray->id }}" data-toggle="dropdown">
                                                    {{ __('doctors/rays_trans.processes') }}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $ray->id }}">
                                                    
                                                    @if(!$ray->employee)
                                                        <a class="dropdown-item text-info" href="{{ route('rays_employees.rays.edit', [$ray->id]) }}">
                                                            <i class="las la-pen"></i> {{ __('doctors/rays_trans.edit') }}
                                                        </a>
                                                    @else 
                                                        @if($ray->rays_status_id == 2)
                                                            <a class="dropdown-item text-primary" href="{{route('rays_employees.rays.show_ray_images' , [$ray->id])}}">
                                                                <i class="fas fa-images"></i> {{ __('dashboard/patient_trans.show_images') }}
                                                            </a> 
                                                            <a class="dropdown-item text-danger" data-toggle="modal" href="#delete{{$ray->id}}">
                                                                <i class="las la-trash"></i> {{ __('doctors/rays_trans.delete') }}
                                                            </a>
                                                        @endif
                                                    @endif
                                                    
                                                    </div>
                                                </div>
                                                @include('dasboard_rays_employees.rays.delete')
                                        </td>
                                    {{-- @endif --}}
                                </tr>

                                {{-- delete modal --}}
                                {{-- @include('dashboard.rays.delete') --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/row-->
@endsection

@section('js')
@endsection
