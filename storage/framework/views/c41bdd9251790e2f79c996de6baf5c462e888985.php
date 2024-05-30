<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.code', function () {
            var type = $(this).val();
            if (type == 'manual') {
                $('#manual').removeClass('d-none');
                $('#manual').addClass('d-block');
                $('#auto').removeClass('d-block');
                $('#auto').addClass('d-none');
            } else {
                $('#auto').removeClass('d-none');
                $('#auto').addClass('d-block');
                $('#manual').removeClass('d-block');
                $('#manual').addClass('d-none');
            }
        });

        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Coupon')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create coupon')): ?>

       <a href="#" data-size="lg" data-url="<?php echo e(route('coupons.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Coupon')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Code')); ?></th>
                                <th> <?php echo e(__('Discount (%)')); ?></th>
                                <th> <?php echo e(__('Limit')); ?></th>
                                <th> <?php echo e(__('Used')); ?></th>
                                <th> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e($coupon->name); ?></td>
                                    <td><?php echo e($coupon->code); ?></td>
                                    <td><?php echo e($coupon->discount); ?></td>
                                    <td><?php echo e($coupon->limit); ?></td>
                                    <td><?php echo e($coupon->used_coupon()); ?></td>
                                    <td class="Action">
                                        <span>
                                        <div class="action-btn bg-info ms-2">
                                        <a href="<?php echo e(route('coupons.show',$coupon->id)); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                        </div>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit coupon')): ?>
                                        <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('coupons.edit',$coupon->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Coupon')); ?>" data-bs-toggle="tooltip"  title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete coupon')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['coupons.destroy', $coupon->id],'id'=>'delete-form-'.$coupon->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($coupon->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/coupon/index.blade.php ENDPATH**/ ?>