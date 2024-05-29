<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Designation')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Designation')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create designation')): ?>
            <a href="#" data-url="<?php echo e(route('designation.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Designation')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Department')); ?></th>
                                <th><?php echo e(__('Designation')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $department = \App\Models\Department::where('id', $designation->department_id)->first();
                                ?>
                                <tr>
                                    <td><?php echo e(!empty($department->name)?$department->name:''); ?></td>
                                    <td><?php echo e($designation->name); ?></td>

                                    <td class="Action">
                                        <span>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit designation')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('designation.edit',$designation->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Designation')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete designation')): ?>
                                                <div class="action-btn bg-danger ms-2">

                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['designation.destroy', $designation->id],'id'=>'delete-form-'.$designation->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($designation->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/designation/index.blade.php ENDPATH**/ ?>