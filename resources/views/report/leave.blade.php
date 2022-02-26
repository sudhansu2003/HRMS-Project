@extends('layouts.admin')
@section('page-title')
    {{__('Manage Leave Report')}}
@endsection
@push('script-page')

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
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();
            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.year').addClass('d-none');
                $('.year').removeClass('d-block');
            } else {
                $('.year').addClass('d-block');
                $('.year').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2">
            {{ Form::open(array('route' => array('report.leave'),'method'=>'get','id'=>'report_leave')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    <label class="text-type">{{__('Type')}}</label> <br>
                    <div class="d-flex radio-check">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="monthly" value="monthly" name="type" class="custom-control-input monthly" {{isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'}}>
                            <label class="custom-control-label" for="monthly">{{__('Monthly')}}</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="yearly" value="yearly" name="type" class="custom-control-input yearly" {{isset($_GET['type']) && $_GET['type']=='yearly' ?'checked':''}}>
                            <label class="custom-control-label" for="yearly">{{__('Yearly')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 month">
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('month',__('Month'),['class'=>'text-type'])}}
                    {{Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 year d-none">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('year', __('Year'),['class'=>'text-type']) }}
                    <select class="form-control select2" id="year" name="year" tabindex="-1" aria-hidden="true">
                        @for($filterYear['starting_year']; $filterYear['starting_year'] <= $filterYear['ending_year']; $filterYear['starting_year']++)
                            <option {{(isset($_GET['year']) && $_GET['year'] == $filterYear['starting_year'] ?'selected':'')}} {{(!isset($_GET['year']) && date('Y') == $filterYear['starting_year'] ?'selected':'')}} value="{{$filterYear['starting_year']}}">{{$filterYear['starting_year']}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('branch', __('Branch'),['class'=>'text-type']) }}
                    {{ Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('department', __('Department'),['class'=>'text-type']) }}
                    {{ Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_leave').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('report.leave')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
    {{ Form::close() }}
@endsection

@section('content')
    <div id="printableArea" class="mt-4">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{  $filterYear['branch'] .' '.__('Branch') .' '.$filterYear['dateYearRange'].' '.$filterYear['type'].' '.__('Leave Report of').' '. $filterYear['department'].' '.'Department'}}" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['type'].' '.__('Leave Summary')}}</h5>
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
            @if($filterYear['branch']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Department')}} :</h5>
                        <h5 class="report-text mb-0">{{($filterYear['department']) }}</h5>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['dateYearRange']}}</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 col-lg-4">
                <div class="card p-4 mb-4">
                    <div class="float-left">
                        <h5 class="report-text gray-text mb-0">{{__('Approved Leaves')}} :</h5>
                        <h5 class="report-text mb-0">{{$filter['totalApproved']}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-lg-4">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Rejected Leave')}}</h5>
                    <h5 class="report-text mb-0">{{$filter['totalReject']}}</h5>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-lg-4">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Pending Leaves')}}</h5>
                    <h5 class="report-text mb-0">{{$filter['totalPending']}}</h5>
                </div>
            </div>
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
                                <th>{{__('Approved Leaves')}}</th>
                                <th>{{__('Rejected Leaves')}}</th>
                                <th>{{__('Pending Leaves')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaves as $leave)
                                <tr>
                                    <td>{{ \Auth::user()->employeeIdFormat($leave['employee_id']) }}</td>
                                    <td>{{$leave['employee']}}</td>
                                    <td>
                                        <div class="m-view-btn badge-success">{{$leave['approved']}}
                                            <a href="#" data-url="{{ route('report.employee.leave',[$leave['id'],'Approve',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" data-ajax-popup="true" data-title="{{__('Approved Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-view-btn badge-danger">{{$leave['reject']}}
                                            <a href="#" data-url="{{ route('report.employee.leave',[$leave['id'],'Reject',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete" data-ajax-popup="true" data-title="{{__('Rejected Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="m-view-btn m-blue-bg">{{$leave['pending']}}
                                            <a href="#" data-url="{{ route('report.employee.leave',[$leave['id'],'Pending',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')]) }}" class="table-action table-action-delete" data-ajax-popup="true" data-title="{{__('Pending Leave Detail')}}" data-toggle="tooltip" data-original-title="{{__('View')}}">{{__('View')}}</a>
                                        </div>
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

