<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('POS Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('POS Summary')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/datatable/buttons.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('POS ID')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Customer')); ?></th>
                                    <th><?php echo e(__('Warehouse')); ?></th>
                                    <th><?php echo e(__('Sub Total')); ?></th>
                                    <th><?php echo e(__('Discount')); ?></th>
                                    <th><?php echo e(__('Total')); ?></th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php $__empty_1 = true; $__currentLoopData = $posPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posPayment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>


                                        <td class="Id">
                                            <a href="<?php echo e(route('pos.show',\Crypt::encrypt($posPayment->id))); ?>" class="btn btn-outline-primary">
                                                <?php echo e(AUth::user()->posNumberFormat($posPayment->id)); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e(Auth::user()->dateFormat($posPayment->created_at)); ?></td>
                                        <?php if($posPayment->customer_id == 0): ?>
                                            <td class=""><?php echo e(__('Walk-in Customer')); ?></td>
                                        <?php else: ?>
                                            <td><?php echo e(!empty($posPayment->customer) ? $posPayment->customer->name : ''); ?> </td>
                                        <?php endif; ?>
                                        <td><?php echo e(!empty($posPayment->warehouse) ? $posPayment->warehouse->name : ''); ?> </td>
                                        <td><?php echo e(!empty($posPayment->posPayment)? \Auth::user()->priceFormat ($posPayment->posPayment->amount) :0); ?></td>
                                        <td><?php echo e(!empty($posPayment->posPayment)? \Auth::user()->priceFormat($posPayment->posPayment->discount) :0); ?></td>
                                        <td><?php echo e(!empty($posPayment->posPayment)? \Auth::user()->priceFormat($posPayment->posPayment->discount_amount) :0); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-dark"><p><?php echo e(__('No Data Found')); ?></p></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/pos/report.blade.php ENDPATH**/ ?>