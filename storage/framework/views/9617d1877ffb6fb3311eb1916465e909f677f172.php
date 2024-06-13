
<div class="modal-body">
    <div class="row">
        <?php $__currentLoopData = $response; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $que => $ans): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 text-xs">
                <h6 class="text-small"><?php echo e($que); ?></h6>
                <p class="text-sm"><?php echo e($ans); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/form_builder/response_detail.blade.php ENDPATH**/ ?>