@extends('layouts.admin')
@section('page-title')
    {{ __('Employee Report') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Employee Report') }}</li>
@endsection

@section('content')
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
                            {{-- @if (Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))--}}
                            {{-- <th width="200px">{{ __('Action') }}</th>--}}
                            {{--  @endif--}}
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
                                        {{ $attendance->clock_out != '00:00:00' ?
                                            gmdate('H:i',
                                            strtotime(Auth::user()->timeFormat($attendance->clock_out)) -
                                            strtotime(Auth::user()->timeFormat($attendance->clock_in)) )
                                            : '00:00'
                                            }}
                                        @php
                                            $grand_total = gmdate('H:i',
                                                    strtotime($attendance->clock_out) - strtotime($attendance->clock_in) )
                                        @endphp
                                    </td>
                                    <td>{{ $attendance->late }}</td>
                                    <td>{{ $attendance->early_leaving }}</td>
                                    <td>{{ $attendance->overtime }}</td>
                                    <td class="Action">
                                        @if (Gate::check('Edit Attendance') || Gate::check('Delete Attendance'))
                                            <span>

                                            <div class="action-btn bg-info ms-2">

                                                        <a href="{{route('employee.report',$attendance->employee_id)}}"
                                                           class="mx-3 btn btn-sm  align-items-center" data-size="lg"

                                                           data-ajax-popup="true" data-size="md"
                                                           data-bs-toggle="tooltip"
                                                           data-title="{{ __('View Report') }}"
                                                           data-bs-original-title="{{ __('Report') }}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>



                                                @can('Edit Attendance')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                           data-size="lg"
                                                           data-url="{{ URL::to('attendanceemployee/' . $attendance->id . '/edit') }}"
                                                           data-ajax-popup="true" data-size="md"
                                                           data-bs-toggle="tooltip"
                                                           title="" data-title="{{ __('Edit Attendance') }}"
                                                           data-bs-original-title="{{ __('Edit') }}">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                @endcan

                                                @can('Delete Attendance')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['attendanceemployee.destroy', $attendance->id], 'id' => 'delete-form-' . $attendance->id]) !!}
                                                        <a href="#"
                                                           class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                           data-bs-toggle="tooltip" title=""
                                                           data-bs-original-title="Delete"
                                                           aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

