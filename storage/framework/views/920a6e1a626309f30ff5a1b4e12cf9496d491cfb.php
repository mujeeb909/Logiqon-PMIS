<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Product Stock')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product Stock')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('productstock.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
           class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        

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
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Product Name')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-style"><?php echo e($stock->created_at->format('d M Y')); ?></td>
                                    <td><?php echo e(!empty($stock->product) ? $stock->product->name : ''); ?>

                                    <td class="font-style"><?php echo e($stock->quantity); ?></td>
                                    <td>
                                        <?php if($stock->type == "manually"): ?>
                                            <span class="status_badge badge bg-secondary p-2 px-3 rounded"><?php echo e(ucfirst($stock->type)); ?></span>
                                        <?php elseif($stock->type == "invoice"): ?>
                                            <span class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e(ucfirst($stock->type)); ?></span>
                                        <?php elseif($stock->type == "bill"): ?>
                                            <span class="status_badge badge bg-primary p-2 px-3 rounded"><?php echo e(ucfirst($stock->type)); ?></span>
                                        <?php elseif($stock->type == "purchase"): ?>
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e(ucfirst($stock->type)); ?></span>
                                        <?php elseif($stock->type == "pos"): ?>
                                            <span class="status_badge badge bg-info p-2 px-3 rounded"><?php echo e(ucfirst($stock->type)); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="font-style"><?php echo e($stock->description); ?></td>

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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/report/product_stock_report.blade.php ENDPATH**/ ?>