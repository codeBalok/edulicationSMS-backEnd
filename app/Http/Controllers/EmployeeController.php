<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class EmployeeController extends Controller
{
   
    //
    public function employeeList(Request $request) {
        $data = [];
        $data['title'] = 'Staff List';
        $data['menu_active_tab'] = 'staff-list';
       

        if(!empty($request->role) || $request->role != null){
            $data['selected_role'] = $role = $request->role;
        }
        else{
            $data['selected_role'] = '0';
        }

        if(!empty($request->department) || $request->department != null){
            $data['selected_department'] = $department = $request->department;
        }
        else{
            $data['selected_department'] = '0';
        }

        if(!empty($request->designation) || $request->designation != null){
            $data['selected_designation'] = $designation = $request->designation;
        }
        else{
            $data['selected_designation'] = '0';
        }

        if(!empty($request->contract_type) || $request->contract_type != null){
            $data['selected_contract'] = $contract_type = $request->contract_type;
        }
        else{
            $data['selected_contract'] = '0';
        }

        if(!empty($request->shift) || $request->shift != null){
            $data['selected_shift'] = $shift = $request->shift;
        }
        else{
            $data['selected_shift'] = '0';
        }


       


        // $data['employee'] = Employee::join('department','department.id','=','employee.department_id')
        // ->join('designation','designation.id','=','employee.designation_id')
        // ->orderBy('id', 'DESC')
        // ->get(['employee.*','department.department_name','designation.designation_name']);
        
       

        $emp = Employee::where('id', '!=', null);

        if(!empty($request->role)){
            $emp->where('role_id', $role);
        }
        if(!empty($request->department)){
            $emp->where('department_id', $department);
        }
        if(!empty($request->designation)){
            $emp->where('designation_id', $designation);
        }
        if(!empty($request->contract_type)){
            $emp->where('employee_status', $contract_type);
        }
        if(!empty($request->shift)){
            $emp->where('work_shift', $shift);
        }


        $data['employee'] = $emp->orderBy('id', 'asc')->get();
        $data['departments'] = Department::where('is_deleted', '0')
        ->orderBy('department_name', 'asc')->get();
        $data['designations'] = Designation::where('is_deleted', '0')
        ->orderBy('designation_name', 'asc')->get();
        $data['role'] = Role::orderBy('name', 'asc')->get();

        return view('admin.employee.list')->with($data);
    }
    public function addEmployee(Request $request) {
        $data = [];
        $data['title'] = 'Add Employee';
        $data['menu_active_tab'] = 'add-employee';
        $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['role'] = Role::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        
        
        return view('admin.employee.add',compact('data'));
    }
    public function storeEmployee(Request $request) {
        //dd($request);
        $rules = [
             'first_name' => ['required', 'regex:/^[a-zA-Z]+$/'],
            'last_name' => 'required|string|min:1|max:255', 
            'joining_date' => 'required|date',
            'profile_photo' => 'nullable|image',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
           
            try {
        $data = new Employee(); 
        $latestemp = Employee::latest()->first(); // Retrieve the latest employee
        
        $latestEmployeeCode = $latestemp ? $latestemp->employee_code : 0; // Retrieve the latest employee code
        //dd($latestEmployeeCode);
        $value = (int) substr($latestEmployeeCode, 3) + 1; // Extract the numerical value and increment it

        $employeeCode = 'emp' . str_pad($value, 3, '0', STR_PAD_LEFT); // Generate the new employee code

        $data->employee_code = $employeeCode;
       
                if ($request->file("image") && $request->file('image')->isValid()) {

                            $image = $request->file("image");

                            $extension = $image->getClientOriginalExtension();
                            $fileName = Str::uuid() . '.' . $extension;
                            $image->move('uploads/employee', $fileName);
                            $item_url = 'uploads/employee/' . $fileName;
                
                            @unlink($data->profile_photo);
                            $data->profile_photo = $item_url;
                           
                        }
                
               // dd($data->profile_photo);
                        $data->first_name = $request->input('first_name');
                        $data->last_name = $request->input('last_name');
                        $data->gender = $request->input('gender');
                        $data->birthdate = $request->input('birthdate');
                        $data->contact_number = $request->input('contact_number');
                        $data->email = $request->input('email');
                        $data->address = $request->input('address');
                        $data->joining_date = $request->input('joining_date');
                        $data->work_shift= $request->input('work_shift');
                        $data->salary = $request->input('salary');
                        $data->employee_status = $request->input('employee_status');
                        $data->department_id = $request->input('department_id');
                        $data->designation_id = $request->input('designation_id');
                        $data->role_id = $request->input('role_id');
                       // dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('employee-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('employee-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editEmployee(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Employee';
        $data['menu_active_tab'] = 'employee-list';
       
        if ($id) {
            $employee = Employee::find($id);
            
            $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            $data['role'] = Role::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            if ($employee) {
                $data['employee'] = $employee;
                return view('admin.employee.edit')->with($data);
            } else {
                return redirect()->route('employee-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('employee-list')->with('failed', 'Record not found.');
        }
    }

    public function updateEmployee(Request $request, $id) {
        if ($id) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'profile_photo' => 'nullable|image',
//                'email' => 'required',
            ]);
            $employee = Employee::find($id);
            if ($employee) {
                if ($request->file("profile_photo") && $request->file('profile_photo')->isValid()) {
                    $image = $request->file("profile_photo");
                    $extension = $image->getClientOriginalExtension();
                    $fileName = Str::uuid() . '.' . $extension;
                    $image->move('uploads/employee', $fileName);
                    $item_url = 'uploads/employee/' . $fileName;
                
                    // Remove the old image
                    @unlink($employee->profile_photo);
                
                    // Update the database with the new file path
                    $employee->profile_photo = $item_url;
                   // dd($employee->profile_photo );
                }
                $employee->first_name = $request->input('first_name');
                $employee->last_name = $request->input('last_name');
                $employee->gender = $request->input('gender');
                $employee->birthdate = $request->input('birthdate');
                $employee->contact_number = $request->input('contact_number');
                $employee->email = $request->input('email');
                $employee->address = $request->input('address');
               
                $employee->joining_date = $request->input('joining_date');
                $employee->work_shift = $request->input('work_shift');
                $employee->salary = $request->input('salary');
                $employee->employee_code = $request->input('employee_code');
                $employee->employee_status = $request->input('employee_status');
                $employee->department_id = $request->input('department_id');
                $employee->designation_id = $request->input('designation_id');
                $employee->role_id = $request->input('role_id');

                //dd($employee);
                // $employee->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $employee->save();
            }
            return redirect()->route('employee-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('employee-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteEmployee($id) {
        if ($id) {
            $emp = Employee::find($id);
            if ($emp) {
                $emp->is_deleted = '1';
                //  $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $emp->save();
            }

            return redirect()->route('employee-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('employee-list')->with('failed', 'Record not found.');
        }
    
    }


}
