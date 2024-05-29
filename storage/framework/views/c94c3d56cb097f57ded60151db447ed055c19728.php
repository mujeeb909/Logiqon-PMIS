<?php echo e(Form::open(array('url'=>'loan','method'=>'post'))); ?>

<?php echo e(Form::hidden('employee_id',$employee->id, array())); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title', __('Title'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('title',null, array('class' => 'form-control ','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('loan_option', __('Loan Options'),['class'=>'form-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('loan_option',$loan_options,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('type', __('Type'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('type', $loan, null, ['class' => 'form-control select amount_type', 'required' => 'required'])); ?>

        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Loan Amount'),['class'=>'form-label amount_label'])); ?>

            <?php echo e(Form::number('amount',null, array('class' => 'form-control ','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('start_date',null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('end_date',null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('reason', __('Reason'))); ?>

                <?php echo e(Form::textarea('reason',null, array('class' => 'form-control ','required'=>'required'))); ?>

            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/loan/create.blade.php ENDPATH**/ ?>