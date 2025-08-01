<!-- Modal -->
<div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('dashboard/doctors_trans.unActivate') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.doctors.update_status') }}" method="post" autocomplete="off">
                {{method_field('PUT')}}
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">{{__('dashboard/doctors_trans.status_doctor')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{__('dashboard/doctors_trans.Choose')}}--</option>
                            <option value="1">{{__('dashboard/doctors_trans.Enabled')}}</option>
                            <option value="0">{{__('dashboard/doctors_trans.Not_enabled')}}</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>