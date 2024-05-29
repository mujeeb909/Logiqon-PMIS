<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Goals')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Goal')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
<div class="float-end">
     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create goal')): ?>
            <a href="#" data-url="<?php echo e(route('goal.create')); ?>" data-bs-toggle="tooltip" data-size="lg" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Goal')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style
">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Type')); ?></th>
                                <th> <?php echo e(__('From')); ?></th>
                                <th> <?php echo e(__('To')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Is Dashboard Display')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $golas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gola): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-style"><?php echo e($gola->name); ?></td>
                                    <td class="font-style"> <?php echo e(__(\App\Models\Goal::$goalType[$gola->type])); ?> </td>
                                    <td class="font-style"><?php echo e($gola->from); ?></td>
                                    <td class="font-style"><?php echo e($gola->to); ?></td>
                                    <td class="font-style"><?php echo e(\Auth::user()->priceFormat($gola->amount)); ?></td>
                                    <td class="font-style"><?php echo e($gola->is_display==1 ? __('Yes') :__('No')); ?></td>
                                    <td class="Action">
                                        <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit goal')): ?>
                                        <div class="action-btn bg-primary ms-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('goal.edit',$gola->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Goal')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete goal')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['goal.destroy', $gola->id],'id'=>'delete-form-'.$gola->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($gola->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/goal/index.blade.php ENDPATH**/ ?>