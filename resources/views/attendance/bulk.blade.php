@extends('layouts.admin')
@section('page-title')
    {{__('Manage Bulk Attendance')}}
@endsection
@push('script-page')
    <script>
        $('#present_all').click(function (event) {
            if (this.checked) {
                $('.present').each(function () {
                    this.checked = true;
                });

                $('.present_check_in').removeClass('d-none');
                $('.present_check_in').addClass('d-block');

            } else {
                $('.present').each(function () {
                    this.checked = false;
                });
                $('.present_check_in').removeClass('d-block');
                $('.present_check_in').addClass('d-none');

            }
        });

        $('.present').click(function (event) {
            var div = $(this).parent().parent().parent().parent().find('.present_check_in');
            if (this.checked) {
                div.removeClass('d-none');
                div.addClass('d-block');

            } else {
                div.removeClass('d-block');
                div.addClass('d-none');
            }

        });
    </script>
@endpush

@section('action-button')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    {{ Form::open(array('route' => array('attendanceemployee.bulkattendance'),'method'=>'get','id'=>'bulkattendance_filter')) }}
                    <div class="row d-flex justify-content-end py-0">

                        <div class="col-xl-2 col-lg-2 col-md-6">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{Form::label('date',__('Date'),['class'=>'text-type']) }}
                                    {{Form::text('date',isset($_GET['date'])?$_GET['date']:date('Y-m-d'),array('class'=>'month-btn form-control datepicker'))}}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('branch', __('Branch'),['class'=>'text-type']) }}
                                    {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2','required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-6">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('department', __('Department'),['class'=>'text-type']) }}
                                    {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2','required')) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <a href="#" class="apply-btn" onclick="document.getElementById('bulkattendance_filter').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </a>
                            <a href="{{route('timesheet.index')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                            </a>

                        </div>

                    </div>
                    {{ Form::close() }}

                    {{Form::open(array('route'=>array('attendanceemployee.bulkattendance'),'method'=>'post'))}}
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th width="10%">{{__('Employee Id')}}</th>
                                <th>{{__('Employee')}}</th>
                                <th>{{__('Branch')}}</th>
                                <th>{{__('Department')}}</th>
                                <th>
                                    <div class="form-group my-auto">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" name="present_all" id="present_all" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="present_all"> {{__('Attendance')}}</label>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                @php
                                    $attendance=$employee->present_status($employee->id,isset($_GET['date'])?$_GET['date']:date('Y-m-d'));
                                @endphp
                                <tr>
                                    <td class="Id">
                                        <input type="hidden" value="{{$employee->id}}" name="employee_id[]">
                                        <a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="">{{ \Auth::user()->employeeIdFormat($employee->employee_id) }}</a>
                                    </td>
                                    <td>{{$employee->name}}</td>
                                    <td>{{!empty($employee->branch)?$employee->branch->name:''}}</td>
                                    <td>{{!empty($employee->department)?$employee->department->name:''}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input present" type="checkbox" name="present-{{$employee->id}}" id="present{{$employee->id}}" {{ (!empty($attendance)&&$attendance->status == 'Present') ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="present{{$employee->id}}"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8 present_check_in {{ empty($attendance) ? 'd-none' : '' }} ">
                                                <div class="row">
                                                    <label class="col-md-2 control-label">{{__('In')}}</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control timepicker" name="in-{{$employee->id}}" value="{{!empty($attendance) && $attendance->clock_in!='00:00:00' ? $attendance->clock_in : \Utility::getValByName('company_start_time')}}">
                                                    </div>

                                                    <label for="inputValue" class="col-md-2 control-label">{{__('Out')}}</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control timepicker" name="out-{{$employee->id}}" value="{{!empty($attendance) &&  $attendance->clock_out !='00:00:00'? $attendance->clock_out : \Utility::getValByName('company_end_time')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="attendance-btn text-right pt-4">
                        <input type="hidden" value="{{isset($_GET['date'])?$_GET['date']:date('Y-m-d')}}" name="date">
                        <input type="hidden" value="{{isset($_GET['branch'])?$_GET['branch']:''}}" name="branch">
                        <input type="hidden" value="{{isset($_GET['department'])?$_GET['department']:''}}" name="department">
                        {{Form::submit(__('Update'),array('class'=>'btn-create badge-blue'))}}
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {format: 'YYYY-MM-DD'},
            });
        });
    </script>
@endpush
