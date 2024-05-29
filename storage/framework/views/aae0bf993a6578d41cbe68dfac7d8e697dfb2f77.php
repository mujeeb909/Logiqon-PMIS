<?php echo e(Form::open(array('url' => 'goal'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('amount', __('Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amount', '', array('class' => 'form-control','required'=>'required','step'=>'0.01'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('type', __('Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('type',$types,null, array('class' => 'form-control select','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('from', __('From'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('from',null,array('class'=>'form-control','required'=>'required'))); ?>


        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('to', __('To'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('to',null,array('class'=>'form-control','required'=>'required'))); ?>


        </div>
        <div class="form-group col-md-12">
            <input class="form-check-input" type="checkbox" name="is_display" id="is_display" checked>
            <label class="custom-control-label form-label" for="is_display"><?php echo e(__('Display On Dashboard')); ?></label>

        </div>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>


<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/goal/create.blade.php ENDPATH**/ ?>