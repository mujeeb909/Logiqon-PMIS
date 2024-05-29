<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Job')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Job')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>


    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            document.addEventListener('copy', function (e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>


<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create job')): ?>
            <a href="<?php echo e(route('job.create')); ?>" class="btn btn-sm btn-primary"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Job')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-primary">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($data['total']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-info">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Active')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($data['active']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-cast"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Inactive')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Jobs')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($data['in_active']); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>



    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Title')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Created At')); ?></th>
                                <?php if( Gate::check('edit job') ||Gate::check('delete job') ||Gate::check('show job')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($job->branches)?$job->branches->name:__('All')); ?></td>
                                    <td><?php echo e($job->title); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($job->start_date)); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($job->end_date)); ?></td>
                                    <td>
                                        <?php if($job->status=='active'): ?>
                                            <span class="status_badge badge bg-success p-2 px-3 rounded"><?php echo e(App\Models\Job::$status[$job->status]); ?></span>
                                        <?php else: ?>
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e(App\Models\Job::$status[$job->status]); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($job->created_at)); ?></td>
                                    <?php if( Gate::check('edit job') ||Gate::check('delete job') || Gate::check('show job')): ?>
                                        <td>

                                        <?php if($job->status!='in_active'): ?>








                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="#" id="<?php echo e(route('job.requirement',[$job->code,!empty($job)?$job->createdBy->lang:'en'])); ?>" class="mx-3 btn btn-sm align-items-center"  onclick="copyToClipboard(this)" data-bs-toggle="tooltip" title="<?php echo e(__('Copy')); ?>" data-original-title="<?php echo e(__('Click to copy')); ?>"><i class="ti ti-link text-white"></i></a>
                                                </div>


                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show job')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="<?php echo e(route('job.show',$job->id)); ?>" data-title="<?php echo e(__('Job Detail')); ?>" title="<?php echo e(__('View')); ?>"  class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('View Detail')); ?>">
                                                    <i class="ti ti-eye text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit job')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="<?php echo e(route('job.edit',$job->id)); ?>" data-title="<?php echo e(__('Edit Job')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete job')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['job.destroy', $job->id],'id'=>'delete-form-'.$job->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($job->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/job/index.blade.php ENDPATH**/ ?>