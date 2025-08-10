<!-- Modal -->
<div class="modal fade" id="delete{{ $paymentAccount->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('dashboard/finance_trans.delete_payment_account') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.finance_payment_account.destroy') }}" method="post">
                {{ method_field('delete') }}
                @csrf
                <div class="modal-body">
                    <h5>{{trans('dashboard/finance_trans.warning_payment_account')}}</h5>
                    
                    <input type="hidden" name="id" value="{{ $paymentAccount->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('dashboard/finance_trans.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('dashboard/finance_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>