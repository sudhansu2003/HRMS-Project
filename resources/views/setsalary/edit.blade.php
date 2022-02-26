@extends('layouts.admin')
@section('page-title')
    {{__('Manage Employee  Salary List')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#salary" class="active">{{__('Salary')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#allowance" class="">{{__('Allowance')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#commission" class="">{{__('Commission')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#loan" class="">{{__('Loan')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#saturation-deduction" class="">{{__('Saturation Deduction')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#other-payment" class="">{{__('Other Payment')}}</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#overtime" class="">{{__('Overtime')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="salary" class="tab-pane in active">
                        <div class="card">
                            <div class="card-body">
                                {{ Form::model($employee, array('route' => array('employee.salary.update', $employee->id), 'method' => 'POST')) }}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('salary_type', __('Payslip Type*'),['class'=>'form-control-label']) }}
                                            {{ Form::select('salary_type',$payslip_type,null, array('class' => 'form-control select2','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('salary', __('Salary'),['class'=>'form-control-label']) }}
                                            {{ Form::number('salary',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                </div>
                                @can('Create Set Salary')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    <div id="allowance" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'allowance','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('allowance_option', __('Allowance Options*'),['class'=>'form-control-label']) }}
                                            {{ Form::select('allowance_option',$allowance_options,null, array('class' => 'form-control select2','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
                                            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>

                                @can('Create Allowance')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="allowance-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('Employee Name')}}</th>
                                            <th>{{__('Allownace Option')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($allowances as $allowance)
                                            <tr>
                                                <td>{{ $allowance->employee()->name }}</td>
                                                <td>{{ $allowance->allowance_option()->name }}</td>
                                                <td>{{ $allowance->title }}</td>
                                                <td>{{  \Auth::user()->priceFormat($allowance->amount) }}</td>
                                                @can('Delete Set Salary')
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
                                                @endcan
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commission" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'commission','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
                                            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>
                                @can('Create Commission')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="commission-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('Employee Name')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($commissions as $commission)
                                            <tr>
                                                <td>{{ $commission->employee()->name }}</td>
                                                <td>{{ $commission->title }}</td>
                                                <td>{{  \Auth::user()->priceFormat($commission->amount )}}</td>

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
                    </div>
                    <div id="loan" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'loan','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('loan_option', __('Loan Options*'),['class'=>'form-control-label']) }}
                                            {{ Form::select('loan_option',$loan_options,null, array('class' => 'form-control select2','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('amount', __('Loan Amount'),['class'=>'form-control-label']) }}
                                            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('start_date', __('Start Date'),['class'=>'form-control-label']) }}
                                            {{ Form::text('start_date',null, array('class' => 'form-control datepicker','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('end_date', __('End Date'),['class'=>'form-control-label']) }}
                                            {{ Form::text('end_date',null, array('class' => 'form-control datepicker','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('reason', __('Reason'),['class'=>'form-control-label']) }}
                                            {{ Form::textarea('reason',null, array('class' => 'form-control','rows'=>1,'required'=>'required')) }}
                                        </div>
                                    </div>
                                </div>

                                @can('Create Loan')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}

                                <hr>

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="loan-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('employee')}}</th>
                                            <th>{{__('Loan Options')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Loan Amount')}}</th>
                                            <th>{{__('Start Date')}}</th>
                                            <th>{{__('End Date')}}</th>
                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($loans as $loan)
                                            <tr>
                                                <td>{{ $loan->employee()->name }}</td>
                                                <td>{{ $loan->loan_option()->name }}</td>
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
                    </div>
                    <div id="saturation-deduction" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'saturationdeduction','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('deduction_option', __('Deduction Options*'),['class'=>'form-control-label']) }}
                                            {{ Form::select('deduction_option',$deduction_options,null, array('class' => 'form-control select2','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
                                            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>
                                @can('Create Saturation Deduction')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}

                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="saturation-deduction-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('Employee Name')}}</th>
                                            <th>{{__('Deduction Option')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($saturationdeductions as $saturationdeduction)
                                            <tr>

                                                <td>{{ $saturationdeduction->employee()->name }}</td>
                                                <td>{{ $saturationdeduction->deduction_option()->name }}</td>
                                                <td>{{ $saturationdeduction->title }}</td>
                                                <td>{{ \Auth::user()->priceFormat( $saturationdeduction->amount )}}</td>

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
                    </div>
                    <div id="other-payment" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'otherpayment','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Title'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('amount', __('Amount'),['class'=>'form-control-label']) }}
                                            {{ Form::number('amount',null, array('class' => 'form-control ','required'=>'required' ,'step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>

                                @can('Create Other Payment')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}


                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="other-payment-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('employee')}}</th>
                                            <th>{{__('Title')}}</th>
                                            <th>{{__('Amount')}}</th>
                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($otherpayments as $otherpayment)
                                            <tr>
                                                <td>{{ $otherpayment->employee()->name }}</td>
                                                <td>{{ $otherpayment->title }}</td>
                                                <td>{{  \Auth::user()->priceFormat($otherpayment->amount )}}</td>

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
                    </div>
                    <div id="overtime" class="tab-pane">
                        <div class="card">
                            <div class="card-body">
                                {{Form::open(array('url'=>'overtime','method'=>'post'))}}
                                @csrf
                                {{ Form::hidden('employee_id',$employee->id, array()) }}
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('title', __('Overtime Title*'),['class'=>'form-control-label']) }}
                                            {{ Form::text('title',null, array('class' => 'form-control ','required'=>'required')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('number_of_days', __('Number of days'),['class'=>'form-control-label']) }}
                                            {{ Form::number('number_of_days',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('hours', __('Hours'),['class'=>'form-control-label']) }}
                                            {{ Form::number('hours',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('rate', __('Rate'),['class'=>'form-control-label']) }}
                                            {{ Form::number('rate',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01')) }}
                                        </div>
                                    </div>
                                </div>
                                @can('Create Overtime')
                                    <div class="row">
                                        <div class="col-12 text-right mt-1">
                                            <input type="submit" value="{{__('Save Change')}}" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                @endcan
                                {{Form::close()}}

                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0" id="overtime-dataTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('Employee Name')}}</th>
                                            <th>{{__('Overtime Title')}}</th>
                                            <th>{{__('Number of days')}}</th>
                                            <th>{{__('Hours')}}</th>
                                            <th>{{__('Rate')}}</th>

                                            <th width="200px">{{__('Action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        @foreach ($overtimes as $overtime)
                                            <tr>
                                                <td>{{ $overtime->employee()->name }}</td>
                                                <td>{{ $overtime->title }}</td>
                                                <td>{{ $overtime->number_of_days }}</td>
                                                <td>{{ $overtime->hours }}</td>
                                                <td>{{ \Auth::user()->priceFormat( $overtime->rate) }}</td>

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
            </section>
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
