<!-- Modal -->
<div class="modal fade" id="edit{{ $insurance->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('Dashboard/insurance_trans.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.insurance.update') }}" method="post">
                {{method_field('put')}}
                @csrf
               
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $insurance->id }}">                    
                    <label for="name">{{trans('dashboard/insurance_trans.insurance_name')}}</label>
                    <input type="text" name="name" class="form-control" value="{{ $insurance->name }}">
                    
                    <label for="insurance_code">{{trans('dashboard/insurance_trans.insurance_code')}}</label>
                    <input type="text" name="insurance_code" class="form-control" value="{{$insurance->insurance_code }}">

                    
                    <label for="insurance_discount">{{trans('dashboard/insurance_trans.insurance_discount')}}</label>
                    <input type="number" name="insurance_discount" class="form-control" min="0.1" step="0.1" value="{{$insurance->insurance_discount }}">

                    
                    <label for="patient_discount">{{trans('dashboard/insurance_trans.patient_discount')}}</label>
                    <input type="number" name="patient_discount" class="form-control" min="0.1" step="0.1" value="{{$insurance->patient_discount }}" >

                    <label for="notes">{{trans('dashboard/insurance_trans.insurance_notes')}}</label>
                    <input type="text" name="notes" class="form-control" value="{{$insurance->notes }}">
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/doctors_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/doctors_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>