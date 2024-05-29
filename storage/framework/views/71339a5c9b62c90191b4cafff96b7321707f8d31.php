<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Complain')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Complain')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create complaint')): ?>
            <a href="#" data-url="<?php echo e(route('complaint.create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Complaint')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                <th><?php echo e(__('Complaint From')); ?></th>
                                <th><?php echo e(__('Complaint Against')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Complaint Date')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <?php if(Gate::check('edit complaint') || Gate::check('delete complaint')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(!empty( $complaint->complaintFrom($complaint->complaint_from))? $complaint->complaintFrom($complaint->complaint_from)->name:''); ?></td>
                                    <td><?php echo e(!empty($complaint->complaintAgainst($complaint->complaint_against))?$complaint->complaintAgainst($complaint->complaint_against)->name:''); ?></td>
                                    <td><?php echo e($complaint->title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat( $complaint->complaint_date)); ?></td>
                                    <td><?php echo e($complaint->description); ?></td>
                                    <?php if(Gate::check('edit complaint') || Gate::check('delete complaint')): ?>
                                        <td>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit complaint')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(URL::to('complaint/'.$complaint->id.'/edit')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Complaint')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                                </div>
                                           <?php endif; ?>


                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete complaint')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['complaint.destroy', $complaint->id],'id'=>'delete-form-'.$complaint->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($complaint->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/complaint/index.blade.php ENDPATH**/ ?>