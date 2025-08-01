@extends('dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <!-- Internal Select2 css -->
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}"
          rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

@section('title')
    {{trans('dashboard/doctors_trans.add_Doctor')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> {{trans('dashboard/doctors_trans.doctor_title')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
               {{trans('dashboard/doctors_trans.Edit')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.doctors.update') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        {{ method_field('put') }}
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div>
                                @if($doctor->image)
                                    <img style="border-radius:20%"
                                         src="{{Url::asset('dashboard/img/doctors/'.$doctor->image->url)}}"
                                         height="150px" width="150px" alt="">
                                @else
                                    <img style="border-radius:50%"
                                         src="{{Url::asset('dashboard/img/Doctors/Default.png')}}"
                                         height="150px"
                                         width="150px" alt="">
                                @endif
                            </div>
                            <br><br>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('dashboard/doctors_trans.name_doctor')}}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name" value="{{$doctor->name ?? $doctor->translation->first()->name}}" type="text">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('dashboard/doctors_trans.email_doctor')}}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$doctor->email}}" name="email" type="email">
                                </div>
                            </div>


                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ trans('dashboard/doctors_trans.phone_doctor') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{$doctor->phone}}" name="phone" type="tel">
                                    <input class="form-control" value="{{$doctor->id}}" name="id" type="hidden">
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('dashboard/doctors_trans.section')}}</label>
                                </div>

                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id" class="form-control SlectBox">
                                        @foreach($sections as $section)
                                            <option
                                                value="{{$section->id}}" {{$section->id == $doctor->section_id ? 'selected':"" }}>
                                                {{$section->name ?? $section->translation->first()->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class=" row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{trans('dashboard/doctors_trans.appointments')}}</label>
                                </div>

                                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple class="testselect2" name="appointments[]">
                                        @php
                                            $selectedIds = $doctor->appointments->pluck('id')->toArray();
                                        @endphp

                                        @foreach($appointments as $appointment)
                                            <option value="{{ $appointment->id }}"
                                                {{ in_array($appointment->id, $selectedIds) ? 'selected' : '' }}>
                                                {{ $appointment->name ?? optional($appointment->translation->first())->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">
                                        {{ trans('dashboard/doctors_trans.doctor_photo') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                    <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                                {{ trans('dashboard/doctors_trans.submit') }}
                            </button>
                            
                            <button type="button"
                                class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
                                onclick="window.history.back();">
                                {{ trans('dashboard/doctors_trans.back') }}
                            </button>
 
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
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>


    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('dashboard/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{URL::asset('dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{URL::asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{URL::asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{URL::asset('dashboard/plugins/pickerjs/picker.min.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('dashboard/js/form-elements.js')}}"></script>


@endsection