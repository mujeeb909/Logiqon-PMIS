<!DOCTYPE html>
<?php
    use App\Models\Utility;

        // $logo=asset(Storage::url('uploads/logo/'));
        $logo=\App\Models\Utility::get_file('uploads/logo/');
        $company_logo=Utility::getValByName('company_logo_dark');
        $company_logos=Utility::getValByName('company_logo_light');
        $company_favicon=Utility::getValByName('company_favicon');
        $setting = \App\Models\Utility::colorset();
        $mode_setting = \App\Models\Utility::mode_layout();
        $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
        $company_logo = \App\Models\Utility::GetLogo();
        $SITE_RTL= isset($setting['SITE_RTL'])?$setting['SITE_RTL']:'off';

    $getseo= App\Models\Utility::getSeoSetting();
    $metatitle =  isset($getseo['meta_title']) ? $getseo['meta_title'] :'';
    $metsdesc= isset($getseo['meta_desc'])?$getseo['meta_desc']:'';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image'])?$getseo['meta_image']:'';
    $get_cookie = \App\Models\Utility::getCookieSetting();

?>


<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(isset($setting['SITE_RTL']) && $setting['SITE_RTL'] == 'on' ? 'rtl' : ''); ?>">

<head>
    <title><?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'ERPGO')); ?> - <?php echo $__env->yieldContent('page-title'); ?></title>

    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metsdesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metsdesc); ?>">
    <meta property="og:image" content="<?php echo e($meta_image.$meta_logo); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metsdesc); ?>">
    <meta property="twitter:image" content="<?php echo e($meta_image.$meta_logo); ?>">


    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content="Dashboard Template Description"/>
    <meta name="keywords" content="Dashboard Template"/>
    <meta name="author" content="Rajodiya Infotech"/>

    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" type="image/x-icon"/>

    <!-- font css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">

    <!-- vendor css -->

<?php if($setting['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-rtl.css')); ?>" id="main-style-link">
    <?php endif; ?>
    <?php if($setting['cust_darklayout']=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>



    <link rel="stylesheet" href="<?php echo e(asset('assets/css/customizer.css')); ?>">

</head>

<body class="<?php echo e($color); ?>">
<div class="auth-wrapper auth-v3">
    <div class="bg-auth-side bg-primary"></div>
    <div class="auth-content">
        <nav class="navbar navbar-expand-md navbar-light default">
            <div class="container-fluid pe-2">
                <a class="navbar-brand" href="#">

                    <?php if($mode_setting['cust_darklayout'] && $mode_setting['cust_darklayout'] == 'on' ): ?>
                        <img src="<?php echo e($logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png')); ?>"
                             alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo w-50">
                    <?php else: ?>
                        <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                             alt="<?php echo e(config('app.name', 'ERPGo-SaaS')); ?>" class="logo w-50">
                    <?php endif; ?>
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="flex-grow: 0;">
                    <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Support</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Terms</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Privacy</a>
                        </li>
                        <?php echo $__env->yieldContent('auth-topbar'); ?>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="card">
            <div class="row align-items-center text-start">
                <div class="col-xl-6">
                    <div class="card-body">
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                </div>
                <div class="col-xl-6 img-card-side">
                    <div class="auth-img-content">
                        <img
                            src="<?php echo e(asset('assets/images/auth/img-auth-3.svg')); ?>"
                            alt=""
                            class="img-fluid"
                        />
                        <h3 class="text-white mb-4 mt-5">
                            “Attention is the new currency”
                        </h3>
                        <p class="text-white">
                            The more effortless the writing looks, the more effort the
                            writer actually put into the process.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="auth-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <p class="">
                            <?php echo e((Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright ERPGO')); ?> <?php echo e(date('Y')); ?>

                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="<?php echo e(asset('assets/js/vendor-all.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script>
    feather.replace();
</script>


<script>
    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
        pctoggle.addEventListener("click", function () {
            if (
                !document.querySelector(".pct-customizer").classList.contains("active")
            ) {
                document.querySelector(".pct-customizer").classList.add("active");
            } else {
                document.querySelector(".pct-customizer").classList.remove("active");
            }
        });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function (event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }



    var custthemebg = document.querySelector("#cust-theme-bg");
    custthemebg.addEventListener("click", function () {
        if (custthemebg.checked) {
            document.querySelector(".dash-sidebar").classList.add("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.add("transprent-bg");
        } else {
            document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
            document
                .querySelector(".dash-header:not(.dash-mob-header)")
                .classList.remove("transprent-bg");
        }
    });

    var custdarklayout = document.querySelector("#cust-darklayout");
    custdarklayout.addEventListener("click", function () {
        if (custdarklayout.checked) {
            document
                .querySelector(".m-header > .b-brand > .logo-lg")
                .setAttribute("src", "<?php echo e(asset('assets/images/logo.svg')); ?>");
            document
                .querySelector("#main-style-link")
                .setAttribute("href", "<?php echo e(asset('assets/css/style-dark.css')); ?>");
        } else {
            document
                .querySelector(".m-header > .b-brand > .logo-lg")
                .setAttribute("src", "<?php echo e(asset('assets/images/logo-dark.png')); ?>");
            document
                .querySelector("#main-style-link")
                .setAttribute("href", "<?php echo e(asset('assets/css/style.css')); ?>");
        }
    });

    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>
<?php echo $__env->yieldPushContent('custom-scripts'); ?>


<?php if($get_cookie['enable_cookie'] == 'on'): ?>
    <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/layouts/auth.blade.php ENDPATH**/ ?>