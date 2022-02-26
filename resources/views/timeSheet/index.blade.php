@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Timesheet') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create TimeSheet')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="{{ route('timesheet.create') }}"
                        class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                        data-title="{{ __('Create New') }}">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="{{ route('timesheet.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-file-excel"></i> {{ __('Export') }}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-url="{{ route('timesheet.file.import') }}" data-ajax-popup="true"
                        data-title="{{ __('Import Timsheet CSV file') }}">
                        <i class="fa fa-file-csv"></i> {{ __('Import') }}
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
                    @if (\Auth::user()->type != 'employee')
                        {{ Form::open(['route' => ['timesheet.index'], 'method' => 'get', 'id' => 'timesheet_filter']) }}
                        <div class="row d-flex justify-content-end mt-2">
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('start_date', __('Start Date'), ['class' => 'text-type']) }}
                                        {{ Form::text('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control datepicker']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('end_date', __('End Date'), ['class' => 'text-type']) }}
                                        {{ Form::text('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control datepicker']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('employee', __('Employee'), ['class' => 'text-type']) }}
                                        {{ Form::select('employee', $employeesList, isset($_GET['employee']) ? $_GET['employee'] : '', ['class' => 'form-control select2']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <a href="#" class="apply-btn"
                                    onclick="document.getElementById('timesheet_filter').submit(); return false;"
                                    data-toggle="tooltip" data-original-title="{{ __('apply') }}">
                                    <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                                </a>
                                <a href="{{ route('timesheet.index') }}" class="reset-btn" data-toggle="tooltip"
                                    data-original-title="{{ __('Reset') }}">
                                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                                </a>

                            </div>
                        </div>
                        {{ Form::close() }}
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    @if (\Auth::user()->type != 'employee')
                                        <th>{{ __('Employee') }}</th>
                                    @endif
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Hours') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th width="200px">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                @foreach ($timeSheets as $timeSheet)
                                    <tr>
                                        @if (\Auth::user()->type != 'employee')
                                            <td>{{ !empty($timeSheet->employee) ? $timeSheet->employee->name : '' }}</td>
                                        @endif
                                        <td>{{ \Auth::user()->dateFormat($timeSheet->date) }}</td>
                                        <td>{{ $timeSheet->hours }}</td>
                                        <td>{{ $timeSheet->remark }}</td>
                                        <td>
                                            @can('Edit TimeSheet')
                                                <a href="#" data-url="{{ route('timesheet.edit', $timeSheet->id) }}"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="{{ __('Edit Timesheet') }}" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit') }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('Delete TimeSheet')
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="{{ __('Delete') }}"
                                                    data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                    data-confirm-yes="document.getElementById('delete-form-{{ $timeSheet->id }}').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['timesheet.destroy', $timeSheet->id], 'id' => 'delete-form-' . $timeSheet->id]) !!}
                                                {!! Form::close() !!}
                                            @endcan
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
