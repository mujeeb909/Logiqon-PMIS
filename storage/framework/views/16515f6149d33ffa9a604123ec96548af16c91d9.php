<?php echo e(Form::model($formBuilder, array('route' => array('form_builder.update', $formBuilder->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required' => 'required'))); ?>

        </div>
        <div class="col-12 form-group">
            <label for="exampleColorInput" class="form-label"><?php echo e(__('Active')); ?></label>
            <div class="d-flex radio-check">
                <div class="form-check form-check-inline">
                    <input type="radio" id="on" value="1" name="is_active" class="form-check-input" <?php echo e(($formBuilder->is_active == 1) ? 'checked' : ''); ?>>
                    <label class="custom-control-label form-label" for="on"><?php echo e(__('On')); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="off" value="0" name="is_active" class="form-check-input" <?php echo e(($formBuilder->is_active == 0) ? 'checked' : ''); ?>>
                    <label class="custom-control-label form-label" for="off"><?php echo e(__('Off')); ?></label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/form_builder/edit.blade.php ENDPATH**/ ?>