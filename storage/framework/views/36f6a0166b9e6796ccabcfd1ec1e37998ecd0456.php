<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Chart of Accounts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Chart of Account')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '#type', function () {
            var type = $(this).val();
            $.ajax({
                url: '<?php echo e(route('charofAccount.subType')); ?>',
                type: 'POST',
                data: {
                    "type": type, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#sub_type').empty();
                    $.each(data, function (key, value) {
                        $('#sub_type').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create chart of account')): ?>
                <a href="#" data-url="<?php echo e(route('chart-of-account.create')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Account')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-plus"></i>
                </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <div class="row">
        <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type=>$accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6><?php echo e($type); ?></h6>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Code')); ?></th>
                                    <th> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Type')); ?></th>
                                    <th> <?php echo e(__('Balance')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                    <th width="10%"> <?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td><?php echo e($account->code); ?></td>
                                        <td><a href="<?php echo e(route('report.ledger')); ?>?account=<?php echo e($account->id); ?>"><?php echo e($account->name); ?></a></td>
                                        <td><?php echo e(!empty($account->subType)?$account->subType->name:'-'); ?></td>
                                        <td>
                                            <?php if(!empty($account->balance()) && $account->balance()['netAmount']<0): ?>
                                                <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($account->balance()['netAmount']))); ?>

                                            <?php elseif(!empty($account->balance()) && $account->balance()['netAmount']>0): ?>
                                                <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($account->balance()['netAmount'])); ?>

                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($account->is_enabled==1): ?>
                                                <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__('Enabled')); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__('Disabled')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="Action">
                                            <div class="action-btn bg-info ms-2">
                                                <a href="<?php echo e(route('report.ledger')); ?>?account=<?php echo e($account->id); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('Ledger Summary')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit chart of account')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('chart-of-account.edit',$account->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Account')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete chart of account')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['chart-of-account.destroy', $account->id],'id'=>'delete-form-'.$account->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($account->id); ?>').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/chartOfAccount/index.blade.php ENDPATH**/ ?>