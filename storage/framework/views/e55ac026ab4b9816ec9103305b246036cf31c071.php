<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leave')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Leave')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('leave.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="<?php echo e(__('Create New Leave')); ?>">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="<?php echo e(route('leave.export')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> <?php echo e(__('Export')); ?>

                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                                <tr>
                                    <?php if(\Auth::user()->type != 'employee'): ?>
                                        <th><?php echo e(__('Employee')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Leave Type')); ?></th>
                                    <th><?php echo e(__('Applied On')); ?></th>
                                    <th><?php echo e(__('Start Date')); ?></th>
                                    <th><?php echo e(__('End Date')); ?></th>
                                    <th><?php echo e(__('Total Days')); ?></th>
                                    <th><?php echo e(__('Leave Reason')); ?></th>
                                    <th><?php echo e(__('status')); ?></th>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(\Auth::user()->type != 'employee'): ?>
                                            <td><?php echo e(!empty(\Auth::user()->getEmployee($leave->employee_id)) ? \Auth::user()->getEmployee($leave->employee_id)->name : ''); ?>

                                            </td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty(\Auth::user()->getLeaveType($leave->leave_type_id)) ? \Auth::user()->getLeaveType($leave->leave_type_id)->title : ''); ?>

                                        </td>
                                        <td><?php echo e(\Auth::user()->dateFormat($leave->applied_on)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($leave->start_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($leave->end_date)); ?></td>
                                        <?php
                                            $startDate = new \DateTime($leave->start_date);
                                            $endDate = new \DateTime($leave->end_date);
                                            
                                            $total_leave_days = !empty($startDate->diff($endDate)) ? $startDate->diff($endDate)->days : 0;
                                            
                                        ?>
                                        <td><?php echo e($total_leave_days); ?></td>
                                        <td><?php echo e($leave->leave_reason); ?></td>
                                        <td>
                                            <?php if($leave->status == 'Pending'): ?>
                                                <div class="badge badge-pill badge-warning"><?php echo e($leave->status); ?></div>
                                            <?php elseif($leave->status=="Approve"): ?>
                                                <div class="badge badge-pill badge-success"><?php echo e($leave->status); ?></div>
                                            <?php else: ?>
                                                <div class="badge badge-pill badge-danger"><?php echo e($leave->status); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(\Auth::user()->type == 'employee'): ?>
                                                <?php if($leave->status == 'Pending'): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Leave')): ?>
                                                        <a href="#" data-url="<?php echo e(URL::to('leave/' . $leave->id . '/edit')); ?>"
                                                            data-size="lg" data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Edit Leave')); ?>" class="edit-icon"
                                                            data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a href="#" data-url="<?php echo e(URL::to('leave/' . $leave->id . '/action')); ?>"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Leave Action')); ?>" class="edit-icon bg-success"
                                                    data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Leave Action')); ?>"><i
                                                        class="fas fa-caret-right"></i> </a>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Leave')): ?>
                                                    <a href="#" data-url="<?php echo e(URL::to('leave/' . $leave->id . '/edit')); ?>"
                                                        data-size="lg" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Edit Leave')); ?>" class="edit-icon"
                                                        data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Leave')): ?>
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($leave->id); ?>').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['leave.destroy', $leave->id], 'id' => 'delete-form-' . $leave->id]); ?>

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

    <?php $__env->startPush('script-page'); ?>
        <script>
            $(document).on('change', '#employee_id', function() {
                var employee_id = $(this).val();

                $.ajax({
                    url: '<?php echo e(route('leave.jsoncount')); ?>',
                    type: 'POST',
                    data: {
                        "employee_id": employee_id,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(data) {

                        $('#leave_type_id').empty();
                        $('#leave_type_id').append(
                            '<option value=""><?php echo e(__('Select Leave Type')); ?></option>');

                        $.each(data, function(key, value) {

                            if (value.total_leave >= value.days) {
                                $('#leave_type_id').append('<option value="' + value.id +
                                    '" disabled>' + value.title + '&nbsp(' + value.total_leave +
                                    '/' + value.days + ')</option>');
                            } else {
                                $('#leave_type_id').append('<option value="' + value.id + '">' +
                                    value.title + '&nbsp(' + value.total_leave + '/' + value
                                    .days + ')</option>');
                            }
                        });

                    }
                });
            });
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/leave/index.blade.php ENDPATH**/ ?>