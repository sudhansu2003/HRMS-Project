@extends('layouts.admin')
@section('page-title')
    {{__('Manage Employee Salary')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th>{{__('Employee Id')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Payroll Type') }}</th>
                                <th>{{__('Salary') }}</th>
                                <th>{{__('Net Salary') }}</th>
                                <th width="200px">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="Id">
                                        <a href="{{route('setsalary.show',$employee->id)}}"  data-toggle="tooltip" data-original-title="{{__('View')}}">
                                            {{ \Auth::user()->employeeIdFormat($employee->employee_id) }}
                                        </a>
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->salary_type() }}</td>
                                    <td>{{  \Auth::user()->priceFormat($employee->salary) }}</td>
                                    <td>{{  !empty($employee->get_net_salary()) ?\Auth::user()->priceFormat($employee->get_net_salary()):'' }}</td>
                                    <td>
                                        <a href="{{route('setsalary.show',$employee->id)}}" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="{{__('View')}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
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


