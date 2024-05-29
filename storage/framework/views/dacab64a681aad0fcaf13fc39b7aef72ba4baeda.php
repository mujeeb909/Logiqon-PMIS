<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Zoom Meeting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Zoom Meeting')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>

    <script type="text/javascript">

        $(document).on("click", '.member_remove', function () {
            var rid = $(this).attr('data-id');
            $('.confirm_yes').addClass('m_remove');
            $('.confirm_yes').attr('uid', rid);
            $('#cModal').modal('show');
        });
        $(document).on('click', '.m_remove', function (e) {
            var id = $(this).attr('uid');
            var p_url = "<?php echo e(url('zoom-meeting')); ?>"+'/'+id;
            var data = {id: id};
            deleteAjax(p_url, data, function (res) {
                toastrs(res.flag, res.msg);
                if(res.flag == 1){
                    location.reload();
                }
                $('#cModal').modal('hide');
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">




        <a href="<?php echo e(route('zoom-meeting.calender')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Calender View')); ?>" data-original-title="<?php echo e(__('Calender View')); ?>">
            <i class="ti ti-calendar"></i>
        </a>

        <a href="#" data-size="lg" data-url="<?php echo e(route('zoom-meeting.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create  New Meeting')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>

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
                                <th> <?php echo e(__('Title')); ?> </th>
                                <th> <?php echo e(__('Project')); ?>  </th>
                                <th> <?php echo e(__('User')); ?>  </th>
                                <?php if(\Auth::user()->type == 'company'): ?>
                                    <th> <?php echo e(__('Client')); ?>  </th>
                                <?php endif; ?>
                                <th ><?php echo e(__('Meeting Time')); ?></th>
                                <th ><?php echo e(__('Duration')); ?></th>
                                <th ><?php echo e(__('Join URL')); ?></th>
                                <th ><?php echo e(__('Status')); ?></th>
                                <?php if(\Auth::user()->type == 'company'): ?>
                                    <th class="text-end"> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($item->title); ?></td>
                                    <td><?php echo e(!empty($item->projectName)?$item->projectName:''); ?></td>
                                    <td>
                                        <div class="avatar-group">
                                            <?php $__currentLoopData = $item->users($item->user_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="#" class="avatar rounded-circle avatar-sm avatar-group">
                                                    <img alt="" <?php if(!empty($users->avatar)): ?> src="<?php echo e($profile.'/'.$projectUser->avatar); ?>" <?php else: ?>  avatar="<?php echo e((!empty($projectUser)?$projectUser->name:'')); ?>" <?php endif; ?> data-original-title="<?php echo e((!empty($projectUser)?$projectUser->name:'')); ?>" data-toggle="tooltip" data-original-title="<?php echo e((!empty($projectUser)?$projectUser->name:'')); ?>" class="">
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                    </td>


                                    <?php if(\Auth::user()->type == 'company'): ?>
                                        <td><?php echo e($item->client_name); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($item->start_date); ?></td>
                                    <td><?php echo e($item->duration); ?> <?php echo e(__("Minutes")); ?></td>

                                    <td>
                                        <?php if($item->created_by == \Auth::user()->id && $item->checkDateTime()): ?>
                                            <a href="<?php echo e($item->start_url); ?>" target="_blank"> <?php echo e(__('Start meeting')); ?> <i class="ti ti-external-link-square-alt "></i></a>
                                        <?php elseif($item->checkDateTime()): ?>

                                            <a href="<?php echo e($item->join_url); ?>" target="_blank"> <?php echo e(__('Join meeting')); ?> <i class="ti ti-external-link-square-alt "></i></a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>


                                    </td>
                                    <td>
                                        <?php if($item->checkDateTime()): ?>
                                            <?php if($item->status == 'waiting'): ?>
                                                <span class="badge bg-info p-2 px-3 rounded"><?php echo e(ucfirst($item->status)); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-success p-2 px-3 rounded"><?php echo e(ucfirst($item->status)); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="badge bg-danger p-2 px-3 rounded"><?php echo e(__("End")); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(\Auth::user()->type == 'company'): ?>
                                        <td class="text-end">
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['zoom-meeting.destroy', $item->id],'id'=>'delete-form-'.$item->id]); ?>


                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($item->id); ?>').submit();"><i class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ERP\resources\views/zoom-meeting/index.blade.php ENDPATH**/ ?>