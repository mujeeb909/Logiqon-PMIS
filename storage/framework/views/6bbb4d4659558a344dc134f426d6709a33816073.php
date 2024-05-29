<?php echo e(Form::open(array('url'=>'leave','method'=>'post'))); ?>

    <div class="modal-body">

    <?php if(\Auth::user()->type =='company'): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('employee_id',__('Employee') ,['class'=>'form-label'])); ?>

                    <?php echo e(Form::select('employee_id',$employees,null,array('class'=>'form-control select','id'=>'employee_id','placeholder'=>__('Select Employee')))); ?>

                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_type_id',__('Leave Type') ,['class'=>'form-label'])); ?>

                <select name="leave_type_id" id="leave_type_id" class="form-control select">
                    <?php $__currentLoopData = $leavetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($leave->id); ?>"><?php echo e($leave->title); ?> (<p class="float-right pr-5"><?php echo e($leave->days); ?></p>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

                <?php echo e(Form::date('start_date',null,array('class'=>'form-control'))); ?>



            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

                <?php echo e(Form::date('end_date',null,array('class'=>'form-control'))); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('leave_reason',__('Leave Reason') ,['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('leave_reason',null,array('class'=>'form-control','placeholder'=>__('Leave Reason')))); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('remark',__('Remark'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('remark',null,array('class'=>'form-control','placeholder'=>__('Leave Remark')))); ?>

            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/leave/create.blade.php ENDPATH**/ ?>