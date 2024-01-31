<?php $__env->startSection('page-title'); ?>
    <?php if(\Auth::user()  ->type=='super admin'): ?>
        <?php echo e(__('Manage Companies')); ?>

    <?php else: ?>
        <?php echo e(__('Manage Users')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create User')): ?>
        <div class="all-button-box row d-flex justify-content-end">
            <?php if(\Auth::user()->type=='super admin'): ?>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="<?php echo e(route('user.create')); ?>" data-size="xl" data-ajax-popup="true" data-title="<?php echo e(__('Create New Company')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            <?php else: ?>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                    <a href="#" data-url="<?php echo e(route('user.create')); ?>" data-size="xl" data-ajax-popup="true" data-title="<?php echo e(__('Create New User')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                        <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php
    $profile=asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-sm-6 col-md-6">
                <div class="card profile-card">
                    <?php if(Gate::check('Edit User') || Gate::check('Delete User')): ?>
                        <div class="edit-profile user-text">
                            <div class="dropdown action-item">
                                <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit User')): ?>
                                        <a href="#" data-url="<?php echo e(route('user.edit',$user->id)); ?>" class="dropdown-item text-sm" data-ajax-popup="true" data-toggle="tooltip" data-title="<?php echo e(__('Edit User')); ?>" data-original-title="<?php echo e(__('Edit User')); ?>"><?php echo e(__('Edit')); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete User')): ?>
                                        <a href="#" class="dropdown-item text-sm" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($user->id); ?>').submit();"><?php echo e(__('Delete')); ?></a>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id],'id'=>'delete-form-'.$user->id]); ?>

                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="avatar-parent-child">
                        <img src="<?php echo e((!empty($user->avatar)? $profile.'/'.$user->avatar : $profile.'/avatar.png')); ?>" class="avatar rounded-circle avatar-xl">
                    </div>
                    <h4 class="h4 mb-0 mt-2"><?php echo e($user->name); ?></h4>
                    <h5 class="office-time mb-0"><?php echo e($user->company_name); ?></h5>
                    <div class="sal-right-card">
                        <span class="badge badge-pill badge-blue"><?php echo e($user->type); ?></span>
                    </div>
                    <h6 class="office-time mb-0 mt-4"><?php echo e($user->email); ?></h6>

                    <?php if(\Auth::user()->type == 'super admin'): ?>
                        <div class="mt-4">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-6 text-center">
                                    <span class="d-block font-weight-bold mb-0"><?php echo e(!empty($user->currentPlan)?$user->currentPlan->name:''); ?></span>
                                </div>
                                <div class="col-6 text-center Id">
                                    <a href="#" data-url="<?php echo e(route('plan.upgrade',$user->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Upgrade Plan')); ?>"><?php echo e(__('Upgrade Plan')); ?></a>
                                </div>
                                <div class="col-12">
                                    <hr class="my-3">
                                </div>
                                <div class="col-12 text-center pb-2">
                                    <span class="text-dark text-xs"><?php echo e(__('Plan Expire : ')); ?> <?php echo e(!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date):'Unlimited'); ?></span>
                                </div>
                                <div class="col-6 text-center">
                                    <span class="d-block text-sm font-weight-bold mb-0"><?php echo e(\Auth::user()->countUsers()); ?></span>
                                    <span class="d-block text-sm text-muted"><?php echo e(__('Users')); ?></span>
                                </div>
                                <div class="col-6 text-center">
                                    <span class="d-block text-sm font-weight-bold mb-0"><?php echo e(\Auth::user()->countEmployees()); ?></span>
                                    <span class="d-block text-sm text-muted"><?php echo e(__('Employees')); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/user/index.blade.php ENDPATH**/ ?>