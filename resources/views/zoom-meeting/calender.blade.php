@extends('layouts.admin')

@section('page-title')
    {{__('Manage Zoom-Meeting')}}
@endsection
@php
    $setting = \App\Models\Utility::settings();
@endphp
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Zoom Meeting')}}</li>
@endsection

@section('action-btn')

    <div class="float-end">
        <a href="{{ route('zoom-meeting.index') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="{{__('List View')}}" data-original-title="{{__('List View')}}">
            <i class="ti ti-list"></i>
        </a>
        <a href="#" data-size="lg" data-url="{{ route('zoom-meeting.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create New Meeting')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>

@endsection



@push('script-page')
    <script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>

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
                url: $("#zoom_calendar").val()+"/zoom-meeting/get_zoom_meeting_data" ,
                method:"POST",
                data: {"_token": "{{ csrf_token() }}",'calender_type':calender_type},
                success: function(data) {
                    (function () {
                        var etitle;
                        var etype;
                        var etypeclass;
                        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'timeGridDay,timeGridWeek,dayGridMonth'
                            },
                            buttonText: {
                                timeGridDay: "{{__('Day')}}",
                                timeGridWeek: "{{__('Week')}}",
                                dayGridMonth: "{{__('Month')}}"
                            },
                            themeSystem: 'bootstrap',
                            initialDate: '{{ $transdate }}',
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

{{--    <script type="text/javascript">--}}

{{--        (function () {--}}
{{--            var etitle;--}}
{{--            var etype;--}}
{{--            var etypeclass;--}}
{{--            var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {--}}
{{--                headerToolbar: {--}}
{{--                    left: 'prev,next today',--}}
{{--                    center: 'title',--}}
{{--                    right: 'timeGridDay,timeGridWeek,dayGridMonth'--}}
{{--                },--}}
{{--                buttonText: {--}}
{{--                    timeGridDay: "{{__('Day')}}",--}}
{{--                    timeGridWeek: "{{__('Week')}}",--}}
{{--                    dayGridMonth: "{{__('Month')}}"--}}
{{--                },--}}
{{--                themeSystem: 'bootstrap',--}}
{{--                initialDate: '{{ $transdate }}',--}}
{{--                slotDuration: '00:10:00',--}}
{{--                navLinks: true,--}}
{{--                droppable: true,--}}
{{--                selectable: true,--}}
{{--                selectMirror: true,--}}
{{--                editable: true,--}}
{{--                dayMaxEvents: true,--}}
{{--                handleWindowResize: true,--}}
{{--                events: {!! json_encode($calandar) !!},--}}
{{--            });--}}
{{--            calendar.render();--}}
{{--        })();--}}
{{--    </script>--}}

@endpush


@section('content')



    <div class="row">


        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>{{ __('Calendar') }}</h5>
                        </div>
                        <div class="col-lg-6">
                            @if (isset($setting['google_calendar_enable']) && $setting['google_calendar_enable'] == 'on')
                                <select class="form-control" name="calender_type" id="calender_type" style="float: right;width: 150px;" onchange="get_data()">
                                    <option value="goggle_calender">{{__('Google Calender')}}</option>
                                    <option value="local_calender" selected="true">{{__('Local Calender')}}</option>
                                </select>
                            @endif
                            <input type="hidden" id="zoom_calendar" value="{{url('/')}}">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar' data-toggle="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">{{__('Mettings')}}</h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        @foreach($calandar as $event)

                            @php
                                $month = date("m",strtotime($event['start']));
                            @endphp
                            @if($month == date('m'))
                                <li class="list-group-item card mb-3">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-video"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="m-0">
                                                        <a href="{{$event['url']}}" class="fc-daygrid-event" style="white-space: inherit;">
                                                            <div class="fc-event-title-container">
                                                                <div class="fc-event-title text-dark">{{$event['title']}}</div>
                                                            </div>
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">{{$event['start']}}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection

