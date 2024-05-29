<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Budget Planner')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Budget Planner')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create budget plan')): ?>
        <div class="float-end">
            <a href="<?php echo e(route('budget.create',0)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('From')); ?></th>
                                
                                <th> <?php echo e(__('Budget Period')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $budgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-style"><?php echo e($budget->name); ?></td>
                                    <td class="font-style"><?php echo e($budget->from); ?></td>
                                    
                                    <td class="font-style"><?php echo e(__(\App\Models\Budget::$period[$budget->period])); ?></td>
                                    <td class="Action">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit budget plan')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                 <a href="<?php echo e(route('budget.edit',Crypt::encrypt($budget->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view budget plan')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="<?php echo e(route('budget.show',\Crypt::encrypt($budget->id))); ?>" class="mx-3 btn btn-sm align-items-center " data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete budget plan')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['budget.destroy', $budget->id],'id'=>'delete-form-'.$budget->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($budget->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/budget/index.blade.php ENDPATH**/ ?>