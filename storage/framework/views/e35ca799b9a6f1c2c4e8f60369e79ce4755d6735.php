<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Leave')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Manage Leave')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create leave')): ?>
        <a href="#" data-size="lg" data-url="<?php echo e(route('leave.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Leave')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
    <div class="col-xl-12">
            <div class="card">
            <div class="card-body table-border-style">
                    <div class="table-responsive">
                    <table class="table datatable">
                            <thead>
                            <tr>
                                <?php if(\Auth::user()->type!='Employee'): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Leave Type')); ?></th>
                                <th><?php echo e(__('Applied On')); ?></th>
                                <th><?php echo e(__('Start Date')); ?></th>
                                <th><?php echo e(__('End Date')); ?></th>
                                <th><?php echo e(__('Total Days')); ?></th>
                                <th><?php echo e(__('Leave Reason')); ?></th>
                                <th><?php echo e(__('status')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Auth::user()->type!='Employee'): ?>
                                        <td><?php echo e(!empty(\Auth::user()->getEmployee($leave->employee_id))?\Auth::user()->getEmployee($leave->employee_id)->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(!empty(\Auth::user()->getLeaveType($leave->leave_type_id))?\Auth::user()->getLeaveType($leave->leave_type_id)->title:''); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($leave->applied_on )); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($leave->start_date )); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($leave->end_date )); ?></td>

                                        <td><?php echo e($leave->total_leave_days); ?></td>
                                    <td><?php echo e($leave->leave_reason); ?></td>
                                    <td>

                                        <?php if($leave->status=="Pending"): ?><div class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e($leave->status); ?></div>
                                        <?php elseif($leave->status=="Approved"): ?>
                                            <div class="status_badge badge bg-success p-2 px-3 rounded"><?php echo e($leave->status); ?></div>
                                        <?php else: ?>
                                            <div class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e($leave->status); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(\Auth::user()->type == 'Employee'): ?>
                                            <?php if($leave->status == "Pending"): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit leave')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="<?php echo e(URL::to('leave/'.$leave->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Leave')); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="#" data-url="<?php echo e(URL::to('leave/'.$leave->id.'/action')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Leave Action')); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Leave Action')); ?>" data-original-title="<?php echo e(__('Leave Action')); ?>">
                                                <i class="ti ti-caret-right text-white"></i> </a>
                                        </div>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit leave')): ?>
                                            <div class="action-btn bg-primary ms-2">
                                                <a href="#" data-url="<?php echo e(URL::to('leave/'.$leave->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Leave')); ?>" class="mx-3 btn btn-sm  align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i></a>
                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete leave')): ?>
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['leave.destroy', $leave->id],'id'=>'delete-form-'.$leave->id]); ?>

                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($leave->id); ?>').submit();">
                                            <i class="ti ti-trash text-white"></i></a>
                                            <?php echo Form::close(); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
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

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '#employee_id', function () {
            var employee_id = $(this).val();

            $.ajax({
                url: '<?php echo e(route('leave.jsoncount')); ?>',
                type: 'POST',
                data: {
                    "employee_id": employee_id, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {

                    $('#leave_type_id').empty();
                    $('#leave_type_id').append('<option value=""><?php echo e(__('Select Leave Type')); ?></option>');

                    $.each(data, function (key, value) {

                        if (value.total_leave >= value.days) {
                            $('#leave_type_id').append('<option value="' + value.id + '" disabled>' + value.title + '&nbsp(' + value.total_leave + '/' + value.days + ')</option>');
                        } else {
                            $('#leave_type_id').append('<option value="' + value.id + '">' + value.title + '&nbsp(' + value.total_leave + '/' + value.days + ')</option>');
                        }
                    });

                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/leave/index.blade.php ENDPATH**/ ?>