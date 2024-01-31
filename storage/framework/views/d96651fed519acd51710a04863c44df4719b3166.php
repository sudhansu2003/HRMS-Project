<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Timesheet')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create TimeSheet')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('timesheet.create')); ?>"
                        class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                        data-title="<?php echo e(__('Create New')); ?>">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="<?php echo e(route('timesheet.export')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-file-excel"></i> <?php echo e(__('Export')); ?>

                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-url="<?php echo e(route('timesheet.file.import')); ?>" data-ajax-popup="true"
                        data-title="<?php echo e(__('Import Timsheet CSV file')); ?>">
                        <i class="fa fa-file-csv"></i> <?php echo e(__('Import')); ?>

                    </a>
                </div>
            </div>
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <?php if(\Auth::user()->type != 'employee'): ?>
                        <?php echo e(Form::open(['route' => ['timesheet.index'], 'method' => 'get', 'id' => 'timesheet_filter'])); ?>

                        <div class="row d-flex justify-content-end mt-2">
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'text-type'])); ?>

                                        <?php echo e(Form::text('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control datepicker'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'text-type'])); ?>

                                        <?php echo e(Form::text('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control datepicker'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('employee', __('Employee'), ['class' => 'text-type'])); ?>

                                        <?php echo e(Form::select('employee', $employeesList, isset($_GET['employee']) ? $_GET['employee'] : '', ['class' => 'form-control select2'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <a href="#" class="apply-btn"
                                    onclick="document.getElementById('timesheet_filter').submit(); return false;"
                                    data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('timesheet.index')); ?>" class="reset-btn" data-toggle="tooltip"
                                    data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                                </a>

                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <?php if(\Auth::user()->type != 'employee'): ?>
                                        <th><?php echo e(__('Employee')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Hours')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                    <th><?php echo e(__('Project Name')); ?></th>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                <?php $__currentLoopData = $timeSheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timeSheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(\Auth::user()->type != 'employee'): ?>
                                            <td><?php echo e(!empty($timeSheet->employee) ? $timeSheet->employee->name : ''); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e(\Auth::user()->dateFormat($timeSheet->date)); ?></td>
                                        <td><?php echo e($timeSheet->hours); ?></td>
                                        <td><?php echo e($timeSheet->remark); ?></td>
                                        <td><?php echo e($timeSheet->project_name); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit TimeSheet')): ?>
                                                <a href="#" data-url="<?php echo e(route('timesheet.edit', $timeSheet->id)); ?>"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Edit Timesheet')); ?>" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete TimeSheet')): ?>
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($timeSheet->id); ?>').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['timesheet.destroy', $timeSheet->id], 'id' => 'delete-form-' . $timeSheet->id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/timeSheet/index.blade.php ENDPATH**/ ?>