<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceType;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    //

    public function attendanceList()
    {
        $data = [];
        $data['title'] = 'Add Attendance';
        $data['menu_active_tab'] = 'add-attendance';
        $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['employeecategory'] = EmployeeCategory::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
       
        return view('admin.attendance.list')->with($data);
    
    }
    public function filterAttendance(Request $request)
    {
        $designation = $request->input('designation_id');
        $department = $request->input('department_id');
        $selectedMonth = $request->input('attendancemonth');
        $category = $request->input('employee_category_id');
       
        try{
        
        $data['employees'] = Attendance::join('employee','employee.id','=','attendance.employee_id')
       ->join('employee_category','employee_category.id','=','attendance.employee_category_id')
            ->where('attendance.designation_id', $designation)
            ->where('attendance.department_id', $department)
            ->where('attendance.employee_category_id', $category)
            ->whereMonth('attendance.date_of_attendance', Carbon::parse($selectedMonth)->month)
            ->get();
        //    foreach( $employees as $employee ){
        // print_r($employee);   
        // }
   // echo json_encode($employees);
        // Assuming you want to return the $employees data as JSON
      return response()->json($data);
        }
        catch(Exception $e){
        {
            return $e;
        }
    }
}

    public function addAttendance(Request $request) {
        $data = [];
        $data['title'] = 'Add Attendance';
        $data['menu_active_tab'] = 'add-attendance';
        $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['employee'] = Employee::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['employeecategory'] = EmployeeCategory::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['attendancetype'] = AttendanceType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
//dd($data['employeecategory']);
        return view('admin.attendance.add')->with($data);
    }
    public function storeAttendance(Request $request) {
       // dd($request->all());
        $validatedData = $request->validate([
            'date_of_attendance' => 'required|date',
            'employee_id' => 'required|exists:employee,id',
            'department_id' => 'required|exists:department,id',
            'designation_id' => 'required|exists:designation,id',
            'attendance_type_id' => 'required|exists:attendance_type,id',
            'employee_category_id' => 'required|exists:employee_category,id',
            
        ]);
   
        // Create attendance
        $attendance = new Attendance();
        $attendance->date_of_attendance = $validatedData['date_of_attendance'];
        $attendance->employee_id = $validatedData['employee_id'];
        $attendance->department_id = $validatedData['department_id'];
        $attendance->designation_id = $validatedData['designation_id'];
        $attendance->attendance_type_id = $validatedData['attendance_type_id'];
        $attendance->employee_category_id = $validatedData['employee_category_id'];
        $attendance->remarks = $request['remarks'];
       // dd($attendance);
        $attendance->save();
    
        return redirect()->route('attendance-list')->with('success', 'Record added successfully.');

    }

}
