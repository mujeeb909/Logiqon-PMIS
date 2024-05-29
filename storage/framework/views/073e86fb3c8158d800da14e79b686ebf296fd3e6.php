<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Role')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Role')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="lg" data-url="<?php echo e(route('roles.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Role')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
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
                                <th><?php echo e(__('Role')); ?> </th>
                                <th><?php echo e(__('Permissions')); ?> </th>
                                <th width="150"><?php echo e(__('Action')); ?> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($role->name != 'client'): ?>
                                    <tr class="font-style">
                                        <td class="Role"><?php echo e($role->name); ?></td>
                                        <td class="Permission">
                                            <?php for($j=0;$j<count($role->permissions()->pluck('name'));$j++): ?>
                                                <span class="badge rounded-pill bg-primary"><?php echo e($role->permissions()->pluck('name')[$j]); ?></span>
                                            <?php endfor; ?>
                                        </td>
                                        <td class="Action">
                                        <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit role')): ?>
                                                <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(route('roles.edit',$role->id)); ?>" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Role Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <?php endif; ?>

                                            <?php if($role->name != 'Employee'): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete role')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" ><i class="ti ti-trash text-white"></i></a>
                                                        <?php echo Form::close(); ?>

                                                     </div>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                        </span>
                                        </td>
                                    </tr>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/role/index.blade.php ENDPATH**/ ?>