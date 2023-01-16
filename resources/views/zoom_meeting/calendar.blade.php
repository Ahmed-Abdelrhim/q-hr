
@extends('layouts.admin')

@section('page-title')
     {{ __('Zoom Meetings Calender') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Zoom Metting') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('zoom-meeting.index') }}" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
        data-bs-original-title="{{ __('List View') }}">
        <i class="ti ti-list"></i>
    </a>
    @if (\Auth::user()->type == 'company')
        <a href="#" data-url="{{ route('zoom-meeting.create') }}" data-ajax-popup="true"
            data-title="{{ __('Create New Zoom Meeting') }}" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="{{ __('Create') }}">
            <i class="ti ti-plus"></i>
        </a>
    @endif
@endsection


@section('content')
   
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __("Calendar") }}</h5>
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
           
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">{{ __("Mettings") }}</h4>
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
                                             <h5 class="  text-primary">
                                                <a href="#" data-size="lg" data-url="{{ route('zoom-meeting.show',$event->id) }}" data-ajax-popup="true" data-title="{{__('Edit Event')}}" class="text-primary">{{$event->title}}</a>
                                            </h5>
                                                <div class="card-text small text-dark">{{ date('d F Y, h:m A',strtotime($event->start_date)) }}
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
    
@endsection
@push('script-page')
<script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>



<script type="text/javascript">
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
        
            slotDuration: '00:10:00',
            navLinks: true,
            droppable: true,
            selectable: true,
            selectMirror: true,
            editable: true,
            dayMaxEvents: true,
            handleWindowResize: true,
            events:{!! $calandar!!},
           
           
        });
        
        calendar.render();
    })();
</script>
@endpush