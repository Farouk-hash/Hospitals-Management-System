<!-- Modal -->
<div class="modal fade" id="add{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('dashboard/doctors_trans.add_diagnostic')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctors_dashboard.diagnostic.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="pd-30 pd-sm-40 bg-gray-200">
                    <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                    
                    <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1">
                        <label for="diagnostic">
                            {{ __('dashboard/doctors_trans.diagnostic_notes') }}
                        </label>
                    </div>
                    
                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                        <textarea
                            class="form-control @error('diagnostic') is-invalid @enderror"
                            name="diagnostic"
                            rows="3"
                        >{{ old('diagnostic') }}</textarea>

                        @error('diagnostic')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    </div>

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1">
                            <label for="drugs">
                                {{ __('dashboard/doctors_trans.diagnostic_drugs') }}
                            </label>
                        </div>

                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <textarea
                                class="form-control @error('drugs') is-invalid @enderror"
                                name="drugs"
                                rows="3"
                            >{{ old('drugs') }}</textarea>

                            @error('drugs')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                        {{ __('dashboard/doctors_trans.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>