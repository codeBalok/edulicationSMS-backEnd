<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    //
    public function departmentList() {
        $data = [];
        $data['title'] = 'Department List';
        $data['menu_active_tab'] = 'user-list';
        $data['department'] = Department::orderBy('id', 'DESC')->get();

        return view('admin.department.list')->with($data);
    }
    public function addDepartment(Request $request) {
        $data = [];
        $data['title'] = 'Add department';
        $data['menu_active_tab'] = 'add-department';
        return view('admin.department.add')->with($data);
    }
    public function storeDepartment(Request $request) {
        //dd($request);
        $rules = [
            'department_name' => 'required|string|min:1|max:255',
//            
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            // $data = $request->input();
         
            try {
                $data = new Department();
                        $data->department_name = $request->input('department_name');
                        $data->description = $request->input('description');
                        //dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('department-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('department-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editDepartment(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Department';
        $data['menu_active_tab'] = 'department-list';
        if ($id) {
            $department = Department::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($department) {
                $data['department'] = $department;
                return view('admin.department.edit')->with($data);
            } else {
                return redirect()->route('department-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('department-list')->with('failed', 'Record not found.');
        }
    }
    public function updateDepartment(Request $request, $id) {
        if ($id) {
            $request->validate([
                'department_name' => 'required',
                
            ]);
            $department = Department::find($id);
            if ($department) {
                $department->department_name = $request->input('department_name');
                $department->description = $request->input('description');
               
                $department->save();

            }
            return redirect()->route('department-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('department-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteDepartment($id) {
        if ($id) {
            $department = Department::find($id);
            if ($department) {
                $department->is_deleted = '1';
                // $department->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $department->save();
            }
            return redirect()->route('department-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('department-list')->with('failed', 'Record not found.');
        }
    }
}
