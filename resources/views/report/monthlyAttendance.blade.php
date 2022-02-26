@extends('layouts.admin')
@section('page-title')
    {{__('Manage Monthly Attendance')}}
@endsection
@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            {{ Form::open(array('route' => array('report.monthly.attendance'),'method'=>'get','id'=>'report_monthly_attendance')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('month',__('Month'),['class'=>'text-type'])}}
                    {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('branch', __('Branch'),['class'=>'text-type']) }}
                    {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('department', __('Department'),['class'=>'text-type']) }}
                    {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_monthly_attendance').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('report.monthly.attendance')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="{{route('report.attendance',[isset($_GET['month'])?$_GET['month']:date('Y-m'),(isset($_GET['branch']) && !empty($_GET['branch'])) ?$_GET['branch']:0,(isset($_GET['department']) && !empty($_GET['department'])) ?$_GET['department']:0])}}" class="action-btn" >
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('content')
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{  $data['branch'] .' '.__('Branch') .' '.$data['curMonth'].' '.__('Attendance Report of').' '. $data['department'].' '.'Department'}}" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                    <h5 class="report-text mb-0">{{__('Attendance Summary')}}</h5>
                </div>
            </div>
            @if($data['branch']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Branch')}} :</h5>
                        <h5 class="report-text mb-0">{{$data['branch']}}</h5>
                    </div>
                </div>
            @endif
            @if($data['department']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Department')}} :</h5>
                        <h5 class="report-text mb-0">{{$data['department']}}</h5>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                    <h5 class="report-text mb-0">{{$data['curMonth']}}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <div class="float-left">
                        <h5 class="report-text gray-text mb-0">{{__('Attendance')}}</h5>
                        <h5 class="report-text mb-0">{{__('Total present')}}: {{$data['totalPresent']}}</h5>
                    </div>
                    <div class="float-right">
                        <h5 class="report-text gray-text mb-0"></h5>
                        <h5 class="report-text mb-0">{{__('Total leave')}} : {{$data['totalLeave']}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Overtime')}}</h5>
                    <h5 class="report-text mb-0">{{__('Total overtime in hours')}} : {{number_format($data['totalOvertime'],2)}}</h5>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Early leave')}}</h5>
                    <h5 class="report-text mb-0">{{__('Total early leave in hours')}} : {{number_format($data['totalEarlyLeave'],2)}}</h5>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Employee late')}}</h5>
                    <h5 class="report-text mb-0">{{__('Total late in hours')}} : {{number_format($data['totalLate'],2)}}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive py-4 attendance-table-responsive">
                            <table class="table table-striped mb-0" id="dataTable-1">
                                <thead>
                                <tr>
                                    <th class="active">{{__('Name')}}</th>
                                    @foreach($dates as $date)
                                        <th>{{$date}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employeesAttendance as $attendance)
                                    <tr>
                                        <td>{{$attendance['name']}}</td>
                                        @foreach($attendance['status'] as $status)
                                            <td>
                                                @if($status=='P')
                                                    <i class="custom-badge badge-success">{{__('P')}}</i>
                                                @elseif($status=='L')
                                                    <i class="custom-badge badge-danger">{{__('L')}}</i>
                                                @endif
                                            </td>
                                        @endforeach
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

