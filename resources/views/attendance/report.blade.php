@extends('layouts.custom')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Report') }}</li>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Report') }}</li>
@endsection

@section('content')
    <!-- Filter Data -->
    <div class="col-sm-12">
        <div class=" mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <form id="new" action="{{route('filter.employee.attendance',$id)}}" method="GET">
                        @csrf
                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="custom_date">{{__('Date From')}}</label>
                                            <input class="form-control month-btn" name="date_from" type="date"
                                                   id="custom_date"/>
                                        </div>
                                    </div>


                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="date_from">{{__('Date To')}}</label>
                                            <input class="form-control month-btn" name="date_to" type="date"
                                                   id="date_from"/>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary"
                                           onclick="document.getElementById('new').submit(); return false;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- View Employee Attendance Data -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">

                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                        <tr>
                            @if (\Auth::user()->type != 'employee')
                                <th>{{ __('Employee') }}</th>
                            @endif
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Clock In') }}</th>
                            <th>{{ __('Clock Out') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Late') }}</th>
                            <th>{{ __('Early Leaving') }}</th>
                            <th>{{ __('Overtime') }}</th>
                                {{--                            @if (Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))--}}
                                {{--                                <th width="200px">{{ __('Action') }}</th>--}}
                                {{--                            @endif--}}
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($attendanceEmployee))
                            @foreach ($attendanceEmployee as $attendance)
                                <tr>
                                    @if (\Auth::user()->type != 'employee')
                                        <td>{{ !empty($attendance->employee) ? $attendance->employee->name : '' }}</td>
                                    @endif
                                    <td>{{ \Auth::user()->dateFormat($attendance->date) }}</td>
                                    <td>{{ $attendance->status }}</td>
                                    <td>{{ $attendance->clock_in != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_in) : '00:00' }}
                                    </td>
                                    <td>{{ $attendance->clock_out != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_out) : '00:00' }}
                                    </td>
                                    <!-- Total Logged Hours-->
                                    <td>
                                        {{-- {{ $attendance->clock_out != '00:00:00' ?--}}
                                        {{-- gmdate('H:i',--}}
                                        {{-- strtotime(Auth::user()->timeFormat($attendance->clock_out)) ---}}
                                        {{-- strtotime(Auth::user()->timeFormat($attendance->clock_in)) )--}}
                                        {{-- : '00:00'--}}
                                        {{-- }}--}}

                                        {{
                                            $attendance->clock_out != '00:00:00' ?
                                            gmdate('H:i',strtotime($attendance->clock_out) - strtotime($attendance->clock_in)): '00:00'
                                        }}
                                    </td>
                                    <td>{{ $attendance->late }}</td>
                                    <td>{{ $attendance->early_leaving }}</td>
                                    <td>{{ $attendance->overtime }}</td>

                                </tr>
                            @endforeach
                        @endif
                        {{-- <tr class="mx-auto col-xl-12 col-lg-12 col-md-12 text-center" style="display: flex">--}}

                            <tr>
                                <td>Grand Total : {{$grand_total}}</td>
                                {{-- <td class="col-xl-12 mx-auto" style="justify-content: center">Grand Total : {{$grand_total}}</td>--}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
