@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Expense') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Expense')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('expense.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="{{ __('Create New Expense') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('expense.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
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
                                    <th>{{ __('Payee') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Ref#') }}</th>
                                    <th>{{ __('Payment') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ !empty($expense->account($expense->account_id)) ? $expense->account($expense->account_id)->account_name : '' }}
                                        </td>
                                        <td>{{ !empty($expense->payee($expense->payee_id)) ? $expense->payee($expense->payee_id)->payee_name : '' }}
                                        </td>
                                        <td>{{ \Auth::user()->priceFormat($expense->amount) }}</td>
                                        <td>{{ !empty($expense->expense_category($expense->expense_category_id)) ? $expense->expense_category($expense->expense_category_id)->name : '' }}
                                        </td>
                                        <td>{{ $expense->referal_id }}</td>
                                        <td>{{ !empty($expense->payment_type($expense->payment_type_id)) ? $expense->payment_type($expense->payment_type_id)->name : '' }}
                                        </td>
                                        <td>{{ \Auth::user()->dateFormat($expense->date) }}</td>
                                        <td>
                                            @can('Edit Expense')
                                                <a href="#" data-url="{{ URL::to('expense/' . $expense->id . '/edit') }}"
                                                    data-size="lg" data-ajax-popup="true" data-title="{{ __('Edit Expense') }}"
                                                    class="edit-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Edit') }}"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Expense')
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $expense->id }}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['expense.destroy', $expense->id], 'id' => 'delete-form-' . $expense->id]) !!}
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
