<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Exception;
use Illuminate\Http\Request;
use Str;

class LeaveTypeController extends Controller
{
    //
    public function leavetypeList() {
        $data = [];
        $data['title'] = 'Leave type List';
        $data['menu_active_tab'] = 'leavetype-list';
        $data['rows'] = LeaveType::where('is_deleted','0')->orderBy('title', 'asc')->get();

        return view('admin.leave_type.list')->with($data);
    }

    public function addLeaveType(Request $request) {
        $data = [];
        $data['title'] = 'Add leave type';
        $data['menu_active_tab'] = 'add-leavetype';
        return view('admin.leave_type.add')->with($data);
    }
    public function storeLeaveType(Request $request) {
        
       // Field Validation
       $request->validate([
        'title' => 'required|max:191|unique:leave_types,title',
        ]);
      
      
            try {
                 // Insert Data
                $leaveType = new LeaveType;
                $leaveType->title = $request->title;
                $leaveType->slug = Str::slug($request->title, '-');
                $leaveType->limit = $request->limit ?? 0;
                $leaveType->description = $request->description;
               
                $leaveType->save();

                return redirect()->route('leavetype-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               //dd($e);
                return redirect()->route('leavetype-list')->with('failed', 'Record not added.');
            }
        
    }
    public function editLeaveType(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Leave Type';
        $data['menu_active_tab'] = 'leavetype-list';
        if ($id) {
            $leavetype = LeaveType::find($id);
            $data['leavetype'] = LeaveType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
            if ($leavetype) {
                $data['leavetype'] = $leavetype;
                
                return view('admin.leave_type.edit')->with($data);
            } else {
                return redirect()->route('leavetype-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('leavetype-list')->with('failed', 'Record not found.');
        }
    }
    public function updateLeaveType(Request $request, $id) {
        
        if ($id) {
            
            // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:leave_types,title,'.$id,
        ]);

           
        $data = $request->input();
        $leavetype = LeaveType::find($id);

          //  dd($designation);
          if ($leavetype) {
            $leavetype->title = $data['title'];
            $leavetype->slug = Str::slug($data['title'], '-');
            $leavetype->limit = $data['limit'] ?? 0;
            $leavetype->description = isset($data['description']) ? $data['description'] : null;
            $leavetype->status = $data['status'];
            $leavetype->save();
        }
        
            return redirect()->route('leavetype-list')->with('success', 'Record Updated.');
        } else {
           // dd('fail');
            return redirect()->route('leavetype-list')->with('failed', 'Record not found.');
        }
    }
    public function deleteLeaveType($id) {
        if ($id) {
            $leavetype = LeaveType::find($id);
            if ($leavetype) {
                $leavetype->is_deleted = '1';
                
                $leavetype->save();
            }
            return redirect()->route('leavetype-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('leavetype-list')->with('failed', 'Record not found.');
        }
    }
    
}
