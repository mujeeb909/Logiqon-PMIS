<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('POS Product Barcode')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('POS Product Barcode')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/datatable/buttons.dataTables.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create barcode')): ?>
            <a href="<?php echo e(route('pos.print')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Print Barcode')); ?>">
                <i class="ti ti-scan text-white"></i>
            </a>
            <a data-url="<?php echo e(route('pos.setting')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Barcode Setting')); ?>" title="<?php echo e(__('Barcode Setting')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-settings text-white"></i>
            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable-barcode" >
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Product')); ?></th>
                                    <th><?php echo e(__('SKU')); ?></th>
                                    <th><?php echo e(__('Barcode')); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($productService->name); ?></td>
                                        <td><?php echo e($productService->sku); ?></td>
                                        <td>
                                            <div id="<?php echo e($productService->id); ?>" class="product_barcode product_barcode_hight_de" data-skucode="<?php echo e($productService->sku); ?>"></div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-dark"><p><?php echo e(__('No Data Found')); ?></p></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>

    <script src="<?php echo e(asset('public/js/jquery-barcode.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $(".product_barcode").each(function() {
                var id = $(this).attr("id");
                var sku = $(this).data('skucode');
                generateBarcode(sku, id);
            });
        });
        function generateBarcode(val, id) {

            var value = val;
            var btype = '<?php echo e($barcode['barcodeType']); ?>';
            var renderer = '<?php echo e($barcode['barcodeFormat']); ?>';
            var settings = {
                output: renderer,
                bgColor: '#FFFFFF',
                color: '#000000',
                barWidth: '1',
                barHeight: '50',
                moduleSize: '5',
                posX: '10',
                posY: '20',
                addQuietZone: '1'
            };
            $('#' + id).html("").show().barcode(value, btype, settings);

        }

        setTimeout(myGreeting, 1000);
        function myGreeting() {
            if ($(".datatable-barcode").length > 0) {
                const dataTable =  new simpleDatatables.DataTable(".datatable-barcode");
            }
        }
        // });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/pos/barcode.blade.php ENDPATH**/ ?>