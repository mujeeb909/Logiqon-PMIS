
<?php echo e(Form::model($milestone, array('route' => array('project.milestone.update', $milestone->id), 'method' => 'POST'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-6">
            <?php echo e(Form::label('title', __('Title'),['class' => 'form-label'])); ?>

            <?php echo e(Form::text('title', null, array('class' => 'form-control','required'=>'required'))); ?>

            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-title" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('status', __('Status'),['class' => 'form-label'])); ?>

            <?php echo Form::select('status',\App\Models\Project::$project_status, null,array('class' => 'form-control selectric select','required'=>'required')); ?>

            <?php $__errorArgs = ['client'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="invalid-client" role="alert">
                <strong class="text-danger"><?php echo e($message); ?></strong>
            </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('start_date', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-6">
            <?php echo e(Form::label('due_date', __('Due Date'),['class' => 'col-form-label'])); ?>

            <?php echo e(Form::date('due_date', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('cost', __('Cost'),['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('cost', null, array('class' => 'form-control','required'=>'required','stage'=>'0.01'))); ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group  col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class' => 'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="task-summary" class="col-form-label"><?php echo e(__('Progress')); ?></label>
            <input type="range" class="slider w-100 mb-0 " name="progress" id="myRange" value="<?php echo e(($milestone->progress)?$milestone->progress:'0'); ?>" min="0" max="100" oninput="ageOutputId.value = myRange.value">
            <output name="ageOutputName" id="ageOutputId"><?php echo e(($milestone->progress)?$milestone->progress:"0"); ?></output>
            %
        </div>
</div>


    <div class="modal-footer">
        <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
        <input type="submit" value="<?php echo e(__('Edit')); ?>" class="btn btn-primary">
    </div>

<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/milestoneEdit.blade.php ENDPATH**/ ?>