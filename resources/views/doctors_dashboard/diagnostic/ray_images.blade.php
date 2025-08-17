
    {{-- @extends('') --}}
@extends($layout)
@section('css')
    <!-- Internal Gallery css -->
    <link href="{{ URL::asset('dashboard/plugins/gallery/lightgallery.css') }}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Gallery</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- Gallery -->
    <div class="demo-gallery">
        <ul id="lightgallery" class="list-unstyled row row-sm pr-0">
            @foreach ($images as $image)
                <li class="col-sm-6 col-lg-4">
                    <div style="width: 100%; height: 200px; overflow: hidden;">
                        <a href="{{ URL::asset('dashboard/img/Rays/' . $image->url) }}"
                        data-responsive="{{ URL::asset('dashboard/img/Rays/' . $image->url) }}"
                        data-src="{{ URL::asset('dashboard/img/Rays/' . $image->url) }}"
                        data-sub-html="<h4>Gallery Image</h4>">
                            <img class="img-responsive"
                                src="{{ URL::asset('dashboard/img/Rays/' . $image->url) }}"
                                alt="Thumb-1" style="width:100%; height:100%; object-fit:cover;">
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <!-- /Gallery -->
@endsection

@section('js')
    <script src="{{ URL::asset('dashboard/js/gallery.js') }}"></script>
    
@endsection
