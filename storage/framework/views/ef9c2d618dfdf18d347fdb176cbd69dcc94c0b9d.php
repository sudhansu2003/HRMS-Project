<div class="card bg-none card-box">
    <?php echo e(Form::open(['route' => 'projectassigns.storeassign'])); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('id', __('Employee Name'), ['class' => 'form-control-label'])); ?>

            <?php echo Form::select('id', $usersWithoutProject->pluck('user_name','user_id'), null, ['class' => 'form-control font-style select2', 'required' => 'required']); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('project_name', __('Project Name'), ['class' => 'form-control-label'])); ?>

            <?php echo Form::select('project_name', $projectName->pluck('project_name', 'project_name'), null, ['class' => 'form-control font-style select2', 'required' => 'required']); ?>

        </div>
        <div class="col-12">
            <input type="submit" value="<?php echo e(__('Assign')); ?>" class="btn-create badge-blue">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Assigned Users:</h4>
            <?php if($usersWithProject->count() > 0): ?>
                <ul>
                <?php $__currentLoopData = $usersWithProject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="d-flex justify-content-between align-items-center">
                        <span><?php echo e($user->user_name); ?></span>
                        <form method="post" action="<?php echo e(route('projectassigns.unassign', ['user_name' => $user->user_name, 'project_name' => $projectName->first()->project_name])); ?>" id="delete-form-<?php echo e($user->user_id); ?>" style="display: none;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('delete'); ?>
                            <input type="hidden" name="user_name" value="<?php echo e($user->user_name); ?>">
                            <input type="hidden" name="project_name" value="<?php echo e($projectName->first()->project_name); ?>">
                        </form>
                        <a href="#" class="delete-icon" 
                            data-toggle="tooltip" 
                            data-original-title="Delete"
                            onclick="event.preventDefault(); document.getElementById('delete-form-<?php echo e($user->user_id); ?>').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p>No employees assigned to this project.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\HRMS\resources\views/projectassign/assignicon.blade.php ENDPATH**/ ?>