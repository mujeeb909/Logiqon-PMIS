<?php echo e(Form::open(array('url' => 'warehouse'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('address',__('Address'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::textarea('address',null,array('class'=>'form-control','rows'=>3))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city',__('City'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('city',null,array('class'=>'form-control'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('city_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

            <?php echo e(Form::text('city_zip',null,array('class'=>'form-control'))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/warehouse/create.blade.php ENDPATH**/ ?>