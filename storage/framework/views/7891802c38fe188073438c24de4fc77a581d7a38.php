<?php
    $result = json_decode($project->copylinksetting);
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Projects Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        loadProjectUser();
        (function () {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data:<?php echo e(json_encode(array_map('intval',$project_data['timesheet_chart']['chart']))); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#timesheet_chart"), options);
            chart.render();
        })();

        (function () {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data:<?php echo e(json_encode($project_data['task_chart']['chart'])); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#task_chart"), options);
            chart.render();
        })();

        $(document).on('click', '.invite_usr', function () {
            var project_id = $('#project_id').val();
            var user_id = $(this).attr('data-id');

            $.ajax({
                url: '<?php echo e(route('invite.project.user.member')); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                success: function (data) {
                    if (data.code == '200') {
                        show_toastr(data.status, data.success, 'success')
                        setInterval('location.reload()', 5000);
                        loadProjectUser();
                    } else if (data.code == '404') {
                        show_toastr(data.status, data.errors, 'error')
                    }
                }
            });
        });

        function loadProjectUser() {

            var mainEle = $('#project_users');
            var project_id = '<?php echo e($project->id); ?>';

            $.ajax({
                url: '<?php echo e(route('project.user')); ?>',
                data: {project_id: project_id},
                beforeSend: function () {
                    $('#project_users').html('<tr><th colspan="2" class="h6 text-center pt-5"><?php echo e(__('Loading...')); ?></th></tr>');
                },
                success: function (data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    // loadConfirm();
                }
            });
        }

    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        // $(".list-group-item").click(function(){
        //     $('.list-group-item').filter(function(){
        //         return this.href == id;
        //     }).parent().removeClass('text-primary');
        // });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>

    <script>
        function ajaxFilterTimesheetTableView() {

            var mainEle = $('#timesheet-table-view');
            var notfound = $('.notfound-timesheet');
            var notfound1 = $('.notfound-timesheet1');

            var week = parseInt($('#weeknumber').val());
            var project_id = '<?php echo e($project->id); ?>';

            var data = {
                week: week,
                project_id: project_id,
            };

            $.ajax({

                url: '<?php echo e(route('filter.timesheet.table.view')); ?>',

                data: data,
                success: function(data) {

                    $('.weekly-dates-div .weekly-dates').text(data.onewWeekDate);
                    $('.weekly-dates-div #selected_dates').val(data.selectedDate);

                    $('#project_tasks').find('option').not(':first').remove();

                    $.each(data.tasks, function(i, item) {
                        $('#project_tasks').append($("<option></option>")
                            .attr("value", i)
                            .text(item));
                    });

                    if (data.totalrecords == 0) {
                        mainEle.hide();
                        notfound.css('display', 'block');
                        notfound1.hide();
                    } else {
                        notfound.hide();
                        mainEle.show();
                    }

                    mainEle.html(data.html);
                }
            });
        }

        $(function() {
            ajaxFilterTimesheetTableView();
        });

        $(document).on('click', '.weekly-dates-div i', function() {

            var weeknumber = parseInt($('#weeknumber').val());

            if ($(this).hasClass('previous')) {

                weeknumber--;
                $('#weeknumber').val(weeknumber);

            } else if ($(this).hasClass('next')) {

                weeknumber++;
                $('#weeknumber').val(weeknumber);
            }

            ajaxFilterTimesheetTableView();
        });

        $(document).on('click', '[data-ajax-timesheet-popup="true"]', function(e) {
            e.preventDefault();

            var data = {};
            var url = $(this).data('url');
            var type = $(this).data('type');
            var date = $(this).data('date');
            var task_id = $(this).data('task-id');
            var user_id = $(this).data('user-id');
            var p_id = $(this).data('project-id');

            data.date = date;
            data.task_id = task_id;

            if (user_id != undefined) {
                data.user_id = user_id;
            }

            if (type == 'create') {
                var title = '<?php echo e(__('Create Timesheet')); ?>';
                data.p_id = '<?php echo e($project->id); ?>';
                data.project_id = data.p_id != '-1' ? data.p_id : p_id;

            } else if (type == 'edit') {
                var title = '<?php echo e(__('Edit Timesheet')); ?>';
            }

            $("#commonModal .modal-title").html(title + ` <small>(` + moment(date).format("ddd, Do MMM YYYY") +
                `)</small>`);

            $.ajax({
                url: url,
                data: data,
                dataType: 'html',
                success: function(data) {
                    $('#commonModal .body').html(data);
                    // $('#commonModal .modal-body').html(data);
                    $("#commonModal").modal('show');
                    commonLoader();
                    loadConfirm();
                }
            });
        });

        $(document).on('click', '#project_tasks', function(e) {
            var mainEle = $('#timesheet-table-view');
            var notfound = $('.notfound-timesheet');

            var selectEle = $(this).children("option:selected");
            var task_id = selectEle.val();
            var selected_dates = $('#selected_dates').val();

            if (task_id != '') {

                $.ajax({
                    url: '<?php echo e(route('filter.timesheet.table.view')); ?>',
                    data: {
                        project_id: '<?php echo e($project->id); ?>',
                        task_id: task_id,
                        selected_dates: selected_dates,
                    },
                    success: function(data) {

                        notfound.hide();
                        mainEle.show();

                        $('#timesheet-table-view tbody').append(data.html);
                        selectEle.remove();
                    }
                });
            }
        });

        $(document).on('change', '#time_hour, #time_minute', function() {

            var hour = $('#time_hour').children("option:selected").val();
            var minute = $('#time_minute').children("option:selected").val();
            var total = $('#totaltasktime').val().split(':');

            if (hour == '00' && minute == '00') {
                $(this).val('');
                return;
            }

            hour = hour != '' ? hour : 0;
            hour = parseInt(hour) + parseInt(total[0]);

            minute = minute != '' ? minute : 0;
            minute = parseInt(minute) + parseInt(total[1]);

            if (minute > 50) {
                minute = minute - 60;
                hour++;
            }

            hour = hour < 10 ? '0' + hour : hour;
            minute = minute < 10 ? '0' + minute : minute;

            $('.display-total-time span').text('<?php echo e(__('Total Time')); ?> : ' + hour + ' <?php echo e(__('Hours')); ?> ' +
                minute + ' <?php echo e(__('Minutes')); ?>');
        });
    </script>

    <script type="text/javascript">

        function init_slider(){
            if($(".product-left").length){
                var productSlider = new Swiper('.product-slider', {
                    spaceBetween: 0,
                    centeredSlides: false,
                    loop:false,
                    direction: 'horizontal',
                    loopedSlides: 5,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    resizeObserver:true,
                });
                var productThumbs = new Swiper('.product-thumbs', {
                    spaceBetween: 0,
                    centeredSlides: true,
                    loop: false,
                    slideToClickedSlide: true,
                    direction: 'horizontal',
                    slidesPerView: 7,
                    loopedSlides: 5,
                });
                productSlider.controller.control = productThumbs;
                productThumbs.controller.control = productSlider;
            }
        }

        $(document).on('click', '.view-images', function () {

            var p_url = "<?php echo e(route('tracker.image.view')); ?>";
            var data = {
                'id': $(this).attr('data-id')
            };
            postAjax(p_url, data, function (res) {
                $('.image_sider_div').html(res);
                $('#exampleModalCenter').modal('show');
                setTimeout(function(){
                    var total = $('.product-left').find('.product-slider').length
                    if(total > 0){
                        init_slider();
                    }

                },200);

            });
        });

        // ============================ Remove Track Image ===============================//
        $(document).on("click", '.track-image-remove', function () {
            var rid = $(this).attr('data-pid');
            $('.confirm_yes').addClass('image_remove');
            $('.confirm_yes').attr('image_id', rid);
            $('#cModal').modal('show');
            var total = $('.product-left').find('.swiper-slide').length
        });

        function removeImage(id){
            var p_url = "<?php echo e(route('tracker.image.remove')); ?>";
            var data = {id: id};
            deleteAjax(p_url, data, function (res) {

                if(res.flag){
                    $('#slide-thum-'+id).remove();
                    $('#slide-'+id).remove();
                    setTimeout(function(){
                        var total = $('.product-left').find('.swiper-slide').length
                        if(total > 0){
                            init_slider();
                        }else{
                            $('.product-left').html('<div class="no-image"><h5 class="text-muted">Images Not Available .</h5></div>');
                        }
                    },200);
                }

                $('#cModal').modal('hide');
                show_toastr('error',res.msg,'error');
            });
        }
    </script>



