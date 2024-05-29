<?php echo e(Form::open(array('url'=>'commission','method'=>'post'))); ?>

<?php echo e(Form::hidden('employee_id',$employee->id, array())); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title', __('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type', __('Type'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('type', $commissions, null, ['class' => 'form-control select amount_type', 'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-label amount_label'])); ?>

            <?php echo e(Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01'))); ?>

        </div>

    </div>
</div>
    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    </div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/commission/create.blade.php ENDPATH**/ ?>