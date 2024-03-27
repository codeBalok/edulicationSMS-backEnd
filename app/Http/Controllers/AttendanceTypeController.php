<?php

namespace App\Http\Controllers;

use App\Models\AttendanceType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceTypeController extends Controller
{
    //

    public function attendancetypeList() {
        $data = [];
        $data['title'] = 'Attendance type List';
        $data['menu_active_tab'] = 'attendancetype-list';
        $data['attendancetype'] = AttendanceType::orderBy('id', 'DESC')->get();

        return view('admin.attendancetype.list')->with($data);
    }

    public function addAttendanceType(Request $request) {
        $data = [];
        $data['title'] = 'Add Attendance Type';
        $data['menu_active_tab'] = 'add-attendancetype';
        return view('admin.attendancetype.add')->with($data);
    }

    public function storeAttendanceType(Request $request) {
        //dd($request);
        $rules = [
            'type' => 'required|string|min:1|max:255',
            'name' => 'required|string|min:1|max:255',

//            
        ];
        $validator = Validator::make($request->all(), $rules);
            //dd($validator);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
             $data = $request->input();
         
            try {
                $data = new AttendanceType();
               
                    //dd($isActive);
                        $data->type = $request->input('type');
                        $data->name = $request->input('name');
                        $data->description = $request->input('description');
                        $data->is_active = $request->input('is_active');
                        
                        //dd($data);
                        $data->save();
                        //dd("success");
                return redirect()->route('attendancetype-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('attendancetype-list')->with('failed', 'Record not added.');
            }
        }
    }
    public function editAttendanceType(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Attendance Type';
        $data['menu_active_tab'] = 'attendancetype-list';
        if ($id) {
            $designation = AttendanceType::find($id);
            $data['attendancetype'] = AttendanceType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            if ($designation) {
                $data['attendancetype'] = $designation;
                //dd($data['designation']);
                return view('admin.attendancetype.edit')->with($data);
            } else {
                return redirect()->route('attendancetype-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('attendancetype-list')->with('failed', 'Record not found.');
        }
    }
    public function updateAttendanceType(Request $request, $id) {
        
        if ($id) {
            
            $request->validate([
                'type' => 'required',
                'name' => 'required',

            ]);
           
            $data = $request->input();
            //dd($data);
            $attendancetype = AttendanceType::find($id);

          //  dd($designation);
            if ($attendancetype) {
                
                $attendancetype->type = isset($data['type']) ? $data['type'] : null;
                $attendancetype->name = isset($data['name']) ? $data['name'] : null;
                $attendancetype->is_active = $request->has('is_active');
                $attendancetype->description = isset($data['description']) ? $data['description'] : 1;

                $attendancetype->save();
                
            }
            //dd('success');
            return redirect()->route('attendancetype-list')->with('success', 'Record Updated.');
        } else {
           // dd('fail');
            return redirect()->route('attendancetype-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteAttendanceType($id) {
        if ($id) {
            $attendancetype = AttendanceType::find($id);
            if ($attendancetype) {
                $attendancetype->is_deleted = '1';
                // $department->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $attendancetype->save();
            }
            return redirect()->route('attendancetype-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('attendancetype-list')->with('failed', 'Record not found.');
        }
    }
    
}
