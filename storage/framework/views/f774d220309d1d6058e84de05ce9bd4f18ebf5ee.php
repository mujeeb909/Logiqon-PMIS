<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Tax Rate')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Taxes')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create constant tax')): ?>
            <a href="#" data-url="<?php echo e(route('taxes.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Tax Rate')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.account_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Tax Name')); ?></th>
                                <th> <?php echo e(__('Rate %')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($taxe->name); ?></td>
                                    <td><?php echo e($taxe->rate); ?></td>
                                    <td class="Action">
                                        <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit constant tax')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('taxes.edit',$taxe->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Tax Rate')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete constant tax')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['taxes.destroy', $taxe->id],'id'=>'delete-form-'.$taxe->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($taxe->id); ?>').submit();">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/taxes/index.blade.php ENDPATH**/ ?>