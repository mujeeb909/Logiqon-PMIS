<?php
    $dir = asset(Storage::url('uploads/plan'));
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create plan')): ?>
            <?php if(isset($admin_payment_setting) && !empty($admin_payment_setting)): ?>
                <?php if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' || $admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>

                    <a href="#" data-size="lg" data-url="<?php echo e(route('plans.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Plan')); ?>" class="btn btn-sm btn-primary">
                        <i class="ti ti-plus"></i>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="plan_card">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s" style="
                   visibility: visible;
                   animation-delay: 0.2s;
                   animation-name: fadeInUp;
                   ">
                    <div class="card-body">
                        <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                        <?php if(\Auth::user()->type == 'company' && \Auth::user()->plan == $plan->id): ?>
                            <div class="d-flex flex-row-reverse m-0 p-0">
                                 <span class=" align-items-right">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                </span>
                            </div>

                        <?php endif; ?>
                        <h1 class="mb-4 f-w-600 "><?php echo e((env('CURRENCY_SYMBOL') ? env('CURRENCY_SYMBOL') : '$')); ?><?php echo e(number_format($plan->price)); ?>

                            <small class="text-sm">/<?php echo e(__(\App\Models\Plan::$arrDuration[$plan->duration])); ?></small></h1>
                        <p class="mb-0">
                            <?php echo e(__('Duration : ').__(\App\Models\Plan::$arrDuration[$plan->duration])); ?><br/>
                        </p>

                        <div class="row ">
                            <div class="col-6">
                                <ul class="list-unstyled my-5">
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_users==-1)?__('Unlimited'):$plan->max_users); ?> <?php echo e(__('Users')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_customers==-1)?__('Unlimited'):$plan->max_customers); ?> <?php echo e(__('Customers')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_venders==-1)?__('Unlimited'):$plan->max_venders); ?> <?php echo e(__('Vendors')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->max_clients==-1)?__('Unlimited'):$plan->max_clients); ?> <?php echo e(__('Clients')); ?></li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled my-5">
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->account==1)?__('Enable'):__('Disable')); ?> <?php echo e(__('Account')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->crm==1)?__('Enable'):__('Disable')); ?> <?php echo e(__('CRM')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->hrm==1)?__('Enable'):__('Disable')); ?> <?php echo e(__('HRM')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->project==1)?__('Enable'):__('Disable')); ?> <?php echo e(__('Project')); ?></li>
                                    <li class="white-sapce-nowrap"><span class="theme-avtar"><i class="text-primary ti ti-circle-plus"></i></span><?php echo e(($plan->pos==1)?__('Enable'):__('Disable')); ?> <?php echo e(__('POS')); ?></li>
                                </ul>
                            </div>
                        </div>

                        <?php if(\Auth::user()->type =='super admin'): ?>
                            <div class="col-4">
                                <a title="<?php echo e(__('Edit Plan')); ?>" href="#" class="btn btn-primary btn-icon m-1" data-url="<?php echo e(route('plans.edit',$plan->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Plan')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                    <i class="ti ti-edit"></i>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if(isset($admin_payment_setting) && !empty($admin_payment_setting)): ?>
                            <?php if($admin_payment_setting['is_stripe_enabled'] == 'on' || $admin_payment_setting['is_paypal_enabled'] == 'on' || $admin_payment_setting['is_paystack_enabled'] == 'on' || $admin_payment_setting['is_flutterwave_enabled'] == 'on'|| $admin_payment_setting['is_razorpay_enabled'] == 'on' || $admin_payment_setting['is_mercado_enabled'] == 'on'|| $admin_payment_setting['is_paytm_enabled'] == 'on'  || $admin_payment_setting['is_mollie_enabled'] == 'on'||
                            $admin_payment_setting['is_skrill_enabled'] == 'on' || $admin_payment_setting['is_coingate_enabled'] == 'on' || $admin_payment_setting['is_paymentwall_enabled'] == 'on'): ?>
                                <?php if(\Auth::user()->type != 'super admin'): ?>

                                    <?php if($plan->id != \Auth::user()->plan): ?>
                                        <?php if($plan->price > 0): ?>
                                            <a href="<?php echo e(route('stripe',\Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>" class="btn btn-primary btn-icon m-1"><?php echo e(__('Buy Plan')); ?></a>


                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($plan->id != 1 && $plan->id != \Auth::user()->plan): ?>
                                        <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                            <a href="<?php echo e(route('send.request',[\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>" class="btn btn-primary btn-icon m-1" data-title="<?php echo e(__('Send Request')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Send Request')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-corner-up-right"></i></span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('request.cancel',\Auth::user()->id)); ?>" class="btn btn-danger btn-icon m-1" data-title="<?php echo e(__('`Cancle Request')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Cancle Request')); ?>">
                                                <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>


                        <?php if(\Auth::user()->type =='company' && \Auth::user()->plan == $plan->id): ?>
                            <p class="display-total-time text-dark mb-0">
                                <?php echo e(__('Plan Expired : ')); ?> <?php echo e(!empty(\Auth::user()->plan_expire_date) ? \Auth::user()->dateFormat(\Auth::user()->plan_expire_date):'unlimited'); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/plan/index.blade.php ENDPATH**/ ?>