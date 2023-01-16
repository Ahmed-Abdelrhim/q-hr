@extends('layouts.admin')

@section('page-title')
   {{ __('Event') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Event') }}</li>
@endsection

@section('action-button')
    @can('Create Event')
        <a href="#" data-url="{{ route('event.create') }}" data-ajax-popup="true" data-size="lg"
            data-title="{{ __('Create New Event') }}" data-bs-toggle="tooltip" title="{{ __('Create') }}"
            class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection


@section('content')
    {{-- <div class="page-title">
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

        </div>
    </div> --}}



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
                    <h4 class="mb-4">{{__('Upcoming Events')}}</h4>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        <li class="list-group-item card mb-3">
                            <div class="row align-items-center justify-content-between">

                                <div class=" align-items-center">
                                    @if(!$events->isEmpty())
                                        @foreach ($current_month_event as $event)
                                            <div class="card mb-3 border shadow-none">
                                                <div class="px-3">
                                                    <div class="row align-items-center">
                                                        <div class="col ml-n2">
                                                            <h5 class="text-sm mb-0 fc-event-title-container">
                                                                <a href="#" data-size="lg" data-url="{{ route('event.edit',$event->id) }}" data-ajax-popup="true" data-title="{{__('Edit Event')}}" class="fc-event-title text-primary">
                                                                    {{$event->title}}
                                                                </a>
                                                            </h5><br>

                                                            <p class="card-text small text-dark mt-0">
                                                                {{__('Start Date : ')}}
                                                                {{  \Auth::user()->dateFormat($event->start_date)}}<br>
                                                                {{__('End Date : ')}}
                                                                {{  \Auth::user()->dateFormat($event->end_date) }}
                                                            </p>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center">

                                        </div>
                                    @endif
                                </div>
                            </div>

                        </li>

                    </ul>
                </div>
            </div>
    </div>
    </div>
@endsection


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
                    right: 'timeGridDay,timeGridWeek,dayGridMonth'
                },
                buttonText: {
                    timeGridDay: "{{__('Day')}}",
                    timeGridWeek: "{{__('Week')}}",
                    dayGridMonth: "{{__('Month')}}"
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
                events: {!! $arrEvents !!},


            });

            calendar.render();
        })();
    </script>


    <script>
        $(document).ready(function() {
            var b_id = $('#branch_id').val();
            getDepartment(b_id);
        });
        $(document).on('change', 'select[name=branch_id]', function() {
            var branch_id = $(this).val();
            getDepartment(branch_id);
        });

        function getDepartment(bid) {

            $.ajax({
                url: '{{ route('event.getdepartment') }}',
                type: 'POST',
                data: {
                    "branch_id": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {


                    $('.department_id').empty();
                    var emp_selct = ` <select class="form-control  department_id" name="department_id[]" id="choices-multiple"
                                            placeholder="Select Department" multiple >
                                            </select>`;
                    $('.department_div').html(emp_selct);

                    $('.department_id').append('<option value="0"> {{ __('All') }} </option>');
                    $.each(data, function(key, value) {
                        $('.department_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    new Choices('#choices-multiple', {
                        removeItemButton: true,
                    });


                }
            });
        }

        $(document).on('change', '.department_id', function() {
            var department_id = $(this).val();
            getEmployee(department_id);
        });

        function getEmployee(did) {
            $.ajax({
                url: '{{ route('event.getemployee') }}',
                type: 'POST',
                data: {
                    "department_id": did,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {

                    $('.employee_id').empty();
                    var emp_selct = ` <select class="form-control  employee_id" name="employee_id[]" id="choices-multiple1"
                                            placeholder="Select Employee" multiple >
                                            </select>`;
                    $('.employee_div').html(emp_selct);

                    $('.employee_id').append('<option value="0"> {{ __('All') }} </option>');
                    $.each(data, function(key, value) {
                        $('.employee_id').append('<option value="' + key + '">' + value +
                            '</option>');
                    });
                    new Choices('#choices-multiple1', {
                        removeItemButton: true,
                    });

                }
            });
        }
    </script>
@endpush
