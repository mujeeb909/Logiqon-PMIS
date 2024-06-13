<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Support')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 "><?php echo e(__('Support')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Support')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="<?php echo e(route('support.grid')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
        </a>
       <a href="#" data-size="lg" data-url="<?php echo e(route('support.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Support')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-3 col-md-6">
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
                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0"><?php echo e($countTicket); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted"><?php echo e(__('Open')); ?></small>
                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0"><?php echo e($countOpenTicket); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted"><?php echo e(__('On Hold')); ?></small>
                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0"><?php echo e($countonholdTicket); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-cast"></i>
                            </div>
                            <div class="ms-3">
                                <small class="text-muted"><?php echo e(__('Close')); ?></small>
                                <h6 class="m-0"><?php echo e(__('Ticket')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto text-end">
                        <h3 class="m-0"><?php echo e($countCloseTicket); ?></h3>
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
                            <th scope="col"><?php echo e(__('Created By')); ?></th>
                            <th scope="col"><?php echo e(__('Ticket')); ?></th>
                            <th scope="col"><?php echo e(__('Code')); ?></th>
                            <th scope="col"><?php echo e(__('Attachment')); ?></th>
                            <th scope="col"><?php echo e(__('Assign User')); ?></th>
                            <th scope="col"><?php echo e(__('Status')); ?></th>
                            <th scope="col"><?php echo e(__('Created At')); ?></th>
                            <th scope="col" ><?php echo e(__('Action')); ?></th>
                        </tr>
                        </thead>
                        <tbody class="list">
                            <?php
                                $supportpath=\App\Models\Utility::get_file('uploads/supports');
                            ?>
                            <?php $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div>
                                                <div class="avatar-parent-child">
                                                    <img alt="" class="avatar rounded-circle avatar-sm" <?php if(!empty($support->createdBy) && !empty($support->createdBy->avatar) && file_exists('storage/uploads/avatar/'.$support->createdBy->avatar)): ?> src="<?php echo e(asset(Storage::url('uploads/avatar')).'/'.$support->createdBy->avatar); ?>" <?php else: ?>  src="<?php echo e(asset(Storage::url('uploads/avatar')).'/avatar.png'); ?>" <?php endif; ?>>
                                                    <?php if($support->replyUnread()>0): ?>
                                                        <span class="avatar-child avatar-badge bg-success"></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <?php echo e(!empty($support->createdBy)?$support->createdBy->name:''); ?>

                                            </div>
                                        </div>
                                    </td>
                                    <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                                <a href="<?php echo e(route('support.reply',\Crypt::encrypt($support->id))); ?>" class="name h6 mb-0 text-sm"><?php echo e($support->subject); ?></a><br>
                                                <?php if($support->priority == 0): ?>
                                                    <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-primary p-2 px-3 rounded">   <?php echo e(__(\App\Models\Support::$priority[$support->priority])); ?></span>
                                                <?php elseif($support->priority == 1): ?>
                                                    <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-info p-2 px-3 rounded">   <?php echo e(__(\App\Models\Support::$priority[$support->priority])); ?></span>
                                                <?php elseif($support->priority == 2): ?>
                                                    <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-warning p-2 px-3 rounded">   <?php echo e(__(\App\Models\Support::$priority[$support->priority])); ?></span>
                                                <?php elseif($support->priority == 3): ?>
                                                    <span data-toggle="tooltip" data-title="<?php echo e(__('Priority')); ?>" class="text-capitalize badge bg-danger p-2 px-3 rounded">   <?php echo e(__(\App\Models\Support::$priority[$support->priority])); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo e($support->ticket_code); ?></td>
                                    <td>
                                        <?php if(!empty($support->attachment)): ?>
                                            <a  class="action-btn bg-primary ms-2 btn btn-sm align-items-center" href="<?php echo e($supportpath . '/' . $support->attachment); ?>" download="">
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                            <a href="<?php echo e($supportpath . '/' . $support->attachment); ?>"  class="action-btn bg-secondary ms-2 mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" target="_blank"><span class="btn-inner--icon"><i class="ti ti-crosshair text-white" ></i></span></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e(!empty($support->assignUser)?$support->assignUser->name:'-'); ?></td>
                                    <td>
                                        <?php if($support->status == 'Open'): ?>
                                            <span class="status_badge text-capitalize badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Support::$status[$support->status])); ?></span>
                                        <?php elseif($support->status == 'Close'): ?>
                                            <span class="status_badge text-capitalize badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Support::$status[$support->status])); ?></span>
                                        <?php elseif($support->status == 'On Hold'): ?>
                                            <span  class="status_badge text-capitalize badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Support::$status[$support->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->dateFormat($support->created_at)); ?></td>
                                    <td class="Action">
                                    <span>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="<?php echo e(route('support.reply',\Crypt::encrypt($support->id))); ?>" data-title="<?php echo e(__('Support Reply')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Reply')); ?>" data-original-title="<?php echo e(__('Reply')); ?>">
                                                <i class="ti ti-corner-up-left text-white"></i>
                                            </a>
                                        </div>
                                        <?php if(\Auth::user()->type=='company' || \Auth::user()->id==$support->ticket_created): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-size="lg" data-url="<?php echo e(route('support.edit',$support->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Support')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['support.destroy', $support->id],'id'=>'delete-form-'.$support->id]); ?>

                                                    <a href="#!" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" title="<?php echo e(__('Delete')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($support->id); ?>').submit();">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                 <?php echo Form::close(); ?>

                                            </div>

                                        <?php endif; ?>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/support/index.blade.php ENDPATH**/ ?>