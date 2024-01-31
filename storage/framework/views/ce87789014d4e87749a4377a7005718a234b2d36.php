

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Project Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                        <div class="all-button-box row d-flex justify-content-end">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Project Assign')): ?>
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="all-button-box d-flex justify-content-end">
                                        <a href="#" data-url="<?php echo e(route('projectdetails.create')); ?>"
                                            class="btn btn-sm btn-white btn-icon-only" 
                                            data-ajax-popup="true"
                                            data-title="<?php echo e(__('Create New Project')); ?>">
                                            <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th><?php echo e(__('Project ID')); ?></th>
                                <th><?php echo e(__('Project Name')); ?></th>
                                <th><?php echo e(__('Client Name')); ?></th>
                                <th><?php echo e(__('Deal Date')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('Estimated Delivery Date')); ?></th>
                                <th><?php echo e(__('Actual Delivery Date')); ?></th>
                                <th><?php echo e(__('Early Delivery')); ?></th>
                                <th><?php echo e(__('Late Delivery')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($project['project_id']); ?></td>
                                        <td><?php echo e($project['project_name']); ?></td>
                                        <td><?php echo e($project['client_name']); ?></td>
                                        <td><?php echo e($project['deal_date']); ?></td>
                                        <td><?php echo e($project['start_date']); ?></td>
                                        <td><?php echo e($project['estimated_delivery_date']); ?></td>
                                        <td><?php echo e($project['actual_delivery_date']); ?></td>
                                        <td><?php echo e($project['early_delivery']); ?></td>
                                        <td><?php echo e($project['late_delivery']); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Project Assign')): ?>
                                                <a href="#" data-url="<?php echo e(route('projectdetail.edit',['project_id' => $project->project_id] )); ?>"
                                                    data-size="lg" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Edit Project Details')); ?>" class="edit-icon"
                                                    data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Project Assign')): ?>
                                                <a href="#" class="delete-icon" data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                    data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($project->project_id); ?>').submit();"><i
                                                        class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['projectdetail.destroy', 'project_id' => $project->project_id], 'id' => 'delete-form-' . $project->project_id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Project Assign')): ?>
                                                <a href="#" data-url="<?php echo e(route('projectassigns.assignproject',['project_id' => $project->project_id])); ?>" class="create-project-assign-icon" data-ajax-popup="true" data-title="<?php echo e(__('Assign Project')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Assign Project')); ?>">
                                                    <i class="fas fa-tasks"></i>
                                                </a>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/projectassign/index.blade.php ENDPATH**/ ?>