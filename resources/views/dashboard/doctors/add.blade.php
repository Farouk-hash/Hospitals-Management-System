@extends('dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@section('title')
    {{__('dashboard/doctors_trans.add_doctor')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{__('dashboard/doctors_trans.doctor_title')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               {{__('dashboard/doctors_trans.add_Doctor')}}</span>
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

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.doctors.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{__('dashboard/doctors_trans.name_doctor')}}</label>
                                </div>
                                
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    
                                    <input class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}">

                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                                                        
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{__('dashboard/doctors_trans.email_doctor')}}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    
                                    <input class="form-control @error('email') is-invalid @enderror"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}">

                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('dashboard/doctors_trans.password') }}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    
                                    <input class="form-control @error('password') is-invalid @enderror"
                                        name="password"
                                        type="password">

                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('dashboard/doctors_trans.phone_doctor') }}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    
                                    <input class="form-control @error('phone') is-invalid @enderror"
                                        name="phone"
                                        type="tel"
                                        value="{{ old('phone') }}">

                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                @if(!$section_id)
                                    <div class="col-md-1">
                                        <label for="exampleInputEmail1">
                                            {{__('dashboard/doctors_trans.section')}}</label>
                                    </div>
                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                        <select name="section_id" class="form-control SlectBox">
                                            <option value="" selected disabled>------</option>
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}">{{$section->name ?? $section->translation->first()->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else  
                                {{var_dump($section_id)}}
                                    <input type="hidden" name="section_id" value="{{$section_id}}">
                                @endif
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{__('dashboard/doctors_trans.appointments')}}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple="multiple" class="testselect2" name="appointments[]">
                                        <option selected value="" selected disabled>-- {{__('dashboard/doctors_trans.appointments_dediction')}} --</option>
                                        @foreach ($appointments as $appointment)
                                            <option value="{{$appointment->id}}">{{$appointment->name ?? $appointment->translation->first()->name}}</option>
                                        @endforeach
                                        
                                    </select>

                                </div>

                            </div>

                           
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ __('dashboard/doctors_trans.doctor_photo') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                    <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                                </div>
                            </div>



                            <button type="submit"
                                    class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('dashboard/doctors_trans.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('dashboard/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>


@endsection