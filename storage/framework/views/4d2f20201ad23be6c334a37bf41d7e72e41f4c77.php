<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Proposals')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Proposal')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <a href="<?php echo e(route('proposal.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create proposal')): ?>
            <a href="<?php echo e(route('proposal.create',0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">

                            <?php echo e(Form::open(array('route' => array('proposal.index'),'method' => 'GET','id'=>'frm_submit'))); ?>




                        <div class="d-flex align-items-center justify-content-end">








                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 me-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('issue_date', __('Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:null, array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1'))); ?>

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                                <div class="btn-box">
                                    <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('status', [ ''=>'Select Status'] + $status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select'))); ?>

                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">

                                <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('frm_submit').submit(); return false;" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>
                                <a href="<?php echo e(route('productservice.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                   title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white "></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

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
                                <th> <?php echo e(__('Proposal')); ?></th>



                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Issue Date')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                    <th width="10%"> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td class="Id">
                                        <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->proposalNumberFormat($proposal->proposal_id)); ?>

                                        </a>
                                    </td>

                                    <td><?php echo e(!empty($proposal->category)?$proposal->category->name:''); ?></td>
                                    <td><?php echo e(Auth::user()->dateFormat($proposal->issue_date)); ?></td>
                                    <td>
                                        <?php if($proposal->status == 0): ?>
                                            <span class="status_badge badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 1): ?>
                                            <span class="status_badge badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 2): ?>
                                            <span class="status_badge badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 3): ?>
                                            <span class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php elseif($proposal->status == 4): ?>
                                            <span class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Proposal::$statues[$proposal->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit proposal') || Gate::check('delete proposal') || Gate::check('show proposal')): ?>
                                        <td class="Action">
                                            <?php if($proposal->is_convert==0): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert invoice')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <?php echo Form::open(['method' => 'get', 'route' => ['proposal.convert', $proposal->id],'id'=>'proposal-form-'.$proposal->id]); ?>


                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip"
                                                           title="<?php echo e(__('Convert Invoice')); ?>" data-original-title="<?php echo e(__('Convert to Invoice')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm convert to invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('proposal-form-<?php echo e($proposal->id); ?>').submit();">
                                                            <i class="ti ti-exchange text-white"></i>
                                                            <?php echo Form::close(); ?>

                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('invoice.show',\Crypt::encrypt($proposal->converted_invoice_id))); ?>"
                                                           class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Already convert to Invoice')); ?>" data-original-title="<?php echo e(__('Already convert to Invoice')); ?>" >
                                                            <i class="ti ti-file text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate proposal')): ?>
                                                <div class="action-btn bg-success ms-2">
                                                    <?php echo Form::open(['method' => 'get', 'route' => ['proposal.duplicate', $proposal->id],'id'=>'duplicate-form-'.$proposal->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Duplicate')); ?>" data-original-title="<?php echo e(__('Duplicate')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm duplicate this invoice. Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($proposal->id); ?>').submit();">
                                                        <i class="ti ti-copy text-white text-white"></i>
                                                        <?php echo Form::close(); ?>

                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show proposal')): ?>

                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('proposal.show',\Crypt::encrypt($proposal->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Show')); ?>" data-original-title="<?php echo e(__('Detail')); ?>">
                                                            <i class="ti ti-eye text-white text-white"></i>
                                                        </a>
                                                    </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit proposal')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="<?php echo e(route('proposal.edit',\Crypt::encrypt($proposal->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete proposal')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['proposal.destroy', $proposal->id],'id'=>'delete-form-'.$proposal->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($proposal->id); ?>').submit();">
                                                        <i class="ti ti-trash text-white text-white"></i>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/proposal/index.blade.php ENDPATH**/ ?>