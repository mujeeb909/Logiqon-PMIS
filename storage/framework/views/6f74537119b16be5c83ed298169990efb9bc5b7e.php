<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product Stock')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product Stock')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
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
                                <th><?php echo e(__('Sku')); ?></th>
                                <th><?php echo e(__('Current Quantity')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($productService->name); ?></td>
                                    <td><?php echo e($productService->sku); ?></td>
                                    <td><?php echo e($productService->quantity); ?></td>

                                    <td class="Action">
                                        <div class="action-btn bg-info ms-2">
                                            <a data-size="md" href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('productstock.edit', $productService->id)); ?>" data-ajax-popup="true"  data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Update Quantity')); ?>">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                        </div>


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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/productstock/index.blade.php ENDPATH**/ ?>