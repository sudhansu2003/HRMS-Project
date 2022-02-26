<div class="card bg-none card-box">
    <div class="row px-3">
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0">{{__('Employee')}}</h5>
            <h5 class="emp-title black-text">{{  !empty($payslip->employees)? \Auth::user()->employeeIdFormat( $payslip->employees->employee_id):''}}</h5>
        </div>
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0">{{__('Basic Salary')}}</h5>
            <h5 class="emp-title black-text">{{  \Auth::user()->priceFormat( $payslip->basic_salary)}}</h5>
        </div>
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0">{{__('Payroll Month')}}</h5>
            <h5 class="emp-title black-text">{{ \Auth::user()->dateFormat( $payslip->salary_month)}}</h5>
        </div>

        <div class="col-lg-12 our-system">
            {{Form::open(array('route'=>array('payslip.updateemployee',$payslip->employee_id),'method'=>'post'))}}
            {!! Form::hidden('payslip_id', $payslip->id, ['class' => 'form-control']) !!}
            <div class="row">
                <ul class="nav nav-tabs my-4">
                    <li>
                        <a data-toggle="tab" href="#allowance" class="active">{{__('Allowance')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#commission">{{__('Commission')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#loan">{{__('Loan')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#deduction">{{__('Saturation Deduction')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#payment">{{__('Other Payment')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#overtime">{{__('Overtime')}}</a>
                    </li>
                </ul>
                <div class="tab-content pt-4">
                    <div id="allowance" class="tab-pane in active">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $allowances = json_decode($payslip->allowance);
                                        @endphp
                                        @foreach($allowances as $allownace)
                                            <div class="col-md-12 form-group">
                                                {!! Form::label('title', $allownace->title,['class'=>'form-control-label']) !!}
                                                {!! Form::text('allowance[]', $allownace->amount, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('allowance_id[]', $allownace->id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commission" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $commissions = json_decode($payslip->commission);
                                        @endphp
                                        @foreach($commissions as $commission)
                                            <div class="col-md-12 form-group">
                                                {!! Form::label('title', $commission->title,['class'=>'form-control-label']) !!}
                                                {!! Form::text('commission[]', $commission->amount, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('commission_id[]', $commission->id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="loan" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $loans = json_decode($payslip->loan);
                                        @endphp
                                        @foreach($loans as $loan)
                                            <div class="col-md-12 form-group">
                                                {!! Form::label('title', $loan->title,['class'=>'form-control-label']) !!}
                                                {!! Form::text('loan[]', $loan->amount, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('loan_id[]', $loan->id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="deduction" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $saturation_deductions = json_decode($payslip->saturation_deduction);
                                        @endphp
                                        @foreach($saturation_deductions as $deduction)
                                            <div class="col-md-12 form-group">
                                                {!! Form::label('title', $deduction->title,['class'=>'form-control-label']) !!}
                                                {!! Form::text('saturation_deductions[]', $deduction->amount, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('saturation_deductions_id[]', $deduction->id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="payment" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $other_payments = json_decode($payslip->other_payment);
                                        @endphp
                                        @foreach($other_payments as $payment)
                                            <div class="col-md-12 form-group">
                                                {!! Form::label('title', $payment->title,['class'=>'form-control-label']) !!}
                                                {!! Form::text('other_payment[]', $payment->amount, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('other_payment_id[]', $payment->id, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="overtime" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        @php
                                            $overtimes = json_decode($payslip->overtime);
                                        @endphp
                                        @foreach($overtimes as $overtime)
                                            <div class="col-md-6 form-group">
                                                {!! Form::label('rate', $overtime->title.' '.__('Rate'),['class'=>'form-control-label']) !!}
                                                {!! Form::text('rate[]', $overtime->rate, ['class' => 'form-control']) !!}
                                                {!! Form::hidden('rate_id[]', $overtime->id, ['class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-md-6 form-group">
                                                {!! Form::label('hours',$overtime->title.' '.__('Hours'),['class'=>'form-control-label']) !!}
                                                {!! Form::text('hours[]', $overtime->rate, ['class' => 'form-control']) !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4 text-right">
                <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
