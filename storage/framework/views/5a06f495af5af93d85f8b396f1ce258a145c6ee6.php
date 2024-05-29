<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Journal Entry')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Journal Entry')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create journal entry')): ?>
            <a href="<?php echo e(route('journal-entry.create')); ?>" data-title="<?php echo e(__('Create New Journal')); ?>" data-bs-toggle="tooltip"  title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
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
                                <th> <?php echo e(__('Journal ID')); ?></th>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $journalEntries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $journalEntry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <a href="<?php echo e(route('journal-entry.show',$journalEntry->id)); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->journalNumberFormat($journalEntry->journal_id)); ?></a>
                                    </td>
                                    <td><?php echo e(Auth::user()->dateFormat($journalEntry->date)); ?></td>
                                    <td>
                                        <?php echo e(\Auth::user()->priceFormat($journalEntry->totalCredit())); ?>

                                    </td>
                                    <td><?php echo e(!empty($journalEntry->description)?$journalEntry->description:'-'); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit journal entry')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a data-title="<?php echo e(__('Edit Journal')); ?>" href="<?php echo e(route('journal-entry.edit',[$journalEntry->id])); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete journal entry')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => array('journal-entry.destroy', $journalEntry->id),'id'=>'delete-form-'.$journalEntry->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($journalEntry->id); ?>').submit();">
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
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/journalEntry/index.blade.php ENDPATH**/ ?>