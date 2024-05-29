<?php
   // $profile=asset(Storage::url('uploads/avatar/'));
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Client')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Client')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md" data-url="<?php echo e(route('clients.create')); ?>" data-ajax-popup="true"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xxl-12">
            <div class="row">
                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header border-0 pb-0">

                                <div class="card-header-right">
                                    <div class="btn-group card-option">
                                        <button type="button" class="btn dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end">





                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit client')): ?>
                                                <a href="#!" data-size="md" data-url="<?php echo e(route('clients.edit',$client->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit User')); ?>">
                                                    <i class="ti ti-pencil"></i>
                                                    <span><?php echo e(__('Edit')); ?></span>
                                                </a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete client')): ?>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $client['id']],'id'=>'delete-form-'.$client['id']]); ?>

                                                <a href="#!"  class="dropdown-item bs-pass-para">
                                                    <i class="ti ti-archive"></i>
                                                    <span> <?php if($client->delete_status!=0): ?><?php echo e(__('Delete')); ?> <?php else: ?> <?php echo e(__('Restore')); ?><?php endif; ?></span>
                                                </a>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>

                                            <a href="#!" data-url="<?php echo e(route('clients.reset',\Crypt::encrypt($client->id))); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                                <i class="ti ti-adjustments"></i>
                                                <span>  <?php echo e(__('Reset Password')); ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body full-card">
                                <div class="img-fluid rounded-circle card-avatar">
                                    <img src="<?php echo e((!empty($client->avatar))? asset(Storage::url("uploads/avatar/".$client->avatar)): asset(Storage::url("uploads/avatar/avatar.png"))); ?>"  class="img-user wid-80 rounded-circle">
                                </div>
                                <h4 class="mt-2 text-primary"><?php echo e($client->name); ?></h4>
                                <p></p>
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="d-grid text-primary">
                                            <?php echo e($client->email); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="align-items-center h6 mt-2" data-bs-toggle="tooltip" title="<?php echo e(__('Last Login')); ?>">
                                    <?php echo e((!empty($client->last_login_at)) ? $client->last_login_at : ''); ?>

                                </div>
                            </div>
                            <div class="card-footer p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mb-0"> <?php if($client->clientDeals): ?>
                                                <?php echo e($client->clientDeals->count()); ?>

                                            <?php endif; ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Deals')); ?></p>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="mb-0"><?php if($client->clientProjects): ?>
                                                <?php echo e($client->clientProjects->count()); ?>

                                            <?php endif; ?></h6>
                                        <p class="text-muted text-sm mb-0"><?php echo e(__('Projects')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/clients/index.blade.php ENDPATH**/ ?>