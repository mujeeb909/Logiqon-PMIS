<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Purchase')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Purchase')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>

        $('.copy_link').click(function (e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">






        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create purchase')): ?>
            <a href="<?php echo e(route('purchase.create',0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
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
                                <th> <?php echo e(__('Purchase')); ?></th>
                                <th> <?php echo e(__('Vendor')); ?></th>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Purchase Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase')): ?>
                                    <th > <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>


                            <?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="Id">
                                        <a href="<?php echo e(route('purchase.show',\Crypt::encrypt($purchase->id))); ?>" class="btn btn-outline-primary"><?php echo e(Auth::user()->purchaseNumberFormat($purchase->purchase_id)); ?></a>

                                    </td>

                                    <td> <?php echo e((!empty( $purchase->vender)?$purchase->vender->name:'')); ?> </td>

                                    <td><?php echo e(!empty($purchase->category)?$purchase->category->name:''); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($purchase->purchase_date)); ?></td>

                                    <td>
                                        <?php if($purchase->status == 0): ?>
                                            <span class="purchase_status badge bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Purchase::$statues[$purchase->status])); ?></span>
                                        <?php elseif($purchase->status == 1): ?>
                                            <span class="purchase_status badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Purchase::$statues[$purchase->status])); ?></span>
                                        <?php elseif($purchase->status == 2): ?>
                                            <span class="purchase_status badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Purchase::$statues[$purchase->status])); ?></span>
                                        <?php elseif($purchase->status == 3): ?>
                                            <span class="purchase_status badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Purchase::$statues[$purchase->status])); ?></span>
                                        <?php elseif($purchase->status == 4): ?>
                                            <span class="purchase_status badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Purchase::$statues[$purchase->status])); ?></span>
                                        <?php endif; ?>
                                    </td>



                                    <?php if(Gate::check('edit purchase') || Gate::check('delete purchase') || Gate::check('show purchase')): ?>
                                        <td class="Action">
                                            <span>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show purchase')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('purchase.show',\Crypt::encrypt($purchase->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                                <i class="ti ti-eye text-white"></i>
                                                            </a>
                                                        </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit purchase')): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="<?php echo e(route('purchase.edit',\Crypt::encrypt($purchase->id))); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit" data-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete purchase')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['purchase.destroy', $purchase->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$purchase->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($purchase->id); ?>').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </span>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/purchase/index.blade.php ENDPATH**/ ?>