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

class AcademicSessionController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Academic Session List';
        $data['menu_active_tab'] = 'academic-session-list';
        $data['academic_session'] = \App\Models\AcademicSession::orderBy('id', 'DESC')->where('is_deleted', '0')->get();
//dd($data['academic_session'] );
        return view('admin.academic_session.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Academic Session';
        $data['menu_active_tab'] = 'add-academic-session';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.academic_session.add')->with($data);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:1|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('insert')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            $data = $request->input();
            try {
                $academic_session = new \App\Models\AcademicSession();
                $academic_session->name = $data['name'];
                $academic_session->start_date = $data['start_date'];
                $academic_session->end_date = $data['end_date'];
                $academic_session->description = $data['description'];
                $academic_session->save();
                return redirect()->route('academic-session-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
                return redirect()->route('academic-session-list')->with('failed', 'Record not added.');
            }
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Academic Session';
        $data['menu_active_tab'] = 'academic-session-list';
        if ($id) {
            $academic_session = \App\Models\AcademicSession::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($academic_session) {
                $data['academic_session'] = $academic_session;
                return view('admin.academic_session.edit')->with($data);
            } else {
                return redirect()->route('academic-session-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('academic-session-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $request->validate([
                'name' => 'required',
            ]);
            $data = $request->input();
            $academic_session = \App\Models\AcademicSession::find($id);
            if ($academic_session) {
                $academic_session->name = $data['name'];
                $academic_session->start_date = $data['start_date'];
                $academic_session->end_date = $data['end_date'];
                $academic_session->description = $data['description'];
                $academic_session->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $academic_session->save();

                return redirect()->route('academic-session-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('academic-session-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $academic_session = \App\Models\AcademicSession::find($id);
            if ($academic_session) {
                $academic_session->is_deleted = '1';
                $academic_session->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $academic_session->save();
            }
            return redirect()->route('academic-session-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('academic-session-list')->with('failed', 'Record not found.');
        }
    }

}
