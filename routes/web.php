<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceEmployeeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::get('/check', 'HomeController@check')->middleware(
    [
        'auth',
        'XSS',
    ]
);
// Route::get('/password/resets/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');;

Route::get('/', 'HomeController@index')->name('home')->middleware(['XSS']);
Route::get('/home', 'HomeController@index')->name('home')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/home/getlanguvage', 'HomeController@getlanguvage')->name('home.getlanguvage');


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){

    Route::resource('settings', 'SettingsController');
    Route::post('email-settings', 'SettingsController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings', 'SettingsController@saveCompanySettings')->name('company.settings');
    Route::post('payment-settings', 'SettingsController@savePaymentSettings')->name('payment.settings');
    Route::post('system-settings', 'SettingsController@saveSystemSettings')->name('system.settings');
    Route::get('company-setting', 'SettingsController@companyIndex')->name('company.setting');
    // Route::get('company-email-setting/{name}', 'SettingsController@updateEmailStatus')->name('company.email.setting');
    Route::get('company-email-setting/{name}', 'EmailTemplateController@updateStatus')->name('company.email.setting');

    Route::post('pusher-settings', 'SettingsController@savePusherSettings')->name('pusher.settings');
    Route::post('business-setting', 'SettingsController@saveBusinessSettings')->name('business.setting');

    Route::post('zoom-settings', 'SettingsController@zoomSetting')->name('zoom.settings');

    Route::get('test-mail', 'SettingsController@testMail')->name('test.mail');
    Route::post('test-mail', 'SettingsController@testMail')->name('test.mail');
    Route::post('test-mail/send', 'SettingsController@testSendMail')->name('test.send.mail');

    Route::get('create/ip', 'SettingsController@createIp')->name('create.ip');
    Route::post('create/ip', 'SettingsController@storeIp')->name('store.ip');
    Route::get('edit/ip/{id}', 'SettingsController@editIp')->name('edit.ip');
    Route::post('edit/ip/{id}', 'SettingsController@updateIp')->name('update.ip');
    Route::delete('destroy/ip/{id}', 'SettingsController@destroyIp')->name('destroy.ip');
}
);

// Email Templates
Route::get('email_template_lang/{id}/{lang?}', 'EmailTemplateController@manageEmailLang')->name('manage.email.language')->middleware(['auth','XSS']);
Route::post('email_template_store/{pid}', 'EmailTemplateController@storeEmailLang')->name('store.email.language')->middleware(['auth']);
Route::post('email_template_status/{id}', 'EmailTemplateController@updateStatus')->name('status.email.language')->middleware(['auth']);

