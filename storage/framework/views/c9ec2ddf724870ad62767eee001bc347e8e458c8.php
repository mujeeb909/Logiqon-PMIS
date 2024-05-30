<?php $__env->startSection('page-title'); ?> <?php echo e(__('Gantt Chart')); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.show',$project->id)); ?>">    <?php echo e(ucwords($project->project_name)); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Gantt Chart')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
<div class="float-end">
    <div class="btn-group mr-2" id="change_view" role="group">
        <a href="<?php echo e(route('projects.gantt',[$project->id,'Quarter Day'])); ?>" class="btn btn-primary <?php if($duration == 'Quarter Day'): ?>active <?php endif; ?>" data-value="Quarter Day"><?php echo e(__('Quarter Day')); ?></a>
        <a href="<?php echo e(route('projects.gantt',[$project->id,'Half Day'])); ?>" class="btn btn-primary <?php if($duration == 'Half Day'): ?>active <?php endif; ?>" data-value="Half Day"><?php echo e(__('Half Day')); ?></a>
        <a href="<?php echo e(route('projects.gantt',[$project->id,'Day'])); ?>" class="btn btn-primary <?php if($duration == 'Day'): ?>active <?php endif; ?>" data-value="Day"><?php echo e(__('Day')); ?></a>
        <a href="<?php echo e(route('projects.gantt',[$project->id,'Week'])); ?>" class="btn btn-primary <?php if($duration == 'Week'): ?>active <?php endif; ?>" data-value="Week"><?php echo e(__('Week')); ?></a>
        <a href="<?php echo e(route('projects.gantt',[$project->id,'Month'])); ?>" class="btn btn-primary <?php if($duration == 'Month'): ?>active <?php endif; ?>" data-value="Month"><?php echo e(__('Month')); ?></a>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
        <a href="<?php echo e(route('projects.show',$project->id)); ?>" class="btn btn-primary " data-bs-toggle="tooltip" title="<?php echo e(__('Back')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-arrow-left"></i></span>
        </a>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats border-0">
                <div class="card-body"></div>
                <?php if($project): ?>
                    <div class="gantt-target"></div>
                <?php else: ?>
                    <h1>404</h1>
                    <div class="page-description">
                        <?php echo e(__('Page Not Found')); ?>

                    </div>
                    <div class="page-search">
                        <p class="text-muted mt-3"><?php echo e(__("It's looking like you may have taken a wrong turn. Don't worry... it happens to the best of us. Here's a little tip that might help you get back on track.")); ?></p>
                        <div class="mt-3">
                            <a class="btn-return-home badge-blue" href="<?php echo e(route('home')); ?>"><i class="ti ti-reply"></i> <?php echo e(__('Return Home')); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php if($project): ?>
    <?php $__env->startPush('css-page'); ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/frappe-gantt.css')); ?>" />
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('script-page'); ?>
        <?php
            $currantLang = basename(App::getLocale());
        ?>
        <script>
            const month_names = {
                "<?php echo e($currantLang); ?>": [
                    '<?php echo e(__('January')); ?>',
                    '<?php echo e(__('February')); ?>',
                    '<?php echo e(__('March')); ?>',
                    '<?php echo e(__('April')); ?>',
                    '<?php echo e(__('May')); ?>',
                    '<?php echo e(__('June')); ?>',
                    '<?php echo e(__('July')); ?>',
                    '<?php echo e(__('August')); ?>',
                    '<?php echo e(__('September')); ?>',
                    '<?php echo e(__('October')); ?>',
                    '<?php echo e(__('November')); ?>',
                    '<?php echo e(__('December')); ?>'
                ],
                "en": [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December'
                ],
            };
        </script>
        <script src="<?php echo e(asset('js/frappe-gantt.js')); ?>"></script>
        <script>
            var tasks = JSON.parse('<?php echo addslashes(json_encode($tasks)); ?>');
            var gantt_chart = new Gantt(".gantt-target", tasks, {
                custom_popup_html: function(task) {
                    var status_class = 'success';
                    if(task.custom_class == 'medium'){
                        status_class = 'info'
                    }else if(task.custom_class == 'high'){
                        status_class = 'danger'
                    }
                    return `<div class="details-container">
                                <div class="title">${task.name} <span class="badge badge-${status_class} float-right">${task.extra.priority}</span></div>
                                <div class="subtitle">
                                    <b>${task.progress}%</b> <?php echo e(__('Progress')); ?> <br>
                                    <b>${task.extra.comments}</b> <?php echo e(__('Comments')); ?> <br>
                                    <b><?php echo e(__('Duration')); ?></b> ${task.extra.duration}
                                </div>
                            </div>
                          `;
                },
                on_click: function (task) {
                    //console.log(task);
                },
                on_date_change: function(task, start, end) {
                    task_id = task.id;
                    start = moment(start);
                    end = moment(end);
                    $.ajax({
                        url: "<?php echo e(route('projects.gantt.post',[$project->id])); ?>",
                        data:{
                            start:start.format('YYYY-MM-DD HH:mm:ss'),
                            end:end.format('YYYY-MM-DD HH:mm:ss'),
                            task_id:task_id,
                            _token : "<?php echo e(csrf_token()); ?>",
                        },
                        type:'POST',
                        success:function (data) {

                        },
                        error:function (data) {
                            show_toastr('Error', '<?php echo e(__("Some Thing Is Wrong!")); ?>', 'error');
                        }
                    });
                },
                view_mode: '<?php echo e($duration); ?>',
                language: '<?php echo e($currantLang); ?>'
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/gantt.blade.php ENDPATH**/ ?>