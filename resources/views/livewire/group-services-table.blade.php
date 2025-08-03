
<div class="card-header pb-0">
    <div class="d-flex justify-content-between">
        <button type="button"
            class="btn btn-primary pd-x-30 mg-r-5 mg-t-5"
            wire:click="edit">
            add group services
        </button>                                    
        <button type="button"
            class="btn btn-secondary pd-x-30 mg-r-5 mg-t-5"
            onclick="window.history.back();">
            {{ trans('dashboard/doctors_trans.back') }}
        </button>
        
    </div>
</div>


<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0">#</th>
                <th class="wd-15p border-bottom-0">Name</th>
                <th class="wd-15p border-bottom-0">Notes</th>
                <th class="wd-15p border-bottom-0">Before dicsount</th>
                <th class="wd-15p border-bottom-0">taxes</th>
                <th class="wd-15p border-bottom-0">Price</th>
                <th class="wd-15p border-bottom-0">Status</th>
                <th class="wd-20p border-bottom-0">Created</th>
                <th class="wd-15p border-bottom-0">Updated</th>
                <th class="wd-10p border-bottom-0">Process</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($groupservices as $groupservice)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    

                    <td>{{$groupservice->name ?? $groupservice->translations()->first()->name ?? 'No name'}}</td>
                    <td>{{ substr($groupservice->notes, 0, 5)}}</td>
                    <td>{{$groupservice->price_before_discount}}</td>
                    <td>{{$groupservice->taxes}}</td>
                    <td>{{$groupservice->total_price}}</td>
                    

                    <td>
                        <div class="dot-label bg-{{$groupservice->status == 1 ? 'success':'danger'}} ml-1"></div>
                        {{$groupservice->status == 1 ? 'Enabled':'Not'}}
                    </td>


                    <td>{{$groupservice->created_at->diffForHumans()}}</td>
                    <td>{{$groupservice->updated_at->diffForHumans()}}</td>
                    
                    <td style="display: flex; justify-content: center; gap: 2px;">
                        <button wire:click="edit({{ $groupservice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button wire:click="destroy({{ $groupservice->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>

                    
                    
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
                
