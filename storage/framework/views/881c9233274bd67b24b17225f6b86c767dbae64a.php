<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Loan Option')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Loan Option')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create loan option')): ?>
            <a href="#" data-url="<?php echo e(route('loanoption.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Loan Option')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>

        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.hrm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Loan Option')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $loanoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loanoption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loanoption->name); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit loan option')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(URL::to('loanoption/'.$loanoption->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Loan Option')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete loan option')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['loanoption.destroy', $loanoption->id],'id'=>'delete-form-'.$loanoption->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        <?php endif; ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/loanoption/index.blade.php ENDPATH**/ ?>