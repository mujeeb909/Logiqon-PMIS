<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Goal Tracking')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Goal Tracking')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <style>
        @import url(<?php echo e(asset('css/font-awesome.css')); ?>);
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/bootstrap-toggle.js')); ?>"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
            $("fieldset[id^='demo'] .stars").click(function () {
                alert($(this).val());
                $(this).attr("checked");
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create goal tracking')): ?>
       <a href="#" data-size="lg" data-url="<?php echo e(route('goaltracking.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Goal Tracking')); ?>" class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Goal Type')); ?></th>
                                <th><?php echo e(__('Subject')); ?></th>
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Target Achievement')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Rating')); ?></th>
                                <th width="20%"><?php echo e(__('Progress')); ?></th>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">

                            <?php $__currentLoopData = $goalTrackings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goalTracking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(!empty($goalTracking->goalType)?$goalTracking->goalType->name:''); ?></td>
                                    <td><?php echo e($goalTracking->subject); ?></td>
                                    <td><?php echo e(!empty($goalTracking->branches)?$goalTracking->branches->name:''); ?></td>
                                    <td><?php echo e($goalTracking->target_achievement); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($goalTracking->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($goalTracking->end_date)); ?></td>
                                    <td>
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($goalTracking->rating < $i): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="text-warning fas fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </td>
                                    <td>
                                        <div class="progress-wrapper">
                                            <span class="progress-percentage"><small class="font-weight-bold"></small><?php echo e($goalTracking->progress); ?>%</span>
                                            <div class="progress progress-xs mt-2 w-100">
                                                <div class="progress-bar bg-<?php echo e(Utility::getProgressColor($goalTracking->progress)); ?>" role="progressbar" aria-valuenow="<?php echo e($goalTracking->progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($goalTracking->progress); ?>%;"></div>
                                            </div>
                                        </div>

                                    </td>
                                    <?php if( Gate::check('edit goal tracking') ||Gate::check('delete goal tracking')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit goal tracking')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="<?php echo e(route('goaltracking.edit',$goalTracking->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Goal Tracking')); ?>" class="mx-3 btn btn-sm align-items-center " data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete goal tracking')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['goaltracking.destroy', $goalTracking->id],'id'=>'delete-form-'.$goalTracking->id]); ?>

                                                   <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($goalTracking->id); ?>').submit();">
                                                   <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                            <?php endif; ?>
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




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/goaltracking/index.blade.php ENDPATH**/ ?>