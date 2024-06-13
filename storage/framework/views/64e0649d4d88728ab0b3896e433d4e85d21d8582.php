<?php echo e(Form::open(array('route' => ['form.field.store',$formbuilder->id]))); ?>

<div class="modal-body">
    <div class="row" id="frm_field_data">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Question Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name[]', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('type', __('Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('type[]', $types,null, array('class' => 'form-control select2','id'=>'choices-multiple1','required'=>'required'))); ?>

        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/form_builder/field_create.blade.php ENDPATH**/ ?>