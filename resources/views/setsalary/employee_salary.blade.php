@extends('layouts.admin')
@section('page-title')
    {{__('Employee Set Salary')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card min-height-253">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Employee Salary')}}</h6>
                                </div>
                                @can('Create Set Salary')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('employee.basic.salary',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Set Basic Sallary')}}" data-toggle="tooltip" data-original-title="{{__('Basic Salary')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="project-info d-flex text-sm">
                                <div class="project-info-inner mr-3 col-6">
                                    <b class="m-0"> {{__('Payslip Type') }} </b>
                                    <div class="project-amnt pt-1">{{ $employee->salary_type() }}</div>
                                </div>
                                <div class="project-info-inner mr-3 col-6">
                                    <b class="m-0"> {{__('Salary') }} </b>
                                    <div class="project-amnt pt-1">{{ $employee->salary }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Allowance')}}</h6>
                                </div>
                                @can('Create Allowance')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('allowances.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Allowance')}}" data-toggle="tooltip" data-original-title="{{__('Create Allowance')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Allownace Option')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allowances as $allowance)
                                    <tr>
                                        <td>{{ !empty($allowance->employee())?$allowance->employee()->name:'' }}</td>
                                        <td>{{ !empty($allowance->allowance_option())?$allowance->allowance_option()->name:'' }}</td>
                                        <td>{{ $allowance->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($allowance->amount) }}</td>
                                        <td>
                                            @can('Edit Allowance')
                                                <a href="#" data-url="{{ URL::to('allowance/'.$allowance->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Allowance')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Allowance')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('allowance-delete-form-{{$allowance->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['allowance.destroy', $allowance->id],'id'=>'allowance-delete-form-'.$allowance->id]) !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Commission')}}</h6>
                                </div>
                                @can('Create Commission')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('commissions.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Commission')}}" data-toggle="tooltip" data-original-title="{{__('Create Commission')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($commissions as $commission)
                                    <tr>
                                        <td>{{ !empty($commission->employee())?$commission->employee()->name:'' }}</td>
                                        <td>{{ $commission->title }}</td>
                                        <td>{{ \Auth::user()->priceFormat( $commission->amount) }}</td>
                                        <td class="text-right">
                                            @can('Edit Commission')
                                                <a href="#" data-url="{{ URL::to('commission/'.$commission->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Commission')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Commission')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('commission-delete-form-{{$commission->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['commission.destroy', $commission->id],'id'=>'commission-delete-form-'.$commission->id]) !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Loan')}}</h6>
                                </div>
                                @can('Create Loan')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('loans.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Loan')}}" data-toggle="tooltip" data-original-title="{{__('Create Loan')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee')}}</th>
                                    <th>{{__('Loan Options')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Loan Amount')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('End Date')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($loans as $loan)
                                    <tr>
                                        <td>{{ !empty($loan->employee())?$loan->employee()->name:'' }}</td>
                                        <td>{{!empty( $loan->loan_option())? $loan->loan_option()->name:'' }}</td>
                                        <td>{{ $loan->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($loan->amount) }}</td>
                                        <td>{{  \Auth::user()->dateFormat($loan->start_date) }}</td>
                                        <td>{{ \Auth::user()->dateFormat( $loan->end_date) }}</td>
                                        <td class="text-right">
                                            @can('Edit Loan')
                                                <a href="#" data-url="{{ URL::to('loan/'.$loan->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Loan')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Loan')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('loan-delete-form-{{$loan->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['loan.destroy', $loan->id],'id'=>'loan-delete-form-'.$loan->id]) !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Saturation Deduction')}}</h6>
                                </div>
                                @can('Create Saturation Deduction')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('saturationdeductions.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Saturation Deduction')}}" data-toggle="tooltip" data-original-title="{{__('Create Saturation Deduction')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Deduction Option')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($saturationdeductions as $saturationdeduction)
                                    <tr>
                                        <td>{{ !empty($saturationdeduction->employee())?$saturationdeduction->employee()->name:'' }}</td>
                                        <td>{{ !empty($saturationdeduction->deduction_option())?$saturationdeduction->deduction_option()->name:'' }}</td>
                                        <td>{{ $saturationdeduction->title }}</td>
                                        <td>{{ \Auth::user()->priceFormat( $saturationdeduction->amount) }}</td>
                                        <td class="text-right">
                                            @can('Edit Saturation Deduction')
                                                <a href="#" data-url="{{ URL::to('saturationdeduction/'.$saturationdeduction->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Saturation Deduction')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Saturation Deduction')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('deduction-delete-form-{{$saturationdeduction->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['saturationdeduction.destroy', $saturationdeduction->id],'id'=>'deduction-delete-form-'.$saturationdeduction->id]) !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Other Payment')}}</h6>
                                </div>
                                @can('Create Other Payment')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('otherpayments.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Other Payment')}}" data-toggle="tooltip" data-original-title="{{__('Create Other Payment')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee')}}</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($otherpayments as $otherpayment)
                                    <tr>
                                        <td>{{ !empty($otherpayment->employee())?$otherpayment->employee()->name:'' }}</td>
                                        <td>{{ $otherpayment->title }}</td>
                                        <td>{{  \Auth::user()->priceFormat($otherpayment->amount) }}</td>
                                        <td class="text-right">
                                            @can('Edit Other Payment')
                                                <a href="#" data-url="{{ URL::to('otherpayment/'.$otherpayment->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Other Payment')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Other Payment')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('payment-delete-form-{{$otherpayment->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['otherpayment.destroy', $otherpayment->id],'id'=>'payment-delete-form-'.$otherpayment->id]) !!}
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h6 class="mb-0">{{__('Overtime')}}</h6>
                                </div>
                                @can('Create Overtime')
                                    <div class="col text-right">
                                        <a href="#" data-url="{{ route('overtimes.create',$employee->id) }}" data-size="md" data-ajax-popup="true" data-title="{{__('Create Overtime')}}" data-toggle="tooltip" data-original-title="{{__('Create Overtime')}}" class="apply-btn">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>{{__('Employee Name')}}</th>
                                    <th>{{__('Overtime Title')}}</th>
                                    <th>{{__('Number of days')}}</th>
                                    <th>{{__('Hours')}}</th>
                                    <th>{{__('Rate')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($overtimes as $overtime)
                                    <tr>
                                        <td>{{ !empty($overtime->employee())?$overtime->employee()->name:'' }}</td>
                                        <td>{{ $overtime->title }}</td>
                                        <td>{{ $overtime->number_of_days }}</td>
                                        <td>{{ $overtime->hours }}</td>
                                        <td>{{  \Auth::user()->priceFormat($overtime->rate) }}</td>
                                        <td class="text-right">
                                            @can('Edit Overtime')
                                                <a href="#" data-url="{{ URL::to('overtime/'.$overtime->id.'/edit') }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit OverTime')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('Delete Overtime')
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('overtime-delete-form-{{$overtime->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['overtime.destroy', $overtime->id],'id'=>'overtime-delete-form-'.$overtime->id]) !!}
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
    </div>
@endsection

@push('script-page')
    <script type="text/javascript">

        $(document).ready(function () {
            var d_id = $('#department_id').val();
            var designation_id = '{{ $employee->designation_id }}';
            getDesignation(d_id);


            $("#allowance-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#commission-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#loan-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#saturation-deduction-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#other-payment-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });

            $("#overtime-dataTable").dataTable({
                "columnDefs": [
                    {"sortable": false, "targets": [1]}
                ]
            });
        });

        $(document).on('change', 'select[name=department_id]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '{{route('employee.json')}}',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value="">{{__('Select any Designation')}}</option>');
                    $.each(data, function (key, value) {
                        var select = '';
                        if (key == '{{ $employee->designation_id }}') {
                            select = 'selected';
                        }

                        $('#designation_id').append('<option value="' + key + '"  ' + select + '>' + value + '</option>');
                    });
                }
            });
        }

    </script>
@endpush
