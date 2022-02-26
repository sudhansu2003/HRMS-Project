@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Holiday') }}
@endsection

@section('action-button')
    @can('Create Holiday')
        <div class="all-button-box row d-flex justify-content-end mt-2">
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('holiday.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="{{ __('Create New Holiday') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="{{ route('holidays.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-file-excel"></i> {{ __('Export') }}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-url="{{ route('holidays.file.import') }}" data-ajax-popup="true"
                        data-title="{{ __('Import Holiday CSV file') }}">
                        <i class="fa fa-file-csv"></i> {{ __('Import') }}
                    </a>
                </div>
            </div>
            <div class="col-auto">
                <div class="all-button-box">
                    <a href="{{ route('holiday.calender') }}" class="action-btn" data-toggle="tooltip"
                        data-original-title="{{ __('Calender View') }}">
                        <i class="fa fa-calendar"></i>
                    </a>
                </div>
            </div>
        </div>
    @endcan


@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    {{ Form::open(['route' => ['holiday.index'], 'method' => 'get', 'id' => 'holiday_filter']) }}
                    <div class="row d-flex justify-content-end mt-2">

                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'text-type']) }}
                                    {{ Form::text('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control datepicker']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'text-type']) }}
                                    {{ Form::text('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control datepicker']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <a href="#" class="apply-btn"
                                onclick="document.getElementById('holiday_filter').submit(); return false;"
                                data-toggle="tooltip" data-original-title="{{ __('apply') }}">
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </a>
                            <a href="{{ route('holiday.index') }}" class="reset-btn" data-toggle="tooltip"
                                data-original-title="{{ __('Reset') }}">
                                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                            </a>

                        </div>
                    </div>
                    {{ Form::close() }}
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Occasion') }}</th>
                                    @if (Gate::check('Edit Holiday') || Gate::check('Delete Holiday'))
                                        <th>{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($holidays as $holiday)
                                    <tr>
                                        <td>{{ \Auth::user()->dateFormat($holiday->date) }}</td>
                                        <td>{{ $holiday->occasion }}</td>
                                        @if (Gate::check('Edit Holiday') || Gate::check('Delete Holiday'))
                                            <td class="Action">
                                                <span>
                                                    @can('Edit Holiday')
                                                        <a href="#" class="edit-icon"
                                                            data-url="{{ route('holiday.edit', $holiday->id) }}"
                                                            data-ajax-popup="true" data-title="{{ __('Edit Holiday') }}"
                                                            data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                    @endcan
                                                    @can('Delete Holiday')
                                                        <a href="#" class="delete-icon" data-toggle="tooltip"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="document.getElementById('delete-form-{{ $holiday->id }}').submit();">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['holiday.destroy', $holiday->id], 'id' => 'delete-form-' . $holiday->id]) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </span>
                                            </td>
                                        @endif
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
