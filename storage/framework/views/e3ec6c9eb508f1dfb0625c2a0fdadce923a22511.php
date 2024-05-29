<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Debit Notes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Debit Note')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '#bill', function () {

            var id = $(this).val();
            var url = "<?php echo e(route('bill.get')); ?>";

            $.ajax({
                url: url,
                type: 'get',
                cache: false,
                data: {
                    'bill_id': id,

                },
                success: function (data) {
                    $('#amount').val(data)
                },

            });

        })
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create debit note')): ?>
            <a href="#" data-url="<?php echo e(route('bill.custom.debit.note')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Debit Note')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                <th> <?php echo e(__('Bill')); ?></th>
                                <th> <?php echo e(__('Vendor')); ?></th>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($bill->debitNote)): ?>
                                    <?php $__currentLoopData = $bill->debitNote; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debitNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="font-style">
                                            <td class="Id">
                                                <a href="<?php echo e(route('bill.show',\Crypt::encrypt($debitNote->bill))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->billNumberFormat($bill->bill_id)); ?>


                                                </a>
                                            </td>
                                            <td><?php echo e((!empty($bill->vender)?$bill->vender->name:'-')); ?></td>
                                            <td><?php echo e(Auth::user()->dateFormat($debitNote->date)); ?></td>
                                            <td><?php echo e(Auth::user()->priceFormat($debitNote->amount)); ?></td>
                                            <td><?php echo e(!empty($debitNote->description)?$debitNote->description:'-'); ?></td>
                                            <td class="Action">
                                                <span>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit debit note')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a data-url="<?php echo e(route('bill.edit.debit.note',[$debitNote->bill,$debitNote->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Debit Note')); ?>" href="#" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit debit note')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => array('bill.delete.debit.note', $debitNote->bill,$debitNote->id),'id'=>'delete-form-'.$debitNote->id]); ?>


                                                            <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($debitNote->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/debitNote/index.blade.php ENDPATH**/ ?>