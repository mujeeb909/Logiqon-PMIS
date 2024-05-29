<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Assets')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Assets')); ?></li>
<?php $__env->stopSection(); ?>
<?php
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create assets')): ?>
            <a href="#" data-url="<?php echo e(route('account-assets.create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Assets')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Users')); ?></th>
                                <th><?php echo e(__('Purchase Date')); ?></th>
                                <th><?php echo e(__('Supported Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="font-style"><?php echo e($asset->name); ?></td>
                                    <td>
                                        <div class="avatar-group">
                                            <?php $__currentLoopData = $asset->users($asset->employee_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="#" class="avatar rounded-circle avatar-sm avatar-group">
                                                    <img alt="" <?php if(!empty($user->avatar)): ?> src="<?php echo e($profile.'/'.$user->avatar); ?>"
                                                         <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>"
                                                         <?php endif; ?> data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>"
                                                         data-bs-toggle="tooltip" data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" class="">
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                    </td>

                                    <td class="font-style"><?php echo e(\Auth::user()->dateFormat($asset->purchase_date)); ?></td>
                                    <td class="font-style"><?php echo e(\Auth::user()->dateFormat($asset->supported_date)); ?></td>
                                    <td class="font-style"><?php echo e(\Auth::user()->priceFormat($asset->amount)); ?></td>
                                    <td class="font-style"><?php echo e(!empty($asset->description)?$asset->description:'-'); ?></td>
                                    <td class="Action">
                                        <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit assets')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('account-assets.edit',$asset->id)); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Edit Assets')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete assets')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['account-assets.destroy', $asset->id],'id'=>'delete-form-'.$asset->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($asset->id); ?>').submit();">
                                                    <i class="ti ti-trash text-white text-white"></i>
                                                </a>
                                                <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                            </div>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/assets/index.blade.php ENDPATH**/ ?>