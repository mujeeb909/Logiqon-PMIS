@extends('layouts.admin')

@section('page-title')
    {{__('Timesheet List')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Timesheet')}}</li>
@endsection

@section('action-btn')
    <div class="row justify-content-end align-items-end text-end">
        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-6 weekly-dates-div me-2">
            <a href="#" class="action-item previous"><i class="ti ti-arrow-left"></i></a>
            <span class="weekly-dates"></span>
            <input type="hidden" id="weeknumber" value="0">
            <input type="hidden" id="selected_dates">
            <a href="#" class="action-item next"><i class="ti ti-arrow-right"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row mt-4">
        <div class="col-12">
            <div class="card ">
                <div class="card-wrapper project-timesheet overflow-auto"></div>
                <div class="text-center notfound-timesheet">
                    <div class="empty-project-text text-center p-3 min-h-300">
                        <h5 class="pt-5">{{ __("We couldn't find any data") }}</h5>
                        <p class="m-0">{{ __("Sorry we can't find any timesheet records on this week.") }}</p>
                        <p class="m-0">{{ __("To add timesheet record go to ") }}<a href="{{route('projects.index')}}">{{__('projects')}}</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-page')
    <script>
        function ajaxFilterTimesheetTableView() {
            var mainEle = $('.project-timesheet');
            var notfound = $('.notfound-timesheet');
            var week = parseInt($('#weeknumber').val());
            var project_id = '0';
            var data = {
                week: week,
                project_id: project_id,
            }

            $.ajax({
                url: '{{ route('filter.timesheet.table.view') }}',
                data: data,
                success: function (data) {
                    $('.weekly-dates-div .weekly-dates').text(data.onewWeekDate);
                    $('.weekly-dates-div #selected_dates').val(data.selectedDate);

                    $.each(data.sectiontasks, function (i, item) {

                        var optionhtml = '';

                        if (item.section_id != 0 && item.section_name != '' && item.tasks.length > 0) {
                            optionhtml += `<a href="#" class="dropdown-item select-sub-heading" data-tasks-count="` + item.tasks.length + `">` + item.section_name + `</a>`;
                        }
                        $.each(item.tasks, function (ji, jitem) {
                            optionhtml += `<a href="#" class="dropdown-item select-task" data-task-id="` + jitem.task_id + `">` + jitem.task_name + `</a>`;
                        });
                    });

                    if (data.totalrecords == 0) {
                        mainEle.hide();
                        notfound.css('display', 'block');
                    } else {
                        notfound.hide();
                        mainEle.show();
                    }
                    mainEle.html(data.html);
                }
            });
        }

        $(function () {
            ajaxFilterTimesheetTableView();
        });

        $(document).on('click', '.weekly-dates-div .action-item', function () {
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


        $(document).on('change', '#time_hour, #time_minute', function () {

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

            $('.display-total-time small').text('{{ __("Total Time worked on this task") }} : ' + hour + ' {{ __("Hours") }} ' + minute + ' {{ __("Minutes") }}');
        });

        $(document).on('click', '.timesheet-owner .owner-timesheet-status', function (e) {
            ajaxFilterTimesheetTableView();
        });


        $(document).on('click', '[data-ajax-timesheet-popup="true"]', function (e) {
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
                var title = 'Create Timesheet';
                data.p_id = '-1';
                data.project_id = data.p_id != '-1' ? data.p_id : p_id;

            } else if (type == 'edit') {
                var title = 'Edit Timesheet';
            }

            $("#commonModal .modal-title").html(title + ` <small>(` + moment(date).format("ddd, Do MMM YYYY") + `)</small>`);

            $.ajax({
                url: url,
                data: data,
                dataType: 'html',
                success: function (data) {
                    $('#commonModal .body').html(data);
                    // $('#commonModal .modal-body').html(data);
                    $("#commonModal").modal('show');
                    commonLoader();
                    loadConfirm();
                }
            });
        });
    </script>
@endpush
