<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Attendance List')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();

            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.date').addClass('d-none');
                $('.date').removeClass('d-block');
            } else {
                $('.date').addClass('d-block');
                $('.date').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-button'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <?php echo e(Form::open(array('route' => array('attendanceemployee.index'),'method'=>'get','id'=>'attendanceemployee_filter'))); ?>

                    <div class="row d-flex justify-content-end mt-2">
                        <div class="col-auto">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    <label class="text-type"><?php echo e(__('Type')); ?></label> <br>
                                    <div class="d-flex radio-check">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="custom-control-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'); ?>>
                                            <label class="custom-control-label" for="monthly"><?php echo e(__('Monthly')); ?></label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="daily" value="daily" name="type" class="custom-control-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''); ?>>
                                            <label class="custom-control-label" for="daily"><?php echo e(__('Daily')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto month">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    <?php echo e(Form::label('month',__('Month'),['class'=>'text-type'])); ?>

                                    <?php echo e(Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control month-btn'))); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-auto date">
                            <div class="all-select-box">
                                <div class="btn-box">
                                    <?php echo e(Form::label('date', __('Date'),['class'=>'text-type'])); ?>

                                    <?php echo e(Form::text('date',isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control datepicker month-btn'))); ?>

                                </div>
                            </div>
                        </div>
                        <?php if(\Auth::user()->type != 'employee'): ?>
                            <div class="col-xl-2 col-lg-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('branch', __('Branch'),['class'=>'text-type'])); ?>

                                        <?php echo e(Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2'))); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-3">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('department', __('Department'),['class'=>'text-type'])); ?>

                                        <?php echo e(Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2'))); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-auto my-auto">
                            <a href="#" class="apply-btn" onclick="document.getElementById('attendanceemployee_filter').submit(); return false;">
                                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                            </a>
                            <a href="<?php echo e(route('attendanceemployee.index')); ?>" class="reset-btn">
                                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                            </a>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <?php if(\Auth::user()->type!='employee'): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Clock In')); ?></th>
                                <th><?php echo e(__('Clock Out')); ?></th>
                                <th><?php echo e(__('Late')); ?></th>
                                <th><?php echo e(__('Early Leaving')); ?></th>
                                <th><?php echo e(__('Overtime')); ?></th>
                                <?php if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $attendanceEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Auth::user()->type!='employee'): ?>
                                        <td><?php echo e(!empty($attendance->employee)?$attendance->employee->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Auth::user()->dateFormat($attendance->date)); ?></td>
                                    <td><?php echo e($attendance->status); ?></td>
                                    <td><?php echo e(($attendance->clock_in !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_in):'00:00'); ?> </td>
                                    <td><?php echo e(($attendance->clock_out !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_out):'00:00'); ?></td>
                                    <td><?php echo e($attendance->late); ?></td>
                                    <td><?php echo e($attendance->early_leaving); ?></td>
                                    <td><?php echo e($attendance->overtime); ?></td>
                                    <?php if(Gate::check('Edit Attendance') || Gate::check('Delete Attendance')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Attendance')): ?>
                                                <a href="#" data-url="<?php echo e(URL::to('attendanceemployee/'.$attendance->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Attendance')); ?>" class="edit-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Attendance')): ?>
                                                <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($attendance->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id],'id'=>'delete-form-'.$attendance->id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
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

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function () {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {format: 'YYYY-MM-DD'},
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\pshrmsl\resources\views/attendance/index.blade.php ENDPATH**/ ?>