<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Training')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Training')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create training')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('training.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Training')); ?>" class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Training Type')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Employee')); ?></th>
                                <th><?php echo e(__('Trainer')); ?></th>
                                <th><?php echo e(__('Training Duration')); ?></th>
                                <th><?php echo e(__('Cost')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($training->branches)?$training->branches->name:''); ?></td>
                                    <td><?php echo e(!empty($training->types)?$training->types->name:''); ?>

                                    </td>
                                    <td>
                                        <?php if($training->status == 0): ?>
                                            <span class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 1): ?>
                                            <span class="status_badge badge bg-primary p-2 px-3 rounded"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 2): ?>
                                            <span class="status_badge badge bg-success p-2 px-3 rounded"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 3): ?>
                                            <span class="status_badge badge bg-info p-2 px-3 rounded"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(!empty($training->employees)?$training->employees->name:''); ?> </td>
                                    <td><?php echo e(!empty($training->trainers)?$training->trainers->firstname:''); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($training->start_date) .' to '.\Auth::user()->dateFormat($training->end_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($training->training_cost)); ?></td>
                                    <?php if( Gate::check('edit training') ||Gate::check('delete training') || Gate::check('show training')): ?>
                                        <td>


                                            <div class="action-btn bg-info ms-2">
                                                <a href="<?php echo e(route('training.show',\Illuminate\Support\Facades\Crypt::encrypt($training->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View Detail')); ?>">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>

                                            </div>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit training')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="<?php echo e(route('training.edit',$training->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Training')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit ')); ?>" class="mx-3 btn btn-sm  align-items-center">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete training')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['training.destroy', $training->id],'id'=>'delete-form-'.$training->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($training->id); ?>').submit();" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash text-white"></i></a>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/training/index.blade.php ENDPATH**/ ?>