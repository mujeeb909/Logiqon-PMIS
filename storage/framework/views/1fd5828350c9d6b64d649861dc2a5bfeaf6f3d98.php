<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    use App\Models\Utility;
    use App\Models\WebhookSetting;
    // $logo=asset(Storage::url('uploads/logo/'));
       $logo=\App\Models\Utility::get_file('uploads/logo');
       $logo_light = \App\Models\Utility::getValByName('company_logo_light');
       $logo_dark = \App\Models\Utility::getValByName('company_logo_dark');
       $company_favicon = \App\Models\Utility::getValByName('company_favicon');
       $setting = \App\Models\Utility::colorset();
       $mode_setting = \App\Models\Utility::mode_layout();
       $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
       $company_setting=\App\Models\Utility::settingsById('site_currency');
       $SITE_RTL= isset($setting['SITE_RTL'])?$setting['SITE_RTL']:'off';
       $EmailTemplates   = App\Models\EmailTemplate::all();
       $currantLang =  Utility::languages();
       $webhookSetting =WebhookSetting::where('created_by', '=', \Auth::user()->creatorId())->get();


?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $('.summernote-simple0').on('summernote.blur', function () {
            $.ajax({
                url: "<?php echo e(route('offerlatter.update',$offerlang)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), content: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple1').on('summernote.blur', function () {
            $.ajax({
                url: "<?php echo e(route('joiningletter.update',$joininglang)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), content: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple2').on('summernote.blur', function () {
            $.ajax({
                url: "<?php echo e(route('experiencecertificate.update',$explang)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), content: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple3').on('summernote.blur', function () {
            $.ajax({
                url: "<?php echo e(route('noc.update',$noclang)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), content: $(this).val()},
                type: 'POST',
                success: function (response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("chnge", "select[name='bill_template'], input[name='bill_color']", function () {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '<?php echo e(url('/bill/preview')); ?>/' + template + '/' + color);
        });
    </script>

    <script>
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300,
            })
            // $(".list-group-item").click(function(){
            //     $('.list-group-item').filter(function(){
            //         return this.href == id;
            //     }).parent().removeClass('text-primary');
            // });

            function check_theme(color_val) {
                $('#theme_color').prop('checked', false);
                $('input[value="' + color_val + '"]').prop('checked', true);
            }
        </script>

    <script>
        document.getElementById('company_logo_dark').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('company_logo_light').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
        document.getElementById('company_favicon').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>

    <script type="text/javascript">
        $(document).on("click", ".email-template-checkbox", function () {
            var chbox = $(this);
            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'PUT',
                success: function (response) {
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                        if (chbox.val() == 1) {
                            $('#' + chbox.attr('id')).val(0);
                        } else {
                            $('#' + chbox.attr('id')).val(1);
                        }
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('Error', response.error, 'error');
                    } else {
                        show_toastr('Error', response, 'error');
                    }
                }
            })
        });
    </script>

    <script>
        $(document).on('change', '#vat_gst_number_switch', function() {
            if($(this).is(':checked'))
            {
                $('.tax_type_div').removeClass('d-none');
            } else {
                $('.tax_type_div').addClass('d-none');
            }
        });
    </script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#brand-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Brand Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#system-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('System Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#company-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Company Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#payment-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#zoom-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Zoom Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#slack-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Slack Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#telegram-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Telegram Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#twilio-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#email-notification-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#offer-letter-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Offer Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#joining-letter-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Joining Letter Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#experience-certificate-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Experience Certificate Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#noc-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('NOC Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#google-calender" class="list-group-item list-group-item-action border-0"><?php echo e(__('Google Calendar Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#webhook-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Webhook Settings')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">

                    <!--Business Setting-->
                    <div id="brand-settings" class="card">
                        <?php echo e(Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                        <div class="card-header">
                            <h5><?php echo e(__('Brand Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your brand details')); ?></small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo dark')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image" src="<?php echo e($logo.'/'.(isset($logo_dark) && !empty($logo_dark)?$logo_dark:'logo-dark.png')); ?>"
                                                         class="big-logo">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_logo_dark">
                                                        <div class="bg-primary company_logo_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" name="company_logo_dark" id="company_logo_dark" class="form-control file setting_logo" data-filename="company_logo_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['company_logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo Light')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image1" src="<?php echo e($logo.'/'.(isset($logo_light) && !empty($logo_light)?$logo_light:'logo-light.png')); ?>"
                                                         class="big-logo img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_logo_light">
                                                        <div class=" bg-primary dark_logo_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file setting_logo" name="company_logo_light" id="company_logo_light"
                                                               data-filename="dark_logo_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Favicon')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image2" src="<?php echo e((!empty($company_favicon)?$logo.'/'. $company_favicon:$logo.'/'. 'favicon.png')); ?>" width="50px"
                                                         class="img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_favicon">
                                                        <div class="bg-primary company_favicon_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file setting_logo"  id="company_favicon" name="company_favicon"
                                                               data-filename="company_favicon_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('title_text',__('Title Text'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-title_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-4 form-group">
                                    <?php echo e(Form::label('footer_text',__('Footer Text'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::text('footer_text',Utility::getValByName('footer_text'),array('class'=>'form-control','placeholder'=>__('Enter Footer Text')))); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="custom-control custom-switch">
                                        <label class="text-dark mb-1 mt-1" for="SITE_RTL"><?php echo e(__('Enable RTL')); ?></label>
                                        <div class="">
                                            <input type="checkbox" name="SITE_RTL" id="SITE_RTL" data-toggle="switchbutton"  data-onstyle="primary"  <?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="custom-control-label" for="SITE_RTL"></label>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="small-title mt-2"><?php echo e(__('Theme Customizer')); ?></h5>
                                <div class="setting-card setting-logo-box ">
                                    <div class="row">
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="credit-card" class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                            </h6>

                                            <hr class="my-2" />
                                            <div class="theme-color themes-color">
                                                <a href="#!" class="<?php echo e(($settings['color'] == 'theme-1') ? 'active_color' : ''); ?>" data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-1" style="display: none;">
                                                <a href="#!" class="<?php echo e(($settings['color'] == 'theme-2') ? 'active_color' : ''); ?> " data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-2" style="display: none;">
                                                <a href="#!" class="<?php echo e(($settings['color'] == 'theme-3') ? 'active_color' : ''); ?>" data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-3" style="display: none;">
                                                <a href="#!" class="<?php echo e(($settings['color'] == 'theme-4') ? 'active_color' : ''); ?>" data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-4" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="layout" class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                            </h6>
                                            <hr class="mt-1" />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg" name="cust_theme_bg" <?php echo e(!empty($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on' ? 'checked' : ''); ?>/>
                                                <label class="form-check-label f-w-600 pl-1" for="cust-theme-bg"
                                                ><?php echo e(__('Transparent layout')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-1">
                                                <i data-feather="sun" class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                            </h6>
                                            <hr class="mt-1" />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout" name="cust_darklayout"<?php echo e(!empty($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--System Settings-->
                    <div id="system-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('System Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your system details')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings,array('route'=>'system.settings','method'=>'post'))); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency',__('Currency *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('site_currency', $settings['site_currency'], ['class' => 'form-control font-style', 'required', 'placeholder' => __('Enter Currency')])); ?>

                                    <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><br>
                                        <a href="https://stripe.com/docs/currencies"
                                           target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a></small> <br>
                                    <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-site_currency" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency_symbol',__('Currency Symbol *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('site_currency_symbol',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-site_currency_symbol" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <div class="row ms-1">
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="radio" name="site_currency_symbol_position" value="pre" <?php if(@$settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>
                                            id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo e(__('Pre')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="radio" name="site_currency_symbol_position" value="post" <?php if(@$settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>
                                            id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                <?php echo e(__('Post')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="site_date_format" class="form-label"><?php echo e(__('Date Format')); ?></label>
                                    <select type="text" name="site_date_format" class="form-control selectric" id="site_date_format">
                                        <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                                        <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>dd-mm-yyyy</option>
                                        <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>mm-dd-yyyy</option>
                                        <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>yyyy-mm-dd</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_time_format" class="form-label"><?php echo e(__('Time Format')); ?></label>
                                    <select type="text" name="site_time_format" class="form-control selectric" id="site_time_format">
                                        <option value="g:i A" <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                        <option value="g:i a" <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm</option>
                                        <option value="H:i" <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('invoice_prefix',__('Invoice Prefix'),array('class'=>'form-label'))); ?>


                                    <?php echo e(Form::text('invoice_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['invoice_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-invoice_prefix" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('proposal_prefix',__('Proposal Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('proposal_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['proposal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-proposal_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('purchase_prefix',__('Purchase Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('purchase_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['purchase_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-purchase_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('pos_prefix',__('Pos Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('pos_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['pos_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pos_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('bill_prefix',__('Bill Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('bill_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['bill_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-bill_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('customer_prefix',__('Customer Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('customer_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['customer_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-customer_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('vender_prefix',__('Vendor Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('vender_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['vender_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-vender_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('footer_title',__('Invoice/Bill Footer Title'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('footer_title',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-footer_title" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('decimal_number',__('Decimal Number Format'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::number('decimal_number', null, ['class'=>'form-control'])); ?>

                                    <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-decimal_number" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('journal_prefix',__('Journal Prefix'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::text('journal_prefix',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['journal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-journal_prefix" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label mb-0"><?php echo e(__('Application URL')); ?></label> <br>
                                    <small><?php echo e(__("Application URL to log into the app.")); ?></small>
                                    <?php echo e(Form::text('currency',URL::to('/'), ['class' => 'form-control', 'placeholder' => __('Enter Currency'),'disabled'=>'true'])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label mb-0"><?php echo e(__('Tracking Interval')); ?></label> <br>
                                    <small><?php echo e(__("Image Screenshot Take Interval time ( 1 = 1 min)")); ?></small>
                                    <?php echo e(Form::number('interval_time',isset($settings['interval_time'])?$settings['interval_time']:'10', ['class' => 'form-control', 'placeholder' => __('Enter Tracking Interval')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('shipping_display',__('Display Shipping in Proposal / Invoice / Bill'),array('class'=>'form-label'))); ?>

                                    <div class=" form-switch form-switch-left">
                                        <input type="checkbox" class="form-check-input mt-4" name="shipping_display" id="email_tempalte_13" <?php echo e(($settings['shipping_display']=='on')?'checked':''); ?> >
                                        <label class="form-check-label" for="email_tempalte_13"></label>
                                    </div>

                                    <?php $__errorArgs = ['shipping_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-shipping_display" role="alert">
                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('footer_notes',__('Invoice/Bill Footer Notes'),array('class'=>'form-label'))); ?>

                                    <?php echo e(Form::textarea('footer_notes', null, ['class'=>'form-control','rows'=>'3'])); ?>

                                    <?php $__errorArgs = ['footer_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-footer_notes" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Company Settings-->
                    <div id="company-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Company Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your company details')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings,array('route'=>'company.settings','method'=>'post'))); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_name *',__('Company Name *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_name',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_address',__('Address'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_address',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_address" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_city',__('City'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_city',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_city" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_state',__('State'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_state',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_state" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_zipcode',__('Zip/Post Code'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_zipcode',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_zipcode" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <?php echo e(Form::label('company_country',__('Country'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_country',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_country" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_telephone',__('Telephone'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_telephone',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_telephone" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_email',__('System Email *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_email',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_email" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_email_from_name',__('Email (From Name) *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))); ?>

                                    <?php $__errorArgs = ['company_email_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_email_from_name" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('registration_number',__('Company Registration Number *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::text('registration_number',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['registration_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-registration_number" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_start_time',__('Company Start Time *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::time('company_start_time',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_start_time" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_end_time',__('Company End Time *'),array('class' => 'form-label'))); ?>

                                    <?php echo e(Form::time('company_end_time',null,array('class'=>'form-control'))); ?>

                                    <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-company_end_time" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-12 mt-2">
                                    <?php echo e(Form::label('timezone',__('Timezone'),array('class' => 'form-label'))); ?>

                                    <select type="text" name="timezone" class="form-control custom-select" id="timezone">
                                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>" <?php echo e((env('TIMEZONE')==$k)?'selected':''); ?>><?php echo e($timezone); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label for="vat_gst_number_switch"><?php echo e(__('Tax Number')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1 float-end">
                                                <input type="checkbox" name="vat_gst_number_switch" class="form-check-input input-primary pointer" value="on" id="vat_gst_number_switch" <?php echo e($settings['vat_gst_number_switch']=='on'?' checked ':''); ?>>
                                                <label class="form-check-label" for="vat_gst_number_switch"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 tax_type_div <?php echo e($settings['vat_gst_number_switch'] !='on'?' d-none ':''); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio8" name="tax_type" value="VAT" class="form-check-input" <?php echo e(($settings['tax_type'] == 'VAT')?'checked':''); ?> >
                                                <label class="form-check-label" for="customRadio8"><?php echo e(__('VAT Number')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio7" name="tax_type" value="GST" class="form-check-input" <?php echo e(($settings['tax_type'] == 'GST')?'checked':''); ?>>
                                                <label class="form-check-label" for="customRadio7"><?php echo e(__('GST Number')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::text('vat_number',null,array('class'=>'form-control','placeholder'=>__('Enter VAT / GST Number')))); ?>

                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Payment Settings-->
                    <div class="card" id="payment-settings">
                        <div class="card-header">
                            <h5><?php echo e('Payment Settings'); ?></h5>
                            <small
                                class="text-secondary font-weight-bold"><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings,['route'=>'company.payment.settings', 'method'=>'POST'])); ?>

                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="faq justify-content-center">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="accordion accordion-flush setting-accordion" id="accordionExample">

                                                    <!-- Stripe -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                                    aria-expanded="false" aria-controls="collapseOne">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Stripe')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_stripe_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_stripe_enabled"
                                                                               name="is_stripe_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_stripe_enabled']) && $company_payment_setting['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse"
                                                             aria-labelledby="headingOne"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <?php echo e(Form::label('stripe_key', __('Stripe Key'), ['class' => 'col-form-label'])); ?>

                                                                                <?php echo e(Form::text('stripe_key', isset($company_payment_setting['stripe_key']) ? $company_payment_setting['stripe_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Stripe Key')])); ?>

                                                                                <?php if($errors->has('stripe_key')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('stripe_key')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <?php echo e(Form::label('stripe_secret', __('Stripe Secret'), ['class' => 'col-form-label'])); ?>

                                                                                <?php echo e(Form::text('stripe_secret', isset($company_payment_setting['stripe_secret']) ? $company_payment_setting['stripe_secret'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Stripe Secret')])); ?>

                                                                                <?php if($errors->has('stripe_secret')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('stripe_secret')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paypal -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingTwo">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paypal')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paypal_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_paypal_enabled"
                                                                               name="is_paypal_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paypal_enabled']) && $company_payment_setting['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                                             aria-labelledby="headingTwo"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="d-flex">
                                                                    <div class="mr-2" style="margin-right: 15px;">
                                                                        <div class="border card p-1">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label text-dark me-2">
                                                                                    <input type="radio"
                                                                                           name="paypal_mode" value="sandbox"
                                                                                           class="form-check-input"
                                                                                        <?php echo e((isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == '') || (isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Sandbox')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mr-2">
                                                                        <div class="border card p-1">
                                                                            <div class="form-check">
                                                                                <label class="form-check-label text-dark me-2">
                                                                                    <input type="radio"
                                                                                           name="paypal_mode" value="live"
                                                                                           class="form-check-input"
                                                                                        <?php echo e(isset($company_payment_setting['paypal_mode']) && $company_payment_setting['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                    <?php echo e(__('Live')); ?>

                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                       for="paypal_client_id"><?php echo e(__('Client ID')); ?></label>
                                                                                <input type="text"
                                                                                       name="paypal_client_id"
                                                                                       id="paypal_client_id"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['paypal_client_id']) || is_null($company_payment_setting['paypal_client_id']) ? '' : $company_payment_setting['paypal_client_id']); ?>"
                                                                                       placeholder="<?php echo e(__('Client ID')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label class="col-form-label"
                                                                                       for="paypal_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="paypal_secret_key"
                                                                                       id="paypal_secret_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paypal_secret_key']) ? $company_payment_setting['paypal_secret_key'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Secret Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paystack -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingThree">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                                    aria-expanded="false" aria-controls="collapseThree">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paystack')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paystack_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_paystack_enabled"
                                                                               name="is_paystack_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paystack_enabled']) && $company_payment_setting['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseThree" class="accordion-collapse collapse"
                                                             aria-labelledby="headingThree"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                       class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="paystack_public_key"
                                                                                       id="paystack_public_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paystack_public_key']) ? $company_payment_setting['paystack_public_key'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Public Key')); ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                       class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="paystack_secret_key"
                                                                                       id="paystack_secret_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paystack_secret_key']) ? $company_payment_setting['paystack_secret_key'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Secret Key')); ?>" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Flutterwave -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFour">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                                    aria-expanded="false" aria-controls="collapseFour">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Flutterwave')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                               name="is_flutterwave_enabled" value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_flutterwave_enabled"
                                                                               name="is_flutterwave_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_flutterwave_enabled']) && $company_payment_setting['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFour" class="accordion-collapse collapse"
                                                             aria-labelledby="headingFour"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                       class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="flutterwave_public_key"
                                                                                       id="flutterwave_public_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['flutterwave_public_key']) ? $company_payment_setting['flutterwave_public_key'] : ''); ?>"
                                                                                       placeholder="Public Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                       class="col-form-label"><?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="flutterwave_secret_key"
                                                                                       id="flutterwave_secret_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['flutterwave_secret_key']) ? $company_payment_setting['flutterwave_secret_key'] : ''); ?>"
                                                                                       placeholder="Secret Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Razorpay -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingFive">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                                    aria-expanded="false" aria-controls="collapseFive">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Razorpay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_razorpay_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_razorpay_enabled"
                                                                               name="is_razorpay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_razorpay_enabled']) && $company_payment_setting['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseFive" class="accordion-collapse collapse"
                                                             aria-labelledby="headingFive"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paypal_client_id"
                                                                                       class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="razorpay_public_key"
                                                                                       id="razorpay_public_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['razorpay_public_key']) || is_null($company_payment_setting['razorpay_public_key']) ? '' : $company_payment_setting['razorpay_public_key']); ?>"
                                                                                       placeholder="Public Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paystack_secret_key"
                                                                                       class="col-form-label">
                                                                                    <?php echo e(__('Secret Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="razorpay_secret_key"
                                                                                       id="razorpay_secret_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['razorpay_secret_key']) || is_null($company_payment_setting['razorpay_secret_key']) ? '' : $company_payment_setting['razorpay_secret_key']); ?>"
                                                                                       placeholder="Secret Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Paytm -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingSix">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                                    aria-expanded="false" aria-controls="collapseSix">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Paytm')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_paytm_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_paytm_enabled"
                                                                               name="is_paytm_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paytm_enabled']) && $company_payment_setting['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseSix" class="accordion-collapse collapse"
                                                             aria-labelledby="headingSix"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="paypal-label col-form-label"
                                                                           for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="paytm_mode"
                                                                                               value="local"
                                                                                               class="form-check-input"
                                                                                            <?php echo e(!isset($company_payment_setting['paytm_mode']) || $company_payment_setting['paytm_mode'] == '' || $company_payment_setting['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Local')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="paytm_mode"
                                                                                               value="production"
                                                                                               class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['paytm_mode']) && $company_payment_setting['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Production')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_public_key"
                                                                                       class="col-form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                                                <input type="text"
                                                                                       name="paytm_merchant_id"
                                                                                       id="paytm_merchant_id"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paytm_merchant_id']) ? $company_payment_setting['paytm_merchant_id'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Merchant ID')); ?>" />
                                                                                <?php if($errors->has('paytm_merchant_id')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_merchant_id')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_secret_key"
                                                                                       class="col-form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="paytm_merchant_key"
                                                                                       id="paytm_merchant_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paytm_merchant_key']) ? $company_payment_setting['paytm_merchant_key'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Merchant Key')); ?>" />
                                                                                <?php if($errors->has('paytm_merchant_key')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_merchant_key')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paytm_industry_type"
                                                                                       class="col-form-label"><?php echo e(__('Industry Type')); ?></label>
                                                                                <input type="text"
                                                                                       name="paytm_industry_type"
                                                                                       id="paytm_industry_type"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['paytm_industry_type']) ? $company_payment_setting['paytm_industry_type'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Industry Type')); ?>" />
                                                                                <?php if($errors->has('paytm_industry_type')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('paytm_industry_type')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mercado Pago -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingseven">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseseven"
                                                                    aria-expanded="false" aria-controls="collapseseven">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Mercado Pago')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_mercado_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_mercado_enabled"
                                                                               name="is_mercado_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_mercado_enabled']) && $company_payment_setting['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseseven" class="accordion-collapse collapse"
                                                             aria-labelledby="headingseven"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="coingate-label col-form-label"
                                                                           for="mercado_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="mercado_mode"
                                                                                               value="sandbox"
                                                                                               class="form-check-input"
                                                                                            <?php echo e((isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == '') || (isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="mercado_mode"
                                                                                               value="live"
                                                                                               class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['mercado_mode']) && $company_payment_setting['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mercado_access_token"
                                                                                       class="col-form-label"><?php echo e(__('Access Token')); ?></label>
                                                                                <input type="text"
                                                                                       name="mercado_access_token"
                                                                                       id="mercado_access_token"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['mercado_access_token']) ? $company_payment_setting['mercado_access_token'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Access Token')); ?>" />
                                                                                <?php if($errors->has('mercado_secret_key')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('mercado_access_token')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Mollie -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingeight">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseeight"
                                                                    aria-expanded="false" aria-controls="collapseeight">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Mollie')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_mollie_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_mollie_enabled"
                                                                               name="is_mollie_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_mollie_enabled']) && $company_payment_setting['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseeight" class="accordion-collapse collapse"
                                                             aria-labelledby="headingeight"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_api_key"
                                                                                       class="col-form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="mollie_api_key"
                                                                                       id="mollie_api_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['mollie_api_key']) || is_null($company_payment_setting['mollie_api_key']) ? '' : $company_payment_setting['mollie_api_key']); ?>"
                                                                                       placeholder="Mollie Api Key">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_profile_id"
                                                                                       class="col-form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                                                <input type="text"
                                                                                       name="mollie_profile_id"
                                                                                       id="mollie_profile_id"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['mollie_profile_id']) || is_null($company_payment_setting['mollie_profile_id']) ? '' : $company_payment_setting['mollie_profile_id']); ?>"
                                                                                       placeholder="Mollie Profile Id">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_partner_id"
                                                                                       class="col-form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                                                <input type="text"
                                                                                       name="mollie_partner_id"
                                                                                       id="mollie_partner_id"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['mollie_partner_id']) || is_null($company_payment_setting['mollie_partner_id']) ? '' : $company_payment_setting['mollie_partner_id']); ?>"
                                                                                       placeholder="Mollie Partner Id">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Skrill -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingnine">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapsenine"
                                                                    aria-expanded="false" aria-controls="collapsenine">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Skrill')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_skrill_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_skrill_enabled"
                                                                               name="is_skrill_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_skrill_enabled']) && $company_payment_setting['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsenine" class="accordion-collapse collapse"
                                                             aria-labelledby="headingnine"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="mollie_api_key"
                                                                                       class="col-form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                                                <input type="email" name="skrill_email"
                                                                                       id="skrill_email" class="form-control"
                                                                                       value="<?php echo e(isset($company_payment_setting['skrill_email']) ? $company_payment_setting['skrill_email'] : ''); ?>"
                                                                                       placeholder="<?php echo e(__('Enter Skrill Email')); ?>" />
                                                                                <?php if($errors->has('skrill_email')): ?>
                                                                                    <span class="invalid-feedback d-block">
                                                                                        <?php echo e($errors->first('skrill_email')); ?>

                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- CoinGate -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingten">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseten"
                                                                    aria-expanded="false" aria-controls="collapseten">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('CoinGate')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden" name="is_coingate_enabled"
                                                                               value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_coingate_enabled"
                                                                               name="is_coingate_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_coingate_enabled']) && $company_payment_setting['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseten" class="accordion-collapse collapse"
                                                             aria-labelledby="headingten"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="col-md-12 pb-4">
                                                                    <label class="col-form-label"
                                                                           for="coingate_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                                    <br>
                                                                    <div class="d-flex">
                                                                        <div class="mr-2" style="margin-right: 15px;">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="coingate_mode"
                                                                                               value="sandbox"
                                                                                               class="form-check-input"
                                                                                            <?php echo e(!isset($company_payment_setting['coingate_mode']) || $company_payment_setting['coingate_mode'] == '' || $company_payment_setting['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Sandbox')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mr-2">
                                                                            <div class="border card p-1">
                                                                                <div class="form-check">
                                                                                    <label
                                                                                        class="form-check-label text-dark me-2">
                                                                                        <input type="radio"
                                                                                               name="coingate_mode"
                                                                                               value="live"
                                                                                               class="form-check-input"
                                                                                            <?php echo e(isset($company_payment_setting['coingate_mode']) && $company_payment_setting['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                                        <?php echo e(__('Live')); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="coingate_auth_token"
                                                                                       class="col-form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                                                <input type="text"
                                                                                       name="coingate_auth_token"
                                                                                       id="coingate_auth_token"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['coingate_auth_token']) || is_null($company_payment_setting['coingate_auth_token']) ? '' : $company_payment_setting['coingate_auth_token']); ?>"
                                                                                       placeholder="CoinGate Auth Token">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- PaymentWall -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingeleven">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapseeleven"
                                                                    aria-expanded="false" aria-controls="collapseeleven">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('PaymentWall')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2"><?php echo e(__('Enable')); ?>:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                               name="is_paymentwall_enabled" value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_paymentwall_enabled"
                                                                               name="is_paymentwall_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_paymentwall_enabled']) && $company_payment_setting['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapseeleven" class="accordion-collapse collapse"
                                                             aria-labelledby="headingeleven"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paymentwall_public_key"
                                                                                       class="col-form-label"><?php echo e(__('Public Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="paymentwall_public_key"
                                                                                       id="paymentwall_public_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['paymentwall_public_key']) || is_null($company_payment_setting['paymentwall_public_key']) ? '' : $company_payment_setting['paymentwall_public_key']); ?>"
                                                                                       placeholder="<?php echo e(__('Public Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="paymentwall_secret_key" class="col-form-label"><?php echo e(__('Private Key')); ?></label>
                                                                                <input type="text" name="paymentwall_secret_key" id="paymentwall_secret_key" class="form-control" value="<?php echo e(!isset($company_payment_setting['paymentwall_secret_key']) || is_null($company_payment_setting['paymentwall_secret_key']) ? '' : $company_payment_setting['paymentwall_secret_key']); ?>" placeholder="<?php echo e(__('Private Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Toyyibpay -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingtwelve">
                                                            <button class="accordion-button collapsed" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#collapsetwelve"
                                                                    aria-expanded="false" aria-controls="collapsetwelve">
                                                                <span class="d-flex align-items-center">
                                                                    <?php echo e(__('Toyyibpay')); ?>

                                                                </span>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-2">Enable:</span>
                                                                    <div class="form-check form-switch custom-switch-v1">
                                                                        <input type="hidden"
                                                                               name="is_toyyibpay_enabled" value="off">
                                                                        <input type="checkbox"
                                                                               class="form-check-input input-primary"
                                                                               id="customswitchv1-1 is_toyyibpay_enabled"
                                                                               name="is_toyyibpay_enabled"
                                                                            <?php echo e(isset($company_payment_setting['is_toyyibpay_enabled']) && $company_payment_setting['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                                    </div>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="collapsetwelve" class="accordion-collapse collapse"
                                                             aria-labelledby="headingtwelve"
                                                             data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="row gy-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="toyyibpay_category_code"
                                                                                       class="col-form-label"><?php echo e(__('Category Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="toyyibpay_category_code"
                                                                                       id="toyyibpay_category_code"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['toyyibpay_category_code']) || is_null($company_payment_setting['toyyibpay_category_code']) ? '' : $company_payment_setting['toyyibpay_category_code']); ?>"
                                                                                       placeholder="<?php echo e(__('Category Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="input-edits">
                                                                            <div class="form-group">
                                                                                <label for="toyyibpay_secret_key"
                                                                                       class="col-form-label"><?php echo e(__('Secrect Key')); ?></label>
                                                                                <input type="text"
                                                                                       name="toyyibpay_secret_key"
                                                                                       id="toyyibpay_secret_key"
                                                                                       class="form-control"
                                                                                       value="<?php echo e(!isset($company_payment_setting['toyyibpay_secret_key']) || is_null($company_payment_setting['toyyibpay_secret_key']) ? '' : $company_payment_setting['toyyibpay_secret_key']); ?>"
                                                                                       placeholder="<?php echo e(__('Secrect Key')); ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        </form>
                    </div>

                    <!--Zoom - Metting Settings-->
                    <div id="zoom-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Zoom Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Zoom settings')); ?></small>
                        </div>

                        <div class="card-body">
                            <?php echo e(Form::model($settings,array('route'=>'zoom.settings','method'=>'post'))); ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom API Key')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_apikey',isset($settings['zoom_apikey'])?$settings['zoom_apikey']:'', ['class' => 'form-control', 'placeholder' => __('Enter Zoom API Key')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom API Secret')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_apisecret',isset($settings['zoom_apisecret'])?$settings['zoom_apisecret']:'', ['class' => 'form-control', 'placeholder' => __('Enter Zoom API Secret')])); ?>

                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <!--Slack Settings-->
                    <div id="slack-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Slack Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Slack settings')); ?></small>
                        </div>

                        <div class="card-body">
                            <?php echo e(Form::open(['route' => 'slack.settings','id'=>'slack-setting','method'=>'post' ,'class'=>'d-contents'])); ?>


                            <div class="form-group col-md-12">
                                <label class="form-label"><?php echo e(__('Slack Webhook URL')); ?></label> <br>
                                <?php echo e(Form::text('slack_webhook', isset($settings['slack_webhook']) ?$settings['slack_webhook'] :'', ['class' => 'form-control w-100', 'placeholder' => __('Enter Slack Webhook URL'), 'required' => 'required'])); ?>

                            </div>

                            <div class="col-md-12 mt-5 mb-2">
                                <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Lead')); ?></span>
                                                <?php echo e(Form::checkbox('lead_notification', '1',isset($settings['lead_notification']) && $settings['lead_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'lead_notification'))); ?>

                                                <label class="form-check-label" for="lead_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Deal')); ?></span>
                                                <?php echo e(Form::checkbox('deal_notification', '1',isset($settings['deal_notification']) && $settings['deal_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'deal_notification'))); ?>

                                                <label class="form-check-label" for="deal_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Lead to Deal Conversion')); ?></span>
                                                <?php echo e(Form::checkbox('leadtodeal_notification', '1',isset($settings['leadtodeal_notification']) && $settings['leadtodeal_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'leadtodeal_notification'))); ?>

                                                <label class="form-check-label" for="leadtodeal_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Contract')); ?></span>
                                                <?php echo e(Form::checkbox('contract_notification', '1',isset($settings['contract_notification']) && $settings['contract_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'contract_notification'))); ?>

                                                <label class="form-check-label" for="contract_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Project')); ?></span>
                                                <?php echo e(Form::checkbox('project_notification', '1',isset($settings['project_notification']) && $settings['project_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'project_notification'))); ?>

                                                <label class="form-check-label" for="project_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task')); ?></span>
                                                <?php echo e(Form::checkbox('task_notification', '1',isset($settings['task_notification']) && $settings['task_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'task_notification'))); ?>

                                                <label class="form-check-label" for="task_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Task Stage Updated')); ?></span>
                                                <?php echo e(Form::checkbox('taskmove_notification', '1',isset($settings['taskmove_notification']) && $settings['taskmove_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'taskmove_notification'))); ?>

                                                <label class="form-check-label" for="taskmove_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task Comment')); ?></span>
                                                <?php echo e(Form::checkbox('taskcomment_notification', '1',isset($settings['taskcomment_notification']) && $settings['taskcomment_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'taskcomment_notification'))); ?>

                                                <label class="form-check-label" for="taskcomment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Monthly Payslip')); ?></span>
                                                <?php echo e(Form::checkbox('payslip_notification', '1',isset($settings['payslip_notification']) && $settings['payslip_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'payslip_notification'))); ?>

                                                <label class="form-check-label" for="payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Award')); ?></span>
                                                <?php echo e(Form::checkbox('award_notification', '1',isset($settings['award_notification']) && $settings['award_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'award_notification'))); ?>

                                                <label class="form-check-label" for="award_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Announcement')); ?></span>
                                                <?php echo e(Form::checkbox('announcement_notification', '1',isset($settings['announcement_notification']) && $settings['announcement_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'announcement_notification'))); ?>

                                                <label class="form-check-label" for="announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Holiday')); ?></span>
                                                <?php echo e(Form::checkbox('holiday_notification', '1',isset($settings['holiday_notification']) && $settings['holiday_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'holiday_notification'))); ?>

                                                <label class="form-check-label" for="holiday_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Support Ticket')); ?></span>
                                                <?php echo e(Form::checkbox('support_notification', '1',isset($settings['support_notification']) && $settings['support_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'support_notification'))); ?>

                                                <label class="form-check-label" for="support_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Event')); ?></span>
                                                <?php echo e(Form::checkbox('event_notification', '1',isset($settings['event_notification']) && $settings['event_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'event_notification'))); ?>

                                                <label class="form-check-label" for="event_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Meeting')); ?></span>
                                                <?php echo e(Form::checkbox('meeting_notification', '1',isset($settings['meeting_notification']) && $settings['meeting_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'meeting_notification'))); ?>

                                                <label class="form-check-label" for="meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Company Policy')); ?></span>
                                                <?php echo e(Form::checkbox('policy_notification', '1',isset($settings['policy_notification']) && $settings['policy_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'policy_notification'))); ?>

                                                <label class="form-check-label" for="policy_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('invoice_notification', '1',isset($settings['invoice_notification']) && $settings['invoice_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'invoice_notification'))); ?>

                                                <label class="form-check-label" for="invoice_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('revenue_notification', '1',isset($settings['revenue_notification']) && $settings['revenue_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'revenue_notification'))); ?>

                                                <label class="form-check-label" for="revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('bill_notification', '1',isset($settings['bill_notification']) && $settings['bill_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'bill_notification'))); ?>

                                                <label class="form-check-label" for="bill_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice Payment')); ?></span>
                                                <?php echo e(Form::checkbox('payment_notification', '1',isset($settings['payment_notification']) && $settings['payment_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'payment_notification'))); ?>

                                                <label class="form-check-label" for="payment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Budget')); ?></span>
                                                <?php echo e(Form::checkbox('budget_notification', '1',isset($settings['budget_notification']) && $settings['budget_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'budget_notification'))); ?>

                                                <label class="form-check-label" for="budget_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>

                    </div>

                    <!--Telegram Settings-->
                    <div id="telegram-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Telegram Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Telegram settings')); ?></small>
                        </div>

                        <div class="card-body">
                            <?php echo e(Form::open(['route' => 'telegram.settings','id'=>'telegram-setting','method'=>'post' ,'class'=>'d-contents'])); ?>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label"><?php echo e(__('Telegram AccessToken')); ?></label> <br>
                                    <?php echo e(Form::text('telegram_accestoken',isset($settings['telegram_accestoken'])?$settings['telegram_accestoken']:'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram AccessToken')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label "><?php echo e(__('Telegram ChatID')); ?></label> <br>
                                    <?php echo e(Form::text('telegram_chatid',isset($settings['telegram_chatid'])?$settings['telegram_chatid']:'', ['class' => 'form-control', 'placeholder' => __('Enter Telegram ChatID')])); ?>

                                </div>
                            </div>


                            <div class="col-md-12 mt-5 mb-2">
                                <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Lead')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_lead_notification', '1',isset($settings['telegram_lead_notification']) && $settings['telegram_lead_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_lead_notification'))); ?>

                                                <label class="form-check-label" for="telegram_lead_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Deal')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_deal_notification', '1',isset($settings['telegram_deal_notification']) && $settings['telegram_deal_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_deal_notification'))); ?>

                                                <label class="form-check-label" for="telegram_deal_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Lead to Deal Conversion')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_leadtodeal_notification', '1',isset($settings['telegram_leadtodeal_notification']) && $settings['telegram_leadtodeal_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_leadtodeal_notification'))); ?>

                                                <label class="form-check-label" for="telegram_leadtodeal_notification"></label>

                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Contract')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_contract_notification', '1',isset($settings['telegram_contract_notification']) && $settings['telegram_contract_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_contract_notification'))); ?>

                                                <label class="form-check-label" for="telegram_contract_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Project')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_project_notification', '1',isset($settings['telegram_project_notification']) && $settings['telegram_project_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_project_notification'))); ?>

                                                <label class="form-check-label" for="telegram_project_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_task_notification', '1',isset($settings['telegram_task_notification']) && $settings['telegram_task_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_task_notification'))); ?>

                                                <label class="form-check-label" for="telegram_task_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Task Stage Updated')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_taskmove_notification', '1',isset($settings['telegram_taskmove_notification']) && $settings['telegram_taskmove_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_taskmove_notification'))); ?>

                                                <label class="form-check-label" for="telegram_taskmove_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Task Comment')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_taskcomment_notification', '1',isset($settings['telegram_taskcomment_notification']) && $settings['telegram_taskcomment_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_taskcomment_notification'))); ?>

                                                <label class="form-check-label" for="telegram_taskcomment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Monthly Payslip')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_payslip_notification', '1',isset($settings['telegram_payslip_notification']) && $settings['telegram_payslip_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_payslip_notification'))); ?>

                                                <label class="form-check-label" for="telegram_payslip_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Award')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_award_notification', '1',isset($settings['telegram_award_notification']) && $settings['telegram_award_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_award_notification'))); ?>

                                                <label class="form-check-label" for="telegram_award_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Announcement')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_announcement_notification', '1',isset($settings['telegram_announcement_notification']) && $settings['telegram_announcement_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_announcement_notification'))); ?>

                                                <label class="form-check-label" for="telegram_announcement_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Holiday')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_holiday_notification', '1',isset($settings['telegram_holiday_notification']) && $settings['telegram_holiday_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_holiday_notification'))); ?>

                                                <label class="form-check-label" for="telegram_holiday_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Support Ticket')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_support_notification', '1',isset($settings['telegram_support_notification']) && $settings['telegram_support_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_support_notification'))); ?>

                                                <label class="form-check-label" for="telegram_support_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Event')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_event_notification', '1',isset($settings['telegram_event_notification']) && $settings['telegram_event_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_event_notification'))); ?>

                                                <label class="form-check-label" for="telegram_event_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Meeting')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_meeting_notification', '1',isset($settings['telegram_meeting_notification']) && $settings['telegram_meeting_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_meeting_notification'))); ?>

                                                <label class="form-check-label" for="telegram_meeting_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Company Policy')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_policy_notification', '1',isset($settings['telegram_policy_notification']) && $settings['telegram_policy_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_policy_notification'))); ?>

                                                <label class="form-check-label" for="telegram_policy_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_invoice_notification', '1',isset($settings['telegram_invoice_notification']) && $settings['telegram_invoice_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_invoice_notification'))); ?>

                                                <label class="form-check-label" for="telegram_invoice_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_revenue_notification', '1',isset($settings['telegram_revenue_notification']) && $settings['telegram_revenue_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_revenue_notification'))); ?>

                                                <label class="form-check-label" for="telegram_revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_bill_notification', '1',isset($settings['telegram_bill_notification']) && $settings['telegram_bill_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_bill_notification'))); ?>

                                                <label class="form-check-label" for="telegram_bill_notification"></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice Payment')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_payment_notification', '1',isset($settings['telegram_payment_notification']) && $settings['telegram_payment_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_payment_notification'))); ?>

                                                <label class="form-check-label" for="telegram_payment_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Budget')); ?></span>
                                                <?php echo e(Form::checkbox('telegram_budget_notification', '1',isset($settings['telegram_budget_notification']) && $settings['telegram_budget_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'telegram_budget_notification'))); ?>

                                                <label class="form-check-label" for="telegram_budget_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>


                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>

                    </div>

                    <!--Twilio Settings-->
                    <div id="twilio-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Twilio Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Twilio settings')); ?></small>
                        </div>

                        <div class="card-body">
                            <?php echo e(Form::model($settings,array('route'=>'twilio.setting','method'=>'post'))); ?><div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_sid',__('Twilio SID '),array('class'=>'form-label'))); ?>

                                        <?php echo e(Form::text('twilio_sid', isset($settings['twilio_sid']) ?$settings['twilio_sid'] :'', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio SID'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_sid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-twilio_sid" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_token',__('Twilio Token'),array('class'=>'form-label'))); ?>

                                        <?php echo e(Form::text('twilio_token', isset($settings['twilio_token']) ?$settings['twilio_token'] :'', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio Token'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_token'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-twilio_token" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('twilio_from',__('Twilio From'),array('class'=>'form-label'))); ?>

                                        <?php echo e(Form::text('twilio_from', isset($settings['twilio_from']) ?$settings['twilio_from'] :'', ['class' => 'form-control w-100', 'placeholder' => __('Enter Twilio From'), 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['twilio_from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-twilio_from" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>


                                <div class="col-md-12 mt-4 mb-2">
                                    <h5 class="small-title"><?php echo e(__('Module Settings')); ?></h5>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Customer')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_customer_notification', '1',isset($settings['twilio_customer_notification']) && $settings['twilio_customer_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_customer_notification'))); ?>

                                                <label class="form-check-label" for="twilio_customer_notification"></label>
                                            </div>

                                        </li>
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Vendor')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_vender_notification', '1',isset($settings['twilio_vender_notification']) && $settings['twilio_vender_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_vender_notification'))); ?>

                                                <label class="form-check-label" for="twilio_vender_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Invoice')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_invoice_notification', '1',isset($settings['twilio_invoice_notification']) && $settings['twilio_invoice_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_invoice_notification'))); ?>

                                                <label class="form-check-label" for="twilio_invoice_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Revenue')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_revenue_notification', '1',isset($settings['twilio_revenue_notification']) && $settings['twilio_revenue_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_revenue_notification'))); ?>

                                                <label class="form-check-label" for="twilio_revenue_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Bill')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_bill_notification', '1',isset($settings['twilio_bill_notification']) && $settings['twilio_bill_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_bill_notification'))); ?>

                                                <label class="form-check-label" for="twilio_bill_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Proposal')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_proposal_notification', '1',isset($settings['twilio_proposal_notification']) && $settings['twilio_proposal_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_proposal_notification'))); ?>

                                                <label class="form-check-label" for="twilio_proposal_notification"></label>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('New Payment')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_payment_notification', '1',isset($settings['twilio_payment_notification']) && $settings['twilio_payment_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_payment_notification'))); ?>

                                                <label class="form-check-label" for="twilio_payment_notification"></label>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class=" form-switch form-switch-right">
                                                <span><?php echo e(__('Invoice Reminder')); ?></span>
                                                <?php echo e(Form::checkbox('twilio_reminder_notification', '1',isset($settings['twilio_reminder_notification']) && $settings['twilio_reminder_notification'] == '1' ?'checked':'',array('class'=>'form-check-input','id'=>'twilio_reminder_notification'))); ?>

                                                <label class="form-check-label" for="twilio_reminder_notification"></label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>

                    </div>

                    <!--Email Notification Settings-->
                    <div id="email-notification-settings" class="card">

                        <div class="col-md-12">

                            <div class="card-header">
                                <h5><?php echo e(__('Email Notification Settings')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit email notification settings')); ?></small>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class=""> -->
                                    <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <div class="list-group">
                                                <div class="list-group-item form-switch form-switch-right">
                                                    <label class="form-label" style="margin-left:5%;"><?php echo e($EmailTemplate->name); ?></label>
                                                    <input class="form-check-input email-template-checkbox" id="email_tempalte_<?php echo e(!empty($EmailTemplate->template)?$EmailTemplate->template->id:''); ?>" type="checkbox"
                                                           <?php if(!empty($EmailTemplate->template)?$EmailTemplate->template->is_active:0 == 1): ?> checked="checked" <?php endif; ?> type="checkbox" value="<?php echo e(!empty($EmailTemplate->template)?$EmailTemplate->template->is_active:1); ?>"
                                                           data-url="<?php echo e(route('status.email.language',[!empty($EmailTemplate->template)?$EmailTemplate->template->id:''])); ?>" />
                                                    <label class="form-check-label" for="email_tempalte_<?php echo e(!empty($EmailTemplate->template)?$EmailTemplate->template->id:''); ?>"></label>

                                                </div>
                                            </div>
                                        </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!-- </div> -->
                                </div>
                            <!-- <div class="card-footer p-0">
                                    <div class="col-sm-12 mt-3 px-2">
                                        <div class="text-end">
                                            <input class="btn btn-print-invoice  btn-primary " type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                        </div>
                                    </div>

                                </div> -->
                            </div>
                        </div>

                    </div>

                    <div id="offer-letter-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Offer Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                               href="#" role="button" aria-haspopup="false" aria-expanded="false"
                                               id="dropdownLanguage">
                                            <span
                                                class="drp-text hide-mob text-primary">
                                                <?php echo e(Str::upper($offerlang)); ?>

                                            </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                 aria-labelledby="dropdownLanguage">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.offerlatter.language',['noclangs'=>$noclang, 'explangs'=>$explang, 'offerlangs'=>$offerlangs, 'joininglangs'=>$joininglang ])); ?>"
                                                       class="dropdown-item ms-1 <?php echo e($offerlangs == $offerlang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($offerlangs)); ?></a>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span class="pull-end text-primary">{applicant_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job title')); ?> : <span class="pull-right text-primary">{job_title}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job type')); ?> : <span class="pull-right text-primary">{job_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Proposed Start Date')); ?> : <span class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Working Location')); ?> : <span class="pull-right text-primary">{workplace_location}</span></p>
                                                    <p class="col-4"><?php echo e(__('Days Of Week')); ?> : <span class="pull-right text-primary">{days_of_week}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary')); ?> : <span class="pull-right text-primary">{salary}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Type')); ?> : <span class="pull-right text-primary">{salary_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Duration')); ?> : <span class="pull-end text-primary">{salary_duration}</span></p>
                                                    <p class="col-4"><?php echo e(__('Offer Expiration Date')); ?> : <span class="pull-right text-primary">{offer_expiration_date}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['offerlatter.update',$offerlang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content',__(' Format'),['class'=>'form-label text-dark'])); ?>

                                    <textarea name="content"  class="summernote-simple0 summernote-simple"><?php echo isset($currOfferletterLang->content) ? $currOfferletterLang->content : ""; ?></textarea>

                                </div>




                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="joining-letter-settings"  class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Joining Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                               href="#" role="button" aria-haspopup="false" aria-expanded="false"
                                               id="dropdownLanguage1">
                                            <span
                                                class="drp-text hide-mob text-primary">

                                                <?php echo e(Str::upper($joininglang)); ?>

                                            </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                 aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $joininglangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.joiningletter.language',['noclangs'=>$noclang, 'explangs'=>$explang, 'offerlangs'=>$offerlang, 'joininglangs'=>$joininglangs ] )); ?>"
                                                       class="dropdown-item <?php echo e($joininglangs == $joininglang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($joininglangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Address')); ?> : <span class="pull-right text-primary">{address}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['joiningletter.update',$joininglang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content',__(' Format'),['class'=>'form-label text-dark'])); ?>

                                    <textarea name="content"  class="summernote-simple1 summernote-simple"><?php echo isset($currjoiningletterLang->content) ? $currjoiningletterLang->content : ""; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="experience-certificate-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Experience Certificate Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                               href="#" role="button" aria-haspopup="false" aria-expanded="false"
                                               id="dropdownLanguage1">
                                            <span
                                                class="drp-text hide-mob text-primary">

                                                <?php echo e(Str::upper($explang)); ?>

                                            </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                 aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $explangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.experiencecertificate.language',['noclangs'=>$noclang, 'explangs'=>$explangs, 'offerlangs'=>$offerlang, 'joininglangs'=>$joininglang ] )); ?>"
                                                       class="dropdown-item <?php echo e($explangs == $explang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($explangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Date of Issuance')); ?> : <span class="pull-right text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['experiencecertificate.update',$explang ], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content',__(' Format'),['class'=>'form-label text-dark'])); ?>

                                    <textarea name="content"  class="summernote-simple2 summernote-simple"><?php echo isset($curr_exp_cetificate_Lang->content) ? $curr_exp_cetificate_Lang->content : ""; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="noc-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('NOC Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                                               href="#" role="button" aria-haspopup="false" aria-expanded="false"
                                               id="dropdownLanguage1">
                                            <span
                                                class="drp-text hide-mob text-primary">

                                                <?php echo e(Str::upper($noclang)); ?>

                                            </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                 aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noclangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.noc.language', ['noclangs'=>$noclangs, 'explangs'=>$explang, 'offerlangs'=>$offerlang, 'joininglangs'=>$joininglang ])); ?>"
                                                       class="dropdown-item <?php echo e($noclangs == $noclang ? 'text-primary' : ''); ?>"><?php echo e(Str::upper($noclangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Date')); ?> : <span class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span class="pull-right text-primary">{designation}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">
                                <?php echo e(Form::open(['route' => ['noc.update',$noclang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content',__(' Format'),['class'=>'form-label text-dark'])); ?>

                                    <textarea name="content"  class="summernote-simple3 summernote-simple"><?php echo isset($currnocLang->content) ? $currnocLang->content : ""; ?></textarea>

                                </div>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="google-calender" class="card">
                        <div class="col-md-12">
                            <?php echo e(Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Google Calendar Settings')); ?></h5>
                                    </div>
                                    <div class="col switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="google_calendar_enable" id="google_calendar_enable" data-toggle="switchbutton"  data-onstyle="primary"  <?php echo e($settings['google_calendar_enable'] == 'on' ? 'checked' : ''); ?> >
                                                <label class="custom-control-label" for="google_calendar_enable"></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar id',__('Google Calendar Id'),['class'=>'col-form-label'])); ?>

                                        <?php echo e(Form::text('google_clender_id',!empty($settings['google_clender_id']) ? $settings['google_clender_id'] : '' ,array('class'=>'form-control ' ,'placeholder'=>"Google Calendar Id",'required'=>'required'))); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar json file',__('Google Calendar json File'),['class'=>'col-form-label'])); ?>

                                        <input type="file" class="form-control" name="google_calender_json_file" id="file">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div id="webhook-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Webhook Settings')); ?></h5>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create webhook')): ?>
                                        <div class="col-6 text-end">
                                        <a href="#" data-url="<?php echo e(route('webhook.create')); ?>" data-ajax-popup="true"
                                           data-title="<?php echo e(__('Create New Webhook')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                           class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Module')); ?></th>
                                            <th><?php echo e(__('Url')); ?></th>
                                            <th><?php echo e(__('Method')); ?></th>
                                            <th><?php echo e(__('Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="font-style">
                                        <?php $__empty_1 = true; $__currentLoopData = $webhookSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhooksetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($webhooksetting->module); ?></td>
                                                <td><?php echo e($webhooksetting->url); ?></td>
                                                <td><?php echo e($webhooksetting->method); ?></td>
                                                <td class="Action">
                                                    <span>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit webhook')): ?>
                                                            <div class="action-btn bg-primary ms-2">
                                                                <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                   data-url="<?php echo e(URL::to('webhook-settings/'.$webhooksetting->id.'/edit')); ?>" data-ajax-popup="true"
                                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Webhook Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete webhook')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['webhook.destroy', $webhooksetting->id],'id'=>'delete-form-'.$webhooksetting->id]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash text-white text-white"></i>
                                                                    </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr class="text-center">
                                                <td colspan="4"><?php echo e(__('No Data Found.!')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/settings/company.blade.php ENDPATH**/ ?>