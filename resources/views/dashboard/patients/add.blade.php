@extends('dashboard.layouts.master')
@section('css')

@section('title')
    {{ __('dashboard/patient_trans.add_patient') }}
@stop 
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{__('dashboard/patient_trans.title')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               {{__('dashboard/patient_trans.add_patient')}}</span>
            </div>  

        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.patient.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="pd-30 pd-sm-40 bg-gray-200">

                        {{-- Name --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.name') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.notes') }}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes">
                                    {{ old('notes') }}</textarea>
                                @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Gender --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.gender') }}</label>
                            </div>
                            <div class="col-md-10">
                                <select name="gender_id" class="form-control @error('gender_id') is-invalid @enderror">
                                    <option selected disabled>-- {{ __('dashboard/patient_trans.gender') }} --</option>
                                    @foreach ($gender as $g)
                                        <option value="{{$g->id}}" 
                                        {{ old('gender_id') == $g->id ? 'selected' : '' }}>
                                        {{$g->name}}</option>
                                        
                                    @endforeach
                                </select>
                                @error('gender_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.email') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ old('email') }}">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Birth Date --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.birth_date') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" type="date" value="{{ old('birth_date') }}">
                                @error('birth_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Phone Number (used for password hash) --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/patient_trans.phone_number') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" type="text" value="{{ old('phone_number') }}">
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-main-primary">{{ __('dashboard/patient_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
