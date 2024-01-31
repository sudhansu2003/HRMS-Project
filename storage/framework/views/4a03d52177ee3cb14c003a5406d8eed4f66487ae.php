<div class="card bg-none card-box">
    <?php echo e(Form::open(['route' => 'projectassigns.storeassign'])); ?>

    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Employee Name'), ['class' => 'form-control-label'])); ?>

            <?php echo Form::select('name', $usersWithoutProject->pluck('user_name'), null, ['class' => 'form-control font-style select2', 'required' => 'required']); ?>

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

</div>
<?php /**PATH C:\xampp\htdocs\HRMS\resources\views/projectassign/createassign.blade.php ENDPATH**/ ?>