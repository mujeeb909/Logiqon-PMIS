<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Attendance List')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $('input[name="type"]:radio').on('change', function (e) {
            var type = $(this).val();

            if (type == 'monthly') {
                $('.month').addClass('d-block');
                $('.month').removeClass('d-none');
                $('.date').addClass('d-none');
                $('.date').removeClass('d-block');
            } else {
                $('.date').addClass('d-block');
                $('.date').removeClass('d-none');
                $('.month').addClass('d-none');
                $('.month').removeClass('d-block');
            }
        });

        $('input[name="type"]:radio:checked').trigger('change');

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Attendance')); ?></li>
<?php $__env->stopSection(); ?>








<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-sm-12">
                    <?php if(session('status')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo session('status'); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
                    <?php endif; ?>
            <div class=" mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('attendanceemployee.index'),'method'=>'get','id'=>'attendanceemployee_filter'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-label"><?php echo e(__('Type')); ?></label> <br>

                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="monthly" value="monthly" name="type" class="form-check-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='monthly' ?'checked':'checked'); ?>>
                                            <label class="form-check-label" for="monthly"><?php echo e(__('Monthly')); ?></label>
                                        </div>
                                        <div class="form-check form-check-inline form-group">
                                            <input type="radio" id="daily" value="daily" name="type" class="form-check-input" <?php echo e(isset($_GET['type']) && $_GET['type']=='daily' ?'checked':''); ?>>
                                            <label class="form-check-label" for="daily"><?php echo e(__('Daily')); ?></label>
                                        </div>

                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 month">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('month',__('Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('month',isset($_GET['month'])?$_GET['month']:date('Y-m'),array('class'=>'month-btn form-control month-btn'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::date('date',isset($_GET['date'])?$_GET['date']:'', array('class' => 'form-control month-btn'))); ?>

                                        </div>
                                    </div>
                                    <?php if(\Auth::user()->type != 'employee'): ?>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                <?php echo e(Form::label('branch', __('Branch'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::select('branch', $branch,isset($_GET['branch'])?$_GET['branch']:'', array('class' => 'form-control select'))); ?>

                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                            <div class="btn-box">
                                                <?php echo e(Form::label('department', __('Department'),['class'=>'form-label'])); ?>

                                                <?php echo e(Form::select('department', $department,isset($_GET['department'])?$_GET['department']:'', array('class' => 'form-control select'))); ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('attendanceemployee_filter').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('attendanceemployee.index')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('attendance.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import employee CSV file')); ?>" class="btn btn-sm btn-primary">
                                            <i class="ti ti-file-import"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <?php if(\Auth::user()->type!='Employee'): ?>
                                    <th><?php echo e(__('Employee')); ?></th>
                                <?php endif; ?>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Clock In')); ?></th>
                                <th><?php echo e(__('Clock Out')); ?></th>
                                <th><?php echo e(__('Late')); ?></th>
                                <th><?php echo e(__('Early Leaving')); ?></th>
                                <th><?php echo e(__('Overtime')); ?></th>
                                <?php if(Gate::check('edit attendance') || Gate::check('delete attendance')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $attendanceEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if(\Auth::user()->type!='Employee'): ?>
                                        <td><?php echo e(!empty($attendance->employee)?$attendance->employee->name:''); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e(\Auth::user()->dateFormat($attendance->date)); ?></td>
                                    <td><?php echo e($attendance->status); ?></td>
                                    <td><?php echo e(($attendance->clock_in !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_in):'00:00'); ?> </td>
                                    <td><?php echo e(($attendance->clock_out !='00:00:00') ?\Auth::user()->timeFormat( $attendance->clock_out):'00:00'); ?></td>
                                    <td><?php echo e($attendance->late); ?></td>
                                    <td><?php echo e($attendance->early_leaving); ?></td>
                                    <td><?php echo e($attendance->overtime); ?></td>
                                    <?php if(Gate::check('edit attendance') || Gate::check('delete attendance')): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit attendance')): ?>
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-url="<?php echo e(URL::to('attendanceemployee/'.$attendance->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Attendance')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i></a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete attendance')): ?>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id],'id'=>'delete-form-'.$attendance->id]); ?>


                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                       data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($attendance->id); ?>').submit();">
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

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function () {
            $('.daterangepicker').daterangepicker({
                format: 'yyyy-mm-dd',
                locale: {format: 'YYYY-MM-DD'},
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/attendance/index.blade.php ENDPATH**/ ?>