<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Deals')); ?> <?php if($pipeline): ?> - <?php echo e($pipeline->name); ?> <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>" id="main-style-link">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
    <script>
        !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');

                        var old_status = $("#" + source.id).data('status');
                        var new_status = $("#" + target.id).data('status');
                        var stage_id = $(target).attr('data-id');
                        var pipeline_id = '<?php echo e($pipeline->id); ?>';

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                        $.ajax({
                            url: '<?php echo e(route('deals.order')); ?>',
                            type: 'POST',
                            data: {deal_id: id, stage_id: stage_id, order: order, new_status: new_status, old_status: old_status, pipeline_id: pipeline_id, "_token": $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                show_toastr('error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);


    </script>
    <script>
        $(document).on("change", ".change-pipeline select[name=default_pipeline_id]", function () {
            $('#change-pipeline').submit();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Deal')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

    <div class="float-end">

        
        
        
        
        
        <div class="col-auto">
            <a href="<?php echo e(route('deals.list')); ?>" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-list"></i>
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create deal')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('deals.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create New Deal')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <small class="text-muted"><?php echo e(__('Total Deals')); ?></small>
                            <h4 class="m-0"><?php echo e($cnt_deal['total']); ?></h4>
                        </div>
                        <div class="col-auto">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-layers-difference"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <small class="text-muted"><?php echo e(__('This Month Total Deals')); ?></small>
                            <h4 class="m-0"><?php echo e($cnt_deal['this_month']); ?></h4>
                        </div>
                        <div class="col-auto">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-layers-difference"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <small class="text-muted"><?php echo e(__('This Week Total Deals')); ?></small>
                            <h4 class="m-0"><?php echo e($cnt_deal['this_week']); ?></h4>
                        </div>
                        <div class="col-auto">
                            <div class="theme-avtar bg-warning">
                                <i class="ti ti-layers-difference"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <small class="text-muted"><?php echo e(__('Last 30 Days Total Deals')); ?></small>
                            <h4 class="m-0"><?php echo e($cnt_deal['last_30days']); ?></h4>
                        </div>
                        <div class="col-auto">
                            <div class="theme-avtar bg-danger">
                                <i class="ti ti-layers-difference"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
                $stages = $pipeline->stages;

                     $json = [];
                     foreach ($stages as $stage){
                         $json[] = 'task-list-'.$stage->id;
                     }
            ?>
            <div class="row kanban-wrapper horizontal-scroll-cards" data-containers='<?php echo json_encode($json); ?>' data-plugin="dragula">
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($deals = $stage->deals()); ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-end">
                                    <span class="btn btn-sm btn-primary btn-icon count">
                                        <?php echo e(count($deals)); ?>

                                    </span>
                                </div>
                                <h4 class="mb-0"><?php echo e($stage->name); ?></h4>
                            </div>
                            <div class="card-body kanban-box" id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>">
                                <?php $__currentLoopData = $deals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card" data-id="<?php echo e($deal->id); ?>">
                                        <div class="pt-3 ps-3">
                                            <?php ($labels = $deal->labels()); ?>
                                            <?php if($labels): ?>
                                                <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="badge-xs badge bg-<?php echo e($label->color); ?> p-2 px-3 rounded"><?php echo e($label->name); ?></div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-header border-0 pb-0 position-relative">
                                            <h5><a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view deal')): ?><?php if($deal->is_active): ?><?php echo e(route('deals.show',$deal->id)); ?><?php else: ?>#<?php endif; ?> <?php else: ?>#<?php endif; ?>"><?php echo e($deal->name); ?></a></h5>
                                            <div class="card-header-right">

                                                <?php if(Auth::user()->type != 'client'): ?>
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                <a href="#!" data-size="md" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/labels')); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Labels')); ?>">
                                                                    <i class="ti ti-bookmark"></i>
                                                                    <span><?php echo e(__('Labels')); ?></span>
                                                                </a>

                                                                <a href="#!" data-size="lg" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/edit')); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit Deal')); ?>">
                                                                    <i class="ti ti-pencil"></i>
                                                                    <span><?php echo e(__('Edit')); ?></span>
                                                                </a>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete deal')): ?>
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.destroy', $deal->id],'id'=>'delete-form-'.$deal->id]); ?>

                                                                <a href="#!" class="dropdown-item bs-pass-para">
                                                                    <i class="ti ti-archive"></i>
                                                                    <span> <?php echo e(__('Delete')); ?> </span>
                                                                </a>
                                                                <?php echo Form::close(); ?>

                                                            <?php endif; ?>


                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php
                                        $products = $deal->products();
                                        $sources = $deal->sources();
                                        ?>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Tasks')); ?>">
                                                        <i class="f-16 text-primary ti ti-list"></i> <?php echo e(count($deal->tasks)); ?>/<?php echo e(count($deal->complete_tasks)); ?>

                                                    </li>
                                                </ul>
                                                <div class="user-group">
                                                    <i class="text-primary ti ti-report-money"></i>  <?php echo e(\Auth::user()->priceFormat($deal->price)); ?>

                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <ul class="list-inline mb-0">

                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Product')); ?>">
                                                        <i class="f-16 text-primary ti ti-shopping-cart"></i> <?php echo e(count($products)); ?>

                                                    </li>

                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Source')); ?>">
                                                        <i class="f-16 text-primary ti ti-social"></i><?php echo e(count($sources)); ?>

                                                    </li>
                                                </ul>
                                                <div class="user-group">
                                                    <?php $__currentLoopData = $deal->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <img src="<?php if($user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?> <?php else: ?> <?php echo e(asset('storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>"  data-bs-toggle="tooltip" title="<?php echo e($user->name); ?>">
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ERP\resources\views/deals/index.blade.php ENDPATH**/ ?>