<?php $__env->startSection('page-title'); ?>
    <?php echo e($emailTemplate->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>


    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Email Template')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>






<div class="row">
    <div class="col-lg-6">

    </div>
    <div class="col-lg-6">
        <div class="text-end">
            <div class="d-flex justify-content-end drp-languages">
                <ul class="list-unstyled mb-0 m-2">
                    <li class="dropdown dash-h-item drp-language">
                        <a class="email-color dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                           href="#" role="button" aria-haspopup="false" aria-expanded="false"
                           id="dropdownLanguage">
                            
                            <span
                                class="email-color drp-text hide-mob text-primary"><?php echo e(Str::upper($currEmailTempLang->lang)); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                             aria-labelledby="dropdownLanguage">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, $lang])); ?>"
                                   class="dropdown-item <?php echo e($currEmailTempLang->lang == $lang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($lang)); ?></a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>
                </ul>
                <ul class="list-unstyled mb-0 m-2">
                    <li class="dropdown dash-h-item drp-language">
                        <a class="email-color dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                           href="#" role="button" aria-haspopup="false" aria-expanded="false"
                           id="dropdownLanguage">
                                                <span
                                                    class="drp-text hide-mob text-primary"><?php echo e(__('Template: ')); ?><?php echo e($emailTemplate->name); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown dropdown-menu-end email_temp" aria-labelledby="dropdownLanguage">
                            <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('manage.email.language', [$EmailTemplate->id,(Request::segment(3)?Request::segment(3):\Auth::user()->lang)])); ?>"
                                   class="dropdown-item <?php echo e($EmailTemplate->name == $emailTemplate->name ? 'text-primary' : ''); ?>"><?php echo e($EmailTemplate->name); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body ">
                    
                    <?php echo e(Form::model($currEmailTempLang, array('route' => array('email_template.update', $currEmailTempLang->parent_id), 'method' => 'PUT'))); ?>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h6 class="font-weight-bold pb-1"><?php echo e(__('Place Holder')); ?></h6>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-xs">

                                        <?php if($emailTemplate->slug=='new_user'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Email')); ?> : <span class="pull-right text-primary">{email}</span></p>
                                                <p class="col-4"><?php echo e(__('Password')); ?> : <span class="pull-right text-primary">{password}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_client'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Client Name')); ?> : <span class="pull-right text-primary">{client_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Email')); ?> : <span class="pull-right text-primary">{client_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Password')); ?> : <span class="pull-right text-primary">{client_password}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_support_ticket'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('User Name')); ?> : <span class="pull-right text-primary">{support_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Support Title')); ?> : <span class="pull-right text-primary">{support_title}</span></p>
                                                <p class="col-4"><?php echo e(__('Support Priority')); ?> : <span class="pull-right text-primary">{support_priority}</span></p>
                                                <p class="col-4"><?php echo e(__('Support End Date')); ?> : <span class="pull-right text-primary">{support_end_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Support Description')); ?> : <span class="pull-right text-primary">{support_description}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_contract'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Contract Subject')); ?> : <span class="pull-right text-primary">{contract_subject}</span></p>
                                                <p class="col-4"><?php echo e(__('Client Name')); ?> : <span class="pull-right text-primary">{contract_client}</span></p>
                                                <p class="col-4"><?php echo e(__('Contract Title')); ?> : <span class="pull-right text-primary">{contract_value}</span></p>
                                                <p class="col-4"><?php echo e(__('Contract Priority')); ?> : <span class="pull-right text-primary">{contract_start_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Contract End Date')); ?> : <span class="pull-right text-primary">{contract_end_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Contract Description')); ?> : <span class="pull-right text-primary">{contract_description}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='lead_assigned'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('Lead Name')); ?> : <span class="pull-right text-primary">{lead_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Lead Email')); ?> : <span class="pull-right text-primary">{lead_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Lead Subject')); ?> : <span class="pull-right text-primary">{lead_subject}</span></p>
                                                <p class="col-4"><?php echo e(__('Lead Pipeline')); ?> : <span class="pull-right text-primary">{lead_pipeline}</span></p>
                                                <p class="col-4"><?php echo e(__('Lead Stage')); ?> : <span class="pull-right text-primary">{lead_stage}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='deal_assigned'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('Deal Name')); ?> : <span class="pull-right text-primary">{deal_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Deal Pipeline')); ?> : <span class="pull-right text-primary">{deal_pipeline}</span></p>
                                                <p class="col-4"><?php echo e(__('Deal Stage')); ?> : <span class="pull-right text-primary">{deal_stage}</span></p>
                                                <p class="col-4"><?php echo e(__('Deal Status')); ?> : <span class="pull-right text-primary">{deal_status}</span></p>
                                                <p class="col-4"><?php echo e(__('Deal Price')); ?> : <span class="pull-right text-primary">{deal_price}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='award_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Award Name')); ?> : <span class="pull-right text-primary">{award_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Award Email')); ?> : <span class="pull-right text-primary">{award_email}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='customer_invoice_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Customer Name')); ?> : <span class="pull-right text-primary">{customer_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Customer Email')); ?> : <span class="pull-right text-primary">{customer_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Name')); ?> : <span class="pull-right text-primary">{invoice_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Number')); ?> : <span class="pull-right text-primary">{invoice_number}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Url')); ?> : <span class="pull-right text-primary">{invoice_url}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_invoice_payment'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Customer Name')); ?> : <span class="pull-right text-primary">{invoice_payment_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Payment')); ?> : <span class="pull-right text-primary">{invoice_payment}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Payment Amount')); ?> : <span class="pull-right text-primary">{invoice_payment_amount}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Payment Date')); ?> : <span class="pull-right text-primary">{invoice_payment_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Payment Method')); ?> : <span class="pull-right text-primary">{invoice_payment_method}</span></p>

                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_payment_reminder'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Customer Name')); ?> : <span class="pull-right text-primary">{customer_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Customer Email')); ?> : <span class="pull-right text-primary">{customer_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Reminder Name')); ?> : <span class="pull-right text-primary">{payment_reminder_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Invoice Payment Number')); ?> : <span class="pull-right text-primary">{invoice_payment_number}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Due Amount')); ?> : <span class="pull-right text-primary">{invoice_payment_dueAmount}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Reminder Date')); ?> : <span class="pull-right text-primary">{payment_reminder_date}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='new_bill_payment'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Name')); ?> : <span class="pull-right text-primary">{payment_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Bill')); ?> : <span class="pull-right text-primary">{payment_bill}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Amount')); ?> : <span class="pull-right text-primary">{payment_amount}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Date')); ?> : <span class="pull-right text-primary">{payment_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Payment Method')); ?> : <span class="pull-right text-primary">{payment_method}</span></p>

                                            </div>
                                        <?php elseif($emailTemplate->slug=='bill_resent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Vendor Name')); ?> : <span class="pull-right text-primary">{vender_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Vendor Email')); ?> : <span class="pull-right text-primary">{vender_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Bill Name')); ?> : <span class="pull-right text-primary">{bill_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Bill Number')); ?> : <span class="pull-right text-primary">{bill_number}</span></p>
                                                <p class="col-4"><?php echo e(__('Bill Url')); ?> : <span class="pull-right text-primary">{bill_url}</span></p>

                                            </div>
                                        <?php elseif($emailTemplate->slug=='proposal_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Proposal Name')); ?> : <span class="pull-right text-primary">{proposal_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Proposal Email')); ?> : <span class="pull-right text-primary">{proposal_number}</span></p>
                                                <p class="col-4"><?php echo e(__('Proposal Url')); ?> : <span class="pull-right text-primary">{proposal_url}</span></p>


                                            </div>
                                        <?php elseif($emailTemplate->slug=='complaint_resent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Complaint Name')); ?> : <span class="pull-right text-primary">{complaint_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Complaint Title')); ?> : <span class="pull-right text-primary">{complaint_title}</span></p>
                                                <p class="col-4"><?php echo e(__('Complaint Against')); ?> : <span class="pull-right text-primary">{complaint_against}</span></p>
                                                <p class="col-4"><?php echo e(__('Complaint Date')); ?> : <span class="pull-right text-primary">{complaint_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Complaint Date')); ?> : <span class="pull-right text-primary">{complaint_description}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='leave_action_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave Name')); ?> : <span class="pull-right text-primary">{leave_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave Status')); ?> : <span class="pull-right text-primary">{leave_status}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave Reason')); ?> : <span class="pull-right text-primary">{leave_reason}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave Start Date')); ?> : <span class="pull-right text-primary">{leave_start_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave End Date')); ?> : <span class="pull-right text-primary">{leave_end_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Leave Days')); ?> : <span class="pull-right text-primary">{total_leave_days}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='payslip_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Email')); ?> : <span class="pull-right text-primary">{employee_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Payslip Name')); ?> : <span class="pull-right text-primary">{payslip_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Payslip Salary Month ')); ?> : <span class="pull-right text-primary">{payslip_salary_month}</span></p>
                                                <p class="col-4"><?php echo e(__('Payslip Url')); ?> : <span class="pull-right text-primary">{payslip_url}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='promotion_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p clss="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Designation')); ?> : <span class="pull-right text-primary">{promotion_designation}</span></p>
                                                <p class="col-4"><?php echo e(__('Promotion Title')); ?> : <span class="pull-right text-primary">{promotion_title}</span></p>
                                                <p class="col-4"><?php echo e(__('Promotion Date')); ?> : <span class="pull-right text-primary">{promotion_date}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='resignation_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                
                                                <p class="col-4"><?php echo e(__('Employee Email')); ?> : <span class="pull-right text-primary">{resignation_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{assign_user}</span></p>
                                                <p class="col-4"><?php echo e(__('Last Working Date')); ?> : <span class="pull-right text-primary">{resignation_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Resignation Date')); ?> : <span class="pull-right text-primary">{notice_date}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='termination_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{termination_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Email')); ?> : <span class="pull-right text-primary">{termination_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Notice Date')); ?> : <span class="pull-right text-primary">{notice_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Termination Date')); ?> : <span class="pull-right text-primary">{termination_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Termination Type')); ?> : <span class="pull-right text-primary">{termination_type}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='transfer_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{transfer_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Email')); ?> : <span class="pull-right text-primary">{transfer_email}</span></p>
                                                <p class="col-4"><?php echo e(__('Transfer Date')); ?> : <span class="pull-right text-primary">{transfer_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Transfer Department')); ?> : <span class="pull-right text-primary">{transfer_department}</span></p>
                                                <p class="col-4"><?php echo e(__('Transfer Branch')); ?> : <span class="pull-right text-primary">{transfer_branch}</span></p>
                                                <p class="col-4"><?php echo e(__('Transfer Desciption')); ?> : <span class="pull-right text-primary">{transfer_description}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='trip_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee ')); ?> : <span class="pull-right text-primary">{trip_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Purpose of Trip')); ?> : <span class="pull-right text-primary">{purpose_of_visit}</span></p>
                                                <p class="col-4"><?php echo e(__('Start Date')); ?> : <span class="pull-right text-primary">{start_date}</span></p>
                                                <p class="col-4"><?php echo e(__('End Date')); ?> : <span class="pull-right text-primary">{end_date}</span></p>
                                                <p class="col-4"><?php echo e(__('Country')); ?> : <span class="pull-right text-primary">{place_of_visit}</span></p>
                                                <p class="col-4"><?php echo e(__('Description')); ?> : <span class="pull-right text-primary">{trip_description}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='vender_bill_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Vendor Name')); ?> : <span class="pull-right text-primary">{vender_bill_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Bill Number')); ?> : <span class="pull-right text-primary">{vender_bill_number}</span></p>
                                                <p class="col-4"><?php echo e(__('Bill Url')); ?> : <span class="pull-right text-primary">{vender_bill_url}</span></p>
                                            </div>
                                        <?php elseif($emailTemplate->slug=='warning_sent'): ?>
                                            <div class="row">
                                                <p class="col-4"><?php echo e(__('App Name')); ?> : <span class="pull-end text-primary">{app_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{company_name}</span></p>
                                                <p class="col-4"><?php echo e(__('App Url')); ?> : <span class="pull-right text-primary">{app_url}</span></p>
                                                <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_warning_name}</span></p>
                                                <p class="col-4"><?php echo e(__('Subject')); ?> : <span class="pull-right text-primary">{warning_subject}</span></p>
                                                <p class="col-4"><?php echo e(__('Description')); ?> : <span class="pull-right text-primary">{warning_description}</span></p>
                                            </div>


                                            <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <?php echo e(Form::label('subject', __('Subject'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                        </div>
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('from', __('From'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                        </div>


                        <div class="form-group col-12">
                            <?php echo e(Form::label('content', __('Email Message'), ['class' => 'col-form-label text-dark'])); ?>

                            <?php echo e(Form::textarea('content', $currEmailTempLang->content, ['class' => 'summernote-simple', 'required' => 'required'])); ?>

                        </div>


                        <div class="modal-footer">
                            <?php echo e(Form::hidden('lang', null)); ?>

                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-xs btn-primary'])); ?>

                        </div>

                        <?php echo e(Form::close()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/email_templates/show.blade.php ENDPATH**/ ?>