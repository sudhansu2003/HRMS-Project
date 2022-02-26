@extends('layouts.admin')
@section('page-title')
    {{ __('Manage Employee') }}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Employee')
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="{{ route('employee.create') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-plus"></i> {{ __('Create') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="{{ route('employee.export') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> {{ __('Export') }}
                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                    data-url="{{ route('employee.file.import') }}" data-ajax-popup="true"
                    data-title="{{ __('Import employee CSV file') }}">
                    <i class="fa fa-file-csv"></i> {{ __('Import') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Employee ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Designation') }}</th>
                                    <th>{{ __('Date Of Joining') }}</th>
                                    @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                        <th width="200px">{{ __('Action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td class="Id">
                                            @can('Show Employee')
                                                <a
                                                    href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                            @else
                                                <a href="#">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                            @endcan
                                        </td>
                                        <td class="font-style">{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td class="font-style">
                                            {{ !empty(\Auth::user()->getBranch($employee->branch_id)) ? \Auth::user()->getBranch($employee->branch_id)->name : '' }}
                                        </td>
                                        <td class="font-style">
                                            {{ !empty(\Auth::user()->getDepartment($employee->department_id)) ? \Auth::user()->getDepartment($employee->department_id)->name : '' }}
                                        </td>
                                        <td class="font-style">
                                            {{ !empty(\Auth::user()->getDesignation($employee->designation_id)) ? \Auth::user()->getDesignation($employee->designation_id)->name : '' }}
                                        </td>
                                        <td class="font-style">
                                            {{ \Auth::user()->dateFormat($employee->company_doj) }}</td>
                                        @if (Gate::check('Edit Employee') || Gate::check('Delete Employee'))
                                            <td>
                                                @if ($employee->is_active == 1)
                                                    @can('Edit Employee')
                                                        <a href="{{ route('employee.edit', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}"
                                                            class="edit-icon" data-toggle="tooltip"
                                                            data-original-title="{{ __('Edit') }}"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                    @endcan
                                                    @can('Delete Employee')
                                                        <a href="#" class="delete-icon" data-toggle="tooltip"
                                                            data-original-title="{{ __('Delete') }}"
                                                            data-confirm="{{ __('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?') }}"
                                                            data-confirm-yes="document.getElementById('delete-form-{{ $employee->id }}').submit();"><i
                                                                class="fas fa-trash"></i></a>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['employee.destroy', $employee->id], 'id' => 'delete-form-' . $employee->id]) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                @else
                                                    <i class="fas fa-lock"></i>
                                                @endif
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
