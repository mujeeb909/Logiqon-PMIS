<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Project Bug Status')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Project Bug Status')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <?php if(\Auth::user()->type=='company'): ?>
        <script>
            $(function () {
                $(".sortable").sortable();
                $(".sortable").disableSelection();
                $(".sortable").sortable({
                    stop: function () {
                        var order = [];
                        $(this).find('li').each(function (index, data) {
                            order[index] = $(data).attr('data-id');
                        });

                        $.ajax({
                            url: "<?php echo e(route('bugstatus.order')); ?>",
                            data: {order: order, _token: $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            success: function (data) {
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                toastr('Error', data.error, 'error')
                            }
                        })
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create bug status')): ?>
        <div class="float-end">
            <a href="#" data-url="<?php echo e(route('bugstatus.create')); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary" data-ajax-popup="true" data-title="<?php echo e(__('Create Bug Stage')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-xxl-8">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <?php ($i=0); ?>
                        <?php $__currentLoopData = $bugStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="tab-pane fade show  <?php if($i==0): ?> active <?php endif; ?>" role="tabpanel">
                                <ul class="list-unstyled list-group sortable stage">
                                    <?php $__currentLoopData = $bugStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="d-flex align-items-center justify-content-between list-group-item" data-id="<?php echo e($bug->id); ?>">
                                            <h6 class="mb-0">
                                                <i class="me-3 ti ti-arrows-maximize " data-feather="move"></i>
                                                <span><?php echo e($bug->title); ?></span>
                                            </h6>
                                            <span class="float-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit bug status')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-url="<?php echo e(URL::to('bugstatus/'.$bug->id.'/edit')); ?>" data-ajax-popup="true"  data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Bug Status')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center">
                                                          <i class="ti ti-pencil text-white"></i>
                                                      </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete bug status')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['bugstatus.destroy', $bug->id],'id'=>'delete-form-'.$bug->id]); ?>

                                                              <a href="#!" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-<?php echo e($bug->id); ?>').submit();">
                                                                    <i class="ti ti-trash text-white"></i>
                                                              </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php ($i++); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class=" mt-4"><strong><?php echo e(__('Note')); ?> : </strong><b><?php echo e(__('You can easily change order of project Bug status using drag & drop.')); ?></b></p>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/bugstatus/index.blade.php ENDPATH**/ ?>