Route::resource('email_template', 'EmailTemplateController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('email_template_lang', 'EmailTemplateLangController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get(
    '/test', [
               'as' => 'test.email',
               'uses' => 'SettingsController@testEmail',
           ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post(
    '/test/send', [
                    'as' => 'test.email.send',
                    'uses' => 'SettingsController@testEmailSend',
                ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);
// End

Route::resource('user', 'UserController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('employee/json', 'EmployeeController@json')->name('employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('branch/employee/json', 'EmployeeController@employeeJson')->name('branch.employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee-profile', 'EmployeeController@profile')->name('employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('show-employee-profile/{id}', 'EmployeeController@profileShow')->name('show.employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('lastlogin', 'EmployeeController@lastLogin')->name('lastlogin')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('employee', 'EmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('department', 'DepartmentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('designation', 'DesignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('document', 'DocumentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('branch', 'BranchController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('awardtype', 'AwardTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('award', 'AwardController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('termination/{id}/description', 'TerminationController@description')->name('termination.description');

Route::resource('termination', 'TerminationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('terminationtype', 'TerminationTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getdepartment', 'AnnouncementController@getdepartment')->name('announcement.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getemployee', 'AnnouncementController@getemployee')->name('announcement.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('announcement', 'AnnouncementController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('holiday/calender', 'HolidayController@calender')->name('holiday.calender')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('holiday', 'HolidayController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('employee/salary/{eid}', 'SetSalaryController@employeeBasicSalary')->name('employee.basic.salary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('allowances/create/{eid}', 'AllowanceController@allowanceCreate')->name('allowances.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('commissions/create/{eid}', 'CommissionController@commissionCreate')->name('commissions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('loans/create/{eid}', 'LoanController@loanCreate')->name('loans.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('saturationdeductions/create/{eid}', 'SaturationDeductionController@saturationdeductionCreate')->name('saturationdeductions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('otherpayments/create/{eid}', 'OtherPaymentController@otherpaymentCreate')->name('otherpayments.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('overtimes/create/{eid}', 'OvertimeController@overtimeCreate')->name('overtimes.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);

//payslip

Route::resource('paysliptype', 'PayslipTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('allowance', 'AllowanceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('commission', 'CommissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('allowanceoption', 'AllowanceOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('loanoption', 'LoanOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('deductionoption', 'DeductionOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('loan', 'LoanController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('saturationdeduction', 'SaturationDeductionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('otherpayment', 'OtherPaymentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('overtime', 'OvertimeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('event/getdepartment', 'EventController@getdepartment')->name('event.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('event/getemployee', 'EventController@getemployee')->name('event.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('event/data/{id}', 'EventController@showData')->name('eventsshow');
Route::resource('event', 'EventController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('meeting/getdepartment', 'MeetingController@getdepartment')->name('meeting.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('meeting/getemployee', 'MeetingController@getemployee')->name('meeting.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('meeting', 'MeetingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('employee/update/sallary/{id}', 'SetSalaryController@employeeUpdateSalary')->name('employee.salary.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('salary/employeeSalary', 'SetSalaryController@employeeSalary')->name('employeesalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('setsalary', 'SetSalaryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/paysalary/{id}/{date}', 'PaySlipController@paysalary')->name('payslip.paysalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/bulk_pay_create/{date}', 'PaySlipController@bulk_pay_create')->name('payslip.bulk_pay_create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/bulkpayment/{date}', 'PaySlipController@bulkpayment')->name('payslip.bulkpayment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/search_json', 'PaySlipController@search_json')->name('payslip.search_json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/employeepayslip', 'PaySlipController@employeepayslip')->name('payslip.employeepayslip')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/showemployee/{id}', 'PaySlipController@showemployee')->name('payslip.showemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/editemployee/{id}', 'PaySlipController@editemployee')->name('payslip.editemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('payslip/editemployee/{id}', 'PaySlipController@updateEmployee')->name('payslip.updateemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/pdf/{id}/{m}', 'PaySlipController@pdf')->name('payslip.pdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/payslipPdf/{id}', 'PaySlipController@payslipPdf')->name('payslip.payslipPdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/send/{id}/{m}', 'PaySlipController@send')->name('payslip.send')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/delete/{id}', 'PaySlipController@destroy')->name('payslip.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('payslip', 'PaySlipController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('resignation', 'ResignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('travel', 'TravelController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('promotion', 'PromotionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transfer', 'TransferController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('complaint', 'ComplaintController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('warning', 'WarningController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('profile', 'UserController@profile')->name('profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('accountlist', 'AccountListController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('accountbalance', 'AccountListController@account_balance')->name('accountbalance')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('leave/{id}/action', 'LeaveController@action')->name('leave.action')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/changeaction', 'LeaveController@changeaction')->name('leave.changeaction')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/jsoncount', 'LeaveController@jsoncount')->name('leave.jsoncount')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('leave', 'LeaveController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('ticket/{id}/reply', 'TicketController@reply')->name('ticket.reply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('ticket/changereply', 'TicketController@changereply')->name('ticket.changereply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('ticket', 'TicketController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendance')->name('attendanceemployee.bulkattendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendanceData')->name('attendanceemployee.bulkattendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('attendanceemployee/attendance', 'AttendanceEmployeeController@attendance')->name('attendanceemployee.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('attendanceemployee', 'AttendanceEmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee/report/{id}',[AttendanceEmployeeController::class,'employeeReport'])->name('employee.report');
Route::get('filter/employee/report/{id}',[AttendanceEmployeeController::class,'filterEmployeeReport'])->name('filter.employee.attendance');

// Route::get('attendance/employees',[AttendanceEmployeeController::class,'attendanceFilter'])->name('attendance.employees');


Route::resource('timesheet', 'TimeSheetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::resource('expensetype', 'ExpenseTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('incometype', 'IncomeTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('paymenttype', 'PaymentTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('leavetype', 'LeaveTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('payees', 'PayeesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('payer', 'PayerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('deposit', 'DepositController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('expense', 'ExpenseController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transferbalance', 'TransferBalanceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
}
);

Route::resource('roles', 'RoleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('permissions', 'PermissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::post('change-password', 'UserController@updatePassword')->name('update.password');

Route::resource('account-assets', 'AssetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('document-upload', 'DucumentUploadController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('indicator', 'IndicatorController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('appraisal', 'AppraisalController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltype', 'GoalTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltracking', 'GoalTrackingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('company-policy', 'CompanyPolicyController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainingtype', 'TrainingTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainer', 'TrainerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('training/status', 'TrainingController@updateStatus')->name('training.status')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('training', 'TrainingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);




Route::get('report/income-expense', 'ReportController@incomeVsExpense')->name('report.income-expense')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/leave', 'ReportController@leave')->name('report.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee/{id}/leave/{status}/{type}/{month}/{year}', 'ReportController@employeeLeave')->name('report.employee.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/account-statement', 'ReportController@accountStatement')->name('report.account.statement')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/payroll', 'ReportController@payroll')->name('report.payroll')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/monthly/attendance', 'ReportController@monthlyAttendance')->name('report.monthly.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/attendance/{month}/{branch}/{department}', 'ReportController@exportCsv')->name('report.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/timesheet', 'ReportController@timesheet')->name('report.timesheet')->middleware(
    [
        'auth',
        'XSS',
    ]
);

//------------------------------------  Recurtment --------------------------------

Route::resource('job-category', 'JobCategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job-stage', 'JobStageController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-stage/order', 'JobStageController@order')->name('job.stage.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job', 'JobController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('career/{id}/{lang}', 'JobController@career')->name('career');
Route::get('job/requirement/{code}/{lang}', 'JobController@jobRequirement')->name('job.requirement');
Route::get('job/apply/{code}/{lang}', 'JobController@jobApply')->name('job.apply');
Route::post('job/apply/data/{code}', 'JobController@jobApplyData')->name('job.apply.data');


Route::get('candidates-job-applications', 'JobApplicationController@candidate')->name('job.application.candidate')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('job-application', 'JobApplicationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/order', 'JobApplicationController@order')->name('job.application.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/rating', 'JobApplicationController@rating')->name('job.application.rating')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/archive', 'JobApplicationController@archive')->name('job.application.archive')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/{id}/skill/store', 'JobApplicationController@addSkill')->name('job.application.skill.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/note/store', 'JobApplicationController@addNote')->name('job.application.note.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/note/destroy', 'JobApplicationController@destroyNote')->name('job.application.note.destroy')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/getByJob', 'JobApplicationController@getByJob')->name('get.job.application')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('job-onboard', 'JobApplicationController@jobOnBoard')->name('job.on.board')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/create/{id}', 'JobApplicationController@jobBoardCreate')->name('job.on.board.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/store/{id}', 'JobApplicationController@jobBoardStore')->name('job.on.board.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('job-onboard/edit/{id}', 'JobApplicationController@jobBoardEdit')->name('job.on.board.edit')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/update/{id}', 'JobApplicationController@jobBoardUpdate')->name('job.on.board.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-onboard/delete/{id}', 'JobApplicationController@jobBoardDelete')->name('job.on.board.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvert')->name('job.on.board.convert')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvertData')->name('job.on.board.convert')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::post('job-application/stage/change', 'JobApplicationController@stageChange')->name('job.application.stage.change')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('custom-question', 'CustomQuestionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('interview-schedule', 'InterviewScheduleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('interview-schedule/create/{id?}', 'InterviewScheduleController@create')->name('interview-schedule.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//================================= Custom Landing Page ====================================//

// Route::get('/landingpage', 'LandingPageSectionController@index')->name('custom_landing_page.index')->middleware(['auth','XSS']);
Route::get('/LandingPage/show/{id}', 'LandingPageSectionController@show');
Route::post('/LandingPage/setConetent', 'LandingPageSectionController@setConetent')->middleware(['auth','XSS']);
Route::get('/get_landing_page_section/{name}', function($name) {

    return view('custom_landing_page.'.$name);
});
Route::post('/LandingPage/removeSection/{id}', 'LandingPageSectionController@removeSection')->middleware(['auth','XSS']);
Route::post('/LandingPage/setOrder', 'LandingPageSectionController@setOrder')->middleware(['auth','XSS']);
Route::post('/LandingPage/copySection', 'LandingPageSectionController@copySection')->middleware(['auth','XSS']);
Route::resource('competencies', 'CompetenciesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('performanceType', 'PerformanceTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//Employee Import & Export

Route::get('import/employee/file', 'EmployeeController@importFile')->name('employee.file.import');
Route::post('import/employee', 'EmployeeController@import')->name('employee.import');
Route::get('export/employee', 'EmployeeController@export')->name('employee.export');

// Timesheet Import & Export

Route::get('import/timesheet/file', 'TimeSheetController@importFile')->name('timesheet.file.import');
Route::post('import/timesheet', 'TimeSheetController@import')->name('timesheet.import');
Route::get('export/timesheet', 'TimeSheetController@export')->name('timesheet.export');

//Leave Export
Route::get('export/leave','LeaveController@export')->name('leave.export');

//deposite Export
Route::get('export/deposite','DepositController@export')->name('deposite.export');


//expense Export
Route::get('export/expense','ExpenseController@export')->name('expense.export');

//Transfer Balance Export
Route::get('export/transfer-balance','TransferBalanceController@export')->name('transfer_balance.export');

//Training Import & Export
Route::get('export/training', 'TrainingController@export')->name('training.export');

//Trainer Export
Route::get('export/trainer','TrainerController@export')->name('trainer.export');
Route::get('import/training/file', 'TrainerController@importFile')->name('trainer.file.import');
Route::post('import/training', 'TrainerController@import')->name('trainer.import');

//Holidays Import & Export
Route::get('export/holidays','HolidayController@export')->name('holidays.export');
Route::get('import/holidays/file', 'HolidayController@importFile')->name('holidays.file.import');
Route::post('import/holidays', 'HolidayController@import')->name('holidays.import');

//Asset Import & Export
Route::get('export/assets','AssetController@export')->name('assets.export');
Route::get('import/assets/file', 'AssetController@importFile')->name('assets.file.import');
Route::post('import/assets', 'AssetController@import')->name('assets.import');

//zoom meeting
Route::any('zoommeeting/calendar', 'ZoomMeetingController@calender')->name('zoom_meeting.calender')->middleware(['auth','XSS']);
Route::resource('zoom-meeting', 'ZoomMeetingController')->middleware(['auth','XSS']);


// slack
Route::post('setting/slack','SettingsController@slack')->name('slack.setting');

//telegram
Route::post('setting/telegram','SettingsController@telegram')->name('telegram.setting');

//twilio
Route::post('setting/twilio','SettingsController@twilio')->name('twilio.setting');

// recaptcha
Route::post('/recaptcha-settings',['as' => 'recaptcha.settings.store','uses' =>'SettingsController@recaptchaSettingStore'])->middleware(['auth','XSS']);

// user reset password
Route::any('user-reset-password/{id}', 'UserController@userPassword')->name('user.reset');
Route::post('user-reset-password/{id}', 'UserController@userPasswordReset')->name('user.password.update');

 //contract
 Route::resource('contract_type', 'ContractTypeController')->middleware(['auth','XSS']);
 Route::resource('contract', 'ContractController')->middleware(['auth','XSS']);
Route::post('/contract_status_edit/{id}', 'ContractController@contract_status_edit')->name('contract.status')->middleware(['auth','XSS']);

  Route::post('/contract/{id}/file', ['as' => 'contracts.file.upload','uses' => 'ContractController@fileUpload',])->middleware(['auth','XSS']);
 Route::get('/contract/{id}/file/{fid}', ['as' => 'contracts.file.download','uses' => 'ContractController@fileDownload',])->middleware(['auth','XSS']);
 Route::delete('/contract/{id}/file/delete/{fid}', ['as' => 'contracts.file.delete','uses' => 'ContractController@fileDelete',])->middleware(['auth','XSS']);
 Route::post('/contract/{id}/notestore', ['as' => 'contracts.note.store','uses' => 'ContractController@noteStore',])->middleware(['auth']);
 Route::get('/contract/{id}/note', ['as' => 'contracts.note.destroy','uses' => 'ContractController@noteDestroy',])->middleware(['auth']);

 Route::post('contract/{id}/description', 'ContractController@descriptionStore')->name('contracts.description.store')->middleware(['auth']);


 Route::post('/contract/{id}/commentstore', ['as' => 'comment.store',    'uses' => 'ContractController@commentStore',]);
 Route::get('/contract/{id}/comment', ['as' => 'comment.destroy','uses' => 'ContractController@commentDestroy',]);


 Route::get('/contract/copy/{id}',['as' => 'contracts.copy','uses' =>'ContractController@copycontract'])->middleware(['auth','XSS']);
 Route::post('/contract/copy/store/{id}',['as' => 'contracts.copystore','uses' =>'ContractController@copycontractstore'])->middleware(['auth','XSS']);

 Route::get('contract/{id}/get_contract', 'ContractController@printContract')->name('get.contract');
 Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf');

 Route::get('/contract/{id}/mail', ['as' => 'send.mail.contract','uses' => 'ContractController@sendmailContract',]);
 Route::get('/signature/{id}', 'ContractController@signature')->name('signature')->middleware(['auth','XSS']);
 Route::post('/signaturestore', 'ContractController@signatureStore')->name('signaturestore')->middleware(['auth','XSS']);

//offer Letter
Route::post('setting/offerlatter/{lang?}', 'SettingsController@offerletterupdate')->name('offerlatter.update');
Route::get('setting/offerlatter', 'SettingsController@index')->name('get.offerlatter.language');
Route::get('job-onboard/pdf/{id}', 'JobApplicationController@offerletterPdf')->name('offerlatter.download.pdf');
Route::get('job-onboard/doc/{id}', 'JobApplicationController@offerletterDoc')->name('offerlatter.download.doc');

//joining Letter
Route::post('setting/joiningletter/{lang?}', 'SettingsController@joiningletterupdate')->name('joiningletter.update');
Route::get('setting/joiningletter/', 'SettingsController@index')->name('get.joiningletter.language');
Route::get('employee/pdf/{id}', 'EmployeeController@joiningletterPdf')->name('joiningletter.download.pdf');
Route::get('employee/doc/{id}', 'EmployeeController@joiningletterDoc')->name('joininglatter.download.doc');

//Experience Certificate
Route::post('setting/exp/{lang?}', 'SettingsController@experienceCertificateupdate')->name('experiencecertificate.update');
Route::get('setting/exp', 'SettingsController@index')->name('get.experiencecertificate.language');
Route::get('employee/exppdf/{id}', 'EmployeeController@ExpCertificatePdf')->name('exp.download.pdf');
Route::get('employee/expdoc/{id}', 'EmployeeController@ExpCertificateDoc')->name('exp.download.doc');

//NOC
Route::post('setting/noc/{lang?}', 'SettingsController@NOCupdate')->name('noc.update');
Route::get('setting/noc', 'SettingsController@index')->name('get.noc.language');
Route::get('employee/nocpdf/{id}', 'EmployeeController@NocPdf')->name('noc.download.pdf');
Route::get('employee/nocdoc/{id}', 'EmployeeController@NocDoc')->name('noc.download.doc');

//appricalStar
Route::post('/appraisals', 'AppraisalController@empByStar')->name('empByStar')->middleware(['auth','XSS']);
Route::post('/appraisals1', 'AppraisalController@empByStar1')->name('empByStar1')->middleware(['auth','XSS']);
Route::post('/getemployee', 'AppraisalController@getemployee')->name('getemployee');

//storage Setting
Route::post('storage-settings','SettingsController@storageSettingStore')->name('storage.setting.store')->middleware(['auth','XSS']);



Route::get('hash',function(){})->name('message.data');

Route::get('hash/two',function(){
    auth()->logout();
    return redirect()->route('login');
})->name('message.seen');




