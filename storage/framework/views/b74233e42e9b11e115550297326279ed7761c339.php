<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Bank Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Bank Account')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bank account')): ?>
            <a href="#" data-url="<?php echo e(route('bank-account.create')); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Bank Account')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Bank')); ?></th>
                                <th> <?php echo e(__('Account Number')); ?></th>
                                <th> <?php echo e(__('Current Balance')); ?></th>
                                <th> <?php echo e(__('Contact Number')); ?></th>
                                <th> <?php echo e(__('Bank Branch')); ?></th>

                                    <th width="10%"> <?php echo e(__('Action')); ?></th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($account->holder_name); ?></td>
                                    <td><?php echo e($account->bank_name); ?></td>
                                    <td><?php echo e($account->account_number); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($account->opening_balance)); ?></td>
                                    <td><?php echo e($account->contact_number); ?></td>
                                    <td><?php echo e($account->bank_address); ?></td>
                                    <?php if(Gate::check('edit bank account') || Gate::check('delete bank account')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if($account->holder_name!='Cash'): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bank account')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('bank-account.edit',$account->id)); ?>" data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Bank Account')); ?>"data-bs-toggle="tooltip"  data-size="lg"  data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bank account')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['bank-account.destroy', $account->id],'id'=>'delete-form-'.$account->id]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($account->id); ?>').submit();">
                                                                    <i class="ti ti-trash text-white text-white"></i>
                                                                </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    -
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/bankAccount/index.blade.php ENDPATH**/ ?>