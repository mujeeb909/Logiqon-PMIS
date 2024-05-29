<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Product & Services')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product & Services')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('productservice.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import product CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('productservice.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="lg" data-url="<?php echo e(route('productservice.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Product')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 <?php echo e(isset($_GET['category'])?'show':''); ?>" id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(['route' => ['productservice.index'], 'method' => 'GET', 'id' => 'product_service'])); ?>

                        <div class="d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('category', $category, null, ['class' => 'form-control select','id'=>'choices-multiple', 'required' => 'required'])); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">
                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('product_service').submit(); return false;"
                                   data-bs-toggle="tooltip" title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('productservice.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off "></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                <th><?php echo e(__('Sale Price')); ?></th>
                                <th><?php echo e(__('Purchase Price')); ?></th>
                                <th><?php echo e(__('Tax')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Unit')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $productServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($productService->name); ?></td>
                                    <td><?php echo e($productService->sku); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->sale_price)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($productService->purchase_price )); ?></td>
                                    <td>
                                        <?php if(!empty($productService->tax_id)): ?>
                                            <?php
                                                $taxes=\App\Models\Utility::tax($productService->tax_id);
                                            ?>

                                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class=""><?php echo e($tax->name .' ('.$tax->rate .'%)'); ?></span><br>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(!empty($productService->category)?$productService->category->name:''); ?></td>
                                    <td><?php echo e(!empty($productService->unit())?$productService->unit()->name:''); ?></td>
                                    <?php if($productService->type == 'product'): ?>
                                        <td><?php echo e($productService->quantity); ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                    <?php endif; ?>
                                    <td><?php echo e($productService->type); ?></td>

                                    <?php if(Gate::check('edit product & service') || Gate::check('delete product & service')): ?>
                                        <td class="Action">

                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('productservice.detail',$productService->id)); ?>"
                                                   data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Warehouse Details')); ?>" data-title="<?php echo e(__('Warehouse Details')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit product & service')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="<?php echo e(route('productservice.edit',$productService->id)); ?>" data-ajax-popup="true"  data-size="lg " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"  data-title="<?php echo e(__('Product Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete product & service')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['productservice.destroy', $productService->id],'id'=>'delete-form-'.$productService->id]); ?>

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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/productservice/index.blade.php ENDPATH**/ ?>