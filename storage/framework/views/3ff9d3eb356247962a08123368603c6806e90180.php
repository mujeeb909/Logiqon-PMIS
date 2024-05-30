<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Lead Stages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
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
                        url: "<?php echo e(route('lead_stages.order')); ?>",
                        data: {order: order, _token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        success: function (data) {
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('error', data.error, 'error')
                        }
                    })
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Lead Stage')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md" data-url="<?php echo e(route('lead_stages.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Lead Stage')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-3">
            <?php echo $__env->make('layouts.crm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
            <div class="row justify-content-center">
                <div class="p-3 card">
                    <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                        <?php ($i=0); ?>
                        <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link <?php if($i==0): ?> active <?php endif; ?>" id="pills-user-tab-1" data-bs-toggle="pill"
                                        data-bs-target="#tab<?php echo e($key); ?>" type="button"><?php echo e($pipeline['name']); ?>

                                </button>
                            </li>
                            <?php ($i++); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <?php ($i=0); ?>
                            <?php $__currentLoopData = $pipelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tab-pane fade show <?php if($i==0): ?> active <?php endif; ?>" id="tab<?php echo e($key); ?>" role="tabpanel" aria-labelledby="pills-user-tab-1">
                                    <ul class="list-unstyled list-group sortable stage">
                                        <?php $__currentLoopData = $pipeline['lead_stages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead_stages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="d-flex align-items-center justify-content-between list-group-item" data-id="<?php echo e($lead_stages->id); ?>">
                                                <h6 class="mb-0">
                                                    <i class="me-3 ti ti-arrows-maximize " data-feather="move"></i>
                                                    <span><?php echo e($lead_stages->name); ?></span>
                                                </h6>
                                                <span class="float-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead stage')): ?>
                                                        <div class="action-btn bg-info ms-2"><a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(URL::to('lead_stages/'.$lead_stages->id.'/edit')); ?>" data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Lead Stages')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if(count($pipeline['lead_stages'])): ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead stage')): ?>
                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['lead_stages.destroy', $lead_stages->id]]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </span>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php ($i++); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <p class=" mt-4"><strong><?php echo e(__('Note')); ?> : </strong><b><?php echo e(__('You can easily change order of lead stage using drag & drop.')); ?></b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/lead_stages/index.blade.php ENDPATH**/ ?>