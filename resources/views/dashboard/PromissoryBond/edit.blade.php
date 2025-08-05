@extends('dashboard.layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@section('title')
    {{ __('dashboard/finance_trans.update_promissory_bound') }}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('dashboard/finance_trans.title') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ __('dashboard/finance_trans.update_promissory_bound') }}
                </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.finance_promissory.update') }}" method="post" autocomplete="off">
                        {{method_field('put')}}
                        @csrf
                        <input type="hidden" name='id' value={{$receieptAccount->id}}>
                        <div class="pd-30 pd-sm-40 bg-gray-200">

                            {{-- Patient Dropdown --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.patient_name') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <select name="patient_id" class="form-control @error('patient_id') is-invalid @enderror" disabled>
                                        <option value="" disabled>-- {{ __('dashboard/finance_trans.patient_name') }} --</option>
                                        @foreach ($singleInvoicesPromissories as $singleInvoicesPromissory)
                                            <option 
                                                value="{{ $singleInvoicesPromissory->patient->id }}" 
                                                {{ $receieptAccount->patient_id == $singleInvoicesPromissory->patient->id ? 'selected readonly' : '' }}
                                                
                                            >
                                                {{ $singleInvoicesPromissory->patient->name ?? $singleInvoicesPromissory->patient->translations->first()->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('patient_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Debit Field --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.debit') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <input type="number" step="0.01" name="debit" 
                                    value="{{$receieptAccount->debit}}"
                                    class="form-control @error('debit') is-invalid @enderror" value="{{ old('debit') }}">
                                    @error('debit')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Notes Field --}}
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label>{{ __('dashboard/finance_trans.notes') }}</label>
                                </div>
                                <div class="col-md-11">
                                    <textarea name="notes" rows="3" 
                                    class="form-control @error('notes') is-invalid @enderror">
                                    {{ old('notes') ?? $receieptAccount->notes }}
                                    </textarea>
                                    @error('notes')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">
                                {{ __('dashboard/finance_trans.update_promissory_bound') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
