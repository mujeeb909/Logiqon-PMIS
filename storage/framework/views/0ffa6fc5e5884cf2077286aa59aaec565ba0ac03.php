<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Warehouse')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Warehouse')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <a href="#" data-size="lg" data-url="<?php echo e(route('warehouse.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Warehouse')); ?>"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
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
                                <th><?php echo e(__('Address')); ?></th>
                                <th><?php echo e(__('City')); ?></th>
                                <th><?php echo e(__('Zip Code')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($warehouse->name); ?></td>
                                    <td><?php echo e($warehouse->address); ?></td>
                                    <td><?php echo e($warehouse->city); ?></td>
                                    <td><?php echo e($warehouse->city_zip); ?></td>

                                    <?php if(Gate::check('show warehouse') || Gate::check('edit warehouse') || Gate::check('delete warehouse')): ?>
                                        <td class="Action">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show warehouse')): ?>
                                                <div class="action-btn bg-warning ms-2">

                                                    <a href="<?php echo e(route('warehouse.show',$warehouse->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                       data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>"><i class="ti ti-eye text-white"></i></a>

                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit warehouse')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('warehouse.edit',$warehouse->id)); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Edit Warehouse')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete warehouse')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['warehouse.destroy', $warehouse->id],'id'=>'delete-form-'.$warehouse->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/warehouse/index.blade.php ENDPATH**/ ?>