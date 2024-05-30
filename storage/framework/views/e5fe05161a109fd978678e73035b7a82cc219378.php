<?php
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Project Reports')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo e(__('Project Reports')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('All Project')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/datatable/buttons.dataTables.min.css')); ?>">

<style>
.table.dataTable.no-footer {
    border-bottom: none !important;
}
.display-none {
    display: none !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->type == 'company'): ?>
        <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " >
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['project_report.index'], 'method' => 'GET', 'id' => 'project_report_submit'])); ?>

                            <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 mr-2 mb-0">
                                <div class="btn-box">
                                    <?php echo e(Form::label('users', __('Users'),['class'=>'form-label'])); ?>

                                    <select class="select form-select" name="all_users" id="all_users">
                                        <option value="" class=""><?php echo e(__('All Users')); ?></option>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($user->id); ?>" <?php echo e(isset($_GET['all_users']) && $_GET['all_users']==$user->id?'selected':''); ?>><?php echo e($user->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('status', ['' => 'Select Status'] + $status, isset($_GET['status']) ? $_GET['status'] : '', ['class' => 'form-control select'])); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::date('start_date', isset($_GET['start_date'])?$_GET['start_date']:'', array('class' => 'form-control month-btn'))); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::date('end_date', isset($_GET['end_date'])?$_GET['end_date']:'', array('class' => 'form-control month-btn'))); ?>


                                </div>
                            </div>

                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('project_report_submit').submit(); return false;"
                                   data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('project_report.index')); ?>" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                       data-original-title="<?php echo e(__('Reset')); ?>">
                                        <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                    </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-xl-12 mt-3">
        <div class="card table-card">
            <div class="card-header card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="">
                            <tr>
                                <th><?php echo e(__('Projects')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Projects Members')); ?></th>
                                <th><?php echo e(__('Completion')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
                            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0"><a  class="name mb-0 h6 text-sm"><?php echo e($project->project_name); ?></a></p>
                                        </div>
                                    </td>
                                    <td><?php echo e(Utility::getDateFormated($project->start_date)); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($project->end_date)); ?></td>
                                    <td class="">
                                        <div class="avatar-group" id="project_<?php echo e($project->id); ?>">
                                            <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                                                <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key < 3): ?>
                                                        <a href="#" class="avatar rounded-circle">
                                                            <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>
                                                            title="<?php echo e($user->name); ?>" style="height:36px;width:36px;">
                                                        </a>
                                                    <?php else: ?>
                                                        <?php break; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(count($project->users) > 3): ?>
                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                        <img avatar="+ <?php echo e(count($project->users)-3); ?>" style="height:36px;width:36px;">
                                                    </a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php echo e(__('-')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="">
                                        <h6 class="mb-0 text-success"><?php echo e($project->project_progress()['percentage']); ?></h6>
                                        <div class="progress mb-0"><div class="progress-bar bg-<?php echo e($project->project_progress()['color']); ?>" style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <span class="badge bg-<?php echo e(\App\Models\Project::$status_color[$project->status]); ?> p-2 px-3 rounded status_badge"><?php echo e(__(\App\Models\Project::$project_status[$project->status])); ?></span>
                                    </td>
                                    <td class="">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="<?php echo e(route('project_report.show', $project->id)); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(URL::to('projects/'.$project->id.'/edit')); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Project')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Projects Found.')); ?></h6></th>
                            </tr>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/project_report/index.blade.php ENDPATH**/ ?>