<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('CRM')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 col-md-12 dashboard-card">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-layout-2"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Lead')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($crm_data['total_leads']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 dashboard-card">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-layout-2"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Deal')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($crm_data['total_deals']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 dashboard-card">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-notebook"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Contract')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($crm_data['total_contracts']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Lead Status')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <?php $__currentLoopData = $crm_data['lead_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-sm-6 mb-5">
                                <div class="align-items-start">
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0"><?php echo e($val['lead_stage']); ?></p>
                                        <h3 class="mb-0 text-primary"><?php echo e($val['lead_percentage']); ?>%</h3>
                                        <div class="progress mb-0">
                                            <div class="progress-bar bg-primary" style="width:<?php echo e($val['lead_percentage']); ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Deal Status')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <?php $__currentLoopData = $crm_data['deal_status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-sm-6 mb-5">
                                <div class="align-items-start">
                                    <div class="ms-2">
                                        <p class="text-muted text-sm mb-0"><?php echo e($val['deal_stage']); ?></p>
                                        <h3 class="mb-0 text-primary"><?php echo e($val['deal_percentage']); ?>%</h3>
                                        <div class="progress mb-0">
                                            <div class="progress-bar bg-primary" style="width:<?php echo e($val['deal_percentage']); ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1 mb-0"><?php echo e(__('Latest Contract')); ?></h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th><?php echo e(__('Subject')); ?></th>
                                <?php if(\Auth::user()->type!='client'): ?>
                                <th><?php echo e(__('Client')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Project')); ?></th>
                                <th><?php echo e(__('Contract Type')); ?></th>
                                <th><?php echo e(__('Contract Value')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $crm_data['latestContract']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('contract.show',$contract->id)); ?>" class="btn btn-outline-primary"><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></a>
                                    </td>
                                    <td><?php echo e($contract->subject); ?></td>
                                    <?php if(\Auth::user()->type!='client'): ?>
                                        <td><?php echo e(!empty($contract->clients)?$contract->clients->name:'-'); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty($contract->projects)?$contract->projects->project_name:'-'); ?></td>
                                    <td><?php echo e(!empty($contract->types)?$contract->types->name:''); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($contract->value)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($contract->start_date )); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($contract->end_date )); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="text-center">
                                            <h6><?php echo e(__('There is no latest contract')); ?></h6>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/dashboard/crm-dashboard.blade.php ENDPATH**/ ?>