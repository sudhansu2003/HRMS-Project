@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Deposite') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Deposit')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('deposit.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="{{ __('Create New Deposit') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('deposite.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Payer') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Ref#') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($deposits as $deposit)
                                    <tr>
                                        <td>{{ !empty($deposit->account($deposit->account_id)) ? $deposit->account($deposit->account_id)->account_name : '' }}
                                        </td>
                                        <td>{{ !empty($deposit->payer($deposit->payer_id)) ? $deposit->payer($deposit->payer_id)->payer_name : '' }}
                                        </td>
                                        <td>{{ \Auth::user()->priceFormat($deposit->amount) }}</td>
                                        <td>{{ !empty($deposit->income_category($deposit->income_category_id)) ? $deposit->income_category($deposit->income_category_id)->name : '' }}
                                        </td>
                                        <td>{{ $deposit->referal_id }}</td>
                                        <td>{{ !empty($deposit->payment_type($deposit->payment_type_id)) ? $deposit->payment_type($deposit->payment_type_id)->name : '' }}
                                        </td>
                                        <td>{{ \Auth::user()->dateFormat($deposit->date) }}</td>

                                        <td>
                                            @can('Edit Deposit')
                                                <a href="#" data-url="{{ URL::to('deposit/' . $deposit->id . '/edit') }}"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Deposit') }}" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit') }}"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Deposit')
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $deposit->id }}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['deposit.destroy', $deposit->id], 'id' => 'delete-form-' . $deposit->id]) !!}
                                                {!! Form::close() !!}
                                    @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
