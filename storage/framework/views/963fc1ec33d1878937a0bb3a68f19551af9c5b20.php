<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Last Login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Last Login')); ?></th>
                                <th><?php echo e(__('Role')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($user->type=='employee'): ?>
                                        <td><?php echo e(\Auth::user()->employeeIdFormat($user->id)); ?></td>
                                    <?php else: ?>
                                        <td>--</td>
                                    <?php endif; ?>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->last_login); ?></td>
                                    <td><?php echo e($user->type); ?></td>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\pshrmsl\resources\views/employee/lastLogin.blade.php ENDPATH**/ ?>