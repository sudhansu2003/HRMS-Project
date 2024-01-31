<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Trainer')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Trainer')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('trainer.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"
                        data-ajax-popup="true" data-title="<?php echo e(__('Create New Trainer')); ?>">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="<?php echo e(route('trainer.export')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> <?php echo e(__('Export')); ?>

                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                    data-url="<?php echo e(route('trainer.file.import')); ?>" data-ajax-popup="true"
                    data-title="<?php echo e(__('Import Trainer CSV file')); ?>">
                    <i class="fa fa-file-csv"></i> <?php echo e(__('Import')); ?>

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
                                    <th><?php echo e(__('Branch')); ?></th>
                                    <th><?php echo e(__('Full Name')); ?></th>
                                    <th><?php echo e(__('Contact')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <?php if(Gate::check('Edit Trainer') || Gate::check('Delete Trainer') || Gate::check('Show Trainer')): ?>
                                        <th width="200px"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody class="font-style">
                                <?php $__currentLoopData = $trainers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(!empty($trainer->branches) ? $trainer->branches->name : ''); ?></td>
                                        <td><?php echo e($trainer->firstname . ' ' . $trainer->lastname); ?></td>
                                        <td><?php echo e($trainer->contact); ?></td>
                                        <td><?php echo e($trainer->email); ?></td>
                                        <?php if(Gate::check('Edit Trainer') || Gate::check('Delete Trainer') || Gate::check('Show Trainer')): ?>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Trainer')): ?>
                                                    <a href="#" data-url="<?php echo e(route('trainer.show', $trainer->id)); ?>"
                                                        data-size="lg" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Trainer Detail')); ?>" class="edit-icon bg-success"
                                                        data-toggle="tooltip"
                                                        data-original-title="<?php echo e(__('View Detail')); ?>"><i
                                                            class="fas fa-eye"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Trainer')): ?>
                                                    <a href="#" data-url="<?php echo e(route('trainer.edit', $trainer->id)); ?>"
                                                        data-size="lg" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Edit Trainer')); ?>" class="edit-icon"
                                                        data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Trainer')): ?>
                                                    <a href="#" class="delete-icon"
                                                        data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($trainer->id); ?>').submit();"
                                                        data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>"><i
                                                            class="fas fa-trash"></i></a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['trainer.destroy', $trainer->id], 'id' => 'delete-form-' . $trainer->id]); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/trainer/index.blade.php ENDPATH**/ ?>