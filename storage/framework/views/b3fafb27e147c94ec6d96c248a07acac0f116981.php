<?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
    <div class="row">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-xxl-3">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="d-flex align-items-center">
                            <img <?php echo e($project->img_image); ?> class="img-fluid wid-30 me-2" alt="">
                            <h5 class="mb-0"><a class="text-dark" href="<?php echo e(route('projects.show',$project)); ?>"><?php echo e($project->project_name); ?></a></h5>
                        </div>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project')): ?>
                                        <a class="dropdown-item" data-ajax-popup="true"
                                           data-size="md" data-title="<?php echo e(__('Duplicate Project')); ?>"
                                           data-url="<?php echo e(route('project.copy', [$project->id])); ?>">
                                            <i class="ti ti-copy"></i> <span><?php echo e(__('Duplicate')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                            <i class="ti ti-pencil"></i>
                                            <span><?php echo e(__('Edit')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project')): ?>
                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.destroy',$project->id]]); ?>

                                        <a href="#!" class="dropdown-item bs-pass-para">
                                            <i class="ti ti-archive"></i>
                                            <span> <?php echo e(__('Delete')); ?></span>
                                        </a>

                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Invite User')); ?>">
                                            <i class="ti ti-send"></i>
                                            <span><?php echo e(__('Invite User')); ?></span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 justify-content-between">
                            <div class="col-auto"><span class="badge rounded-pill bg-<?php echo e(\App\Models\Project::$status_color[$project->status]); ?>"><?php echo e(__(\App\Models\Project::$project_status[$project->status])); ?></span>
                            </div>

                        </div>
                        <p class="text-muted text-sm mt-3"><?php echo e($project->description); ?></p>
                        <small><?php echo e(__('MEMBERS')); ?></small>
                        <div class="user-group">
                            <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                                <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($key < 3): ?>
                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                            <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>  alt="image" data-bs-toggle="tooltip" title="<?php echo e($user->name); ?>">
                                        </a>
                                    <?php else: ?>
                                        <?php break; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="card mb-0 mt-3">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mb-0 <?php echo e((strtotime($project->start_date) < time()) ? 'text-danger' : ''); ?>"><?php echo e(Utility::getDateFormated($project->start_date)); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Start Date')); ?></p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h6 class="mb-0"><?php echo e(Utility::getDateFormated($project->end_date)); ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Due Date')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="col-xl-12 col-lg-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h6 class="text-center mb-0"><?php echo e(__('No Projects Found.')); ?></h6>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/grid.blade.php ENDPATH**/ ?>