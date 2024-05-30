
<div class="modal-body">
    <div class="row">
        <?php if(count($users) > 0): ?>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 mb-4">
                    <div class="list-group-item px-0">
                        <div class="row ">
                            <div class="col-auto">
                                <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> class="wid-40 rounded-circle ml-3" alt="avatar image">
                            </div>
                            <div class="col">
                                <h6 class="mb-0"><?php echo e($user->name); ?></h6>
                                <p class="mb-0"><span class="text-success"><?php echo e($user->email); ?></p>
                            </div>
                            <div class="col-auto">
                                <div class="action-btn bg-info ms-2 invite_usr" data-id="<?php echo e($user->id); ?>">
                                    <button type="button" class="mx-3 btn btn-sm  align-items-center">
                                        <span class="btn-inner--visible">
                                        <i class="ti ti-plus text-white" id="usr_icon_<?php echo e($user->id); ?>"></i>
                                        </span>

                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <h5><?php echo e(__('No User Exist')); ?></h5>

            </div>
        <?php endif; ?>
    </div>
    <?php echo e(Form::hidden('project_id', $project_id,['id'=>'project_id'])); ?>

</div>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/invite.blade.php ENDPATH**/ ?>