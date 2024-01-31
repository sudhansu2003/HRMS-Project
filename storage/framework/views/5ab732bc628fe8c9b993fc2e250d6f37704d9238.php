<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Timesheet')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jszip.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/pdfmake.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/dataTables.buttons.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/buttons.html5.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();

        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'pdf',
                        title: filename
                    },
                    {
                        extend: 'excel',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <?php echo e(Form::open(array('route' => array('report.timesheet'),'method'=>'get','id'=>'report_timesheet'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('start_date',__('Start Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::text('start_date',isset($_GET['start_date'])?$_GET['start_date']:date('Y-m-01'),array('class'=>'month-btn form-control datepicker'))); ?>

                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('end_date',__('End Date'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::text('end_date',isset($_GET['end_date'])?$_GET['end_date']:date('Y-m-t'),array('class'=>'month-btn form-control datepicker'))); ?>

                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('branch', __('Branch'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-3 col-md-6 col-sm-12 col-12">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('department', __('Department'),['class'=>'text-type'])); ?>

                    <?php echo e(Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto my-custom">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_timesheet').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('report.timesheet')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="printableArea" class="mt-4">

        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e($filterYear['branch'] .' '.__('Branch') .' '.__('Timesheet Report').' '); ?><?php echo e($filterYear['start_date'].' to '.$filterYear['end_date'].' '.__('of').' '.$filterYear['department'].' '.'Department'); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Title')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e(__('Timesheet Report')); ?></h5>
                </div>
            </div>
            <?php if($filterYear['branch']!='All'): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Branch')); ?> :</h5>
                        <h5 class="report-text mb-0"><?php echo e(($filterYear['branch'])); ?></h5>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filterYear['department']!='All'): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0"><?php echo e(__('Department')); ?> :</h5>
                        <h5 class="report-text mb-0"><?php echo e($filterYear['department']); ?></h5>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($filterYear['start_date'].' to '.$filterYear['end_date']); ?></h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Working Employee')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($filterYear['totalEmployee']); ?></h5>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h5 class="report-text gray-text mb-0"><?php echo e(__('Total Working Hours')); ?> :</h5>
                    <h5 class="report-text mb-0"><?php echo e($filterYear['totalHours']); ?></h5>
                </div>
            </div>
            <?php $__currentLoopData = $timesheetFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheetFilter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-12 col-3">
                    <div class="card p-4 mb-4">
                        <h5 class="report-text gray-text mb-0"><?php echo e($timesheetFilter->name); ?> </h5>
                        <h5 class="report-text mb-0"><?php echo e(__('Total Working Hours')); ?> : <?php echo e($timesheetFilter->total); ?></h5>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive py-4">
                        <table class="table table-striped mb-0" id="report-dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Employee ID')); ?></th>
                                <th><?php echo e(__('Employee')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Hours')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $timesheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timesheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('employee.show',\Illuminate\Support\Facades\Crypt::encrypt($timesheet->employee_id))); ?>" class="btn btn-sm btn-primary"><?php echo e(\Auth::user()->employeeIdFormat($timesheet->employee_id)); ?></a></td>
                                    <td><?php echo e((!empty($timesheet->employee)) ? $timesheet->employee->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($timesheet->date)); ?></td>
                                    <td><?php echo e($timesheet->hours); ?></td>
                                    <td><?php echo e($timesheet->remark); ?></td>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\HRMS\resources\views/report/timesheet.blade.php ENDPATH**/ ?>