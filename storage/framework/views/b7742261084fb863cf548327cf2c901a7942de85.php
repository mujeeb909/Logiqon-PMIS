<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Payment')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create payment')): ?>
            <a href="#" data-url="<?php echo e(route('payment.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"  data-size="lg" data-title="<?php echo e(__('Create New Payment')); ?>"  title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('payment.index'),'method' => 'GET','id'=>'payment_form'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('date', isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control month-btn ','id'=>'pc-daterangepicker-1'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account', __('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account',$account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select' ,'id'=>'choices-multiple'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('vender', __('Vendor'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('vender',$vender,isset($_GET['vender'])?$_GET['vender']:'', array('class' => 'form-control select','id'=>'choices-multiple1'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('category', __('Category'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select','id'=>'choices-multiple2'))); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div clas="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('payment_form').submit(); return false;" data-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>

                                        <a href="<?php echo e(route('productservice.index')); ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                           title="<?php echo e(__('Reset')); ?>">
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Account')); ?></th>
                                <th><?php echo e(__('Vendor')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Reference')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                                <th><?php echo e(__('Payment Receipt')); ?></th>
                                <?php if(Gate::check('edit payment') || Gate::check('delete payment')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $paymentpath=\App\Models\Utility::get_file('uploads/payment');
                            ?>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="font-style">
                                    <td><?php echo e(Auth::user()->dateFormat($payment->date)); ?></td>
                                    <td><?php echo e(Auth::user()->priceFormat($payment->amount)); ?></td>
                                    <td><?php echo e(!empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:''); ?></td>
                                    <td><?php echo e(!empty($payment->vender)?$payment->vender->name:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->category)?$payment->category->name:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->reference)?$payment->reference:'-'); ?></td>
                                    <td><?php echo e(!empty($payment->description)?$payment->description:'-'); ?></td>


















                                    <td>
                                        <?php if(!empty($payment->add_receipt)): ?>
                                            <a  class="action-btn bg-primary ms-2 btn btn-sm align-items-center" href="<?php echo e($paymentpath . '/' . $payment->add_receipt); ?>" download="">
                                                <i class="ti ti-download text-white"></i>
                                            </a>
                                            <a href="<?php echo e($paymentpath . '/' . $payment->add_receipt); ?>"  class="action-btn bg-secondary ms-2 mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" target="_blank"><span class="btn-inner--icon"><i class="ti ti-crosshair text-white" ></i></span></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                    </td>



                                    <?php if(Gate::check('edit revenue') || Gate::check('delete revenue')): ?>
                                        <td class="action text-end">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit payment')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="<?php echo e(route('payment.edit',$payment->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Payment')); ?>" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete payment')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['payment.destroy', $payment->id],'id'=>'delete-form-'.$payment->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment->id); ?>').submit();">
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/payment/index.blade.php ENDPATH**/ ?>