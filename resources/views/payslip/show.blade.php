<div class="card bg-none card-box">
    <div class="col-md-12">
        <div class="card bg-none card-box">
            <form>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <h5 class="emp-title mb-0">{{__('Employee Detail')}}</h5>
                        <h5 class="emp-title black-text">{{ !empty($payslip->employees)? \Auth::user()->employeeIdFormat( $payslip->employees->employee_id):''}}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="emp-title mb-0">{{__('Basic Salary')}}</h5>
                        <h5 class="emp-title black-text">{{ \Auth::user()->priceFormat( $payslip->basic_salary)}}</h5>
                    </div>
                    <div class="col-md-4 mb-3">
                        <h5 class="emp-title mb-0">{{__('Payroll Month')}}</h5>
                        <h5 class="emp-title black-text">{{ \Auth::user()->dateFormat( $payslip->salary_month)}}</h5>
                    </div>

                    <div class="col-lg-12 our-system">
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
                            <div class="tab-content">
                                <div id="allowance" class="tab-pane in active">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $allowances = json_decode($payslip->allowance)
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($allowances as $allownace)
                                                            <tr>
                                                                <td>{{$allownace->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($allownace->amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="commission" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $commissions = json_decode($payslip->commission);
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($commissions as $commission)
                                                            <tr>
                                                                <td>{{$commission->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($commission->amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="loan" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $loans = json_decode($payslip->loan);
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($loans as $loan)
                                                            <tr>
                                                                <td>{{$loan->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($loan->amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="deduction" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $saturation_deductions = json_decode($payslip->saturation_deduction);
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($saturation_deductions as $deduction)
                                                            <tr>
                                                                <td>{{$deduction->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($deduction->amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="payment" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $other_payments = json_decode($payslip->other_payment);
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($other_payments as $payment)
                                                            <tr>
                                                                <td>{{$payment->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($payment->amount)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="overtime" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card bg-none mb-0">
                                                <div class="table-responsive">
                                                    @php
                                                        $overtimes = json_decode($payslip->overtime);
                                                    @endphp
                                                    <table class="table align-items-center">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Title')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list">
                                                        @foreach($overtimes as $overtime)
                                                            <tr>
                                                                <td>{{$overtime->title}}</td>
                                                                <td>{{ \Auth::user()->priceFormat($overtime->rate)}}</td>
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 py-3">
            <h5 class="emp-title mb-0">{{__('Net Salary')}}</h5>
            <h5 class="emp-title black-text">{{ \Auth::user()->priceFormat($payslip->net_payble)}}</h5>
        </div>
    </div>
</div>
