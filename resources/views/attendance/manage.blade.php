@extends('layouts.admin')
@section('page-title')
    {{__('Manage Attendance')}}
@endsection
@section('action-button')
@endsection
@section('content')
<script>
    function updateWfhStatus(value) {
        document.getElementById('wfhStatus').value = value.toString();
    }
</script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    {{ Form::open(['route' => 'attendanceemployee.manageattendance', 'method' => 'get', 'id' => 'manageattendance_filter']) }}
                        <div class="row d-flex justify-content-end py-0 align-items-center">
                            <div class="col-xl-2 col-lg-2 col-md-6">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('date', __('Date'), ['class' => 'text-type']) }}
                                        {{ Form::text('date', request('date', now()->format('Y-m-d')), ['class' => 'month-btn form-control datepicker']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <button type="submit" name="search" class="apply-btn small-icon-button" data-toggle="tooltip" data-original-title="{{ __('Apply') }}"
                                    style="line-height:1.5;padding:7px 12px;border: 1px solid #0f5ef7;">
                                    <span class="btn-inner--icon"><i class="fas fa-search fa-sm"></i></span>
                                </button>
                                <button type="submit" name="reset" class="reset-btn small-icon-button" data-toggle="tooltip" data-original-title="{{ __('Reset') }}"
                                    style="line-height:1.5;padding:7px 12px;border: 1px solid #FF5630;">
                                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt fa-sm"></i></span>
                                </button>
                            </div>
                        </div>
                    {{ Form::close() }}
                    <div class="row d-flex justify-content-end py-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 dataTable">
                                <thead>
                                    <tr>
                                        <th width="10%">{{__('Employee Id')}}</th>
                                        <th>{{__('Employee Name')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Update Status')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($result as $employee)
                                        <tr>
                                            <td class="Id">
                                                {{ $employee->id }}
                                            </td>
                                            <td>
                                                {{ $employee->name }}
                                            </td>
                                            <td>
                                                {{ $employee->date }}
                                            </td>
             
                                            <td class="{{ $employee->status === 'Present' ? 'text-success' : 'text-danger' }}">
                                                @if ($employee->status === 'Present' && $employee->wfh_flag == 1)
                                                    Present(wfh)
                                                @else
                                                    {{ $employee->status === 'Present' ? 'Present' : 'Absent' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_null($employee->date))
                                                    {{ Form::open(['route' => 'attendanceemployee.insertrecord', 'method' => 'post']) }}
                                                    {{ Form::hidden('employeeId', $employee->id) }}
                                                    {{ Form::hidden('date', request('date',$employee->date)) }}
                                                    {{ Form::hidden('status', 'Present') }}
                                                    {{ Form::hidden('clockIn', now()) }}
                                                    {{ Form::hidden('insertRecord', 'true') }}
                                                    {{ Form::hidden('createdBy', Auth::user()->id) }}
                                                    {{ Form::submit('Present', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;']) }}
                                                    {{ Form::close() }}
                                                @else
                                                    {{ Form::open(['route' => 'attendanceemployee.updatestatus', 'method' => 'post']) }}
                                                    {{ Form::hidden('employeeId', $employee->id) }}
                                                    {{ Form::hidden('newStatus', $employee->status === 'Present' ? 'Absent' : 'Present') }}
                                                    {{ Form::hidden('updateStatus', 'true') }}
                                                    {{ Form::hidden('date', $employee->date) }}
                                                    {{ Form::submit($employee->status === 'Present' ? 'Absent' : 'Present', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;']) }}
                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (is_null($employee->date))
                                                    {{ Form::open(['route' => 'attendanceemployee.insertrecord', 'method' => 'post']) }}
                                                    {{ Form::hidden('employeeId', $employee->id) }}
                                                    {{ Form::hidden('date', request('date', $employee->date)) }}
                                                    {{ Form::hidden('status', 'Present(wfh)') }}
                                                    {{ Form::hidden('clockIn', now()) }}
                                                    {{ Form::hidden('insertRecord', 'true') }}
                                                    {{ Form::hidden('createdBy', Auth::user()->id) }}
                                                    {{ Form::submit('Work From Home', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;']) }}
                                                    {{ Form::close() }}
                                                @elseif ($employee->status === 'Present')
                                                
                                                @else
                                                    {{ Form::open(['route' => 'attendanceemployee.updatestatus', 'method' => 'post']) }}
                                                    {{ Form::hidden('employeeId', $employee->id) }}
                                        

                                                    {{ Form::hidden('newStatus', $employee->status === 'Present' ? 'Present(wfh)' : 'Present') }} 
                                                    {{ Form::hidden('updateStatus', 'true') }}
                                                    {{ Form::hidden('date', $employee->date) }}

                                                    @if ($employee->status === 'Present(wfh)')
                                                        {{ Form::hidden('wfhStatus', '0') }} 
                                                    @else
                                                        {{ Form::hidden('wfhStatus', '1') }} 
                                                    @endif

                                                    {{ Form::submit($employee->status === 'Absent' ? 'Work from Home' : 'Present(wfh)', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;']) }}
                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            <script>
                                                function updateWfhStatus() {
                                                    document.getElementById('wfhStatus').value = '1';
                                                }
                                            </script>
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
    </div>
@endsection
