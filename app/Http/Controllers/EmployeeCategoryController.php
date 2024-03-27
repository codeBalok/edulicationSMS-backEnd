<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\EmployeeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeCategoryController extends Controller
{
    //
    public function employeecategoryList() {
        $data = [];
        $data['title'] = 'Employee Category List';
        $data['menu_active_tab'] = 'employee-category-list';
        $data['employeecategory'] = EmployeeCategory::join('designation','designation.id','=','employee_category.employee_designation_id')
        ->orderBy('id', 'DESC')
        ->get(['employee_category.*','designation.designation_name']);
 
           // dd($data);
        return view('admin.employee_category.list')->with($data);
    }
    public function addEmployeeCategory(Request $request) {
        $data = [];
        $data['title'] = 'Add Employee Category';
        $data['menu_active_tab'] = 'add-employeecategory';
        $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();

        return view('admin.employee_category.add')->with($data);
    }
    public function storeEmployeeCategory(Request $request) {
        //dd($request);
        $rules = [
             'name' => 'required|string|max:255',
               
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
             $data = $request->input();
         //dd($data);
            try {
                $data = new EmployeeCategory();
        
               
                        $data->name = $request->input('name');
                        $data->description = $request->input('description');
                        $data->employee_designation_id = $request->input('designation_id');
                        
                       // dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('employeecategory-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('employeecategory-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editEmployeeCategory(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Employee Category';
        $data['menu_active_tab'] = 'employee-category-list';
        if ($id) {
            $employeecategory = EmployeeCategory::find($id);
            $data['designation'] = Designation::where('is_deleted', '0')->orderBy('id', 'ASC')->get();

            if ($employeecategory) {
                $data['employeecategory'] = $employeecategory;
                return view('admin.employee_category.edit')->with($data);
            } else {
                return redirect()->route('employeecategory-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('employeecategory-list')->with('failed', 'Record not found.');
        }
    }

    public function updateEmployeeCategory(Request $request, $id) {
        if ($id) {
            $request->validate([
                'name' => 'required',
                
            ]);
            $employeecategory = EmployeeCategory::find($id);
            if ($employeecategory) {
                $employeecategory->name = $request->input('name');
                $employeecategory->description = $request->input('description');
                $employeecategory->employee_designation_id = $request->input('designation_id');
                // $employee->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $employeecategory->save();
            }
            return redirect()->route('employeecategory-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('employeecategory-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteEmployeeCategory($id) {
        if ($id) {
            $emp = EmployeeCategory::find($id);
            if ($emp) {
                $emp->is_deleted = '1';
                //  $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $emp->save();
            }

            return redirect()->route('employeecategory-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('employeecategory-list')->with('failed', 'Record not found.');
        }
    
    }



}
