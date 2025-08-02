<!-- Modal -->
<div class="modal fade" id="edit{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('dashboard/services_trans.edit_Service')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.services.update') }}" method="post">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                @csrf
                <div class="modal-body">
                    <label for="name">{{__('dashboard/services_trans.name')}}</label>
                    <input type="text" name="name" id="name" value="{{$service->name}}" class="form-control"><br>

                    <input type="hidden" name="id" value="{{$service->id}}" class="form-control"><br>

                    <label for="price">{{__('dashboard/services_trans.price')}}</label>
                    <input type="number" name="price" id="price" value="{{$service->price}}" min="0.01" step="0.01" class="form-control"><br>

                    <div class="form-group">
                        <label for="status">{{trans('dashboard/doctors_trans.status_doctor')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="{{$service->status}}" selected>
                                {{$service->status == 1 ? trans('dashboard/doctors_trans.Enabled'):
                                trans('dashboard/doctors_trans.Not_enabled')}}</option>
                            <option value="1">{{trans('dashboard/doctors_trans.Enabled')}}</option>
                            <option value="0">{{trans('dashboard/doctors_trans.Not_enabled')}}</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>