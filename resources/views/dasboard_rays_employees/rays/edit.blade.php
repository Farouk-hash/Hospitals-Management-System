@extends('dashboard.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>

@section('title')
    {{ __('doctors/rays_trans.add_ray') }}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('doctors/rays_trans.rays_title') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('doctors/rays_trans.add_ray') }}</span>
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
                    <form action="{{ route('rays_employees.rays.update') }}" 
                    method="post" autocomplete="off" enctype="multipart/form-data">
                        {{method_field('put')}}
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            

                            {{-- Notes --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('doctors/rays_trans.notes') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control @error('notes') is-invalid @enderror"
                                    name="notes" rows="3" readonly>{{ $ray->notes}}
                                    </textarea>
                                    
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('doctors/rays_trans.employee_notes') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <textarea class="form-control @error('employee_notes') is-invalid @enderror"
                                    name="employee_notes" rows="3">{{$ray->employee_notes ?? old('employee_notes')}}
                                    </textarea>
                                    
                                </div>
                            </div>

                           {{-- Image --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('doctors/rays_trans.image') }}</label>
                                </div>
                                <div class="col-md-11">
                                    
                                    {{-- File input --}}
                                    <input type="file" accept="image/*" name="image[]" multiple onchange="loadFile(event)">
                                    
                                    {{-- Existing images --}}
                                    @if($ray->image->count())
                                        <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
                                            @foreach($ray->image as $img)
                                                <div style="position:relative;">
                                                    <img src="{{ asset('dashboard/img/Rays/' . $img->url) }}" 
                                                        alt="Image" 
                                                        style="max-width:120px; max-height:120px; object-fit:cover; border:1px solid #ddd; border-radius:6px;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- New uploaded images preview --}}
                                    <div id="output-container" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;"></div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="id" value="{{$ray->id}}">                            
                            {{-- Submit --}}
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                                {{ __('doctors/rays_trans.submit') }}
                            </button>
                            <a href="{{ route('rays_employees.rays.index') }}" class="btn btn-secondary pd-x-30 mg-t-5">
                                {{ __('doctors/rays_trans.back') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function loadFile(event) {
        let container = document.getElementById('output-container');
        container.innerHTML = ''; // Clear old previews

        Array.from(event.target.files).forEach(file => {
            let img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '120px';
            img.style.maxHeight = '120px';
            img.style.objectFit = 'cover';
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '6px';
            container.appendChild(img);
        });
    }
</script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('dashboard/js/select2.js') }}"></script>
<script src="{{ URL::asset('dashboard/js/advanced-form-elements.js') }}"></script>

<!--Internal Sumoselect js-->
<script src="{{ URL::asset('dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

<!--Internal  Notify js -->
<script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('dashboard/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
