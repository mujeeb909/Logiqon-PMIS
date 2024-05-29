<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Revenues')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Revenue')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create revenue')): ?>
            <a href="#" data-url="<?php echo e(route('revenue.create')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Create New Revenue')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('revenue.index'),'method' => 'GET','id'=>'revenue_form'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-3">
                                        <?php echo e(Form::label('date',__('Date'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::text('date', isset($_GET['date'])?$_GET['date']:null, array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1','readonly'))); ?>


                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 month">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account',$account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('customer', __('Customer'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('customer',$customer,isset($_GET['customer'])?$_GET['customer']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">

                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('revenue_form').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="<?php echo e(route('revenue.index')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style mt-2">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Account')); ?></th>
                                <th> <?php echo e(__('Customer')); ?></th>
                                <th> <?php echo e(__('Category')); ?></th>
                                <th> <?php echo e(__('Reference')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Payment Receipt')); ?></th>

                                <?php if(Gate::check('edit revenue') || Gate::check('delete revenue')): ?>
                                    <th width="10%"> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $revenuepath=\App\Models\Utility::get_file('uploads/revenue');
                            ?>
                            <?php $__currentLoopData = $revenues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="font-style">
                                    <td><?php echo e(Auth::user()->dateFormat($revenue->date)); ?></td>
                                    <td><?php echo e(Auth::user()->priceFormat($revenue->amount)); ?></td>
                                    <td><?php echo e(!empty($revenue->bankAccount)?$revenue->bankAccount->bank_name.' '.$revenue->bankAccount->holder_name:''); ?></td>
                                    <td><?php echo e((!empty($revenue->customer)?$revenue->customer->name:'-')); ?></td>
                                    <td><?php echo e(!empty($revenue->category)?$revenue->category->name:'-'); ?></td>
                                    <td><?php echo e(!empty($revenue->reference)?$revenue->reference:'-'); ?></td>
                                    <td><?php echo e(!empty($revenue->description)?$revenue->description:'-'); ?></td>

                                    <td>












                                        <?php if(!empty($revenue->add_receipt)): ?>
                                            <a  class="action-btn bg-primary ms-2 btn btn-sm align-items-center" href="<?php echo e($revenuepath . '/' . $revenue->add_receipt); ?>" download="">
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                            <a href="<?php echo e($revenuepath . '/' . $revenue->add_receipt); ?>"  class="action-btn bg-secondary ms-2 mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" target="_blank"><span class="btn-inner--icon"><i class="ti ti-crosshair text-white" ></i></span></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                    </td>
                                    <?php if(Gate::check('edit revenue') || Gate::check('delete revenue')): ?>
                                        <td class="Action">
                                            <span>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit revenue')): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('revenue.edit',$revenue->id)); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete revenue')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['revenue.destroy', $revenue->id],'class'=>'delete-form-btn','id'=>'delete-form-'.$revenue->id]); ?>


                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($revenue->id); ?>').submit();">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/revenue/index.blade.php ENDPATH**/ ?>