<?php
$profile = asset(Storage::url('uploads/avatar/'));
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Vendors')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Vendor')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" class="btn btn-sm btn-primary" data-url="<?php echo e(route('vender.file.import')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"
           title="<?php echo e(__('Import')); ?>">
            <i class="ti ti-file-import"></i>
        </a>

        <a href="<?php echo e(route('vender.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create vender')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('vender.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Vendor')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
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
                                    <th>#</th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Contact')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Balance')); ?></th>
                                    <th><?php echo e(__('Last Login At')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $venders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $Vender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="cust_tr" id="vend_detail">
                                        <td class="Id">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show vender')): ?>
                                                <a href="<?php echo e(route('vender.show', \Crypt::encrypt($Vender['id']))); ?>" class="btn btn-outline-primary">
                                                    <?php echo e(AUth::user()->venderNumberFormat($Vender['vender_id'])); ?>

                                                </a>
                                            <?php else: ?>
                                                <a href="#" class="btn btn-outline-primary"> <?php echo e(AUth::user()->venderNumberFormat($Vender['vender_id'])); ?>

                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($Vender['name']); ?></td>
                                        <td><?php echo e($Vender['contact']); ?></td>
                                        <td><?php echo e($Vender['email']); ?></td>
                                        <td><?php echo e(\Auth::user()->priceFormat($Vender['balance'])); ?></td>
                                        <td>
                                            <?php echo e(!empty($Vender->last_login_at) ? $Vender->last_login_at : '-'); ?>

                                        </td>
                                        <td class="Action">
                                            <span>
                                                <?php if($Vender['is_active'] == 0): ?>
                                                    <i class="fa fa-lock" title="Inactive"></i>
                                                <?php else: ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show vender')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(route('vender.show', \Crypt::encrypt($Vender['id']))); ?>"
                                                                class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip"
                                                                title="<?php echo e(__('View')); ?>">
                                                                <i class="ti ti-eye text-white text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit vender')): ?>
                                                            <div class="action-btn bg-primary ms-2">
                                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-size="lg"
                                                                data-title="<?php echo e(__('Edit Vendor')); ?>"
                                                                    data-url="<?php echo e(route('vender.edit', $Vender['id'])); ?>"
                                                                    data-ajax-popup="true" title="<?php echo e(__('Edit')); ?>"
                                                                    data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete vender')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['vender.destroy', $Vender['id']], 'id' => 'delete-form-' . $Vender['id']]); ?>


                                                            <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                                   data-original-title="<?php echo e(__('Delete')); ?>" title="<?php echo e(__('Delete')); ?>"
                                                                   data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                   data-confirm-yes="document.getElementById('delete-form-<?php echo e($Vender['id']); ?>').submit();">
                                                                <i class="ti ti-trash text-white text-white"></i>
                                                                </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                    <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/vender/index.blade.php ENDPATH**/ ?>