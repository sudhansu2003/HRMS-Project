@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Transfer Balance') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Transfer Balance')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('transferbalance.create') }}"
                        class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                        data-title="{{ __('Create New Transfer Balance') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('transfer_balance.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
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
                                    <th>{{ __('From Account') }}</th>
                                    <th>{{ __('To Account') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment Method') }}</th>
                                    <th>{{ __('Ref#') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transferbalances as $transferbalance)
                                    <tr>
                                        <td>{{ !empty($transferbalance->account($transferbalance->from_account_id)) ? $transferbalance->account($transferbalance->from_account_id)->account_name : '' }}
                                        </td>
                                        <td>{{ !empty($transferbalance->account($transferbalance->to_account_id)) ? $transferbalance->account($transferbalance->to_account_id)->account_name : '' }}
                                        </td>
                                        <td>{{ \Auth::user()->dateFormat($transferbalance->date) }}</td>
                                        <td>{{ \Auth::user()->priceFormat($transferbalance->amount) }}</td>
                                        <td>{{ !empty($transferbalance->payment_type($transferbalance->payment_type_id)) ? $transferbalance->payment_type($transferbalance->payment_type_id)->name : '' }}
                                        </td>
                                        <td>{{ $transferbalance->referal_id }}</td>
                                        <td>
                                            @can('Edit Transfer Balance')
                                                <a href="#"
                                                    data-url="{{ URL::to('transferbalance/' . $transferbalance->id . '/edit') }}"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Transfer Balance') }}" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit') }}"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Transfer Balance')
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $transferbalance->id }}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['transferbalance.destroy', $transferbalance->id], 'id' => 'delete-form-' . $transferbalance->id]) !!}
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
