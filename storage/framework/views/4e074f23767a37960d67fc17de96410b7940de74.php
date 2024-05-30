<?php echo e(Form::model($project, array('route' => array('project.copy.store', $project->id), 'method' => 'POST'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('project','all','', ['class' => 'form-check-input ','id'=>'all'])); ?>

                    <?php echo e(Form::label('all', __('All'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('task[]','task','', ['class' => 'form-check-input checkbox','id'=>'task'])); ?>

                    <?php echo e(Form::label('task', __('Task'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="row mx-4">
                <div class="col-4 form-group">
                    <div class="form-check">
                        <?php echo e(Form::checkbox('task[]','sub_task','', ['class' => 'form-check-input checkbox task','id'=>'sub_task'])); ?>

                        <?php echo e(Form::label('sub_task', __('Sub Task'),['class'=>'form-check-label'])); ?>

                    </div>
                </div>
                <div class="col-4 form-group">
                    <div class="form-check">
                        <?php echo e(Form::checkbox('task[]','task_comment','', ['class' => 'form-check-input checkbox task','id'=>'task_comment'])); ?>

                        <?php echo e(Form::label('task_comment', __('Comment'),['class'=>'form-check-label'])); ?>

                    </div>
                </div>
                <div class="col-4 form-group">
                    <div class="form-check">
                        <?php echo e(Form::checkbox('task[]','task_files','', ['class' => 'form-check-input checkbox task','id'=>'task_files'])); ?>

                        <?php echo e(Form::label('task_files', __('Files'),['class'=>'form-check-label'])); ?>

                    </div>
                </div>
            </div>
            
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('bug[]','bug','', ['class' => 'form-check-input checkbox','id'=>"bug"])); ?>

                    <?php echo e(Form::label('bug', __('Bug'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="row mx-4">
                    <div class="col-6 form-group">
                        <div class="form-check">
                            <?php echo e(Form::checkbox('bug[]','bug_comment','', ['class' => 'form-check-input checkbox bug','id'=>'bug_comment'])); ?>

                            <?php echo e(Form::label('bug_comment', __('Comment'),['class'=>'form-check-label'])); ?>

                        </div>
                    </div>
                <div class="col-6 form-group">
                    <div class="form-check">
                        <?php echo e(Form::checkbox('bug[]','bug_files','', ['class' => 'form-check-input checkbox bug','id'=>'bug_files'])); ?>

                        <?php echo e(Form::label('bug_files', __('Files'),['class'=>'form-check-label'])); ?>

                    </div>
                </div>
            </div>

            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('user[]','user','', ['class' => 'form-check-input checkbox','id'=>"user"])); ?>

                    <?php echo e(Form::label('user', __('Team Member'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('client[]','client','', ['class' => 'form-check-input checkbox','id'=>"client"])); ?>

                    <?php echo e(Form::label('client', __('Client'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('milestone[]','milestone','', ['class' => 'form-check-input checkbox','id'=>"milestone"])); ?>

                    <?php echo e(Form::label('milestone', __('Milestone'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('project_file[]','project_file','', ['class' => 'form-check-input checkbox','id'=>"project_file"])); ?>

                    <?php echo e(Form::label('project_file', __('Project File'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
            <div class="form-group m-2">
                <div class="form-check">
                    <?php echo e(Form::checkbox('activity[]','activity','', ['class' => 'form-check-input checkbox','id'=>"activity"])); ?>

                    <?php echo e(Form::label('activity', __('Activity'),['class'=>'form-check-label'])); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Copy')); ?></button>
</div>

<?php echo e(Form::close()); ?>


<script>
    $(document).ready(function(){
        $('#all').on('click',function(){
            if(this.checked){
                $('.checkbox').each(function(){
                    this.checked = true;
                });
            }else{
                $('.checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
        $("#sub_task").click(function(){
            $("#task").prop("checked", true);
        });
        $("#task_comment").click(function(){
            $("#task").prop("checked", true);
        });
        $("#task_files").click(function(){
            $("#task").prop("checked", true);
        });
        $("#bug_comment").click(function(){
            $("#bug").prop("checked", true);
        });
        $("#bug_files").click(function(){
            $("#bug").prop("checked", true);
        });

        $('#task').on('click',function(){
            $('.task').each(function(){
                this.checked = false;
            });
        });
        $('#bug').on('click',function(){
            $('.bug').each(function(){
                this.checked = false;
            });
        });
    });
</script>

<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/copy.blade.php ENDPATH**/ ?>