@extends('layouts.admin')
@section('page-title')
    {{__('Manage Timesheet')}}
@endsection
@push('script-page')
    <script type="text/javascript" src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jszip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/buttons.html5.js') }}"></script>
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
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        title: filename
                    },
                    {
                        extend: 'excel',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });

    </script>
@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            {{ Form::open(array('route' => array('report.timesheet'),'method'=>'get','id'=>'report_timesheet')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('start_date',__('Start Date'),['class'=>'text-type'])}}
                    {{Form::text('start_date',isset($_GET['start_date'])?$_GET['start_date']:date('Y-m-01'),array('class'=>'month-btn form-control datepicker'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('end_date',__('End Date'),['class'=>'text-type'])}}
                    {{Form::text('end_date',isset($_GET['end_date'])?$_GET['end_date']:date('Y-m-t'),array('class'=>'month-btn form-control datepicker'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('branch', __('Branch'),['class'=>'text-type']) }}
                    {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('department', __('Department'),['class'=>'text-type']) }}
                    {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_timesheet').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('report.timesheet')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div id="printableArea" class="mt-4">

        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{$filterYear['branch'] .' '.__('Branch') .' '.__('Timesheet Report').' '}}{{$filterYear['start_date'].' to '.$filterYear['end_date'].' '.__('of').' '.$filterYear['department'].' '.'Department'}}" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Title')}} :</h5>
                    <h5 class="report-text mb-0">{{__('Timesheet Report')}}</h5>
                </div>
            </div>
            @if($filterYear['branch']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Branch')}} :</h5>
                        <h5 class="report-text mb-0">{{($filterYear['branch']) }}</h5>
                    </div>
                </div>
            @endif
            @if($filterYear['department']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Department')}} :</h5>
                        <h5 class="report-text mb-0">{{$filterYear['department'] }}</h5>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['start_date'].' to '.$filterYear['end_date']}}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Total Working Employee')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['totalEmployee']}}</h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Total Working Hours')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['totalHours']}}</h5>
                </div>
            </div>
            @foreach($timesheetFilters as $timesheetFilter)
                <div class="col-sm-12 col-3">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{ $timesheetFilter->name }} </h5>
                        <h5 class="report-text mb-0">{{__('Total Working Hours')}} : {{$timesheetFilter->total}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-striped mb-0" id="report-dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Employee ID')}}</th>
                                <th>{{__('Employee')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Hours')}}</th>
                                <th>{{__('Description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timesheets as $timesheet)
                                <tr>
                                    <td><a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($timesheet->employee_id))}}" class="btn btn-sm btn-primary">{{ \Auth::user()->employeeIdFormat($timesheet->employee_id) }}</a></td>
                                    <td>{{(!empty($timesheet->employee)) ? $timesheet->employee->name:''}}</td>
                                    <td>{{\Auth::user()->dateFormat($timesheet->date)}}</td>
                                    <td>{{$timesheet->hours}}</td>
                                    <td>{{$timesheet->remark}}</td>
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

