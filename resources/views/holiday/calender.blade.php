@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Holiday') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Holidays List') }}</li>
@endsection

@section('action-button')
    <!-- <a class="btn btn-sm btn-primary collapsed" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button"
        aria-expanded="false" aria-controls="multiCollapseExample1" data-bs-toggle="tooltip" title="{{ __('Filter') }}">
        <i class="ti ti-filter"></i>
    </a> -->

    <a href="{{ route('holiday.index') }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('List View') }}">
        <i class="ti ti-list-check"></i>
    </a>

    @can('Create Holiday')
        <a href="#" data-url="{{ route('holiday.create') }}" data-ajax-popup="true"
            data-title="{{ __('Create New Holiday') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
        <!-- <div class="multi-collapse mt-2 collapse" id="multiCollapseExample1" style=""> -->
            <div class="card">
                <div class="card-body">
                    {{ Form::open(['route' => ['holiday.calender'], 'method' => 'get', 'id' => 'holiday_filter']) }}
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                {{ Form::date('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control  ', 'autocomplete' => 'off']) }}

                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mx-2">
                            <div class="btn-box">

                                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                {{ Form::date('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control ', 'autocomplete' => 'off']) }}

                            </div>
                        </div>

                        <div class="col-auto float-end ms-2 mt-4">
                            <a href="#" class="btn btn-sm btn-primary"
                                onclick="document.getElementById('holiday_filter').submit(); return false;"
                                data-bs-toggle="tooltip" title="" data-bs-original-title="apply">
                                <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                            </a>
                            <a href="{{ route('holiday.calender') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                title="" data-bs-original-title="Reset">
                                <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                            </a>
                        </div>

                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Calendar') }}</h5>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
    
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">{{ __('Holiday List') }}</h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        @foreach ($current_month_event as $event)
                            <li class="list-group-item card mb-3">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-calendar-event"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="card-text small text-primary">{{ $event->occasion }}</h6>
                                                <div class="card-text small text-dark">Start Date : {{ date('d F Y', strtotime($event->start_date)) }}
                                                </div>
                                                <div class="card-text small text-dark">End Date : {{ date('d F Y', strtotime($event->end_date)) }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
    
                    </ul> 
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @extends('layouts.admin')

@section('page-title')
    {{ __('Manage Holiday') }}
@endsection
@push('css-page')
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">
@endpush
@section('action-button')
    @can('Create Holiday')
                <a href="#" data-url="{{ route('holiday.create') }}"
                data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="{{ __('Create') }}"     class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center" data-ajax-popup="true"
                    data-title="{{ __('Create New Holiday') }}">
                    <i class=" ti ti-plus"></i>x
                </a>
                <a href="{{ route('holiday.index') }}" class="action-btn" data-toggle="tooltip"
                data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="{{ __('View') }}"    data-original-title="{{ __('List View') }}">
                    <i class="fa fa-list"></i>
                </a>
    @endcan
@endsection

@section('content')
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
            {{ Form::open(['route' => ['holiday.calender'], 'method' => 'get', 'id' => 'holiday_filter']) }}

            <div class="btn-box">
                {{ Form::label('start_date', __('Start Date'), ['class' => 'text-type']) }}
                {{ Form::text('start_date', isset($_GET['start_date']) ? $_GET['start_date'] : '', ['class' => 'month-btn form-control ','id'=>'data_picker4']) }}
            </div>
        </div>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">

        <div class="btn-box">
            {{ Form::label('end_date', __('End Date'), ['class' => 'text-type']) }}
            {{ Form::text('end_date', isset($_GET['end_date']) ? $_GET['end_date'] : '', ['class' => 'month-btn form-control ','id'=>'data_picker3']) }}
        </div>
    </div>
    </div>
    <div class="col-auto my-custom">
        <a href="#" class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center"
            onclick="document.getElementById('holiday_filter').submit(); return false;" data-toggle="tooltip"
            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="{{ __('Apply') }}"  data-original-title="{{ __('apply') }}">
            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
        </a>
        <a href="{{ route('holiday.calender') }}"
            class="action-btn btn-warning me-1 btn btn-sm d-inline-flex align-items-center" data-toggle="tooltip"
            data-bs-toggle="tooltip" data-bs-placement="bottom"
            title="{{ __('Reset') }}"   data-original-title="{{ __('Reset') }}">
            <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
        </a>
    </div>
    </div>
    <div class="page-title">
        <div class="row justify-content-between align-items-center full-calender">
            <div class="col d-flex align-items-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
            </div>
            <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{ __('Month') }}</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{ __('Week') }}</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{ __('Day') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- Fullcalendar -->
            <div class="card overflow-hidden widget-calendar">
                <div class="calendar e-height" data-toggle="event_calendar" id="event_calendar"></div>
            </div>
            <!-- Modal - Add new event -->
            <!--* Modal header *-->
            <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="new-event--form">
                                <div class="form-group">
                                    <label class="col-form-label">Event title</label>
                                    <input type="text" class="form-control form-control-alternative new-event--title"
                                        placeholder="Event Title">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="col-form-label d-block mb-3">Status color</label>
                                    <div class="btn-group btn-group-toggle btn-group-colors event-tag"
                                        data-toggle="buttons">
                                        <label class="btn bg-info active"><input type="radio" name="event-tag"
                                                value="bg-info" checked></label>
                                        <label class="btn bg-warning"><input type="radio" name="event-tag"
                                                value="bg-warning"></label>
                                        <label class="btn bg-danger"><input type="radio" name="event-tag"
                                                value="bg-danger"></label>
                                        <label class="btn bg-success"><input type="radio" name="event-tag"
                                                value="bg-success"></label>
                                        <label class="btn bg-secondary"><input type="radio" name="event-tag"
                                                value="bg-default"></label>
                                        <label class="btn bg-primary"><input type="radio" name="event-tag"
                                                value="bg-primary"></label>
                                    </div>
                                </div>
                                <input type="hidden" class="new-event--start" />
                                <input type="hidden" class="new-event--end" />
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-link" data-bs-dismiss="modal">Cancel</button>
                            <button type="button"
                                class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center rounded-pill float-right new-event--add">Create
                                event</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal - Edit event -->
            <div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form class="edit-event--form">
                                <div class="form-group">
                                    <label class="col-form-label">Event title</label>
                                    <input type="text" class="form-control form-control-alternative edit-event--title"
                                        placeholder="Event Title">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label d-block mb-3">Status color</label>
                                    <div class="btn-group btn-group-toggle btn-group-colors event-tag mb-0"
                                        data-toggle="buttons">
                                        <label class="btn bg-info active"><input type="radio" name="event-tag"
                                                value="bg-info" checked></label>
                                        <label class="btn bg-warning"><input type="radio" name="event-tag"
                                                value="bg-warning"></label>
                                        <label class="btn bg-danger"><input type="radio" name="event-tag"
                                                value="bg-danger"></label>
                                        <label class="btn bg-success"><input type="radio" name="event-tag"
                                                value="bg-success"></label>
                                        <label class="btn bg-secondary"><input type="radio" name="event-tag"
                                                value="bg-default"></label>
                                        <label class="btn bg-primary"><input type="radio" name="event-tag"
                                                value="bg-primary"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Description</label>
                                    <textarea class="form-control form-control-alternative edit-event--description textarea-autosize"
                                        placeholder="Event Desctiption"></textarea>
                                    <i class="form-group--bar"></i>
                                </div>
                                <input type="hidden" class="edit-event--id">
                            </form>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-link" data-bs-dismiss="modal">Cancel</button>
                            <button type="button"
                                class="action-btn btn-primary me-1 btn btn-sm d-inline-flex align-items-center rounded-pill float-right"
                                data-calendar="update">Update</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill float-right"
                                data-calendar="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


{{-- @push('theme-script')
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
@endpush

@push('script-page')
    <script>
        // load chart data using these
        // event_calendar (not working now)
        var e, t, a = $('[data-toggle="event_calendar"]');
        a.length && (t = {
                header: {
                    right: "",
                    center: "",
                    left: ""
                },
                buttonIcons: {
                    prev: "calendar--prev",
                    next: "calendar--next"
                },
                theme: !1,
                selectable: !0,
                selectHelper: !0,
                editable: !0,
                events: {!! $arrHolidays !!},
                eventStartEditable: !1,
                locale: '{{ basename(App::getLocale()) }}',

                eventResize: function(event) {
                    var eventObj = {
                        start: event.start.format(),
                        end: event.end.format(),
                    };

                    $.ajax({
                        url: event.resize_url,
                        method: 'PUT',
                        data: eventObj,
                        success: function(response) {},
                        error: function(data) {
                            data = data.responseJSON;
                        }
                    });
                },
                viewRender: function(t) {
                    e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
                },
                eventClick: function(e, t) {
                    var title = e.title;
                    var url = e.url;

                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-md');
                        $("#commonModal").modal('show');
                        $.get(url, {}, function(data) {
                            $('#commonModal .modal-body').html(data);
                        });
                        return false;
                    }
                }
            }, (e = a).fullCalendar(t),
            $("body").on("click", "[data-calendar-view]", function(t) {
                t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                var a = $(this).attr("data-calendar-view");
                e.fullCalendar("changeView", a)
            }), $("body").on("click", ".fullcalendar-btn-next", function(t) {
                t.preventDefault(), e.fullCalendar("next")
            }), $("body").on("click", ".fullcalendar-btn-prev", function(t) {
                t.preventDefault(), e.fullCalendar("prev")
            }));
    </script>
@endpush --}}


@push('script-page')
    <script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>



    <script type="text/javascript">
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
                themeSystem: 'bootstrap',

                slotDuration: '00:10:00',
                navLinks: true,
                droppable: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true,
                handleWindowResize: true,
                events: {!! $arrHolidays !!},


            });

            calendar.render();
        })();
    </script>
@endpush
