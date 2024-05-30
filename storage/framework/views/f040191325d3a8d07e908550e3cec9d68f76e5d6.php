<?php echo e(Form::open(['route' => ['projects.tasks.store',$project_id,$stage_id],'id' => 'create_task'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Task name'),['class' => 'form-label'])); ?><span class="text-danger">*</span>
                <?php echo e(Form::text('name', null, ['class' => 'form-control','required'=>'required'])); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('milestone_id', __('Milestone'),['class' => 'form-label'])); ?>

                <select class="form-control select2" name="milestone_id" id="milestone_id">
                    <option value="0" class="text-muted"><?php echo e(__('Choose Milestone')); ?></option>
                    <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m_val->id); ?>"><?php echo e($m_val->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('description', __('Description'),['class' => 'form-label'])); ?>

                <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('This textarea will autosize while you type')); ?></small>
                <?php echo e(Form::textarea('description', null, ['class' => 'form-control','rows'=>'1','data-toggle' => 'autosize'])); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('estimated_hrs', __('Estimated Hours'),['class' => 'form-label'])); ?><span class="text-danger">*</span>
                <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('allocated total ').$hrs['allocated'].__(' hrs in other tasks')); ?></small>
                <?php echo e(Form::number('estimated_hrs', null, ['class' => 'form-control','required' => 'required','min'=>'0','maxlength' => '8'])); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('priority', __('Priority'),['class' => 'form-label'])); ?>

                <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('Set Priority of your task')); ?></small>
                <select class="form-control select2" name="priority" id="priority" required>
                    <?php $__currentLoopData = \App\Models\ProjectTask::$priority; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>"><?php echo e(__($val)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'),['class' => 'form-label'])); ?>

                <?php echo e(Form::date('start_date', null, ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'),['class' => 'form-label'])); ?>

                <?php echo e(Form::date('end_date', null, ['class' => 'form-control'])); ?>

            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label"><?php echo e(__('Task members')); ?></label>
        <small class="form-text text-muted mb-2 mt-0"><?php echo e(__('Below users are assigned in your project.')); ?></small>
    </div>
    <div class="list-group list-group-flush mb-4">
        <div class="row">
            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                    <div class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="#" class="avatar avatar-sm rounded-circle">
                                    <img class="wid-40 rounded-circle ml-3" data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>/>
                                </a>
                            </div>
                            <div class="col">
                                <p class="d-block h6 text-sm mb-0"><?php echo e($user->name); ?></p>
                                <p class="card-text text-sm text-muted mb-0"><?php echo e($user->email); ?></p>
                            </div>
                            <div class="col-auto text-end add_usr" data-id="<?php echo e($user->id); ?>">
                                <button type="button" class="btn btn-xs btn-animated btn-blue rounded-pill btn-animated-y mr-3">
                                    <span class="btn-inner--visible">
                                      <i class="ti ti-plus" id="usr_icon_<?php echo e($user->id); ?>"></i>
                                    </span>
                                    <span class="btn-inner--hidden text-white" id="usr_txt_<?php echo e($user->id); ?>"><?php echo e(__('Add')); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e(Form::hidden('assign_to', null)); ?>

    </div>
    <?php if(isset($settings['google_calendar_enable']) && $settings['google_calendar_enable'] == 'on'): ?>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('synchronize_type',__('Synchronize in Google Calendar ?'),array('class'=>'form-label'))); ?>

            <div class="form-switch">
                <input type="checkbox" class="form-check-input mt-2" name="synchronize_type" id="switch-shadow" value="google_calender">
                <label class="form-check-label" for="switch-shadow"></label>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/project_task/create.blade.php ENDPATH**/ ?>