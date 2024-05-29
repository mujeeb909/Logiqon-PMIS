<?php
    $users=\Auth::user();
    //$profile=asset(Storage::url('uploads/avatar/'));
    $profile=\App\Models\Utility::get_file('uploads/avatar/');
    $languages=\App\Models\Utility::languages();
    $lang = isset($users->lang)?$users->lang:'en';
    $setting = \App\Models\Utility::colorset();
    $mode_setting = \App\Models\Utility::mode_layout();


    $unseenCounter=App\Models\ChMessage::where('to_id', Auth::user()->id)->where('seen', 0)->count();
?>
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
<?php else: ?>
    <header class="dash-header">
<?php endif; ?>
    <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled">
                <li class="dash-h-item mob-hamburger">
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="dropdown dash-h-item drp-company">
                    <a
                        class="dash-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <span class="theme-avtar">
                             <img src="<?php echo e(!empty(\Auth::user()->avatar) ? $profile . \Auth::user()->avatar :  $profile.'avatar.png'); ?>" class="img-fluid rounded-circle">
                        </span>
                        <span class="hide-mob ms-2"><?php echo e(__('Hi, ')); ?><?php echo e(\Auth::user()->name); ?>!</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <!-- <a href="<?php echo e(route('change.mode')); ?>" class="dropdown-item">
                            <i class="ti ti-circle-plus"></i>
                            <span><?php echo e((Auth::user()->mode == 'light') ? __('Dark Mode') : __('Light Mode')); ?></span>
                        </a> -->

                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('Profile')); ?></span>
                        </a>

                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

                        </form>

                    </div>
                </li>

            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
                <?php if( \Auth::user()->type !='client' && \Auth::user()->type !='super admin' ): ?>
                    <li class="dropdown dash-h-item drp-notification">
                        <a class="dash-head-link arrow-none me-0" href="<?php echo e(url('chats')); ?>" aria-haspopup="false"
                           aria-expanded="false">
                            <i class="ti ti-brand-hipchat"></i>
                            <span class="bg-danger dash-h-badge message-toggle-msg  message-counter custom_messanger_counter beep"> <?php echo e($unseenCounter); ?><span
                                    class="sr-only"></span>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>




                <li class="dropdown dash-h-item drp-language">
                    <a
                        class="dash-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob"><?php echo e(Str::upper(isset($lang)?$lang:'en')); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">

                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language',$language)); ?>" class="dropdown-item <?php if($language == $lang): ?> text-danger <?php endif; ?>">
                                <span><?php echo e(Str::upper($language)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <h></h>
                            <?php if(\Auth::user()->type=='super admin'): ?>

                                <a class="dropdown-item text-primary" href="<?php echo e(route('manage.language',[isset($lang)?$lang:'en'])); ?>"><?php echo e(__('Manage Language ')); ?></a>
                            <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </header>
<?php /**PATH C:\xampp\htdocs\ERP\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>