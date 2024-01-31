<div class="card bg-none card-box">
    <div class="row">
        <?php echo e(Form::model($timeSheet, array('route' => array('timesheet.update', $timeSheet->id), 'method' => 'PUT'))); ?>

        <div class="row">
            <?php if(\Auth::user()->type != 'employee'): ?>
                <div class="form-group col-md-12">
                    <?php echo e(Form::label('employee_id', __('Employee'),['class'=>'form-control-label'])); ?>

                    <?php echo Form::select('employee_id', $employees, null,array('class' => 'form-control font-style select2','required'=>'required')); ?>

                </div>
            <?php endif; ?>
            <div class="form-group col-md-6">
            <?php echo e(Form::label('project_name', __('Project'),['class'=>'form-control-label'])); ?>

            <?php echo e(Form::select('project_name', $timeSheet->pluck('project_name','project_name') , null,array('class' => 'form-control font-style select2','required'=>'required'))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('date', __('Date'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('date',null, array('class' => 'form-control datepicker','required'=>'required'))); ?>

            </div>
            <div class="form-group col-md-6">
                <?php echo e(Form::label('hours', __('Hours'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::number('hours',null, array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

            </div>
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('remark', __('Remark'),['class'=>'form-control-label'])); ?>

                <?php echo Form::textarea('remark', null, ['class'=>'form-control','rows'=>'2']); ?>

            </div>
            <div class="col-12">
                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\HRMS\resources\views/timeSheet/edit.blade.php ENDPATH**/ ?>