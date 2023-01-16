<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data=Employee::get();
        foreach($data as $k=>$employee )
        {
            $data[$k]["branch_id"]=!empty($employees->branch->name);
            $data[$k]["department_id"]=!empty($employees->department->name);
            $data[$k]["designation_id"]=!empty($employee->designation) ? $employee->designation->name:'-';
            $data[$k]["salary_type"]=!empty($employee->salary_type) ? $employee->salaryType->name :'-';
            $data[$k]["salary"]=Employee::employee_salary($employee->salary);
            $data[$k]["created_by"]=Employee::login_user($employee->created_by);
            unset($employee->id,$employee->user_id,$employee->documents,$employee->tax_payer_id,$employee->is_active,$employee->created_at,$employee->updated_at);
        }
        
        return $data;
    }
    public function headings(): array
    {
        return [
            
            "Name",
            "Date of Birth",
            "Gender",
            "Phone Number",
            "Address",
            "Email ID",
            "Password",
            "Employee ID",
            "Branch",
            "Department",
            "Designation",
            "Date of Join",
            "Account Holder Name",
            "Account Number",
            "Bank Name",
            "Bank Identifier Code",
            "Branch Location",
            "Salary Type",
            "Salary",
            "Created By"
        ];
    }
}
