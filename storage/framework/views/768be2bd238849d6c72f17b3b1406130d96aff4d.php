<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Employee Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4">
            <?php echo e(Form::open(array('route' => array('employee.profile'),'method'=>'get','id'=>'employee_profile_filter'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('branch', __('Branch'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('branch',$brances,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'select-box select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('department', __('Department'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('department',$departments,isset($_GET['department'])?$_GET['department']:'', array('class' => 'select-box select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('designation', __('Designation'),['class'=>'text-type'])); ?>

                    <select class="select2 select-box select2-multiple" id="designation_id" name="designation" data-placeholder="<?php echo e(__('Select Designation ...')); ?>">
                        <option value=""><?php echo e(__('Designation')); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-auto text-right my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('employee_profile_filter').submit(); return false;" data-toggle="tooltip" data-title="<?php echo e(__('Apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('employee.profile')); ?>" class="reset-btn" data-toggle="tooltip" data-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <?php echo e(Form::close()); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="card profile-card">
                    <div class="avatar-parent-child">
                        <img src="<?php echo e(!empty($employee->user->avatar) ? asset(Storage::url('uploads/avatar')).'/'.$employee->user->avatar : asset(Storage::url('uploads/avatar')).'/avatar.png'); ?>" class="avatar rounded-circle avatar-xl">
                    </div>
                    <h4 class="h4 mb-0 mt-2"><?php echo e($employee->name); ?></h4>
                    <div class="sal-right-card">
                        <span class="badge badge-pill badge-blue"><?php echo e(!empty($employee->designation)?$employee->designation->name:''); ?></span>
                        <div class="Id">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Employee Profile')): ?>
                                <a href="<?php echo e(route('show.employee.profile',\Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                            <?php else: ?>
                                <a href="#"><?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <div class="text-center">
                    <h6><?php echo e(__('there is no employee')); ?></h6>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

    <script>

        $(document).ready(function () {
            var d_id = $('#department').val();
            getDesignation(d_id);
        });

        $(document).on('change', 'select[name=department]', function () {
            var department_id = $(this).val();
            getDesignation(department_id);
        });

        function getDesignation(did) {
            $.ajax({
                url: '<?php echo e(route('employee.json')); ?>',
                type: 'POST',
                data: {
                    "department_id": did, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#designation_id').empty();
                    $('#designation_id').append('<option value=""><?php echo e(__('Select Designation')); ?></option>');
                    $.each(data, function (key, value) {
                        $('#designation_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/employee/profile.blade.php ENDPATH**/ ?>