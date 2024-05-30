<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bug Report')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Project')); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Bug Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <?php if($view == 'grid'): ?>
            <a href="<?php echo e(route('bugs.view', 'list')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>">
                <span class="btn-inner--text"><i class="ti ti-list"></i></span>
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('bugs.view', 'grid')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="<?php echo e(__('Card View')); ?>">
                <span class="btn-inner--text"><i class="ti ti-table"></i></span>
            </a>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>

            <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="<?php echo e(__('Back')); ?>">
                <span class="btn-inner--icon"><i class="ti ti-arrow-left"></i></span>
            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">

                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead>
                            <tr>
                                <th scope="col"><?php echo e(__('Name')); ?></th>
                                <th scope="col"><?php echo e(__('Bug Status')); ?></th>
                                <th scope="col"><?php echo e(__('Priority')); ?></th>
                                <th scope="col"><?php echo e(__('End Date')); ?></th>
                                <th scope="col"><?php echo e(__('created By')); ?></th>
                                <th scope="col"><?php echo e(__('Assigned To')); ?></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <?php if(count($bugs) > 0): ?>
                                <?php $__currentLoopData = $bugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <span class="h6 text-sm font-weight-bold mb-0"><a href="<?php echo e(route('task.bug',$bug->project_id)); ?>"><?php echo e($bug->title); ?></a></span>
                                            <span class="d-flex text-sm text-muted justify-content-between">
                                    <p class="m-0"><?php echo e(!empty($bug->project)?$bug->project->project_name:''); ?></p>
                                    <span class="me-5 badge p-2 px-3 rounded bg-<?php echo e((\Auth::user()->checkProject($bug->project_id) == 'Owner') ? 'success' : 'warning'); ?>"><?php echo e(__(\Auth::user()->checkProject($bug->project_id))); ?></span>
                                </span>
                                        </td>
                                        <td><?php echo e($bug->bug_status->title); ?></td>
                                        <td>
                                            <span class="status_badge badge p-2 px-3 rounded bg-<?php echo e(__(\App\Models\ProjectTask::$priority_color[$bug->priority])); ?>"><?php echo e(__(\App\Models\ProjectTask::$priority[$bug->priority])); ?></span>
                                        </td>
                                        <td class="<?php echo e((strtotime($bug->due_date) < time()) ? 'text-danger' : ''); ?>"><?php echo e(Utility::getDateFormated($bug->due_date)); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php echo e($bug->createdBy->name); ?>

                                            </div>
                                        </td>
                                        <td>
                                            <div class="avatar-group">
                                                <?php if($bug->users()->count() > 0): ?>
                                                    <?php $user = $bug->users(); ?>

                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                        <img data-original-title="<?php echo e((!empty($user[0])?$user[0]->name:'')); ?>" <?php if($user[0]->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user[0]->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> title="<?php echo e($user[0]->name); ?>" class="hweb">
                                                    </a>
                                                    <?php if($users = $bug->users()): ?>
                                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($key<3): ?>

                                                            <?php else: ?>
                                                                <?php break; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                    <?php if(count($users) > 3): ?>
                                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                                            <img  src="<?php echo e($user->getImgImageAttribute()); ?>">
                                                        </a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <?php echo e(__('-')); ?>

                                                <?php endif; ?>
                                            </div>
                                        </td>

                                        <td class="text-end w-15">
                                            <div class="actions">
                                                <a class="action-item px-1" data-bs-toggle="tooltip" title="<?php echo e(__('Attachment')); ?>" data-original-title="<?php echo e(__('Attachment')); ?>">
                                                    <i class="ti ti-paperclip mr-2"></i><?php echo e(count($bug->bugFiles)); ?>

                                                </a>
                                                <a class="action-item px-1" data-bs-toggle="tooltip" title="<?php echo e(__('Comment')); ?>" data-original-title="<?php echo e(__('Comment')); ?>">
                                                    <i class="ti ti-brand-hipchat mr-2"></i><?php echo e(count($bug->comments)); ?>

                                                </a>
                                                <a class="action-item px-1" data-toggle="tooltip" data-original-title="<?php echo e(__('Checklist')); ?>">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No tasks found')); ?></h6></th>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/allBugListView.blade.php ENDPATH**/ ?>