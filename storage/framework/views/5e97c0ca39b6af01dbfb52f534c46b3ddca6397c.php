<?php echo e(Form::open(array('url' => 'contract'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('client_name', __('Client'),['class'=>'form-label'])); ?>

            
            <?php echo e(Form::select('client_name', $clients, null, ['class' => 'form-control select client_select', 'id' => 'client_select'])); ?>


        </div>
        <div class="form-group col-md-6" >
            <?php echo e(Form::label('projects', __('Projects'),['class'=>'form-label'])); ?>

            <select class="form-control select project_select" id="project_id" name="project_id" >
                <option value=""><?php echo e(__('Select Project')); ?></option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('type', __('Contract Type'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('type', $contractTypes,null, array('class' => 'form-control','data-toggle="select"','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('value', __('Contract Value'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('value', '', array('class' => 'form-control','required'=>'required','stage'=>'0.01'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('start_date', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('end_date', __('End Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('end_date', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'3']); ?>

        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<script src="<?php echo e(asset('assets/js/plugins/choices.min.js')); ?>"></script>
<script>
    if ($(".multi-select").length > 0) {
        $( $(".multi-select") ).each(function( index,element ) {
            var id = $(element).attr('id');
            var multipleCancelButton = new Choices(
                '#'+id, {
                    removeItemButton: true,
                }
            );
        });
    }
</script>

<script type="text/javascript">

    $( ".client_select" ).change(function() {

        var client_id = $(this).val();
        getparent(client_id);
    });

    function getparent(bid) {

        $.ajax({
            url: `<?php echo e(url('contract/clients/select')); ?>/${bid}`,
            type: 'GET',
            success: function (data) {
                console.log(data);
                $("#project_id").html('');
                $('#project_id').append('<select class="form-control" id="project_id" name="project_id[]"  ></select>');
                //var sdfdsfd = JSON.parse(data);
                $.each(data, function (i, item) {
                    console.log(item);
                    $('#project_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                });

                // var multipleCancelButton = new Choices('#project_id', {
                //     removeItemButton: true,
                // });

                if (data == '') {
                    $('#project_id').empty();
                }
            }
        });
    }

</script>

<?php /**PATH C:\xampp\htdocs\ERP\resources\views/contract/create.blade.php ENDPATH**/ ?>