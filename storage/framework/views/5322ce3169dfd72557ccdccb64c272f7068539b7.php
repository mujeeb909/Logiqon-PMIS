<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Register')); ?>

<?php $__env->stopSection(); ?>
<?php
  //  $logo=asset(Storage::url('uploads/logo/'));
$logo=\App\Models\Utility::get_file('uploads/logo');
?>
<?php $__env->startPush('custom-scripts'); ?>
    <?php if(env('RECAPTCHA_MODULE') == 'on'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('auth-topbar'); ?>
    <li class="nav-item ">
        <select class="btn btn-primary my-1 me-2 " onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" id="language">
            <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option class="" <?php if($lang == $language): ?> selected <?php endif; ?> value="<?php echo e(route('register',$language)); ?>"><?php echo e(Str::upper($language)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="">
        <h2 class="mb-3 f-w-600"><?php echo e(__('Register')); ?></h2>
    </div>
    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php if(session('status')): ?>
            <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                <?php echo e(__('Email SMTP settings does not configured so please contact to your site admin.')); ?>

            </div>
        <?php endif; ?>
        <?php echo csrf_field(); ?>
        <div class="">
            <div class="form-group mb-3">
                <label for="name" class="form-label"><?php echo e(__('Name')); ?></label>
                <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label"><?php echo e(__('Email')); ?></label>
                <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="invalid-feedback">
                    <?php echo e(__('Please fill in your email')); ?>

                </div>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label"><?php echo e(__('Password')); ?></label>
                <input id="password" type="password" data-indicator="pwindicator" class="form-control pwstrength <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label"><?php echo e(__('Password Confirmation')); ?></label>
                <input id="password_confirmation" type="password" data-indicator="password_confirmation" class="form-control pwstrength <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password_confirmation" required autocomplete="new-password">
                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div id="password_confirmation" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            <?php if(env('RECAPTCHA_MODULE') == 'on'): ?>
                <div class="form-group mb-3">
                    <?php echo NoCaptcha::display(); ?>

                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="small text-danger" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endif; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block mt-2"><?php echo e(__('Register')); ?></button>
            </div>

        </div>
        <p class="my-4 text-center"><?php echo e(__("Already' have an account?")); ?> <a href="<?php echo e(route('login',!empty(\Auth::user()->lang)?\Auth::user()->lang:'en')); ?>" class="text-primary"><?php echo e(__('Login')); ?></a></p>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ERP\resources\views/auth/register.blade.php ENDPATH**/ ?>