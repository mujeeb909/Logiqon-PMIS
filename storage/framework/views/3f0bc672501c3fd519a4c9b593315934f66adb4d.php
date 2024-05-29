<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        (function () {
            var options = {
                chart: {
                    height: 180,
                    type: 'area',
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                series: [{
                    name: 'Refferal',
                    data:<?php echo json_encode(array_values($home_data['task_overview'])); ?>

                },],
                xaxis: {
                    categories:<?php echo json_encode(array_keys($home_data['task_overview'])); ?>,
                },
                colors: ['#3ec9d6'],
                fill: {
                    type: 'solid',
                },
                grid: {
                    strokeDashArray: 4,
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'right',
                },
                // markers: {
                //     size: 4,
                //     colors: ['#3ec9d6', '#FF3A6E',],
                //     opacity: 0.9,
                //     strokeWidth: 2,
                //     hover: {
                //         size: 7,
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#task_overview"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    height: 300,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 10,
                        dataLabels: {
                            position: 'top',
                        },
                    }
                },
                colors: ["#3ec9d6"],
                dataLabels: {
                    enabled: true,
                    offsetX: -6,
                    style: {
                        fontSize: '12px',
                        colors: ['#fff']
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                },
                grid: {
                    strokeDashArray: 4,
                },
                series: [{
                    data: <?php echo json_encode(array_values($home_data['timesheet_logged'])); ?>

                }],
                xaxis: {
                    categories: <?php echo json_encode(array_keys($home_data['timesheet_logged'])); ?>,
                },
            };
            var chart = new ApexCharts(document.querySelector("#timesheet_logged"), options);
            chart.render();
        })();

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Project')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Projects')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($home_data['total_project']['total']); ?></h4>
                            <small class="text-muted"><span class="text-success"><?php echo e($home_data['total_project']['percentage']); ?>%</span> <?php echo e(__('completd')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-activity"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Tasks')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($home_data['total_task']['total']); ?></h4>
                            <small class="text-muted"><span class="text-success"><?php echo e($home_data['total_task']['percentage']); ?>%</span> <?php echo e(__('completd')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Expense')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($home_data['total_expense']['total']); ?></h4>
                            <small class="text-muted"><span class="text-success"><?php echo e($home_data['total_expense']['percentage']); ?>%</span> <?php echo e(__('expense')); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    <h5><?php echo e(__('Project Status')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <?php $__currentLoopData = $home_data['project_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-sm-6 mb-5">
                                <div class="align-items-start">

                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0"><?php echo e(__(\App\Models\Project::$project_status[$status])); ?></p>
                                        <h3 class="mb-0 text-<?php echo e(\App\Models\Project::$status_color[$status]); ?>"><?php echo e($val['total']); ?>%</h3>
                                        <div class="progress mb-0">
                                            <div class="progress-bar bg-<?php echo e(\App\Models\Project::$status_color[$status]); ?>" style="width: <?php echo e($val['percentage']); ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Tasks Overview')); ?> <span class="float-end"> <small class="text-muted"><?php echo e(__('Total Completed task in last 7 days')); ?></small></span></h5>

                </div>
                <div class="card-body">
                    <div id="task_overview"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Top Due Projects')); ?></h5>
                </div>
                <div class="card-body project_table">
                    <div class="table-responsive ">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th ><?php echo e(__('Status')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($home_data['due_project']->count() > 0): ?>
                                <?php $__currentLoopData = $home_data['due_project']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $due_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo e(asset(Storage::url('/'.$due_project->project_image ))); ?>"
                                                     class="wid-40 rounded-circle me-3" >
                                                <div>
                                                    <h6 class="mb-0"><?php echo e($due_project->project_name); ?></h6>
                                                    <p class="mb-0"><span class="text-success"><?php echo e(\Auth::user()->priceFormat($due_project->budget)); ?></p>

                                                </div>
                                            </div>
                                        </td>
                                        <td ><?php echo e(Utility::getDateFormated($due_project->end_date)); ?></td>
                                        <td class="text-end">
                                            <span class=" status_badge p-2 px-3 rounded badge bg-<?php echo e(\App\Models\Project::$status_color[$due_project->status]); ?>"><?php echo e(__(\App\Models\Project::$project_status[$due_project->status])); ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr class="py-5">
                                    <td class="text-center mb-0" colspan="3"><?php echo e(__('No Due Projects Found.')); ?></td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Timesheet Logged Hours')); ?> <span>  <small class="float-end text-muted flo"><?php echo e(__('Last 7 days')); ?></small></span></h5>
                </div>
                <div class="card-body project_table">
                    <div id="timesheet_logged"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Top Due Tasks')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <?php $__currentLoopData = $home_data['due_tasks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $due_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <small class="text-muted"><?php echo e(__('Task')); ?>:</small>
                                                <h6 class="m-0"><a href="<?php echo e(route('projects.tasks.index',$due_task->project->id)); ?>" class="name mb-0 h6 text-sm"><?php echo e($due_task->name); ?></a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?php echo e(__('Project')); ?>:</small>
                                        <h6 class="m-0 h6 text-sm"><?php echo e($due_task->project->project_name); ?></h6>
                                    </td>
                                    <td>

                                        <small class="text-muted"><?php echo e(__('Stage')); ?>:</small>
                                        <div class="d-flex align-items-center h6 text-sm mt-2">
                                            <span class="full-circle bg-<?php echo e(\App\Models\ProjectTask::$priority_color[$due_task->priority]); ?>"></span>
                                            <span class="ms-1"><?php echo e(\App\Models\ProjectTask::$priority[$due_task->priority]); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted"><?php echo e(__('Completion')); ?>:</small>
                                        <h6 class="m-0 h6 text-sm"><?php echo e($due_task->taskProgress()['percentage']); ?></h6>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/dashboard/project-dashboard.blade.php ENDPATH**/ ?>