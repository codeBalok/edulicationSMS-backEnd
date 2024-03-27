<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    //
    public function designationList() {
        $data = [];
        $data['title'] = 'Designation List';
        $data['menu_active_tab'] = 'designation-list';
        // $data['designation'] = Designation::orderBy('id', 'DESC')->get();
        $data['designation'] = Designation::join('department', 'designation.department_id', '=', 'department.id')
        ->orderBy('id', 'DESC')
        ->get(['designation.*','department.department_name']);
        
        //dd($designation);

        return view('admin.designation.list')->with($data);
    }
    public function addDesignation(Request $request) {
        $data = [];
        $data['title'] = 'Add designation';
        $data['menu_active_tab'] = 'add-designation';
        $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        return view('admin.designation.add')->with($data);
    }
    public function storeDesignation(Request $request) {
        //dd($request);
        $rules = [
            'designation_name' => 'required|string|min:1|max:255',
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
                $data = new Designation();
                        $data->designation_name = $request->input('designation_name');
                        $data->department_id= $request->input('department_id');
                        $data->description = $request->input('description');
                       
                        //dd($data);
                        $data->save();
                       // dd("success");
                return redirect()->route('designation-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('designation-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editDesignation(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Designation';
        $data['menu_active_tab'] = 'designation-list';
        if ($id) {
            $designation = Designation::find($id);
            $data['department'] = Department::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            if ($designation) {
                $data['designation'] = $designation;
                //dd($data['designation']);
                return view('admin.designation.edit')->with($data);
            } else {
                return redirect()->route('designation-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('designation-list')->with('failed', 'Record not found.');
        }
    }
    public function updateDesignation(Request $request, $id) {
        
        if ($id) {
            
            $request->validate([
                'designation_name' => 'required',

            ]);
           
            $data = $request->input();
            //dd($data);
            $designation = Designation::find($id);

          //  dd($designation);
            if ($designation) {
                
                $designation->designation_name = isset($data['designation_name']) ? $data['designation_name'] : null;
                $designation->department_id = isset($data['department_id']) ? $data['department_id'] : null;
                $designation->description = isset($data['description']) ? $data['description'] : 1;

                $designation->save();
                
            }
            //dd('success');
            return redirect()->route('designation-list')->with('success', 'Record Updated.');
        } else {
           // dd('fail');
            return redirect()->route('designation-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteDesignation($id) {
        if ($id) {
            $designation = Designation::find($id);
            if ($designation) {
                $designation->is_deleted = '1';
                // $department->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $designation->save();
            }
            return redirect()->route('designation-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('designation-list')->with('failed', 'Record not found.');
        }
    }

}
