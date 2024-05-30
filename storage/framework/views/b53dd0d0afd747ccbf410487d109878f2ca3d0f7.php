<?php
    $user = json_decode($users->Details);
?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Status')); ?></b></div>
            <p class="text-muted mb-4"><?php echo e($user->status); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Country')); ?> </b></div>
            <p class="text-muted mb-4"><?php echo e($user->country); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Country Code')); ?> </b></div>
            <p class="text-muted mb-4"><?php echo e($user->countryCode); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Region')); ?></b></div>
            <p class="mt-1"><?php echo e($user->region); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Region Name')); ?></b></div>
            <p class="mt-1"><?php echo e($user->regionName); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('City')); ?></b></div>
            <p class="mt-1"><?php echo e($user->city); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Zip')); ?></b></div>
            <p class="mt-1"><?php echo e($user->zip); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Latitude')); ?></b></div>
            <p class="mt-1"><?php echo e($user->lat); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Longitude')); ?></b></div>
            <p class="mt-1"><?php echo e($user->lon); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Timezone')); ?></b></div>
            <p class="mt-1"><?php echo e($user->timezone); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Isp')); ?></b></div>
            <p class="mt-1"><?php echo e($user->isp); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Org')); ?></b></div>
            <p class="mt-1"><?php echo e($user->org); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('As')); ?></b></div>
            <p class="mt-1"><?php echo e($user->as); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Query')); ?></b></div>
            <p class="mt-1"><?php echo e($user->query); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Browser Name')); ?></b></div>
            <p class="mt-1"><?php echo e($user->browser_name); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Os Name')); ?></b></div>
            <p class="mt-1"><?php echo e($user->os_name); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Browser Language')); ?></b></div>
            <p class="mt-1"><?php echo e($user->browser_language); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Device Type')); ?></b></div>
            <p class="mt-1"><?php echo e($user->device_type); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Referrer Host')); ?></b></div>
            <p class="mt-1"><?php echo e($user->referrer_host); ?></p>
        </div>
        <div class="col-md-6 ">
            <div class="form-control-label"><b><?php echo e(__('Referrer Path')); ?></b></div>
            <p class="mt-1"><?php echo e($user->referrer_path); ?></p>
        </div>
    </div>
</div>


<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/user/userlogview.blade.php ENDPATH**/ ?>