<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Warehouse Stock Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Warehouse Stock Details')); ?></li>
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
                                <th><?php echo e(__('Product')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $warehouse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <?php if(!empty($warehouses->product())): ?>
                                        <td><?php echo e(!empty($warehouses->product())? $warehouses->product()->name:''); ?></td>
                                        <td><?php echo e($warehouses->quantity); ?></td>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/warehouse/show.blade.php ENDPATH**/ ?>