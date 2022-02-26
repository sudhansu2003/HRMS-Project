@extends('layouts.admin')
@section('page-title')
    {{__('Manage Attendance List')}}
@endsection
@push('script-page')
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();

            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.date').addClass('d-none');
                $('.date').removeClass('d-block');
            } else {
                $('.date').addClass('d-block');
                $('.date').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush
@section('action-button')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    {{ Form::open(array('route' => array('attendanceemployee.index'),'method'=>'get','id'=>'attendanceemployee_filter')) }}
                    <div class="row d-flex justify-content-end mt-2">
                        <div class="col-auto">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    <label class="text-type">{{__('Type')}}</label> <br>
                                    <div class="d-flex radio-check">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="custom-control-input" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                                            <label class="custom-control-label" for="monthly">{{__('Monthly')}}</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="daily" value="daily" name="type" class="custom-control-input" {{isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''}}>
                                            <label class="custom-control-label" for="daily">{{__('Daily')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto month">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{Form::label('month',__('Month'),['class'=>'text-type'])}}
                                    {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control month-btn'))}}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto date">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    {{ Form::label('date', __('Date'),['class'=>'text-type'])}}
                                    {{ Form::text('date',isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control datepicker month-btn')) }}
                                </div>
                            </div>
                        </div>
                        @if(\Auth::user()->type != 'employee')
                            <div class="col-xl-2 col-lg-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('branch', __('Branch'),['class'=>'text-type'])}}
                                        {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        {{ Form::label('department', __('Department'),['class'=>'text-type'])}}
                                        {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-auto my-auto">
                            <a href="#" class="apply-btn" onclick="document.getElementById('attendanceemployee_filter').submit(); return false;">
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </a>
                            <a href="{{route('attendanceemployee.index')}}" class="reset-btn">
                                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                            </a>
                        </div>
                    </div>
                    {{ Form::close() }}
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                @if(\Auth::user()->type!='employee')
                                    <th>{{__('Employee')}}</th>
                                @endif
                                <th>{{__('Date')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Clock In')}}</th>
                                <th>{{__('Clock Out')}}</th>
                                <th>{{__('Late')}}</th>
                                <th>{{__('Early Leaving')}}</th>
                                <th>{{__('Overtime')}}</th>
                                @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($attendanceEmployee as $attendance)
                                <tr>
                                    @if(\Auth::user()->type!='employee')
                                        <td>{{!empty($attendance->employee)?$attendance->employee->name:'' }}</td>
                                    @endif
                                    <td>{{ \Auth::user()->dateFormat($attendance->date) }}</td>
                                    <td>{{ $attendance->status }}</td>
                                    <td>{{ ($attendance->clock_in !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_in):'00:00' }} </td>
                                    <td>{{ ($attendance->clock_out !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_out):'00:00' }}</td>
                                    <td>{{ $attendance->late }}</td>
                                    <td>{{ $attendance->early_leaving }}</td>
                                    <td>{{ $attendance->overtime }}</td>
                                    @if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                        <td>
                                            @can('Edit Attendance')
                                                <a href="#" data-url="{{ URL::to('attendanceemployee/'.$attendance->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Attendance')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Attendance')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$attendance->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id],'id'=>'delete-form-'.$attendance->id]) !!}
                                                {!! Form::close() !!}
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
