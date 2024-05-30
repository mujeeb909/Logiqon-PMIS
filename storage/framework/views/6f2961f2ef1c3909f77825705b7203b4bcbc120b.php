<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Task Calendar')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php
    $setting = \App\Models\Utility::settings();
?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Task Calendar')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5><?php echo e(__('Calendar')); ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <?php if(isset($setting['google_calendar_enable']) && $setting['google_calendar_enable'] == 'on'): ?>
                                <select class="form-control" name="calender_type" id="calender_type" style="float: right;width: 150px;" onchange="get_data()">
                                    <option value="goggle_calender"><?php echo e(__('Google Calender')); ?></option>
                                    <option value="local_calender" selected="true"><?php echo e(__('Local Calender')); ?></option>
                                </select>
                            <?php endif; ?>
                            <input type="hidden" id="task_calendar" value="<?php echo e(url('/')); ?>">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body task-calendar-scroll">
                    <h4 class="mb-4"><?php echo e(__('Tasks')); ?></h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        <?php $__empty_1 = true; $__currentLoopData = $arrTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="list-group-item card mb-3">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-calendar-event"></i>
                                            </div>
                                            <div class="ms-3 fc-event-title-container">
                                                <h6 class="m-0 text-sm fc-event-title text-primary"><?php echo e($task['title']); ?></h6>
                                                <small class="text-muted"><?php echo e($task['start']); ?>  to <?php echo e($task['end']); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-dark text-center"><?php echo e(__('No Data Found')); ?></p>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>

    <script type="text/javascript">

        $(document).ready(function()
        {
            get_data();
        });
        function get_data()
        {
            var calender_type=$('#calender_type :selected').val();
            $('#calendar').removeClass('local_calender');
            $('#calendar').removeClass('goggle_calender');
            $('#calendar').addClass(calender_type);
            $.ajax({
                url: $("#task_calendar").val()+"/calendar/get_task_data" ,

                method:"POST",
                data: {"_token": "<?php echo e(csrf_token()); ?>",'calender_type':calender_type},
                success: function(data) {
                    console.log(data);
                    (function() {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay'
                            },
                            buttonText: {
                                timeGridDay: "<?php echo e(__('Day')); ?>",
                                timeGridWeek: "<?php echo e(__('Week')); ?>",
                                dayGridMonth: "<?php echo e(__('Month')); ?>"
                            },
                            themeSystem: 'bootstrap',
                            slotDuration: '00:10:00',
                            navLinks: true,
                            droppable: true,
                            selectable: true,
                            selectMirror: true,
                            editable: true,
                            dayMaxEvents: true,
                            handleWindowResize: true,
                            events: data,
                        });

                        calendar.render();
                    })();
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/tasks/calendar.blade.php ENDPATH**/ ?>