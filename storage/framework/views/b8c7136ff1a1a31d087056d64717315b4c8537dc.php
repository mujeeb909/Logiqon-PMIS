<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Appraisal')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Appraisal')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <style>
        @import url(<?php echo e(asset('css/font-awesome.css')); ?>);
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/bootstrap-toggle.js')); ?>"></script>
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();
            $("fieldset[id^='demo'] .stars").click(function () {
                alert($(this).val());
                $(this).attr("checked");
            });
        });

        $(document).ready(function () {
            var employee = $('#employee').val();
            getEmployee(employee);
        });

        $(document).on('change', 'select[name=branch]', function () {
            var branch = $(this).val();
            getEmployee(branch);
        });

        function getEmployee(did) {
            $.ajax({
                url: '<?php echo e(route('branch.employee.json')); ?>',
                type: 'POST',
                data: {
                    "branch": did, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#employee').empty();
                    $('#employee').append('<option value=""><?php echo e(__('Select Employee')); ?></option>');
                    $.each(data, function (key, value) {
                        $('#employee').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }


    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create appraisal')): ?>
       <a href="#" data-size="lg" data-url="<?php echo e(route('appraisal.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Appraisal')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Department')); ?></th>
                                <th><?php echo e(__('Designation')); ?></th>
                                <th><?php echo e(__('Employee')); ?></th>
                                <th><?php echo e(__('Target Rating')); ?></th>
                                <th><?php echo e(__('Overall Rating')); ?></th>
                                <th><?php echo e(__('Appraisal Date')); ?></th>
                                <?php if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody class="font-style">
                            <?php $__currentLoopData = $appraisals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appraisal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                                    $designation=!empty($appraisal->employees) ?  $appraisal->employees->designation->id : 0;
                                    $targetRating =  Utility::getTargetrating($designation,$competencyCount);
                                    if(!empty($appraisal->rating)&&($competencyCount!=0))
                                    {
                                        $rating = json_decode($appraisal->rating,true);
                                        $starsum = array_sum($rating);
                                        $overallrating = $starsum/$competencyCount;
                                    }
                                    else{
                                        $overallrating = 0;
                                    }
                                ?>

                                <?php
                                    if(!empty($appraisal->rating)){
                                        $rating = json_decode($appraisal->rating,true);
                                        $starsum = !empty($rating)?array_sum($rating):0;
                                        $overallrating = ($starsum!=0)? $starsum/count($rating):0;
                                    }
                                    else{
                                        $overallrating = 0;
                                    }
                                ?>
                                <tr>
                                    <td><?php echo e(!empty($appraisal->branches)?$appraisal->branches->name:''); ?></td>
                                    <td><?php echo e(!empty($appraisal->employees)?!empty($appraisal->employees->department)?$appraisal->employees->department->name:'':''); ?></td>
                                    <td><?php echo e(!empty($appraisal->employees)?!empty($appraisal->employees->designation)?$appraisal->employees->designation->name:'':''); ?></td>
                                    <td><?php echo e(!empty($appraisal->employees)?$appraisal->employees->name:''); ?></td>

                                    <td >
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($targetRating < $i): ?>
                                                <?php if(is_float($targetRating) && (round($targetRating) == $i)): ?>
                                                    <i class="text-warning fas fa-star-half-alt"></i>
                                                <?php else: ?>
                                                    <i class="fas fa-star"></i>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <i class="text-warning fas fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="theme-text-color">(<?php echo e(number_format($targetRating,1)); ?>)</span>
                                    </td>


                                    <td>

                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($overallrating < $i): ?>
                                                <?php if(is_float($overallrating) && (round($overallrating) == $i)): ?>
                                                    <i class="text-warning fas fa-star-half-alt"></i>
                                                <?php else: ?>
                                                    <i class="fas fa-star"></i>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <i class="text-warning fas fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="theme-text-color">(<?php echo e(number_format($overallrating,1)); ?>)</span>
                                    </td>
                                    <td><?php echo e($appraisal->appraisal_date); ?></td>
                                    <?php if( Gate::check('edit appraisal') ||Gate::check('delete appraisal') ||Gate::check('show appraisal')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show appraisal')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="<?php echo e(route('appraisal.show',$appraisal->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Appraisal Detail')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('View')); ?>" data-original-title="<?php echo e(__('View Detail')); ?>" class="mx-3 btn btn-sm align-items-center">
                                                    <i class="ti ti-eye text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit appraisal')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="<?php echo e(route('appraisal.edit',$appraisal->id)); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Appraisal')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>" class="mx-3 btn btn-sm align-items-center">
                                                <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                                <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete appraisal')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['appraisal.destroy', $appraisal->id],'id'=>'delete-form-'.$appraisal->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($appraisal->id); ?>').submit();">
                                                <i class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/appraisal/index.blade.php ENDPATH**/ ?>