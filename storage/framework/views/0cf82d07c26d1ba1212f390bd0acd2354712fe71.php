<?php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_small_logo=Utility::getValByName('company_small_logo');

?>
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')); ?>" class="navbar-brand-img">
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
                    <a href="<?php echo e(route('home')); ?>" class="nav-link <?php echo e(request()->is('home*') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i><?php echo e(__('Dashboard')); ?>

                    </a>
                </li>
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('user.index')); ?>" class="nav-link <?php echo e(request()->is('user*') ? 'active' : ''); ?>">
                            <i class="fas fa-user"></i><?php echo e(__('Company')); ?>

                        </a>
                    </li>
                <?php else: ?>
                    <?php if( Gate::check('Manage User') || Gate::check('Manage Role') || Gate::check('Manage Employee Profile')  || Gate::check('Manage Employee Last Login')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'active' : 'collapsed'); ?>" href="#navbar-staff" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' ||
                             Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'true' : 'false'); ?>" aria-controls="navbar-staff">
                                <i class="fas fa-columns"></i><?php echo e(__('Staff')); ?>

                                <i class="fas fa-sort-up"></i>
                            </a>
                            <div class="collapse <?php echo e((Request::route()->getName() == 'user.index' || Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'permissions.index' || Request::route()->getName() == 'employee.profile' || Request::route()->getName() == 'lastlogin') ? 'show' : ''); ?>" id="navbar-staff">
                                <ul class="nav flex-column submenu-ul">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                                        <li class="nav-item <?php echo e(request()->is('user*') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('user.index')); ?>" class="nav-link"><?php echo e(__('User')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                                        <li class="nav-item <?php echo e(request()->is('roles*') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('roles.index')); ?>" class="nav-link"><?php echo e(__('Role')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Employee Profile')): ?>
                                        <li class="nav-item <?php echo e(request()->is('employee-profile') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('employee.profile')); ?>" class="nav-link"><?php echo e(__('Employee Profile')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Employee Last Login')): ?>
                                        <li class="nav-item <?php echo e(request()->is('lastlogin') ? 'active' : ''); ?>">
                                            <a href="<?php echo e(route('lastlogin')); ?>" class="nav-link"><?php echo e(__('Last Login')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Gate::check('Manage Employee')): ?>
                    <?php if(\Auth::user()->type =='employee'): ?>
                        <?php
                            $employee=App\Models\Employee::where('user_id',\Auth::user()->id)->first();
                        ?>
                        <li class="nav-item ">
                            <a href="<?php echo e(route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>" class="nav-link <?php echo e(request()->is('employee*') ? 'active' : ''); ?>">
                                <i class="fas fa-users"></i><?php echo e(__('Employee')); ?>

                            </a>
                        </li>
                    <?php else: ?>

                        <li class="nav-item">
                            <a href="<?php echo e(route('employee.index')); ?>" class="nav-link  <?php echo e((Request::route()->getName() == 'employee.index') ||  (Request::route()->getName() == 'employee.create') ||  (Request::route()->getName() == 'employee.edit') ||  (Request::route()->getName() == 'employee.show') ? 'active' : ''); ?>">
                                <i class="fas fa-users"></i><?php echo e(__('Employee')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(Gate::check('Manage Set Salary') || Gate::check('Manage Pay Slip')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-payroll" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route
                           ()->getName() == 'payslip.pdf') ? 'true' : 'false'); ?>" aria-controls="navbar-payroll">
                            <i class="fas fa-receipt"></i><?php echo e(__('Payroll')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'show' : ''); ?>"
                             id="navbar-payroll">
                            <ul class="nav flex-column submenu-ul">

                                <li class="nav-item <?php echo e(request()->is('setsalary*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('setsalary.index')); ?>" class="nav-link"><?php echo e(__('Set Salary')); ?></a>
                                </li>
                                <li class="nav-item <?php echo e(request()->is('payslip*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('payslip.index')); ?>" class="nav-link"><?php echo e(__('Payslip')); ?></a>
                                </li>

                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(\Auth::user()->type=='employee'): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-payroll" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route
                           ()->getName() == 'payslip.pdf') ? 'true' : 'false'); ?>" aria-controls="navbar-payroll">
                            <i class="fas fa-receipt"></i><?php echo e(__('Payroll')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'setsalary.index' || Request::route()->getName() == 'setsalary.show' ||  Request::route()->getName() == 'payslip.index' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'setsalary.edit' || Request::route()->getName() == 'employeesalary' || Request::route()->getName() == 'payslip.employeepayslip' || Request::route()->getName() == 'payslip.pdf') ? 'show' : ''); ?>"
                             id="navbar-payroll">
                            <ul class="nav flex-column submenu-ul">

                                <li class="nav-item <?php echo e(request()->is('setsalary*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('setsalary.show',\Auth::user()->id)); ?>" class="nav-link"><?php echo e(__('Set Salary')); ?></a>
                                </li>
                                <li class="nav-item <?php echo e(request()->is('payslip*') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('payslip.index')); ?>" class="nav-link"><?php echo e(__('Payslip')); ?></a>
                                </li>

                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if( Gate::check('Manage Attendance') || Gate::check('Manage Leave') || Gate::check('Manage TimeSheet')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-timesheet" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'true' : 'false'); ?>" aria-controls="navbar-timesheet">
                            <i class="fas fa-clock"></i><?php echo e(__('Timesheet')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'leave.index'  || Request::route()->getName() == 'timesheet.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'show' : ''); ?>" id="navbar-timesheet">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage TimeSheet')): ?>
                                    <li class="nav-item <?php echo e(request()->is('timesheet*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('timesheet.index')); ?>" class="nav-link"><?php echo e(__('Timesheet')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Leave')): ?>
                                    <li class="nav-item <?php echo e(request()->is('leave*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('leave.index')); ?>" class="nav-link"><?php echo e(__('Manage Leave')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Attendance')): ?>
                                    <li class="nav-item submenu-li">
                                        <a class="nav-link <?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : 'collapsed'); ?>" href="#navbar-attendance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'true' : 'false'); ?>" aria-controls="navbar-attendance">
                                            <i class="fas fa-flag-checkered"></i><?php echo e(__('Attendance')); ?>

                                            <i class="fas fa-sort-up"></i>
                                        </a>
                                        <div class="collapse submenu-ul <?php echo e((Request::route()->getName() == 'attendanceemployee.index' || Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'show' : ''); ?>" id="navbar-attendance">
                                            <ul class="nav flex-column">
                                                <li class="nav-item <?php echo e((Request::route()->getName() == 'attendanceemployee.index') ? 'active' : ''); ?>">
                                                    <a href="<?php echo e(route('attendanceemployee.index')); ?>" class="nav-link"><?php echo e(__('Marked Attendance')); ?></a>
                                                </li>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Attendance')): ?>
                                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'attendanceemployee.bulkattendance') ? 'active' : ''); ?>">
                                                        <a href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>" class="nav-link"><?php echo e(__('Bulk Attendance')); ?></a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Indicator') || Gate::check('Manage Appraisal') || Gate::check('Manage Goal Tracking')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'active' : 'collapsed'); ?>" href="#navbar-performance" data-toggle="collapse" role="button" aria-expanded="<?php echo e((Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'true' : 'false'); ?>"
                           aria-controls="navbar-performance">
                            <i class="fas fa-cube"></i><?php echo e(__('Performance')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'indicator.index' || Request::route()->getName() == 'appraisal.index' || Request::route()->getName() == 'goaltracking.index') ? 'show' : ''); ?>" id="navbar-performance">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Indicator')): ?>
                                    <li class="nav-item <?php echo e(request()->is('indicator*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('indicator.index')); ?>" class="nav-link"><?php echo e(__('Indicator')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Appraisal')): ?>
                                    <li class="nav-item <?php echo e(request()->is('appraisal*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('appraisal.index')); ?>" class="nav-link"><?php echo e(__('Appraisal')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Goal Tracking')): ?>
                                    <li class="nav-item <?php echo e(request()->is('goaltracking*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('goaltracking.index')); ?>" class="nav-link"><?php echo e(__('Goal Tracking')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Account List') || Gate::check('Manage Payee')  || Gate::check('Manage Payer')  || Gate::check('Manage Deposit') || Gate::check('Manage Expense') || Gate::check('Manage Transfer Balance')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-finance" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'true' : 'false'); ?>"
                           aria-controls="navbar-finance">
                            <i class="fas fa-wallet"></i><?php echo e(__('Finance')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'accountlist.index' || Request::route()->getName() == 'accountbalance' || Request::route()->getName() == 'payees.index' || Request::route()->getName() == 'payer.index' || Request::route()->getName() == 'deposit.index' || Request::route()->getName() == 'expense.index' || Request::route()->getName() == 'transferbalance.index' || Request::route()->getName() == 'viewtransaction.index') ? 'show' : ''); ?>"
                             id="navbar-finance">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Account List')): ?>
                                    <li class="nav-item <?php echo e(request()->is('accountlist*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('accountlist.index')); ?>" class="nav-link"><?php echo e(__('Account List')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Balance Account List')): ?>
                                    <li class="nav-item <?php echo e(request()->is('accountbalance*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('accountbalance')); ?>" class="nav-link"><?php echo e(__('Account Balance')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payee')): ?>
                                    <li class="nav-item <?php echo e(request()->is('payees*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('payees.index')); ?>" class="nav-link"><?php echo e(__('Payees')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payer')): ?>
                                    <li class="nav-item <?php echo e(request()->is('payer*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('payer.index')); ?>" class="nav-link"><?php echo e(__('Payers')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Deposit')): ?>
                                    <li class="nav-item <?php echo e(request()->is('deposit*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('deposit.index')); ?>" class="nav-link"><?php echo e(__('Deposit')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Expense')): ?>
                                    <li class="nav-item <?php echo e(request()->is('expense*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('expense.index')); ?>" class="nav-link"><?php echo e(__('Expense')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Transfer Balance')): ?>
                                    <li class="nav-item <?php echo e(request()->is('transferbalance*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('transferbalance.index')); ?>" class="nav-link"><?php echo e(__('Transfer Balance')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Trainer') || Gate::check('Manage Training')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-training" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'true' : 'false'); ?>"
                           aria-controls="navbar-training">
                            <i class="fas fa-graduation-cap"></i><?php echo e(__('Training')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'trainer.index' || Request::route()->getName() == 'training.index' || Request::route()->getName() == 'training.show') ? 'show' : ''); ?>"
                             id="navbar-training">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Training')): ?>
                                    <li class="nav-item <?php echo e(request()->is('training*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('training.index')); ?>" class="nav-link"><?php echo e(__('Training List')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Trainer')): ?>
                                    <li class="nav-item <?php echo e(request()->is('trainer*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('trainer.index')); ?>" class="nav-link"><?php echo e(__('Trainer')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Awards') || Gate::check('Manage Transfer') || Gate::check('Manage Resignation')  || Gate::check('Manage Travels') || Gate::check('Manage Promotion') || Gate::check('Manage Complaint')|| Gate::check('Manage Warning') || Gate::check('Manage Termination') || Gate::check('Manage Announcement') || Gate::check('Manage Holiday')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'active' : 'collapsed'); ?>"
                           href="#navbar-hr" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'true' : 'false'); ?>"
                           aria-controls="navbar-hr">
                            <i class="fas fa-user-cog"></i><?php echo e(__('HR')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'award.index' ||  Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'resignation.index' || Request::route()->getName() == 'travel.index' ||  Request::route()->getName() == 'promotion.index' || Request::route()->getName() == 'complaint.index' || Request::route()->getName() == 'warning.index' || Request::route()->getName() == 'termination.index'
                || Request::route()->getName() == 'holiday.index'  || Request::route()->getName() == 'announcement.index' ) ? 'show' : ''); ?>"
                             id="navbar-hr">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Award')): ?>
                                    <li class="nav-item <?php echo e(request()->is('award*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('award.index')); ?>" class="nav-link"><?php echo e(__('Award')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Transfer')): ?>
                                    <li class="nav-item <?php echo e(request()->is('transfer*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('transfer.index')); ?>" class="nav-link"><?php echo e(__('Transfer')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Resignation')): ?>
                                    <li class="nav-item <?php echo e(request()->is('resignation*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('resignation.index')); ?>" class="nav-link"><?php echo e(__('Resignation')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Travel')): ?>
                                    <li class="nav-item <?php echo e(request()->is('travel*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('travel.index')); ?>" class="nav-link"><?php echo e(__('Trip')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Promotion')): ?>
                                    <li class="nav-item <?php echo e(request()->is('promotion*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('promotion.index')); ?>" class="nav-link"><?php echo e(__('Promotion')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Complaint')): ?>
                                    <li class="nav-item <?php echo e(request()->is('complaint*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('complaint.index')); ?>" class="nav-link"><?php echo e(__('Complaints')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Warning')): ?>
                                    <li class="nav-item <?php echo e(request()->is('warning*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('warning.index')); ?>" class="nav-link"><?php echo e(__('Warning')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Termination')): ?>
                                    <li class="nav-item <?php echo e(request()->is('termination*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('termination.index')); ?>" class="nav-link"><?php echo e(__('Termination')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Announcement')): ?>
                                    <li class="nav-item <?php echo e(request()->is('announcement*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('announcement.index')); ?>" class="nav-link"><?php echo e(__('Announcement')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Holiday')): ?>
                                    <li class="nav-item <?php echo e(request()->is('holiday*') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('holiday.index')); ?>" class="nav-link"><?php echo e(__('Holidays')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Job') || Gate::check('Manage Job Application')|| Gate::check('Manage Job OnBoard') || Gate::check('Manage Custom Question') || Gate::check('Manage Interview Schedule') || Gate::check('Manage Career')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'active' : 'collapsed'); ?>"
                           href="#navbar-recurtment" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                           'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                           'true' : 'false'); ?>"
                           aria-controls="navbar-training">
                            <i class="fas fa-user-md"></i><?php echo e(__('Recruitment')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' || Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show' || Request::route()->getName() == 'job.application.candidate' || Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert'  || Request::route()->getName() ==
                        'custom-question.index'  || Request::route()->getName() == 'interview-schedule.index') ?
                        'show' : ''); ?>"
                             id="navbar-recurtment">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.index' || Request::route()->getName() == 'job.create' || Request::route()->getName() == 'job.edit' || Request::route()->getName() == 'job.show' ) ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.index')); ?>" class="nav-link"><?php echo e(__('Jobs')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job-application.index' || Request::route()->getName() == 'job-application.show') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job-application.index')); ?>" class="nav-link"><?php echo e(__('Job Application')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Application')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.application.candidate') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.application.candidate')); ?>" class="nav-link"><?php echo e(__('Job Candidate')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job OnBoard')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'job.on.board' || Request::route()->getName() == 'job.on.board.convert') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('job.on.board')); ?>" class="nav-link"><?php echo e(__('Job OnBoard')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Custom Question')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'custom-question.index') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('custom-question.index')); ?>" class="nav-link"><?php echo e(__('Custom Question')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Interview Schedule')): ?>
                                    <li class="nav-item <?php echo e((Request::route()->getName() == 'interview-schedule.index') ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('interview-schedule.index')); ?>" class="nav-link"><?php echo e(__('Interview Schedule')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Career')): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('career',[\Auth::user()->creatorId(),'en'])); ?>" target="_blank" class="nav-link"><?php echo e(__('Career')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(url('chats')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'chats') ? 'active' : ''); ?>">
                            <i class="fas fa-comments"></i><?php echo e(__('Messenger')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Ticket')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('ticket.index')); ?>" class="nav-link <?php echo e(request()->is('ticket*') ? 'active' : ''); ?>">
                            <i class="fas fa-ticket-alt"></i><?php echo e(__('Ticket')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Event')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('event.index')); ?>" class="nav-link <?php echo e(request()->is('event*') ? 'active' : ''); ?>">
                            <i class="fas fa-calendar-alt"></i><?php echo e(__('Event')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meeting')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('meeting.index')); ?>" class="nav-link <?php echo e(request()->is('meeting*') ? 'active' : ''); ?>">
                            <i class="fas fa-handshake"></i><?php echo e(__('Meeting')); ?>

                        </a>
                    </li>
                <?php endif; ?>

                <?php if(\Auth::user()->type == 'company'): ?>
                <li class="nav-item">                        
                    <a href="<?php echo e(route('zoom-meeting.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'zoom-meeting')?'active':''); ?>">
                        <i class="fas fa-video"></i><?php echo e(__('Zoom Meeting')); ?>

                    </a>
                </li>
                <?php endif; ?>

                <?php if(Gate::check('Manage Assets')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('account-assets.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'account-assets')?'active':''); ?>">
                            <i class="fas fa-calculator"></i><?php echo e(__('Assets')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Document')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('document-upload.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'document-upload')?'active':''); ?>">
                            <i class="fas fa-file"></i><?php echo e(__('Document')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Company Policy')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('company-policy.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'company-policy')?'active':''); ?>">
                            <i class="fas fa-pray"></i><?php echo e(__('Company Policy')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Plan')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('plans.index')); ?>" class="nav-link <?php echo e(request()->is('plans*') ? 'active' : ''); ?>">
                            <i class="fas fa-trophy"></i><?php echo e(__('Plan')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('plan_requests.index')); ?>" class="nav-link">
                            <i class="fas fa-paper-plane"></i><?php echo e(__('Plan Request')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('manage coupon')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('coupons.index')); ?>" class="nav-link <?php echo e((Request::segment(1) == 'coupons')?'active':''); ?>">
                            <i class="fas fa-gift"></i><?php echo e(__('Coupon')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Order')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('order.index')); ?>" class="nav-link <?php echo e(request()->is('orders*') ? 'active' : ''); ?>">
                            <i class="fas fa-cart-plus"></i><?php echo e(__('Order')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Report')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'active' : 'collapsed'); ?>"
                           href="#navbar-reports" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'true' : 'false'); ?>"
                           aria-controls="navbar-reports">
                            <i class="fas fa-list"></i><?php echo e(__('Report')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'report.income-expense' || Request::route()->getName() == 'report.leave' || Request::route()->getName() == 'report.account.statement' || Request::route()->getName() == 'report.payroll' || Request::route()->getName() == 'report.monthly.attendance' || Request::route()->getName() == 'report.timesheet' ) ? 'show' : ''); ?>"
                             id="navbar-reports">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                    <li class="nav-item <?php echo e(request()->is('report/income-expense') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.income-expense')); ?>"><?php echo e(__('Income Vs Expense')); ?></a>
                                    </li>
                                    <li class="nav-item <?php echo e(request()->is('report/monthly/attendance') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                    </li>
                                    <li class="nav-item <?php echo e(request()->is('report/leave') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                    </li>
                                    <li class="nav-item <?php echo e(request()->is('report/account-statement') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.account.statement')); ?>"><?php echo e(__('Account Statement')); ?></a>
                                    </li>
                                    <li class="nav-item <?php echo e(request()->is('report/payroll') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                    </li>
                                    <li class="nav-item <?php echo e(request()->is('report/timesheet') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('report.timesheet')); ?>"><?php echo e(__('Timesheet')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Department') || Gate::check('Manage Designation')  || Gate::check('Manage Document Type')  || Gate::check('Manage Branch') || Gate::check('Manage Award Type') || Gate::check('Manage Termination Types')|| Gate::check('Manage Payslip Type') || Gate::check('Manage Allowance Option') || Gate::check('Manage Loan Options')  || Gate::check('Manage Deduction Options') || Gate::check('Manage Expense Type')  || Gate::check('Manage Income Type') || Gate::check('Manage
                             Payment Type')  || Gate::check('Manage Leave Type') || Gate::check('Manage Training Type')  || Gate::check('Manage Job Category') || Gate::check('Manage Job Stage')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'active' : 'collapsed'); ?>"
                           href="#navbar-constant" data-toggle="collapse" role="button"
                           aria-expanded="<?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'true' : 'false'); ?>"
                           aria-controls="navbar-constant">
                            <i class="fas fa-external-link-alt"></i><?php echo e(__('Constant')); ?>

                            <i class="fas fa-sort-up"></i>
                        </a>
                        <div class="collapse <?php echo e((Request::route()->getName() == 'department.index' || Request::route()->getName() == 'designation.index' || Request::route()->getName() == 'document.index' || Request::route()->getName() == 'branch.index' || Request::route()->getName() == 'awardtype.index' || Request::route()->getName() == 'terminationtype.index' || Request::route()->getName() == 'paysliptype.index' || Request::route()->getName() == 'allowanceoption.index' || Request::route()->getName() ==
            'loanoption.index' || Request::route()->getName() == 'deductionoption.index' || Request::route()->getName() == 'expensetype.index' || Request::route()->getName() == 'incometype.index'|| Request::route()->getName() == 'paymenttype.index' || Request::route()->getName() == 'leavetype.index' || Request::route()->getName() == 'goaltype.index' || Request::route()->getName() == 'trainingtype.index' || Request::route()->getName() == 'job-category.index' || Request::route()->getName() ==
            'job-stage.index') ? 'show' : ''); ?>"
                             id="navbar-constant">
                            <ul class="nav flex-column submenu-ul">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Branch')): ?>
                                    <li class="nav-item <?php echo e(request()->is('branch*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('Branch')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Department')): ?>
                                    <li class="nav-item <?php echo e(request()->is('department*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('department.index')); ?>"><?php echo e(__('Department')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Designation')): ?>
                                    <li class="nav-item <?php echo e(request()->is('designation*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Designation')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Document Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('document*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('document.index')); ?>"><?php echo e(__('Document Type')); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Award Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('awardtype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('awardtype.index')); ?>"><?php echo e(__('Award Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Termination Types')): ?>
                                    <li class="nav-item <?php echo e(request()->is('terminationtype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('terminationtype.index')); ?>"><?php echo e(__('Termination Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payslip Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('paysliptype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('paysliptype.index')); ?>"><?php echo e(__('Payslip Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Allowance Option')): ?>
                                    <li class="nav-item <?php echo e(request()->is('allowanceoption*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('allowanceoption.index')); ?>"><?php echo e(__('Allowance Option')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Loan Option')): ?>
                                    <li class="nav-item <?php echo e(request()->is('loanoption*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('loanoption.index')); ?>"><?php echo e(__('Loan Option')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Deduction Option')): ?>
                                    <li class="nav-item <?php echo e(request()->is('deductionoption*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('deductionoption.index')); ?>"><?php echo e(__('Deduction Option')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Expense Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('expensetype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('expensetype.index')); ?>"><?php echo e(__('Expense Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Income Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('incometype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('incometype.index')); ?>"><?php echo e(__('Income Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('paymenttype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('paymenttype.index')); ?>"><?php echo e(__('Payment Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Leave Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('leavetype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('leavetype.index')); ?>"><?php echo e(__('Leave Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Termination Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('terminationtype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('terminationtype.index')); ?>"><?php echo e(__('Termination Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Goal Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('goaltype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('goaltype.index')); ?>"><?php echo e(__('Goal Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Training Type')): ?>
                                    <li class="nav-item <?php echo e(request()->is('trainingtype*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('trainingtype.index')); ?>"><?php echo e(__('Training Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Category')): ?>
                                    <li class="nav-item <?php echo e(request()->is('job-category*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('job-category.index')); ?>"><?php echo e(__('Job Category')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Job Stage')): ?>
                                    <li class="nav-item <?php echo e(request()->is('job-stage*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('job-stage.index')); ?>"><?php echo e(__('Job Stage')); ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                    <li class="nav-item ">
                                        <a class="nav-link" href="<?php echo e(route('performanceType.index')); ?>"><?php echo e(__('Performance Type')); ?></a>
                                    </li>
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Competencies')): ?>
                                    <li class="nav-item <?php echo e(request()->is('competencies*') ? 'active' : ''); ?>">
                                        <a class="nav-link" href="<?php echo e(route('competencies.index')); ?>"><?php echo e(__('Competencies')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if(Auth::user()->type == 'super admin'): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('custom_landing_page.index')); ?>" class="nav-link">
                            <i class="fas fa-clipboard"></i><?php echo e(__('Landing page')); ?>

                        </a>
                    </li>
                <?php endif; ?>
                <?php if(Gate::check('Manage Company Settings') || Gate::check('Manage System Settings')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('settings.index')); ?>" class="nav-link <?php echo e(request()->is('settings*') ? 'active' : ''); ?>">
                            <i class="fas fa-sliders-h"></i><?php echo e(__('System Setting')); ?>

                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\wamp64\www\hrms\resources\views/partial/Admin/menu.blade.php ENDPATH**/ ?>