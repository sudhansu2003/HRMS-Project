<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Employee')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="<?php echo e(route('employee.edit',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?>

                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6 ">
            <div class="employee-detail-wrap">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Personal Detail')); ?></h6>
                    </div>
                    <div class="card-body employee-detail-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('EmployeeId')); ?></strong>
                                    <span><?php echo e($employeesId); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Name')); ?></strong>
                                    <span><?php echo e($employee->name); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Email')); ?></strong>
                                    <span><?php echo e($employee->email); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Date of Birth')); ?></strong>
                                    <span><?php echo e(\Auth::user()->dateFormat($employee->dob)); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Phone')); ?></strong>
                                    <span><?php echo e($employee->phone); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Address')); ?></strong>
                                    <span><?php echo e($employee->address); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Salary Type')); ?></strong>
                                    <span><?php echo e(!empty($employee->salaryType)?$employee->salaryType->name:''); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Basic Salary')); ?></strong>
                                    <span><?php echo e($employee->salary); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="employee-detail-wrap">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Company Detail')); ?></h6>
                    </div>
                    <div class="card-body employee-detail-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Branch')); ?></strong>
                                    <span><?php echo e(!empty($employee->branch)?$employee->branch->name:''); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Department')); ?></strong>
                                    <span><?php echo e(!empty($employee->department)?$employee->department->name:''); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Designation')); ?></strong>
                                    <span><?php echo e(!empty($employee->designation)?$employee->designation->name:''); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Date Of Joining')); ?></strong>
                                    <span><?php echo e(\Auth::user()->dateFormat($employee->company_doj)); ?></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            <div class="employee-detail-wrap">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Document Detail')); ?></h6>
                    </div>
                    <div class="card-body employee-detail-body">
                        <div class="row">
                            <?php
                                $employeedoc = $employee->documents()->pluck('document_value',__('document_id'));
                            ?>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-12">
                                    <div class="info text-sm">
                                        <strong><?php echo e($document->name); ?></strong>
                                        <span><a href="<?php echo e((!empty($employeedoc[$document->id])?asset(Storage::url('uploads/document')).'/'.$employeedoc[$document->id]:'')); ?>" target="_blank"><?php echo e((!empty($employeedoc[$document->id])?$employeedoc[$document->id]:'')); ?></a></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="employee-detail-wrap">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><?php echo e(__('Bank Account Detail')); ?></h6>
                    </div>
                    <div class="card-body employee-detail-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Account Holder Name')); ?></strong>
                                    <span><?php echo e($employee->account_holder_name); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Account Number')); ?></strong>
                                    <span><?php echo e($employee->account_number); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm font-style">
                                    <strong><?php echo e(__('Bank Name')); ?></strong>
                                    <span><?php echo e($employee->bank_name); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Bank Identifier Code')); ?></strong>
                                    <span><?php echo e($employee->bank_identifier_code); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Branch Location')); ?></strong>
                                    <span><?php echo e($employee->branch_location); ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info text-sm">
                                    <strong><?php echo e(__('Tax Payer Id')); ?></strong>
                                    <span><?php echo e($employee->tax_payer_id); ?></span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\pshrmsl\resources\views/employee/show.blade.php ENDPATH**/ ?>