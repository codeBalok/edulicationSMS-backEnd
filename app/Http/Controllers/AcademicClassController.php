<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class AcademicClassController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Academic Class List';
        $data['menu_active_tab'] = 'academic-class-list';
        $data['academic_class'] = \App\Models\AcademicClass::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.academic_class.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Academic Class';
        $data['menu_active_tab'] = 'add-academic-class';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.academic_class.add')->with($data);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|string|min:3|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $academic_class = new \App\Models\AcademicClass();
                $academic_class->name = $data['name'];
//                $academic_class->academic_session_id = isset($data['academic_session_id']) ? $data['academic_session_id'] : null;
                $academic_class->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $academic_class->save();
                return redirect()->route('academic-class-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
                return redirect()->route('academic-class-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Academic Class';
        $data['menu_active_tab'] = 'academic-class-list';
        if ($id) {
            $academic_class = \App\Models\AcademicClass::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($academic_class) {
                $data['academic_class'] = $academic_class;
                return view('admin.academic_class.edit')->with($data);
            } else {
                return redirect()->route('academic-class-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('academic-class-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $request->validate([
                'name' => 'required',
            ]);
            $data = $request->input();
            $academic_class = \App\Models\AcademicClass::find($id);
            if ($academic_class) {
                $academic_class->name = $data['name'];
//                $academic_class->academic_session_id = $data['academic_session_id'];
                $academic_class->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $academic_class->save();

                return redirect()->route('academic-class-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('academic-class-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $academic_class = \App\Models\AcademicClass::find($id);
            if ($academic_class) {
                $academic_class->is_deleted = '1';
//                $academic_class->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $academic_class->save();
            }
            return redirect()->route('academic-class-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('academic-class-list')->with('failed', 'Record not found.');
        }
    }

}
