<?php echo e(Form::open(array('url'=>'award','method'=>'post'))); ?>

<div class="modal-body">

    <div class="row">
        <div class="form-group col-md-6 col-lg-6 ">
            <?php echo e(Form::label('employee_id', __('Employee'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('employee_id', $employees,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('award_type', __('Award Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('award_type', $awardtypes,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('date',__('Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('gift',__('Gift'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('gift',null,array('class'=>'form-control','placeholder'=>__('Enter Gift')))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',__('Description'))); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Description')))); ?>

        </div>
        
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

    <?php echo e(Form::close()); ?>

<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/award/create.blade.php ENDPATH**/ ?>