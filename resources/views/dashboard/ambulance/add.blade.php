@extends('dashboard.layouts.master')

@section('title')
    {{ __('dashboard/ambulance_trans.add_ambulance') }}
@stop

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
                <form action="{{ route('dashboard.ambulance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="pd-30 pd-sm-40 bg-gray-200">

                        {{-- Car Number --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.car_number') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('car_number') is-invalid @enderror" name="car_number" type="text" value="{{ old('car_number') }}">
                                @error('car_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Car Model --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.car_model') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('car_model') is-invalid @enderror" name="car_model" type="text" value="{{ old('car_model') }}">
                                @error('car_model') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Published At --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.published_at') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('published_at') is-invalid @enderror" name="published_at" type="date" value="{{ old('published_at') }}">
                                @error('published_at') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Phone Number --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.phone_number') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" type="text" value="{{ old('phone_number') }}">
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Licence Car Number --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.licence_car_number') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('licence_car_number') is-invalid @enderror" name="licence_car_number" type="text" value="{{ old('licence_car_number') }}">
                                @error('licence_car_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Driver Name --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.driver_name') }}</label>
                            </div>
                            <div class="col-md-10">
                                <input class="form-control @error('driver_name') is-invalid @enderror" name="driver_name" type="text" value="{{ old('driver_name') }}">
                                @error('driver_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.notes') }}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control @error('notes') is-invalid @enderror" name="notes">{{ old('notes') }}</textarea>
                                @error('notes') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        {{-- Car Type --}}
                        <div class="row mg-b-20">
                            <div class="col-md-2">
                                <label>{{ __('dashboard/ambulance_trans.car_type') }}</label>
                            </div>
                            <div class="col-md-10">
                                <select name="car_type_id" class="form-control">
                                    <option selected disabled>-- {{ __('dashboard/ambulance_trans.choose_car_type') }} --</option>
                                    @foreach($car_types as $car_type)
                                        <option value="{{ $car_type->id }}">{{ $car_type->name }}</option>
                                    @endforeach
                                </select>
                                @error('car_type_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-main-primary">{{ __('dashboard/ambulance_trans.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
