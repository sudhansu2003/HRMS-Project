@extends('layouts.admin')
@section('page-title')
    {{__('Manage Account Statement')}}
@endsection
@push('script-page')
@endpush
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
@endpush

@section('action-button')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            {{ Form::open(array('route' => array('report.account.statement'),'method'=>'get','id'=>'report_acc_filter')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('start_month',__('Start Month'),['class'=>'text-type'])}}
                    {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:'',array('class'=>'month-btn form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('end_month',__('End Month'),['class'=>'text-type'])}}
                    {{Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:'',array('class'=>'month-btn form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('account', __('Account'),['class'=>'text-type'])}}
                    {{ Form::select('account', $accountList,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('type', __('Type'),['class'=>'text-type'])}}
                    <select class="form-control select2" id="type" name="type">
                        <option value="income" {{(isset($_GET['account']) && $_GET['type']=='income')?'selected':''}}>{{__('Income')}}</option>
                        <option value="expense" {{(isset($_GET['account']) && $_GET['type']=='expense')?'selected':''}}>{{__('Expense')}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_acc_filter').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('report.account.statement')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    {{--    <div class="row d-flex justify-content-end">--}}
    {{--        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">--}}
    {{--            <div class="all-button-box">--}}
    {{--                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" onclick="document.getElementById('report_acc_filter').submit(); return false;">--}}
    {{--                    <span class="btn-inner--icon">{{__('Apply')}}</span>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">--}}
    {{--            <div class="all-button-box">--}}
    {{--                <a href="{{route('report.account.statement')}}" class="btn btn-xs btn-white btn-icon-only bg-red width-auto">--}}
    {{--                    <span class="btn-inner--icon">{{__('Reset')}}</span>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--            {{ Form::close() }}--}}
    {{--        </div>--}}
    {{--        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">--}}
    {{--            <div class="all-button-box">--}}
    {{--                <a href="#" class="btn btn-xs btn-white btn-icon-only bg-yellow width-auto" onclick="saveAsPDF()">--}}
    {{--                    <span class="btn-inner--icon">{{__('Download')}}</span>--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection

@section('content')
    <div id="printableArea" class="mt-4">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{__('Account Statement').' '. $filterYear['type'].' '.'Report of'.' '.$filterYear['startDateRange'].' to '.$filterYear['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Report')}} :</h5>
                    <h5 class="report-text mb-0">{{__('Account Statement Summary')}}</h5>
                </div>
            </div>
            @if($filterYear['type']!='All')
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{__('Transaction Type')}} :</h5>
                        <h5 class="report-text mb-0">{{$filterYear['type'] }}</h5>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0">{{__('Duration')}} :</h5>
                    <h5 class="report-text mb-0">{{$filterYear['startDateRange'].' to '.$filterYear['endDateRange']}}</h5>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($accounts as $account)
                <div class="col-xl-3 col-md-3 col-lg-3 col-sm-6 col-12">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0">{{$account->account_name}}</h5>
                        <h5 class="report-text mb-0">
                            @if(isset($_GET['type']) && $_GET['type'] =='expense')
                                {{__('Total Debit')}} :
                            @else
                                {{__('Total Credit')}} :
                            @endif :
                            {{\Auth::user()->priceFormat($account->total)}}
                        </h5>
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
                                <th>{{__('Account')}}</th>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Amount')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accountData as $account)
                                <tr>
                                    <td>{{!empty($account->accounts)?$account->accounts->account_name:''}}</td>
                                    <td>{{\Auth::user()->dateFormat($account->date)}}</td>
                                    <td>{{\Auth::user()->priceFormat($account->amount)}}</td>
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

