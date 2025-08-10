<div class="card-header pb-0">
    <div class="d-flex justify-content-between">
        <button type="button"
            class="btn btn-primary pd-x-30 mg-r-5 mg-t-5"
            wire:click="toggle_show_table">
            {{__('dashboard/invoices_trans.add_single_invoice')}}
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
                <th>#</th>
                <th>{{ __('dashboard/invoices_trans.Patient_Name') }}</th>
                <th>{{ __('dashboard/invoices_trans.service_name') }}</th>

                <th>{{ __('dashboard/invoices_trans.service_price') }}</th>
                <th>{{ __('dashboard/invoices_trans.discount') }}</th>
                <th>{{ __('dashboard/invoices_trans.subtotal') }}</th>
                <th>{{ __('dashboard/invoices_trans.tax_rate') }}</th>
                <th>{{ __('dashboard/invoices_trans.tax_amount') }}</th>
                <th>{{ __('dashboard/invoices_trans.Total_price') }}</th>

                <th>{{ __('dashboard/invoices_trans.payment_type') }}</th>

                <th>{{ __('dashboard/invoices_trans.Created_At') }}</th>
                <th>{{ __('dashboard/invoices_trans.Updated_At') }}</th>
                <th>{{ __('dashboard/invoices_trans.status') }}</th>

                <th>{{ __('dashboard/invoices_trans.Actions') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->patient->name ?? $invoice->patient->translations->first()->name}}</td>
                    <td>{{ $invoice->service->name ?? $invoice->service->translations->first()->name}}</td>

                    <td>{{ $invoice->service_price }}</td>
                    <td>{{ $invoice->discount }}</td>
                    <td>{{ $invoice->subtotal }}</td>
                    <td>{{ $invoice->tax_rate }}%</td>
                    <td>{{ $invoice->tax_amount }}</td>
                    <td>{{ $invoice->total_price }}</td>
                    <td>{{ $invoice->payment_type->name }}</td>

                    <td>{{ $invoice->created_at->diffForHumans() }}</td>
                    <td>{{ $invoice->updated_at->diffForHumans() }}</td>

                    <td>{{ 
                    
                    $invoice->invoiceStatus->translation ?  $invoice->invoiceStatus->translation->name :
                    $invoice->invoiceStatus->translations()->first()->name
                    
                    }}</td>

                    <td style="display: flex; justify-content: center; gap: 2px;">
                        <button wire:click="edit({{ $invoice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button wire:click="destroy({{ $invoice->id }})" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i></button>
                        <button wire:click="print({{ $invoice->id }})" class="btn btn-secondary btn-sm">
                            <i class="fa fa-print"></i></button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
