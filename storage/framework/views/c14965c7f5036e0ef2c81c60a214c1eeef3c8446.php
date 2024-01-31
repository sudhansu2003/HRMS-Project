<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Assets')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Assets')): ?>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                <div class="all-button-box">
                    <a href="#" data-url="<?php echo e(route('account-assets.create')); ?>"
                        class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
                        data-title="<?php echo e(__('Create Assets')); ?>">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="<?php echo e(route('assets.export')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fa fa-file-excel"></i> <?php echo e(__('Export')); ?>

                </a>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
            <div class="all-button-box">
                <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"
                    data-url="<?php echo e(route('assets.file.import')); ?>" data-ajax-popup="true"
                    data-title="<?php echo e(__('Import  Asset CSV file')); ?>">
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
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Purchase Date')); ?></th>
                                    <th> <?php echo e(__('Support Until')); ?></th>
                                    <th> <?php echo e(__('Amount')); ?></th>
                                    <th> <?php echo e(__('Description')); ?></th>
                                    <?php if(Gate::check('Edit Assets') || Gate::check('Delete Assets')): ?>
                                        <th> <?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="font-style"><?php echo e($asset->name); ?></td>
                                        <td class="font-style"><?php echo e(\Auth::user()->dateFormat($asset->purchase_date)); ?>

                                        </td>
                                        <td class="font-style">
                                            <?php echo e(\Auth::user()->dateFormat($asset->supported_date)); ?></td>
                                        <td class="font-style"><?php echo e(\Auth::user()->priceFormat($asset->amount)); ?></td>
                                        <td class="font-style"><?php echo e($asset->description); ?></td>
                                        <?php if(Gate::check('Edit Assets') || Gate::check('Delete Assets')): ?>
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Assets')): ?>
                                                    <a href="#" class="edit-icon"
                                                        data-url="<?php echo e(route('account-assets.edit', $asset->id)); ?>"
                                                        data-ajax-popup="true" data-title="<?php echo e(__('Edit Assets')); ?>"
                                                        data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Assets')): ?>
                                                    <a href="#" class="delete-icon" data-toggle="tooltip"
                                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($asset->id); ?>').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['account-assets.destroy', $asset->id], 'id' => 'delete-form-' . $asset->id]); ?>

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
        $(document).ready(function() {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {
                    format: 'YYYY-MM-DD'
                },
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/assets/index.blade.php ENDPATH**/ ?>