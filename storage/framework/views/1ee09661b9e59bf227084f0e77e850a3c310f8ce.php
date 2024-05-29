<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Award')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Award')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create award')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="<?php echo e(route('award.create')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Create New Award')); ?>">
                <i class="fa fa-plus"></i> <?php echo e(__('Create')); ?>

            </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create award')): ?>
        <a href="#" data-size="lg" data-url="<?php echo e(route('award.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Award')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
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
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Award Type')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Gift')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit award') || Gate::check('delete award')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>

                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                    <td><?php echo e(!empty( $award->employee())? $award->employee()->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($award->awardType())?$award->awardType()->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($award->date )); ?></td>
                                    <td><?php echo e($award->gift); ?></td>
                                    <td><?php echo e($award->description); ?></td>

                                    <?php if(Gate::check('edit award') || Gate::check('delete award')): ?>
                                        <td class="Action">
                                            <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit award')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="<?php echo e(URL::to('award/'.$award->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Award')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                    <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete award')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['award.destroy', $award->id],'id'=>'delete-form-'.$award->id]); ?>

                                                 <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($award->id); ?>').submit();">
                                                     <i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/award/index.blade.php ENDPATH**/ ?>