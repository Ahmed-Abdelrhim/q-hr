<?php

namespace App\Http\Controllers;

use App\Models\AttendanceEmployee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\IpRestrict;
use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceEmployeeController extends Controller
{

    public function employeeReport($id)
    {
        $employee = Employee::query()->find($id);
        if (!$employee)
            return 'Employee not found or has been deleted';
        $days_count = now()->day;
        $start = Carbon::now()->subDays(now()->day - 1)->startOfDay()->toDateString();
        $end = Carbon::now()->endOfDay()->toDateString();
        $attendanceEmployee = AttendanceEmployee::query()
            ->where('employee_id', $employee->id)
            ->whereBetween('date', [$start, $end])
            ->get();
        $total_late_per_month = $this->calcTotalLate($attendanceEmployee);

        return view('attendance.report',
            [
                'id' => $id,
                'attendanceEmployee' => $attendanceEmployee,
                'grand_total' => $total_late_per_month,
            ]
        );
    }

    public function filterEmployeeReport(Request $request, $id)
    {
        $employee = Employee::query()->find($id);
        if (!$employee)
            return 'Employee not found or has been deleted';

        $start = $request->get('date_from');
        $end = $request->get('date_to');

        $attendanceEmployee = AttendanceEmployee::query()
            ->where('employee_id', $employee->id)
            ->whereBetween('date', [$start, $end])
            ->get();

        $total_late_per_month = $this->calcTotalLate($attendanceEmployee);
        // dd($total_late_per_month);
        // return $total_late_per_month;

        return view('attendance.report',
            [
                'id' => $id,
                'attendanceEmployee' => $attendanceEmployee,
                'grand_total' => $total_late_per_month
            ]
        );

    }

    public function calcTotalLate($attendanceEmployee)
    {

        $hours_counter = 0;
        $minutes_counter = 0;
        $real_number_hours_of_minutes_fraction = 0;
        $extracted_real_number_from_fraction_part = '00';
        $minutes_is_real_number = false;

        foreach ($attendanceEmployee as $key => $item) {
            $start = strtotime($item->clock_in);
            $end = strtotime($item->clock_out);
            (int)$logged_hours_today = gmdate('H', $end - $start);
            (int)$logged_minutes_today = gmdate('i', $end - $start);

            $hours_counter = $logged_hours_today + $hours_counter;
            $minutes_counter = $logged_minutes_today + $minutes_counter;
        }
        $minutes = $minutes_counter;

        if ($minutes_counter >= 60) {
            $minutes_is_real_number = true;
            $minutes = $minutes_counter / 60;
            // $minutes =ceil( $minutes_counter / 60);

            $real_number_hours_of_minutes_fraction = (int)$minutes;
            $fraction_part = $minutes - $real_number_hours_of_minutes_fraction;
            $extracted_real_number_from_fraction_part = ceil($fraction_part * 60);
            if ($extracted_real_number_from_fraction_part == 0)
                $extracted_real_number_from_fraction_part = '00';

            // $minutes = $real_number + $extracted_real_number_from_fraction_part;
        }
        if ($minutes_is_real_number) {
            // $total_late_per_month = $hours_counter + $minutes . ':' . '00';
            $total_late_per_month = $hours_counter + $real_number_hours_of_minutes_fraction . ':' . $extracted_real_number_from_fraction_part;
        } else {
            $total_late_per_month = $hours_counter . ':' . $minutes;
        }
        return $total_late_per_month;
    }

    public function attendanceFilter(Request $request)
    {
        // return $request;
        if ($request->get('branch') != null) {
            $branch = Branch::query()->where('id', $request->get('branch'))->get(['id', 'name']);
        } else {
            $branch = Branch::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
        }
        if ($request->get('department') != null) {
            $department = Department::query()->where('id', $request->get('department'))->get(['id', 'name']);
        } else {
            $department = Department::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
        }
        if ($request->get('employees') != null) {
            $emps = Employee::query()->where('id', $request->get('employees'))->get(['id', 'name']);
        } else {
            $emps = Employee::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
        }
        $employee = Employee::query()->select('id')->where('created_by', Auth::user()->creatorId());

        $employee = $employee->get()->pluck('id');

        $attendanceEmployee = AttendanceEmployee::query()->whereIn('employee_id', $employee);
        $grand_total = 0;
        return view('attendance.index', compact('attendanceEmployee', 'branch', 'department', 'grand_total', 'emps'));
    }


    public function index(Request $request)
    {
        // return $request;
        if (Auth::user()->can('Manage Attendance')) {
            $branch = Branch::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
            // $branch = Branch::query()->where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $branch->prepend('All', '');

            $department = Department::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
            // $department = Department::query()->where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            // $department->prepend('All', '');
            // return auth()->user()->employee->id;

            // $emps = Employee::query()->where('created_by', Auth::user()->creatorId())->get()->pluck('name', 'id');
            $emps = Employee::query()->where('created_by', Auth::user()->creatorId())->get(['id', 'name']);
            // $emps->prepend('All', '');

            if (Auth::user()->type == 'employee') {

                $emp = !empty(Auth::user()->employee) ? Auth::user()->employee->id : 0;

                $attendanceEmployee = AttendanceEmployee::query()->where('employee_id', $emp);

                if ($request->type == 'monthly' && !empty($request->month)) {
                    $month = date('m', strtotime($request->month));
                    $year = date('Y', strtotime($request->month));

                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween('date', [$start_date, $end_date,]);
                } elseif ($request->type == 'daily' && !empty($request->date)) {
                    $attendanceEmployee->where('date', $request->date);
                } else {
                    $month = date('m');
                    $year = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween('date', [$start_date, $end_date,]);
                }
                $attendanceEmployee = $attendanceEmployee->get();

            } else {
                $employee = Employee::query()->select('id')->where('created_by', Auth::user()->creatorId());

                if (!empty($request->get('employees') && empty($request->get('branch')) && empty($request->get('department')) )) {
                    return $this->employeeReport($request->get('employees'));
                }

                if (!empty($request->branch)) {
                    $employee->where('branch_id', $request->branch);
                }

                if (!empty($request->department)) {
                    $employee->where('department_id', $request->department);
                }

                if (!empty($request->employees)) {
                    $employee->where('id', $request->get('employees'));
                }

                $employee = $employee->get()->pluck('id');


                $attendanceEmployee = AttendanceEmployee::query()->whereIn('employee_id', $employee);

                if ($request->type == 'monthly' && !empty($request->month)) {
                    $month = date('m', strtotime($request->month));
                    $year = date('Y', strtotime($request->month));

                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween('date', [$start_date, $end_date,]);
                } elseif ($request->type == 'daily' && !empty($request->date)) {
                    $attendanceEmployee->where('date', $request->date);
                } else {
                    $month = date('m');
                    $year = date('Y');
                    $start_date = date($year . '-' . $month . '-01');
                    $end_date = date($year . '-' . $month . '-t');

                    $attendanceEmployee->whereBetween('date', [$start_date, $end_date,]);
                }


                $attendanceEmployee = $attendanceEmployee->get();
            }
            $grand_total = null;
            return view('attendance.index', compact('attendanceEmployee', 'branch', 'department', 'grand_total', 'emps'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if (Auth::user()->can('Create Attendance')) {
            $employees = User::query()->where('created_by', '=', Auth::user()->creatorId())->where('type', '=', "employee")->get()->pluck('name', 'id');

            return view('attendance.create', compact('employees'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }


    }

    public function store(Request $request)
    {
        if (Auth::user()->can('Create Attendance')) {
            $validator = \Validator::make(
                $request->all(), [
                    'employee_id' => 'required',
                    'date' => 'required',
                    'clock_in' => 'required',
                    'clock_out' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $startTime = Utility::getValByName('company_start_time');
            $endTime = Utility::getValByName('company_end_time');
            $attendance = AttendanceEmployee::where('employee_id', '=', $request->employee_id)->where('date', '=', $request->date)->where('clock_out', '=', '00:00:00')->get()->toArray();
            if ($attendance) {
                return redirect()->route('attendanceemployee.index')->with('error', __('Employee Attendance Already Created.'));
            } else {
                $date = date("Y-m-d");

                $totalLateSeconds = strtotime($request->clock_in) - strtotime($date . $startTime);

                $hours = floor($totalLateSeconds / 3600);
                $mins = floor($totalLateSeconds / 60 % 60);
                $secs = floor($totalLateSeconds % 60);
                $late = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($request->clock_out);
                $hours = floor($totalEarlyLeavingSeconds / 3600);
                $mins = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


                if (strtotime($request->clock_out) > strtotime($date . $endTime)) {
                    //Overtime
                    $totalOvertimeSeconds = strtotime($request->clock_out) - strtotime($date . $endTime);
                    $hours = floor($totalOvertimeSeconds / 3600);
                    $mins = floor($totalOvertimeSeconds / 60 % 60);
                    $secs = floor($totalOvertimeSeconds % 60);
                    $overtime = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                } else {
                    $overtime = '00:00:00';
                }

                $employeeAttendance = new AttendanceEmployee();
                $employeeAttendance->employee_id = $request->employee_id;
                $employeeAttendance->date = $request->date;
                $employeeAttendance->status = 'Present';
                $employeeAttendance->clock_in = $request->clock_in . ':00';
                $employeeAttendance->clock_out = $request->clock_out . ':00';
                $employeeAttendance->late = $late;
                $employeeAttendance->early_leaving = $earlyLeaving;
                $employeeAttendance->overtime = $overtime;
                $employeeAttendance->total_rest = '00:00:00';
                $employeeAttendance->created_by = \Auth::user()->creatorId();
                $employeeAttendance->save();

                return redirect()->route('attendanceemployee.index')->with('success', __('Employee attendance successfully created.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(Request $request)
    {
        return redirect()->route('attendance.index');
    }

    public function edit($id)
    {
        if (\Auth::user()->can('Edit Attendance')) {
            $attendanceEmployee = AttendanceEmployee::where('id', $id)->first();
            $employees = Employee::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

            return view('attendance.edit', compact('attendanceEmployee', 'employees'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {
        $employeeId = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;
        $todayAttendance = AttendanceEmployee::where('employee_id', '=', $employeeId)->where('date', date('Y-m-d'))->first();
        if (!empty($todayAttendance) && $todayAttendance->clock_out == '00:00:00') {
            $startTime = Utility::getValByName('company_start_time');
            $endTime = Utility::getValByName('company_end_time');
            if (Auth::user()->type == 'employee') {

                $date = date("Y-m-d");
                $time = date("H:i:s");

                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - time();
                $hours = floor($totalEarlyLeavingSeconds / 3600);
                $mins = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                if (time() > strtotime($date . $endTime)) {
                    //Overtime
                    $totalOvertimeSeconds = time() - strtotime($date . $endTime);
                    $hours = floor($totalOvertimeSeconds / 3600);
                    $mins = floor($totalOvertimeSeconds / 60 % 60);
                    $secs = floor($totalOvertimeSeconds % 60);
                    $overtime = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                } else {
                    $overtime = '00:00:00';
                }

                $attendanceEmployee = AttendanceEmployee::find($id);
                $attendanceEmployee->clock_out = $time;
                $attendanceEmployee->early_leaving = $earlyLeaving;
                $attendanceEmployee->overtime = $overtime;
                $attendanceEmployee->save();

                return redirect()->route('home')->with('success', __('Employee successfully clock Out.'));
            } else {
                $date = date("Y-m-d");
                //late
                $totalLateSeconds = strtotime($request->clock_in) - strtotime($date . $startTime);

                $hours = floor($totalLateSeconds / 3600);
                $mins = floor($totalLateSeconds / 60 % 60);
                $secs = floor($totalLateSeconds % 60);
                $late = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                //early Leaving
                $totalEarlyLeavingSeconds = strtotime($date . $endTime) - strtotime($request->clock_out);
                $hours = floor($totalEarlyLeavingSeconds / 3600);
                $mins = floor($totalEarlyLeavingSeconds / 60 % 60);
                $secs = floor($totalEarlyLeavingSeconds % 60);
                $earlyLeaving = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


                if (strtotime($request->clock_out) > strtotime($date . $endTime)) {
                    //Overtime
                    $totalOvertimeSeconds = strtotime($request->clock_out) - strtotime($date . $endTime);
                    $hours = floor($totalOvertimeSeconds / 3600);
                    $mins = floor($totalOvertimeSeconds / 60 % 60);
                    $secs = floor($totalOvertimeSeconds % 60);
                    $overtime = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                } else {
                    $overtime = '00:00:00';
                }

                $attendanceEmployee = AttendanceEmployee::find($id);
                $attendanceEmployee->employee_id = $request->employee_id;
                $attendanceEmployee->date = $request->date;
                $attendanceEmployee->clock_in = $request->clock_in;
                $attendanceEmployee->clock_out = $request->clock_out;
                $attendanceEmployee->late = $late;
                $attendanceEmployee->early_leaving = $earlyLeaving;
                $attendanceEmployee->overtime = $overtime;
                $attendanceEmployee->total_rest = '00:00:00';

                $attendanceEmployee->save();

                return redirect()->route('attendanceemployee.index')->with('success', __('Employee attendance successfully updated.'));
            }
        } else {
            return redirect()->back()->with('error', __('Employee are not allow multiple time clock in & clock for every day.'));
        }
    }

    public function destroy($id)
    {
        if (\Auth::user()->can('Delete Attendance')) {
            $attendance = AttendanceEmployee::where('id', $id)->first();

            $attendance->delete();

            return redirect()->route('attendanceemployee.index')->with('success', __('Attendance successfully deleted.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function attendance(Request $request)
    {
        $settings = Utility::settings();

        if ($settings['ip_restrict'] == 'on') {
            $userIp = request()->ip();
            $ip = IpRestrict::where('created_by', \Auth::user()->creatorId())->whereIn('ip', [$userIp])->first();
            if (!empty($ip)) {
                return redirect()->back()->with('error', __('this ip is not allowed to clock in & clock out.'));
            }
        }

        $employeeId = !empty(\Auth::user()->employee) ? \Auth::user()->employee->id : 0;
        $todayAttendance = AttendanceEmployee::where('employee_id', '=', $employeeId)->where('date', date('Y-m-d'))->first();
        if (empty($todayAttendance)) {

            $startTime = Utility::getValByName('company_start_time');
            $endTime = Utility::getValByName('company_end_time');

            $attendance = AttendanceEmployee::orderBy('id', 'desc')->where('employee_id', '=', $employeeId)->where('clock_out', '=', '00:00:00')->first();

            if ($attendance != null) {
                $attendance = AttendanceEmployee::find($attendance->id);
                $attendance->clock_out = $endTime;
                $attendance->save();
            }

            $date = date("Y-m-d");
            $time = date("H:i:s");

            //late
            $totalLateSeconds = time() - strtotime($date . $startTime);
            $hours = floor($totalLateSeconds / 3600);
            $mins = floor($totalLateSeconds / 60 % 60);
            $secs = floor($totalLateSeconds % 60);
            $late = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

            $checkDb = AttendanceEmployee::where('employee_id', '=', \Auth::user()->id)->get()->toArray();


            if (empty($checkDb)) {
                $employeeAttendance = new AttendanceEmployee();
                $employeeAttendance->employee_id = $employeeId;
                $employeeAttendance->date = $date;
                $employeeAttendance->status = 'Present';
                $employeeAttendance->clock_in = $time;
                $employeeAttendance->clock_out = '00:00:00';
                $employeeAttendance->late = $late;
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime = '00:00:00';
                $employeeAttendance->total_rest = '00:00:00';
                $employeeAttendance->created_by = \Auth::user()->id;

                $employeeAttendance->save();

                return redirect()->route('home')->with('success', __('Employee Successfully Clock In.'));
            }
            foreach ($checkDb as $check) {


                $employeeAttendance = new AttendanceEmployee();
                $employeeAttendance->employee_id = $employeeId;
                $employeeAttendance->date = $date;
                $employeeAttendance->status = 'Present';
                $employeeAttendance->clock_in = $time;
                $employeeAttendance->clock_out = '00:00:00';
                $employeeAttendance->late = $late;
                $employeeAttendance->early_leaving = '00:00:00';
                $employeeAttendance->overtime = '00:00:00';
                $employeeAttendance->total_rest = '00:00:00';
                $employeeAttendance->created_by = \Auth::user()->id;

                $employeeAttendance->save();

                return redirect()->route('home')->with('success', __('Employee Successfully Clock In.'));

            }
        } else {
            return redirect()->back()->with('error', __('Employee are not allow multiple time clock in & clock for every day.'));
        }
    }

    public function bulkAttendance(Request $request)
    {
        if (\Auth::user()->can('Create Attendance')) {

            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');

            $department = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $department->prepend('Select Department', '');

            $employees = [];
            if (!empty($request->branch) && !empty($request->department)) {
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->where('branch_id', $request->branch)->where('department_id', $request->department)->get();


            }


            return view('attendance.bulk', compact('employees', 'branch', 'department'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function bulkAttendanceData(Request $request)
    {

        if (\Auth::user()->can('Create Attendance')) {
            if (!empty($request->branch) && !empty($request->department)) {
                $startTime = Utility::getValByName('company_start_time');
                $endTime = Utility::getValByName('company_end_time');
                $date = $request->date;

                $employees = $request->employee_id;
                $atte = [];
                foreach ($employees as $employee) {
                    $present = 'present-' . $employee;
                    $in = 'in-' . $employee;
                    $out = 'out-' . $employee;
                    $atte[] = $present;
                    if ($request->$present == 'on') {

                        $in = date("H:i:s", strtotime($request->$in));
                        $out = date("H:i:s", strtotime($request->$out));

                        $totalLateSeconds = strtotime($in) - strtotime($startTime);

                        $hours = floor($totalLateSeconds / 3600);
                        $mins = floor($totalLateSeconds / 60 % 60);
                        $secs = floor($totalLateSeconds % 60);
                        $late = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);

                        //early Leaving
                        $totalEarlyLeavingSeconds = strtotime($endTime) - strtotime($out);
                        $hours = floor($totalEarlyLeavingSeconds / 3600);
                        $mins = floor($totalEarlyLeavingSeconds / 60 % 60);
                        $secs = floor($totalEarlyLeavingSeconds % 60);
                        $earlyLeaving = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


                        if (strtotime($out) > strtotime($endTime)) {
                            //Overtime
                            $totalOvertimeSeconds = strtotime($out) - strtotime($endTime);
                            $hours = floor($totalOvertimeSeconds / 3600);
                            $mins = floor($totalOvertimeSeconds / 60 % 60);
                            $secs = floor($totalOvertimeSeconds % 60);
                            $overtime = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
                        } else {
                            $overtime = '00:00:00';
                        }


                        $attendance = AttendanceEmployee::where('employee_id', '=', $employee)->where('date', '=', $request->date)->first();

                        if (!empty($attendance)) {
                            $employeeAttendance = $attendance;
                        } else {
                            $employeeAttendance = new AttendanceEmployee();
                            $employeeAttendance->employee_id = $employee;
                            $employeeAttendance->created_by = \Auth::user()->creatorId();
                        }


                        $employeeAttendance->date = $request->date;
                        $employeeAttendance->status = 'Present';
                        $employeeAttendance->clock_in = $in;
                        $employeeAttendance->clock_out = $out;
                        $employeeAttendance->late = $late;
                        $employeeAttendance->early_leaving = ($earlyLeaving > 0) ? $earlyLeaving : '00:00:00';
                        $employeeAttendance->overtime = $overtime;
                        $employeeAttendance->total_rest = '00:00:00';
                        $employeeAttendance->save();

                    } else {
                        $attendance = AttendanceEmployee::where('employee_id', '=', $employee)->where('date', '=', $request->date)->first();

                        if (!empty($attendance)) {
                            $employeeAttendance = $attendance;
                        } else {
                            $employeeAttendance = new AttendanceEmployee();
                            $employeeAttendance->employee_id = $employee;
                            $employeeAttendance->created_by = \Auth::user()->creatorId();
                        }

                        $employeeAttendance->status = 'Leave';
                        $employeeAttendance->date = $request->date;
                        $employeeAttendance->clock_in = '00:00:00';
                        $employeeAttendance->clock_out = '00:00:00';
                        $employeeAttendance->late = '00:00:00';
                        $employeeAttendance->early_leaving = '00:00:00';
                        $employeeAttendance->overtime = '00:00:00';
                        $employeeAttendance->total_rest = '00:00:00';
                        $employeeAttendance->save();
                    }
                }

                return redirect()->back()->with('success', __('Employee attendance successfully created.'));
            } else {
                return redirect()->back()->with('error', __('Branch & department field required.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

}
