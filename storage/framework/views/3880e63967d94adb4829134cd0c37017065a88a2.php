<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Resignation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Resignation')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create resignation')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('resignation.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Resignation')); ?>" class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Employee Name')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Resignation Date')); ?></th>
                                <th><?php echo e(__('Last Working Date')); ?></th>
                                <th><?php echo e(__('Reason')); ?></th>
                                <?php if(Gate::check('edit resignation') || Gate::check('delete resignation')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $resignations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resignation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                    <td><?php echo e(!empty($resignation->employee())?$resignation->employee()->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Auth::user()->dateFormat($resignation->notice_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($resignation->resignation_date)); ?></td>
                                    <td><?php echo e($resignation->description); ?></td>
                                    <?php if(Gate::check('edit resignation') || Gate::check('delete resignation')): ?>
                                        <td>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit resignation')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-size="lg" data-url="<?php echo e(URL::to('resignation/'.$resignation->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Resignation')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>


                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete resignation')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['resignation.destroy', $resignation->id],'id'=>'delete-form-'.$resignation->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($resignation->id); ?>').submit();">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/resignation/index.blade.php ENDPATH**/ ?>