<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <a href="" class="pt-3">
        <select name="language" id="language" class="btn btn-primary my-2"
                onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option <?php if($lang == $language): ?> selected <?php endif; ?>
                value="<?php echo e(route('projects.link',[\Illuminate\Support\Facades\Crypt::encrypt($project->id), $language])); ?>"><?php echo e(Str::upper($language)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </a>
<?php $__env->stopSection(); ?>

<?php
    $logo = \App\Models\Utility::get_file('tasks/');
    $logo_path = \App\Models\Utility::get_file('/');
?>
<?php

?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush" id="useradd-sidenav">
                    <?php if( isset($result->basic_details) && $result->basic_details == 'on'): ?>
                        <a href="#basic" class="list-group-item list-group-item-action border-0"><?php echo e(__('Basic details')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    <?php endif; ?>
                    <?php if(  isset($result->member) && $result->member == 'on'): ?>
                        <a href="#members" class="list-group-item list-group-item-action border-0 "><?php echo e(__('Members')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                    <?php endif; ?>
                        <?php if( isset($result->task) && $result->task == 'on'): ?>
                            <a href="#task" class="list-group-item list-group-item-action border-0"><?php echo e(__('Task')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if(  isset($result->milestone) && $result->milestone == 'on'): ?>
                        <a href="#milestone" class="list-group-item list-group-item-action border-0"><?php echo e(__('Milestones')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php endif; ?>
                        <?php if( isset($result->attachment) && $result->attachment == 'on'): ?>
                            <a href="#attachment" class="list-group-item list-group-item-action border-0"><?php echo e(__('Files')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($result->bug_report) && $result->bug_report == 'on'): ?>
                            <a href="#bug_report" class="list-group-item list-group-item-action border-0"><?php echo e(__('Bug Report')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($result->timesheet) && $result->timesheet == 'on'): ?>
                            <a href="#timesheet" class="list-group-item list-group-item-action border-0"><?php echo e(__('Timesheet')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($result->tracker_details) && $result->tracker_details == 'on'): ?>
                            <a href="#tracker_details" class="list-group-item list-group-item-action border-0"><?php echo e(__('Tracker details')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($result->expense) && $result->expense == 'on'): ?>
                            <a href="#expense" class="list-group-item list-group-item-action border-0"><?php echo e(__('Expense')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                        <?php if( isset($result->activity) && $result->activity == 'on'): ?>
                            <a href="#activity" class="list-group-item list-group-item-action border-0"><?php echo e(__('Activity Log')); ?>

                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <?php if( isset($result->basic_details) && $result->basic_details == 'on'): ?>
                <div id="basic" class="">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-list"></i>
                                        </div>
                                        <div class="col text-end">
                                            <h6 class="text-muted mb-1"><?php echo e(__('Total Task')); ?></h6>
                                            <span class="h6 font-weight-bold mb-0 "><?php echo e($project_data['task']['total']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="theme-avtar bg-danger">
                                            <i class="ti ti-check"></i>
                                        </div>
                                        <div class="col text-end">
                                            <h6 class="text-muted mb-1"><?php echo e(__('Done Task')); ?></h6>
                                            <span class="h6 font-weight-bold mb-0 "><?php echo e($project_data['task']['done']); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-list"></i>
                                        </div>
                                        <div class="col text-end">
                                            <h6 class="text-muted mb-1"><?php echo e(__('Total Milestone')); ?></h6>
                                            <span class="h6 font-weight-bold mb-0 "><?php echo e(count($project->milestones)); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img <?php echo e($project->img_image); ?> alt="" class="img-user wid-45 rounded-circle">
                                        </div>
                                        <div class="d-block  align-items-center justify-content-between w-100">
                                            <div class="mb-3 mb-sm-0">
                                                <h5 class="mb-1"> <?php echo e($project->project_name); ?></h5>
                                                <p class="mb-0 text-sm">
                                                <div class="progress-wrapper">
                                                    <span class="progress-percentage"><small class="font-weight-bold"><?php echo e(__('Completed:')); ?> : </small><?php echo e($project->project_progress_copy($usr->id)['percentage']); ?></span>
                                                    <div class="progress progress-xs mt-2">
                                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo e($project->project_progress_copy($usr->id)['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project->project_progress_copy($usr->id)['percentage']); ?>;"></div>
                                                    </div>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <h4 class="mt-3 mb-1"></h4>
                                                <p> <?php echo e($project->description); ?></p>
                                            </div>
                                        </div>
                                        <div class="card bg-primary mb-0">
                                            <div class="card-body">
                                                <div class="d-block d-sm-flex align-items-center justify-content-between">
                                                    <div class="row align-items-center">
                                                        <span class="text-white text-sm"><?php echo e(__('Start Date')); ?></span>
                                                        <h5 class="text-white text-nowrap"><?php echo e(Utility::getDateFormated($project->start_date)); ?></h5>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <span class="text-white text-sm"><?php echo e(__('End Date')); ?></span>
                                                        <h5 class="text-white text-nowrap"><?php echo e(Utility::getDateFormated($project->end_date)); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <span class="text-white text-sm"><?php echo e(__('Client')); ?></span>
                                                    <h5 class="text-white text-nowrap"><?php echo e((!empty($project->client)?$project->client->name: '-')); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-clipboard-list"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="text-muted mb-0"><?php echo e(__('Last 7 days task done')); ?></p>
                                                <h4 class="mb-0"><?php echo e($project_data['task_chart']['total']); ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted"><?php echo e(__('Day Left')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['day_left']['day']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['day_left']['percentage']); ?>%"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">

                                                <span class="text-muted"><?php echo e(__('Open Task')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['open_task']['tasks']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['open_task']['percentage']); ?>%"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted"><?php echo e(__('Completed Milestone')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['milestone']['total']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['milestone']['percentage']); ?>%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-clipboard-list"></i>
                                            </div>
                                            <div class="ms-3">
                                                <p class="text-muted mb-0"><?php echo e(__('Last 7 days hours spent')); ?></p>
                                                <h4 class="mb-0"><?php echo e($project_data['timesheet_chart']['total']); ?></h4>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted"><?php echo e(__('Total project time spent')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['time_spent']['total']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['time_spent']['percentage']); ?>%"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">

                                                <span class="text-muted"><?php echo e(__('Allocated hours on task')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['task_allocated_hrs']['hrs']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['task_allocated_hrs']['percentage']); ?>%"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <span class="text-muted"><?php echo e(__('User Assigned')); ?></span>
                                            </div>
                                            <span><?php echo e($project_data['user_assigned']['total']); ?></span>
                                        </div>
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?php echo e($project_data['user_assigned']['percentage']); ?>%"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            <?php endif; ?>

            <?php if( isset($result->member) && $result->member == 'on'): ?>
                    <div id="members" class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Members')); ?>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped data-table">
                                        <thead>
                                        <tr>
                                            <th> <?php echo e(__('Avatar')); ?></th>
                                            <th> <?php echo e(__('Name')); ?></th>
                                            <th> <?php echo e(__('Type')); ?></th>
                                            <th> <?php echo e(__('Email')); ?></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <?php if($project->users || $project->users != '' || $project->users != null): ?>
                                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="">
                                                        <img <?php if($user->avatar): ?>  src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?>   class="avatar rounded-circle" style="height:36px;width:36px;">
                                                    </td>
                                                    <td><?php echo e($user->name); ?></td>
                                                    <td><?php echo e($user->type); ?></td>
                                                    <td><?php echo e($user->email); ?></td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->task) && $result->task == 'on'): ?>
                    <div id="task" class="">
                        <div class="card" style="background-color:transparent !important">
                            <div class="card-header" style="padding: 25px 35px !important; background-color:#ffffff !important">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="row">
                                        <h5 class="mb-0"><?php echo e(__('Task')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col"><?php echo e(__('Task')); ?></th>
                                            <th scope="col"><?php echo e(__('Project')); ?></th>
                                            <th scope="col"><?php echo e(__('Stage')); ?></th>
                                            <th scope="col"><?php echo e(__('Assigned To')); ?></th>
                                            <th scope="col"><?php echo e(__('Priority')); ?></th>
                                            <th scope="col"><?php echo e(__('End Date')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <?php if(!empty(count($tasks)) > 0): ?>
                                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($task->name); ?></td>
                                                    <td><?php echo e($task->project->project_name); ?></td>
                                                    <td><?php echo e($task->stage->name); ?></td>
                                                    <td>
                                                                <div class="avatar-group">
                                                                    <?php if($task->users()->count() > 0): ?>
                                                                        <?php if($users = $task->users()): ?>
                                                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($key<3): ?>
                                                                                    <a href="#" class="avatar rounded-circle avatar-sm">
                                                                                        <img data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> title="<?php echo e($user->name); ?>" class="hweb">
                                                                                    </a>
                                                                                <?php else: ?>
                                                                                    <?php break; ?>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                        <?php if(count($users) > 3): ?>
                                                                            <a href="#" class="avatar rounded-circle avatar-sm">
                                                                                <img  data-original-title="<?php echo e((!empty($user)?$user->name:'')); ?>" <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> class="hweb">
                                                                            </a>
                                                                        <?php endif; ?>
                                                                    <?php else: ?>
                                                                        <?php echo e(__('-')); ?>

                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                    <td>
                                                        <span class="status_badge badge p-2 px-3 rounded bg-<?php echo e(__(\App\Models\ProjectTask::$priority_color[$task->priority])); ?>"><?php echo e(__(\App\Models\ProjectTask::$priority[$task->priority])); ?></span>
                                                    </td>
                                                    <td class="<?php echo e((strtotime($task->end_date) < time()) ? 'text-danger' : ''); ?>"><?php echo e(Utility::getDateFormated($task->end_date)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No tasks found')); ?></h6></th>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->milestone) && $result->milestone == 'on'): ?>
                    <div id="milestone" class="">
                        <div class="card" style="overflow-x: none;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Milestones')); ?>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table  px-2">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(__('Name')); ?></th>
                                            <th><?php echo e(__('Status')); ?></th>
                                            <th><?php echo e(__('Start Date')); ?></th>
                                            <th><?php echo e(__('Due Date')); ?></th>
                                            <th><?php echo e(__('Task')); ?></th>
                                            <th><?php echo e(__('Cost')); ?></th>
                                            <th><?php echo e(__('Progress')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty(count($project->milestones)) > 0): ?>
                                            <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($milestone->title); ?></td>
                                                <td>
                                                    <span class="badge-xs badge bg-<?php echo e(\App\Models\Project::$status_color[$milestone->status]); ?> p-2 px-3 rounded">
                                                        <?php echo e(__(\App\Models\Project::$project_status[$milestone->status])); ?>

                                                    </span>
                                                </td>
                                                <?php if($milestone->start_date): ?>
                                                    <td><?php echo e($milestone->start_date); ?></td>
                                                <?php else: ?>
                                                    <td>-</td>
                                                <?php endif; ?>
                                                <?php if($milestone->due_date): ?>
                                                    <td><?php echo e($milestone->due_date); ?></td>
                                                <?php else: ?>
                                                    <td>-</td>
                                                <?php endif; ?>
                                                <td><?php echo e($milestone->tasks->count().' '. __('Tasks')); ?></td>
                                                <td><?php echo e($user->priceFormat($milestone->cost)); ?>

                                                </td>
                                                <td>
                                                    <div class="progress_wrapper">
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar"
                                                                 style="width: <?php echo e($milestone->progress); ?>%;"
                                                                 aria-valuenow="55" aria-valuemin="0"
                                                                 aria-valuemax="100"></div>
                                                        </div>
                                                        <div class="progress_labels">
                                                            <div class="total_progress">
                                                                <strong> <?php if($milestone->progress): ?> <?php echo e($milestone->progress); ?>% <?php else: ?> 0% <?php endif; ?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No milestone found')); ?></h6></th>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->attachment) && $result->attachment == 'on'): ?>
                    <div id="attachment" class="">
                        <div class="card" style="overflow-x: none;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Files')); ?>

                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php if($project->projectAttachments()->count() > 0): ?>
                                        <?php $__currentLoopData = $project->projectAttachments(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item px-0">
                                                <div class="row align-items-center justify-content-between">
                                                    <div class="col mb-3 mb-sm-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="div">
                                                                <h6 class="m-0"><?php echo e($attachment->name); ?></h6>
                                                                <small class="text-muted"><?php echo e($attachment->file_size); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto text-sm-end d-flex align-items-center">
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="<?php echo e(asset(Storage::url('tasks/'.$attachment->file))); ?>"  data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" class="btn btn-sm" download>
                                                                <i class="ti ti-download text-white"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="py-5">
                                            <h6 class="h6 text-center"><?php echo e(__('No Attachments Found.')); ?></h6>
                                        </div>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->bug_report) && $result->bug_report == 'on'): ?>
                    <div id="bug_report" >
                        <div class="card" style="background-color:transparent !important">
                            <div class="card-header" style="padding: 25px 35px !important; background-color:#ffffff !important">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="row">
                                        <h5 class="mb-0"><?php echo e(__('Bug Report')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                        <tr>
                                            <th> <?php echo e(__('Bug Id')); ?></th>
                                            <th> <?php echo e(__('Assign To')); ?></th>
                                            <th> <?php echo e(__('Bug Title')); ?></th>
                                            <th> <?php echo e(__('Start Date')); ?></th>
                                            <th> <?php echo e(__('Due Date')); ?></th>
                                            <th> <?php echo e(__('Status')); ?></th>
                                            <th> <?php echo e(__('Priority')); ?></th>
                                            <th> <?php echo e(__('Created By')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty(count($bugs)) > 0): ?>
                                            <?php $__currentLoopData = $bugs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($user->bugNumberFormat($bug->bug_id)); ?></td>
                                                <td><?php echo e($user->bugNumberFormat($bug->bug_id)); ?></td>
                                                <td><?php echo e((!empty($bug->assignTo)?$bug->assignTo->name:'')); ?></td>
                                                <td><?php echo e($bug->title); ?></td>
                                                <td><?php echo e($user->dateFormat($bug->start_date)); ?></td>
                                                <td><?php echo e($user->dateFormat($bug->due_date)); ?></td>
                                                <td><?php echo e((!empty($bug->bug_status)?$bug->bug_status->title:'')); ?></td>
                                                <td><?php echo e($bug->priority); ?></td>
                                                <td><?php echo e($bug->createdBy->name); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Bug found')); ?></h6></th>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->timesheet) && $result->timesheet == 'on'): ?>
                    <div id="timesheet" class="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card notfound-timesheet1">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0"> <?php echo e(__('Timesheet')); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="" id="timesheet-table-view" style="width:100%"></div>
                                    </div>
                                </div>

                                <div class="card notfound-timesheet text-center">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="mb-0"> <?php echo e(__('Timesheet')); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="page-error">
                                            <div class="page-inner">
                                                <div class="page-description">
                                                    <?php echo e(__("We couldn't find any data")); ?>

                                                </div>
                                                <div class="page-search">
                                                    <p class="text-muted mt-3">
                                                        <?php echo e(__("Sorry we can't find any timesheet records on this week.")); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->tracker_details) && $result->tracker_details == 'on'): ?>
                    <div id="tracker_details" class="">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Tracker details')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">
                                <div class="table-responsive">
                                    <table class=" table" id="selection-datatable">
                                        <thead>
                                        <tr>
                                            <th> <?php echo e(__('Description')); ?></th>
                                            <th> <?php echo e(__('Project')); ?></th>
                                            <th> <?php echo e(__('Task')); ?></th>
                                            <th> <?php echo e(__('Start Time')); ?></th>
                                            <th> <?php echo e(__('End Time')); ?></th>
                                            <th><?php echo e(__('Total Time')); ?></th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $treckers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trecker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $total_name = App\Models\Utility::second_to_time($trecker->total_time);
                                            ?>
                                            <tr>
                                                <td><?php echo e(__($trecker->name)); ?></td>
                                                <td><?php echo e(__($trecker->project_name)); ?></td>
                                                <td><?php echo e(__($trecker->project_task)); ?></td>
                                                <td><?php echo e(__(date('H:i:s', strtotime($trecker->start_time)))); ?></td>
                                                <td><?php echo e(__(date('H:i:s', strtotime($trecker->end_time)))); ?></td>
                                                <td><?php echo e(__($total_name)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->expense) && $result->expense == 'on'): ?>
                    <div id="expense" >
                        <div class="card" style="background-color:transparent !important">
                            <div class="card-header" style="padding: 25px 35px !important; background-color:#ffffff !important">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="row">
                                        <h5 class="mb-0"><?php echo e(__('Expense')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col"><?php echo e(__('Attachment')); ?></th>
                                            <th scope="col"><?php echo e(__('Name')); ?></th>
                                            <th scope="col"><?php echo e(__('Task')); ?></th>
                                            <th scope="col"><?php echo e(__('Date')); ?></th>
                                            <th scope="col"><?php echo e(__('Amount')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody class="list">
                                        <?php if(isset($project->expense) && !empty($project->expense) && count($project->expense) > 0): ?>
                                            <?php $__currentLoopData = $project->expense; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <th scope="row">
                                                        <?php if(!empty($expense->attachment)): ?>
                                                            <a href="<?php echo e(asset(Storage::url($expense->attachment))); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" download>
                                                                <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
                                                            </a>
                                                        <?php else: ?>

                                                        <?php endif; ?>
                                                    </th>
                                                    <td><?php echo e($expense->name); ?></td>
                                                    <td><?php echo e(!empty($expense->task)?$expense->task->name:'-'); ?></td>
                                                    <td><?php echo e((!empty($expense->date)) ? Utility::getDateFormated($expense->date) : '-'); ?></td>
                                                    <td><?php echo e($user->priceFormat($expense->amount)); ?></td>
                                                    <td><?php echo e($user->priceFormat($expense->amount)); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <th scope="col" colspan="5"><h6 class="text-center"><?php echo e(__('No Expense Found.')); ?></h6></th>
                                            </tr>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if( isset($result->activity) && $result->activity == 'on'): ?>
                    <div id="activity" class="">
                        <div class="card  activity-scroll">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0"><?php echo e(__('Activity')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3 vertical-scroll-cards">
                                <?php if(!empty(count($project->activities)) > 0): ?>
                                    <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card p-2 mb-2">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-<?php echo e($activity->logIcon($activity->log_type)); ?>"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0"><?php echo e(__($activity->log_type)); ?></h6>
                                                    <p class="text-muted text-sm mb-0"><?php echo $activity->getRemark(); ?></p>
                                                </div>
                                            </div>
                                            <p class="text-muted text-sm mb-0"><?php echo e($activity->created_at->diffForHumans()); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No activities found')); ?></h6></th>
                                    </tr>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

        </div>

    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ss_modale " role="document">
            <div class="modal-content image_sider_div">
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.shareproject', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/copylink.blade.php ENDPATH**/ ?>