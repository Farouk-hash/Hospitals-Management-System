<!-- Modal -->
<div class="modal fade" id="delete{{ $raysEmployee->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/doctors_trans.delete_doctor') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.employees.xrays.destroy') }}" method="post">
                {{ method_field('delete') }}
                @csrf
                <div class="modal-body">
                    <h5>{{trans('dashboard/doctors_trans.Warning')}}</h5>
                    {{-- <input type="hidden" value="1" name="page_id"> --}}
                    
                    <input type="hidden" name="id" value="{{ $raysEmployee->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('dashboard/doctors_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('dashboard/doctors_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>