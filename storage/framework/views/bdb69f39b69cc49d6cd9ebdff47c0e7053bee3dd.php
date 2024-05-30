<?php echo e(Form::open(array('url' => 'deals'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('name', __('Deal Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('phone', __('Phone'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('phone', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('price', __('Price'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('price', 0, array('class' => 'form-control','min'=>0))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('clients', __('Clients'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('clients[]', $clients,null, array('class' => 'form-control select2','multiple'=>'','id'=>'choices-multiple1','required'=>'required'))); ?>

            <?php if(count($clients) <= 0 && Auth::user()->type == 'Owner'): ?>
                <div class="text-muted text-xs">
                    <?php echo e(__('Please create new clients')); ?> <a href="<?php echo e(route('clients.index')); ?>"><?php echo e(__('here')); ?></a>.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/deals/create.blade.php ENDPATH**/ ?>