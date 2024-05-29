<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Verify Email')); ?>

<?php $__env->stopSection(); ?>
<?php
  //  $logo=asset(Storage::url('uploads/logo/'));
      $logo=\App\Models\Utility::get_file('uploads/logo');
      $company_logo=Utility::getValByName('company_logo');
      if(empty($lang))
      {
          $lang = Utility::getValByName('default_language');
      }
?>

<?php $__env->startSection('auth-topbar'); ?>
    <select class="btn btn-primary my-1 me-2" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
        <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option class="" <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('verification.notice',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-xl-12">
        <div class="">
            <?php if(session('status') == 'verification-link-sent'): ?>
                <div class="mb-4 font-medium text-sm text-green-600 text-primary">
                    <?php echo e(__('A new verification link has been sent to the email address you provided during registration.')); ?>

                </div>
            <?php endif; ?>
            <div class="mb-4 text-sm text-gray-600">
                <?php echo e(__('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.')); ?>

            </div>
            <div class="mt-4 flex items-center justify-between">
                <div class="row">
                    <div class="col-auto">
                        <form method="POST" action="<?php echo e(route('verification.send')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary btn-sm"> <?php echo e(__('Resend Verification Email')); ?>

                            </button>
                        </form>
                    </div>
                    <div class="col-auto">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-danger btn-sm"><?php echo e(__('Logout')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/auth/verify.blade.php ENDPATH**/ ?>