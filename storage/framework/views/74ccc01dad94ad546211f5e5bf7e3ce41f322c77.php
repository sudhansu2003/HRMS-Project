<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Ticket')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Ticket')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="<?php echo e(route('ticket.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Create New Ticket')); ?>">
                <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

            </a>
            </div>
        <?php endif; ?>
    </div>
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
                                <th><?php echo e(__('New')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Ticket Code')); ?></th>
                                <?php if(auth()->check() && auth()->user()->hasRole('company')): ?>
                                <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Priority')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Created By')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php if(\Auth::user()->type=='employee'): ?>
                                            <?php if($ticket->ticketUnread()>0): ?>
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if($ticket->ticketUnread()>0): ?>
                                                <i title="New Message" class="fas fa-circle circle text-success"></i>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($ticket->title); ?></td>
                                    <td><?php echo e($ticket->ticket_code); ?></td>
                                    <?php if(auth()->check() && auth()->user()->hasRole('company')): ?>
                                    <td><?php echo e(!empty(\Auth::user()->getUser($ticket->employee_id))?\Auth::user()->getUser($ticket->employee_id)->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($ticket->priority); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($ticket->end_date)); ?></td>
                                    <td><?php echo e(!empty($ticket->createdBy)?$ticket->createdBy->name:''); ?></td>
                                    <td><?php echo e($ticket->description); ?></td>
                                    <td class="Action">
                                        <a href="<?php echo e(URL::to('ticket/'.$ticket->id.'/reply')); ?>" class="edit-icon bg-success" data-toggle="tooltip" data-original-title="<?php echo e(__('Reply')); ?>">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Ticket')): ?>
                                            <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($ticket->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['ticket.destroy', $ticket->id],'id'=>'delete-form-'.$ticket->id]); ?>

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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\pshrmsl\resources\views/ticket/index.blade.php ENDPATH**/ ?>