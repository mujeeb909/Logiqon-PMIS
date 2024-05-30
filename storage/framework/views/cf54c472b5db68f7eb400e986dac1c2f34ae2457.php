<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Labels')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Labels')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create label')): ?>
        <div class="float-end">
            <a href="#" data-size="md" data-url="<?php echo e(route('labels.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Labels')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.crm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            <div class="row justify-content-center">

                <div class="p-3 card">
                    <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                        <?php ($i=0); ?>
                        <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($i==0): ?> active <?php endif; ?>" id="pills-user-tab-1" data-bs-toggle="pill"
                                        data-bs-target="#tab<?php echo e($key); ?>" type="button"><?php echo e($pipeline['name']); ?>

                                </button>
                            </li>
                            <?php ($i++); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <?php ($i=0); ?>
                            <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade show <?php if($i==0): ?> active <?php endif; ?>" id="tab<?php echo e($key); ?>" role="tabpanel" aria-labelledby="pills-user-tab-1">
                                    <ul class="list-group sortable">
                                        <?php $__currentLoopData = $pipeline['labels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item" data-id="<?php echo e($label->id); ?>">
                                                <span class="text-sm text-dark"><?php echo e($label->name); ?></span>
                                                <span class="float-end">

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit label')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(URL::to('labels/'.$label->id.'/edit')); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Labels')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(count($pipeline['labels'])): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete label')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['labels.destroy', $label->id]]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                            </span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php ($i++); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/labels/index.blade.php ENDPATH**/ ?>