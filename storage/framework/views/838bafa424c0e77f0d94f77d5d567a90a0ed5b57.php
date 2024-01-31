<div class="card bg-none card-box">
    <?php echo e(Form::open(array('route' => array('projectdetails.store')))); ?>

    <div class="row">
            <div class="form-group col-md-12">
                <?php echo e(Form::label('project_name', __('Project Name'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('project_name', '', ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('client_name', __('Client Name'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('client_name', '', ['class' => 'form-control', 'required' => 'required'])); ?> 
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('deal_date', __('Deal Date'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('deal_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('start_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('estimated_delivery_date', __('Estimated Delivery Date'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('estimated_delivery_date', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('early_delivery', __('Early Delivery'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('early_delivery', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('late_delivery', __('Late Delivery'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::text('late_delivery', '', array('class' => 'form-control datepicker','required'=>'required'))); ?>

        </div>
        <div class="col-12">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn-create badge-blue" style="border-radius: 7px;">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH C:\xampp\htdocs\HRMS\resources\views/projectassign/create.blade.php ENDPATH**/ ?>