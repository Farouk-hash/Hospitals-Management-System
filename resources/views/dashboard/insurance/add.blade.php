<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('dashboard/insurance_trans.add_insurance')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.insurance.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <label for="name">{{trans('dashboard/insurance_trans.insurance_name')}}</label>
                    <input type="text" name="name" class="form-control">
                    
                    <label for="insurance_code">{{trans('dashboard/insurance_trans.insurance_code')}}</label>
                    <input type="text" name="insurance_code" class="form-control">

                    
                    <label for="insurance_discount">{{trans('dashboard/insurance_trans.insurance_discount')}}</label>
                    <input type="number" name="insurance_discount" class="form-control" min="0.1" step="0.1">

                    
                    <label for="patient_discount">{{trans('dashboard/insurance_trans.patient_discount')}}</label>
                    <input type="number" name="patient_discount" class="form-control" min="0.1" step="0.1" >

                    <label for="notes">{{trans('dashboard/insurance_trans.insurance_notes')}}</label>
                    <input type="text" name="notes" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>