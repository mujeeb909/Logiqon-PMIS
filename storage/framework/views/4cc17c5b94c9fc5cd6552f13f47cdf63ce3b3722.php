<?php $__env->startSection('page-title'); ?>
    <?php echo e($formBuilder->name.__("'s Form Field")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('form_builder.index')); ?>"><?php echo e(__('Form Builder')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Add Field')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create form field')): ?>
        <div class="float-end">
            <a href="#" data-size="md" data-url="<?php echo e(route('form.field.create',$formBuilder->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Filed')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th class="text-end" width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($formBuilder->form_field->count()): ?>
                                <?php $__currentLoopData = $formBuilder->form_field; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($field->name); ?></td>
                                        <td><?php echo e(ucfirst($field->type)); ?></td>
                                        <td class="text-end">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit form builder')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('form.field.edit',[$formBuilder->id,$field->id])); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Form Builder Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete form builder')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['form.field.destroy', [$formBuilder->id,$field->id]]]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/form_builder/show.blade.php ENDPATH**/ ?>