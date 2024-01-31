
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Attendance')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script>
    function updateWfhStatus(value) {
        document.getElementById('wfhStatus').value = value.toString();
    }
</script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <?php echo e(Form::open(['route' => 'attendanceemployee.manageattendance', 'method' => 'get', 'id' => 'manageattendance_filter'])); ?>

                        <div class="row d-flex justify-content-end py-0 align-items-center">
                            <div class="col-xl-2 col-lg-2 col-md-6">
                                <div class="all-select-box">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('date', __('Date'), ['class' => 'text-type'])); ?>

                                        <?php echo e(Form::text('date', request('date', now()->format('Y-m-d')), ['class' => 'month-btn form-control datepicker'])); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <button type="submit" name="search" class="apply-btn small-icon-button" data-toggle="tooltip" data-original-title="<?php echo e(__('Apply')); ?>"
                                    style="line-height:1.5;padding:7px 12px;border: 1px solid #0f5ef7;">
                                    <span class="btn-inner--icon"><i class="fas fa-search fa-sm"></i></span>
                                </button>
                                <button type="submit" name="reset" class="reset-btn small-icon-button" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>"
                                    style="line-height:1.5;padding:7px 12px;border: 1px solid #FF5630;">
                                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt fa-sm"></i></span>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                    <div class="row d-flex justify-content-end py-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0 dataTable">
                                <thead>
                                    <tr>
                                        <th width="10%"><?php echo e(__('Employee Id')); ?></th>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                        <th><?php echo e(__('Date')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Update Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="Id">
                                                <?php echo e($employee->id); ?>

                                            </td>
                                            <td>
                                                <?php echo e($employee->name); ?>

                                            </td>
                                            <td>
                                                <?php echo e($employee->date); ?>

                                            </td>
             
                                            <td class="<?php echo e($employee->status === 'Present' ? 'text-success' : 'text-danger'); ?>">
                                                <?php if($employee->status === 'Present' && $employee->wfh_flag == 1): ?>
                                                    Present(wfh)
                                                <?php else: ?>
                                                    <?php echo e($employee->status === 'Present' ? 'Present' : 'Absent'); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(is_null($employee->date)): ?>
                                                    <?php echo e(Form::open(['route' => 'attendanceemployee.insertrecord', 'method' => 'post'])); ?>

                                                    <?php echo e(Form::hidden('employeeId', $employee->id)); ?>

                                                    <?php echo e(Form::hidden('date', request('date',$employee->date))); ?>

                                                    <?php echo e(Form::hidden('status', 'Present')); ?>

                                                    <?php echo e(Form::hidden('clockIn', now())); ?>

                                                    <?php echo e(Form::hidden('insertRecord', 'true')); ?>

                                                    <?php echo e(Form::hidden('createdBy', Auth::user()->id)); ?>

                                                    <?php echo e(Form::submit('Present', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;'])); ?>

                                                    <?php echo e(Form::close()); ?>

                                                <?php else: ?>
                                                    <?php echo e(Form::open(['route' => 'attendanceemployee.updatestatus', 'method' => 'post'])); ?>

                                                    <?php echo e(Form::hidden('employeeId', $employee->id)); ?>

                                                    <?php echo e(Form::hidden('newStatus', $employee->status === 'Present' ? 'Absent' : 'Present')); ?>

                                                    <?php echo e(Form::hidden('updateStatus', 'true')); ?>

                                                    <?php echo e(Form::hidden('date', $employee->date)); ?>

                                                    <?php echo e(Form::submit($employee->status === 'Present' ? 'Absent' : 'Present', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;'])); ?>

                                                    <?php echo e(Form::close()); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if(is_null($employee->date)): ?>
                                                    <?php echo e(Form::open(['route' => 'attendanceemployee.insertrecord', 'method' => 'post'])); ?>

                                                    <?php echo e(Form::hidden('employeeId', $employee->id)); ?>

                                                    <?php echo e(Form::hidden('date', request('date', $employee->date))); ?>

                                                    <?php echo e(Form::hidden('status', 'Present(wfh)')); ?>

                                                    <?php echo e(Form::hidden('clockIn', now())); ?>

                                                    <?php echo e(Form::hidden('insertRecord', 'true')); ?>

                                                    <?php echo e(Form::hidden('createdBy', Auth::user()->id)); ?>

                                                    <?php echo e(Form::submit('Work From Home', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;'])); ?>

                                                    <?php echo e(Form::close()); ?>

                                                <?php elseif($employee->status === 'Present'): ?>
                                                
                                                <?php else: ?>
                                                    <?php echo e(Form::open(['route' => 'attendanceemployee.updatestatus', 'method' => 'post'])); ?>

                                                    <?php echo e(Form::hidden('employeeId', $employee->id)); ?>

                                        

                                                    <?php echo e(Form::hidden('newStatus', $employee->status === 'Present' ? 'Present(wfh)' : 'Present')); ?> 
                                                    <?php echo e(Form::hidden('updateStatus', 'true')); ?>

                                                    <?php echo e(Form::hidden('date', $employee->date)); ?>


                                                    <?php if($employee->status === 'Present(wfh)'): ?>
                                                        <?php echo e(Form::hidden('wfhStatus', '0')); ?> 
                                                    <?php else: ?>
                                                        <?php echo e(Form::hidden('wfhStatus', '1')); ?> 
                                                    <?php endif; ?>

                                                    <?php echo e(Form::submit($employee->status === 'Absent' ? 'Work from Home' : 'Present(wfh)', ['class' => 'btn btn-primary', 'style' => 'background-color: #0f5ef7; color: white; text-align: center; line-height: 4px; height: 40px;'])); ?>

                                                    <?php echo e(Form::close()); ?>

                                                <?php endif; ?>
                                            </td>
                                            <script>
                                                function updateWfhStatus() {
                                                    document.getElementById('wfhStatus').value = '1';
                                                }
                                            </script>
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/attendance/manage.blade.php ENDPATH**/ ?>