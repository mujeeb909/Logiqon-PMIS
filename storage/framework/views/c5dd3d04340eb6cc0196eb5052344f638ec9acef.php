
<?php echo e(Form::model($client, array('route' => array('clients.update', $client->id), 'method' => 'PUT'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','placeholder'=>__('Enter Client Name'),'required'=>'required'))); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('email', __('E-Mail Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::email('email', null, array('class' => 'form-control','placeholder'=>__('Enter Client Email'),'required'=>'required'))); ?>

        </div>

        <?php if(!$customFields->isEmpty()): ?>
            <?php echo $__env->make('custom_fields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>



<?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/clients/edit.blade.php ENDPATH**/ ?>