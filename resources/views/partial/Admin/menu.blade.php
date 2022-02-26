@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');

@endphp
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{$logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')}}" class="navbar-brand-img">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home*') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>{{ __('Dashboard') }}
                    </a>
                </li>
                @if(\Auth::user()->type=='super admin')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>{{ __('Company') }}
                        </a>
                    </li>
                @else
                    @if( Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Employee Profile')  || Gate::check('Manage Employee Last Login'))
                        <li class="nav-item">
                            <a class="nav-link {{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'active' : 'collapsed' }}" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' ||
                             Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'true' : 'false' }}" aria-controls="navbar-staff">
                                <i class="fas fa-columns"></i>{{ __('Staff') }}
                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse {{ (Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'show' : '' }}" id="navbar-staff">
                                <ul class="nav flex-column submenu-ul">
                                    @can('Manage User')
                                        <li class="nav-item {{ request()->is('user*') ? 'active' : '' }}">
                                            <a href="{{ route('user.index') }}" class="nav-link">{{ __('User') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage Role')
                                        <li class="nav-item {{ request()->is('roles*') ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}" class="nav-link">{{ __('Role') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage Employee Profile')
                                        <li class="nav-item {{ request()->is('employee-profile') ? 'active' : '' }}">
                                            <a href="{{ route('employee.profile') }}" class="nav-link">{{ __('Employee Profile') }}</a>
                                        </li>
                                    @endcan
                                    @can('Manage Employee Last Login')
                                        <li class="nav-item {{ request()->is('lastlogin') ? 'active' : '' }}">
                                            <a href="{{ route('lastlogin') }}" class="nav-link">{{ __('Last Login') }}</a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif

                @if(Gate::check('Manage Employee'))
                    @if(\Auth::user()->type =='employee')
                        @php
                            $employee=App\Models\Employee::where('user_id',\Auth::user()->id)->first();
                        @endphp
                        <li class="nav-item ">
                            <a href="{{route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))}}" class="nav-link {{ request()->is('employee*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>{{ __('Employee') }}
                            </a>
                        </li>
                    @else

                        <li class="nav-item">
                            <a href="{{route('employee.index')}}" class="nav-link  {{ (Request::route()->getName() == 'employee.index') ||  (Request::route()->getName() == 'employee.create') ||  (Request::route()->getName() == 'employee.edit') ||  (Request::route()->getName() == 'employee.show') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>{{ __('Employee') }}
                            </a>
                        </li>
                    @endif
                @endif

                @if(Gate::check('Manage Set Salary') || Gate::check('Manage Pay Slip'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'active' : 'collapsed' }}"
                           href="#navbar-payroll" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route
                           ()->getName() == 'payslip.pdf') ? 'true' : 'false' }}" aria-controls="navbar-payroll">
                            <i class="fas fa-receipt"></i>{{ __('Payroll') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'show' : '' }}"
                             id="navbar-payroll">
                            <ul class="nav flex-column submenu-ul">

                                <li class="nav-item {{ request()->is('setsalary*') ? 'active' : '' }}">
                                    <a href="{{ route('setsalary.index') }}" class="nav-link">{{ __('Set Salary') }}</a>
                                </li>
                                <li class="nav-item {{ request()->is('payslip*') ? 'active' : '' }}">
                                    <a href="{{ route('payslip.index') }}" class="nav-link">{{ __('Payslip') }}</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if(\Auth::user()->type=='employee')
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'active' : 'collapsed' }}"
                           href="#navbar-payroll" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route
                           ()->getName() == 'payslip.pdf') ? 'true' : 'false' }}" aria-controls="navbar-payroll">
                            <i class="fas fa-receipt"></i>{{ __('Payroll') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'show' : '' }}"
                             id="navbar-payroll">
                            <ul class="nav flex-column submenu-ul">

                                <li class="nav-item {{ request()->is('setsalary*') ? 'active' : '' }}">
                                    <a href="{{ route('setsalary.show',\Auth::user()->id) }}" class="nav-link">{{ __('Set Salary') }}</a>
                                </li>
                                <li class="nav-item {{ request()->is('payslip*') ? 'active' : '' }}">
                                    <a href="{{ route('payslip.index') }}" class="nav-link">{{ __('Payslip') }}</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif
                @if( Gate::check('Manage Attendance') || Gate::check('Manage Leave') || Gate::check('Manage TimeSheet'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : 'collapsed' }}"
                           href="#navbar-timesheet" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'true' : 'false' }}" aria-controls="navbar-timesheet">
                            <i class="fas fa-clock"></i>{{ __('Timesheet') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'show' : '' }}" id="navbar-timesheet">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage TimeSheet')
                                    <li class="nav-item {{ request()->is('timesheet*') ? 'active' : '' }}">
                                        <a href="{{ route('timesheet.index') }}" class="nav-link">{{ __('Timesheet') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Leave')
                                    <li class="nav-item {{ request()->is('leave*') ? 'active' : '' }}">
                                        <a href="{{ route('leave.index') }}" class="nav-link">{{ __('Manage Leave') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Attendance')
                                    <li class="nav-item submenu-li">
                                        <a class="nav-link {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : 'collapsed' }}" href="#navbar-attendance" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'true' : 'false' }}" aria-controls="navbar-attendance">
                                            <i class="fas fa-flag-checkered"></i>{{ __('Attendance') }}
                                            <i class="fas fa-sort-up"></i>
                                        </a>
                                        <div class="collapse submenu-ul {{ (Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'show' : '' }}" id="navbar-attendance">
                                            <ul class="nav flex-column">
                                                <li class="nav-item {{ (Request::route()->getName() == 'attendanceemployee.index') ? 'active' : '' }}">
                                                    <a href="{{ route('attendanceemployee.index') }}" class="nav-link">{{__('Marked Attendance')}}</a>
                                                </li>
                                                @can('Create Attendance')
                                                    <li class="nav-item {{ (Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : '' }}">
                                                        <a href="{{ route('attendanceemployee.bulkattendance') }}" class="nav-link">{{__('Bulk Attendance')}}</a>
                                                    </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('Manage Indicator') || Gate::check('Manage Appraisal') || Gate::check('Manage Goal Tracking'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'active' : 'collapsed' }}" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="{{ (Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'true' : 'false' }}"
                           aria-controls="navbar-performance">
                            <i class="fas fa-cube"></i>{{ __('Performance') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'show' : '' }}" id="navbar-performance">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Indicator')
                                    <li class="nav-item {{ request()->is('indicator*') ? 'active' : '' }}">
                                        <a href="{{ route('indicator.index') }}" class="nav-link">{{ __('Indicator') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Appraisal')
                                    <li class="nav-item {{ request()->is('appraisal*') ? 'active' : '' }}">
                                        <a href="{{ route('appraisal.index') }}" class="nav-link">{{ __('Appraisal') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Goal Tracking')
                                    <li class="nav-item {{ request()->is('goaltracking*') ? 'active' : '' }}">
                                        <a href="{{ route('goaltracking.index') }}" class="nav-link">{{ __('Goal Tracking') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('Manage Account List') || Gate::check('Manage Payee')  || Gate::check('Manage Payer')  || Gate::check('Manage Deposit') || Gate::check('Manage Expense') || Gate::check('Manage Transfer Balance'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'active' : 'collapsed' }}"
                           href="#navbar-finance" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'true' : 'false' }}"
                           aria-controls="navbar-finance">
                            <i class="fas fa-wallet"></i>{{ __('Finance') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'show' : '' }}"
                             id="navbar-finance">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Account List')
                                    <li class="nav-item {{ request()->is('accountlist*') ? 'active' : '' }}">
                                        <a href="{{ route('accountlist.index') }}" class="nav-link">{{ __('Account List') }}</a>
                                    </li>
                                @endcan
                                @can('View Balance Account List')
                                    <li class="nav-item {{ request()->is('accountbalance*') ? 'active' : '' }}">
                                        <a href="{{ route('accountbalance') }}" class="nav-link">{{ __('Account Balance') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Payee')
                                    <li class="nav-item {{ request()->is('payees*') ? 'active' : '' }}">
                                        <a href="{{ route('payees.index') }}" class="nav-link">{{ __('Payees') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Payer')
                                    <li class="nav-item {{ request()->is('payer*') ? 'active' : '' }}">
                                        <a href="{{ route('payer.index') }}" class="nav-link">{{ __('Payers') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Deposit')
                                    <li class="nav-item {{ request()->is('deposit*') ? 'active' : '' }}">
                                        <a href="{{ route('deposit.index') }}" class="nav-link">{{ __('Deposit') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Expense')
                                    <li class="nav-item {{ request()->is('expense*') ? 'active' : '' }}">
                                        <a href="{{ route('expense.index') }}" class="nav-link">{{ __('Expense') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Transfer Balance')
                                    <li class="nav-item {{ request()->is('transferbalance*') ? 'active' : '' }}">
                                        <a href="{{ route('transferbalance.index') }}" class="nav-link">{{ __('Transfer Balance') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('Manage Trainer') || Gate::check('Manage Training'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'active' : 'collapsed' }}"
                           href="#navbar-training" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'true' : 'false' }}"
                           aria-controls="navbar-training">
                            <i class="fas fa-graduation-cap"></i>{{ __('Training') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'show' : '' }}"
                             id="navbar-training">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Training')
                                    <li class="nav-item {{ request()->is('training*') ? 'active' : '' }}">
                                        <a href="{{ route('training.index') }}" class="nav-link">{{ __('Training List') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Trainer')
                                    <li class="nav-item {{ request()->is('trainer*') ? 'active' : '' }}">
                                        <a href="{{ route('trainer.index') }}" class="nav-link">{{ __('Trainer') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('Manage Awards') || Gate::check('Manage Transfer') || Gate::check('Manage Resignation')  || Gate::check('Manage Travels') || Gate::check('Manage Promotion') || Gate::check('Manage Complaint')|| Gate::check('Manage Warning') || Gate::check('Manage Termination') || Gate::check('Manage Announcement') || Gate::check('Manage Holiday'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'active' : 'collapsed' }}"
                           href="#navbar-hr" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'true' : 'false' }}"
                           aria-controls="navbar-hr">
                            <i class="fas fa-user-cog"></i>{{ __('HR') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'show' : '' }}"
                             id="navbar-hr">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Award')
                                    <li class="nav-item {{ request()->is('award*') ? 'active' : '' }}">
                                        <a href="{{ route('award.index') }}" class="nav-link">{{ __('Award') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Transfer')
                                    <li class="nav-item {{ request()->is('transfer*') ? 'active' : '' }}">
                                        <a href="{{ route('transfer.index') }}" class="nav-link">{{ __('Transfer') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Resignation')
                                    <li class="nav-item {{ request()->is('resignation*') ? 'active' : '' }}">
                                        <a href="{{ route('resignation.index') }}" class="nav-link">{{ __('Resignation') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Travel')
                                    <li class="nav-item {{ request()->is('travel*') ? 'active' : '' }}">
                                        <a href="{{ route('travel.index') }}" class="nav-link">{{ __('Trip') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Promotion')
                                    <li class="nav-item {{ request()->is('promotion*') ? 'active' : '' }}">
                                        <a href="{{ route('promotion.index') }}" class="nav-link">{{ __('Promotion') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Complaint')
                                    <li class="nav-item {{ request()->is('complaint*') ? 'active' : '' }}">
                                        <a href="{{ route('complaint.index') }}" class="nav-link">{{ __('Complaints') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Warning')
                                    <li class="nav-item {{ request()->is('warning*') ? 'active' : '' }}">
                                        <a href="{{ route('warning.index') }}" class="nav-link">{{ __('Warning') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Termination')
                                    <li class="nav-item {{ request()->is('termination*') ? 'active' : '' }}">
                                        <a href="{{ route('termination.index') }}" class="nav-link">{{ __('Termination') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Announcement')
                                    <li class="nav-item {{ request()->is('announcement*') ? 'active' : '' }}">
                                        <a href="{{ route('announcement.index') }}" class="nav-link">{{ __('Announcement') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Holiday')
                                    <li class="nav-item {{ request()->is('holiday*') ? 'active' : '' }}">
                                        <a href="{{ route('holiday.index') }}" class="nav-link">{{ __('Holidays') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Gate::check('Manage Job') || Gate::check('Manage Job Application')|| Gate::check('Manage Job OnBoard') || Gate::check('Manage Custom Question') || Gate::check('Manage Interview Schedule') || Gate::check('Manage Career'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'active' : 'collapsed' }}"
                           href="#navbar-recurtment" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                           'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                           'true' : 'false' }}"
                           aria-controls="navbar-training">
                            <i class="fas fa-user-md"></i>{{ __('Recruitment') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'show' : '' }}"
                             id="navbar-recurtment">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Job')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' ) ? 'active' : '' }}">
                                        <a href="{{ route('job.index') }}" class="nav-link">{{ __('Jobs') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Application')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show') ? 'active' : '' }}">
                                        <a href="{{ route('job-application.index') }}" class="nav-link">{{ __('Job Application') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Application')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.application.candidate') ? 'active' : '' }}">
                                        <a href="{{ route('job.application.candidate') }}" class="nav-link">{{ __('Job Candidate') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job OnBoard')
                                    <li class="nav-item {{ (Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert') ? 'active' : '' }}">
                                        <a href="{{ route('job.on.board') }}" class="nav-link">{{ __('Job OnBoard') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Custom Question')
                                    <li class="nav-item {{ (Request::route()->getName() == 'custom-question.index') ? 'active' : '' }}">
                                        <a href="{{ route('custom-question.index') }}" class="nav-link">{{ __('Custom Question') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Interview Schedule')
                                    <li class="nav-item {{ (Request::route()->getName() == 'interview-schedule.index') ? 'active' : '' }}">
                                        <a href="{{ route('interview-schedule.index') }}" class="nav-link">{{ __('Interview Schedule') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Career')
                                    <li class="nav-item">
                                        <a href="{{ route('career',[\Auth::user()->creatorId(),'en']) }}" target="_blank" class="nav-link">{{ __('Career') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif

                @if(\Auth::user()->type != 'super admin')
                    <li class="nav-item">
                        <a href="{{ url('chats') }}" class="nav-link {{ (Request::route()->getName() == 'chats') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>{{ __('Messenger') }}
                        </a>
                    </li>
                @endif
                @can('Manage Ticket')
                    <li class="nav-item">
                        <a href="{{ route('ticket.index') }}" class="nav-link {{ request()->is('ticket*') ? 'active' : '' }}">
                            <i class="fas fa-ticket-alt"></i>{{ __('Ticket') }}
                        </a>
                    </li>
                @endcan
                @can('Manage Event')
                    <li class="nav-item">
                        <a href="{{ route('event.index') }}" class="nav-link {{ request()->is('event*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i>{{ __('Event') }}
                        </a>
                    </li>
                @endcan
                @can('Manage Meeting')
                    <li class="nav-item">
                        <a href="{{ route('meeting.index') }}" class="nav-link {{ request()->is('meeting*') ? 'active' : '' }}">
                            <i class="fas fa-handshake"></i>{{ __('Meeting') }}
                        </a>
                    </li>
                @endcan

                @if(\Auth::user()->type == 'company')
                <li class="nav-item">                        
                    <a href="{{ route('zoom-meeting.index') }}" class="nav-link {{ (Request::segment(1) == 'zoom-meeting')?'active':''}}">
                        <i class="fas fa-video"></i>{{ __('Zoom Meeting') }}
                    </a>
                </li>
                @endif

                @if(Gate::check('Manage Assets'))
                    <li class="nav-item">
                        <a href="{{ route('account-assets.index') }}" class="nav-link {{ (Request::segment(1) == 'account-assets')?'active':''}}">
                            <i class="fas fa-calculator"></i>{{ __('Assets') }}
                        </a>
                    </li>
                @endcan
                @if(Gate::check('Manage Document'))
                    <li class="nav-item">
                        <a href="{{ route('document-upload.index') }}" class="nav-link {{ (Request::segment(1) == 'document-upload')?'active':''}}">
                            <i class="fas fa-file"></i>{{ __('Document') }}
                        </a>
                    </li>
                @endcan
                @if(Gate::check('Manage Company Policy'))
                    <li class="nav-item">
                        <a href="{{ route('company-policy.index') }}" class="nav-link {{ (Request::segment(1) == 'company-policy')?'active':''}}">
                            <i class="fas fa-pray"></i>{{ __('Company Policy') }}
                        </a>
                    </li>
                @endcan
                @if(Gate::check('Manage Plan'))
                    <li class="nav-item">
                        <a href="{{ route('plans.index') }}" class="nav-link {{ request()->is('plans*') ? 'active' : '' }}">
                            <i class="fas fa-trophy"></i>{{ __('Plan') }}
                        </a>
                    </li>
                @endcan
                @if(\Auth::user()->type=='super admin')
                    <li class="nav-item">
                        <a href="{{ route('plan_requests.index') }}" class="nav-link">
                            <i class="fas fa-paper-plane"></i>{{ __('Plan Request') }}
                        </a>
                    </li>
                @endif
                @if(Gate::check('manage coupon'))
                    <li class="nav-item">
                        <a href="{{ route('coupons.index') }}" class="nav-link {{ (Request::segment(1) == 'coupons')?'active':''}}">
                            <i class="fas fa-gift"></i>{{ __('Coupon') }}
                        </a>
                    </li>
                @endcan
                @if(Gate::check('Manage Order'))
                    <li class="nav-item">
                        <a href="{{ route('order.index') }}" class="nav-link {{ request()->is('orders*') ? 'active' : '' }}">
                            <i class="fas fa-cart-plus"></i>{{ __('Order') }}
                        </a>
                    </li>
                @endcan
                @if(Gate::check('Manage Report'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'active' : 'collapsed' }}"
                           href="#navbar-reports" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'true' : 'false' }}"
                           aria-controls="navbar-reports">
                            <i class="fas fa-list"></i>{{ __('Report') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'show' : '' }}"
                             id="navbar-reports">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Report')
                                    <li class="nav-item {{ request()->is('report/income-expense') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.income-expense') }}">{{ __('Income Vs Expense') }}</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('report/monthly/attendance') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.monthly.attendance') }}">{{ __('Monthly Attendance') }}</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('report/leave') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.leave') }}">{{ __('Leave') }}</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('report/account-statement') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.account.statement') }}">{{ __('Account Statement') }}</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('report/payroll') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.payroll') }}">{{ __('Payroll') }}</a>
                                    </li>
                                    <li class="nav-item {{ request()->is('report/timesheet') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('report.timesheet') }}">{{ __('Timesheet') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif
                @if(Gate::check('Manage Department') || Gate::check('Manage Designation')  || Gate::check('Manage Document Type')  || Gate::check('Manage Branch') || Gate::check('Manage Award Type') || Gate::check('Manage Termination Types')|| Gate::check('Manage Payslip Type') || Gate::check('Manage Allowance Option') || Gate::check('Manage Loan Options')  || Gate::check('Manage Deduction Options') || Gate::check('Manage Expense Type')  || Gate::check('Manage Income Type') || Gate::check('Manage
                             Payment Type')  || Gate::check('Manage Leave Type') || Gate::check('Manage Training Type')  || Gate::check('Manage Job Category') || Gate::check('Manage Job Stage'))
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'active' : 'collapsed' }}"
                           href="#navbar-constant" data-toggle="collapse" role="button"
                           aria-expanded="{{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'true' : 'false' }}"
                           aria-controls="navbar-constant">
                            <i class="fas fa-external-link-alt"></i>{{ __('Constant') }}
                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse {{ (Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'show' : '' }}"
                             id="navbar-constant">
                            <ul class="nav flex-column submenu-ul">
                                @can('Manage Branch')
                                    <li class="nav-item {{ request()->is('branch*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Department')
                                    <li class="nav-item {{ request()->is('department*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('department.index') }}">{{ __('Department') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Designation')
                                    <li class="nav-item {{ request()->is('designation*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('designation.index') }}">{{ __('Designation') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Document Type')
                                    <li class="nav-item {{ request()->is('document*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('document.index') }}">{{ __('Document Type') }}</a>
                                    </li>
                                @endcan

                                @can('Manage Award Type')
                                    <li class="nav-item {{ request()->is('awardtype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('awardtype.index') }}">{{ __('Award Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Termination Types')
                                    <li class="nav-item {{ request()->is('terminationtype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Payslip Type')
                                    <li class="nav-item {{ request()->is('paysliptype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('paysliptype.index') }}">{{ __('Payslip Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Allowance Option')
                                    <li class="nav-item {{ request()->is('allowanceoption*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('allowanceoption.index') }}">{{ __('Allowance Option') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Loan Option')
                                    <li class="nav-item {{ request()->is('loanoption*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('loanoption.index') }}">{{ __('Loan Option') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Deduction Option')
                                    <li class="nav-item {{ request()->is('deductionoption*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('deductionoption.index') }}">{{ __('Deduction Option') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Expense Type')
                                    <li class="nav-item {{ request()->is('expensetype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('expensetype.index') }}">{{ __('Expense Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Income Type')
                                    <li class="nav-item {{ request()->is('incometype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('incometype.index') }}">{{ __('Income Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Payment Type')
                                    <li class="nav-item {{ request()->is('paymenttype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('paymenttype.index') }}">{{ __('Payment Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Leave Type')
                                    <li class="nav-item {{ request()->is('leavetype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('leavetype.index') }}">{{ __('Leave Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Termination Type')
                                    <li class="nav-item {{ request()->is('terminationtype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Goal Type')
                                    <li class="nav-item {{ request()->is('goaltype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('goaltype.index') }}">{{ __('Goal Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Training Type')
                                    <li class="nav-item {{ request()->is('trainingtype*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('trainingtype.index') }}">{{ __('Training Type') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Category')
                                    <li class="nav-item {{ request()->is('job-category*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('job-category.index') }}">{{ __('Job Category') }}</a>
                                    </li>
                                @endcan
                                @can('Manage Job Stage')
                                    <li class="nav-item {{ request()->is('job-stage*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('job-stage.index') }}">{{ __('Job Stage') }}</a>
                                    </li>
                                @endcan
                                
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('performanceType.index') }}">{{ __('Performance Type') }}</a>
                                    </li>
                                
                                @can('Manage Competencies')
                                    <li class="nav-item {{ request()->is('competencies*') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('competencies.index') }}">{{ __('Competencies') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endif
                @if(Auth::user()->type == 'super admin')
                    <li class="nav-item">
                        <a href="{{route('custom_landing_page.index')}}" class="nav-link">
                            <i class="fas fa-clipboard"></i>{{__('Landing page')}}
                        </a>
                    </li>
                @endif
                @if(Gate::check('Manage Company Settings') || Gate::check('Manage System Settings'))
                    <li class="nav-item">
                        <a href="{{ route('settings.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h"></i>{{ __('System Setting') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
