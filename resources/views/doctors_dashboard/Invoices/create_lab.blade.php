<!-- Modal -->
<div class="modal fade" id="addlab{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{trans('doctors/invoices_trans.add_diagnostic_review')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctors_dashboard.diagnostic_lab.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$invoice->id}}" name="invoice_id">
                <div class="pd-30 pd-sm-40 bg-gray-200">
                     <!-- Select Dropdown -->
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1">
                            <label for="diagnostic_id">
                                {{ __('doctors/invoices_trans.select_diagnostic') }}
                            </label>
                        </div>
                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <select 
                                class="form-control @error('diagnostic_id') is-invalid @enderror" 
                                name="diagnostic_id" 
                                required>
                                <option value="">{{ __('doctors/invoices_trans.select_diagnostic') }}</option>
                                @foreach($invoice->diagnostics as $diagnostic)
                                    <option value="{{ $diagnostic->id }}">
                                        {{ $diagnostic->diagnostic }}
                                    </option>
                                @endforeach
                            </select>

                            @error('diagnostic_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>


                    <div class="row row-xs align-items-center mg-b-20">
                    <div class="col-md-1">
                        <label for="diagnostic">
                            {{ __('dashboard/doctors_trans.diagnostic_notes') }}
                        </label>
                    </div>
                    <div class="col-md-11 mg-t-5 mg-md-t-0">
                        <textarea
                            class="form-control @error('diagnostic') is-invalid @enderror"
                            name="notes"
                            rows="3"
                        >{{ old('notes') }}</textarea>

                        @error('notes')
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