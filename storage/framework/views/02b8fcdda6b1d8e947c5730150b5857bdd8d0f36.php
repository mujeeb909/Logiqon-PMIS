<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leave Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Leave Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

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
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();
            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.year').addClass('d-none');
                $('.year').removeClass('d-block');
            } else {
                $('.year').addClass('d-block');
                $('.year').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">





        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.leave'),'method'=>'get','id'=>'report_leave'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-3 mt-2">
                                        <label class="form-label"><?php echo e(__('Type')); ?></label> <br>
                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="form-check-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'); ?>>
                                            <label class="form-check-label" for="monthly"><?php echo e(__('Monthly')); ?></label>
                                        </div>
                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="daily" value="daily" name="type" class="form-check-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''); ?>>
                                            <label class="form-check-label" for="daily"><?php echo e(__('Daily')); ?></label>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 month">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('month',__('Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 year d-none">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('year', __('Year'),['class'=>'form-label'])); ?>

                                            <select class="form-control select" id="year" name="year" tabindex="-1" aria-hidden="true">
                                                <?php for($filterYear['starting_year']; $filterYear['starting_year'] <= $filterYear['ending_year']; $filterYear['starting_year']++): ?>
                                                    <option <?php echo e((isset($_GET['year']) && $_GET['year'] == $filterYear['starting_year'] ?'selected':'')); ?> <?php echo e((!isset($_GET['year']) && date('Y') == $filterYear['starting_year'] ?'selected':'')); ?> value="<?php echo e($filterYear['starting_year']); ?>"><?php echo e($filterYear['starting_year']); ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('branch', __('Branch'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('department', __('Department'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_leave').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.leave')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
    <div id="printableArea" class="">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-report"></i>
                                </div>
                                <div class="ms-3">
                                    <input type="hidden"
                                           value="<?php echo e($filterYear['branch'] . ' ' . __('Branch') . ' ' . $filterYear['dateYearRange'] . ' ' . $filterYear['type'] . ' ' . __('Leave Report of') . ' ' . $filterYear['department'] . ' ' . 'Department'); ?>"
                                           id="filename">
                                    <h5 class="mb-0"><?php echo e(__('Report')); ?></h5>
                                    <div>
                                        <p class="text-muted text-sm mb-0">
                                            <?php echo e($filterYear['type'] . ' ' . __('Leave Summary')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($filterYear['branch'] != 'All'): ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-sitemap"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e(__('Branch')); ?></h5>
                                        <p class="text-muted text-sm mb-0">
                                            <?php echo e($filterYear['branch']); ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filterYear['department'] != 'All'): ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="theme-avtar bg-primary">
                                        <i class="ti ti-template"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0"><?php echo e(__('Department')); ?></h5>
                                        <p class="text-muted text-sm mb-0"><?php echo e($filterYear['department']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-calendar"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Duration')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e($filterYear['dateYearRange']); ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-check"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Approved Leaves')); ?> </h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e($filter['totalApproved']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-x"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Rejected Leave')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e($filter['totalReject']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-circle-minus"></i>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e(__('Pending Leaves')); ?></h5>
                                    <p class="text-muted text-sm mb-0"><?php echo e($filter['totalPending']); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive py-4">
                            <table class="table mb-0" id="report-dataTable">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Employee ID')); ?></th>
                                    <th><?php echo e(__('Employee')); ?></th>
                                    <th><?php echo e(__('Approved Leaves')); ?></th>
                                    <th><?php echo e(__('Rejected Leaves')); ?></th>
                                    <th><?php echo e(__('Pending Leaves')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><a href="#" class="btn btn-sm btn-primary"><?php echo e(\Auth::user()->employeeIdFormat($leave['employee_id'])); ?></a></td>
                                        <td><?php echo e($leave['employee']); ?></td>
                                        <td>
                                            <div class="m-view-btn badge bg-info p-2 px-3 rounded"><?php echo e($leave['approved']); ?>

                                                <a href="#" class="text-white" data-url="<?php echo e(route('report.employee.leave',[$leave['id'],'Approved',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Approved Leave Detail')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View')); ?>"><?php echo e(__('View')); ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="m-view-btn badge bg-danger p-2 px-3 rounded"><?php echo e($leave['reject']); ?>

                                                <a href="#" class="text-white" data-url="<?php echo e(route('report.employee.leave',[$leave['id'],'Reject',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')])); ?>" class="table-action table-action-delete" data-ajax-popup="true" data-title="<?php echo e(__('Rejected Leave Detail')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View')); ?>"><?php echo e(__('View')); ?></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="m-view-btn badge bg-warning p-2 px-3 rounded"><?php echo e($leave['pending']); ?>

                                                <a href="#" class="text-white" data-url="<?php echo e(route('report.employee.leave',[$leave['id'],'Pending',isset($_GET['type']) ?$_GET['type']:'no',isset($_GET['month'])?$_GET['month']:date('Y-m'),isset($_GET['year'])?$_GET['year']:date('Y')])); ?>" class="table-action table-action-delete" data-ajax-popup="true" data-title="<?php echo e(__('Pending Leave Detail')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View')); ?>"><?php echo e(__('View')); ?></a>
                                            </div>
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
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ERP\resources\views/report/leave.blade.php ENDPATH**/ ?>