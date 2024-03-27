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

class RoleController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Role List';
        $data['menu_active_tab'] = 'role-list';
        $data['role'] = \App\Models\Role::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.role.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Role';
        $data['menu_active_tab'] = 'add-role';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.role.add')->with($data);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:roles,name'
        ]);
        $data = $request->input();
        try {
            $role = new \App\Models\Role();
            $role->name = $data['name'];
            $role->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
            $role->save();
            return redirect()->route('role-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('role-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Role';
        $data['menu_active_tab'] = 'role-list';
        if ($id) {
            $role = \App\Models\Role::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($role) {
                $data['role'] = $role;
                return view('admin.role.edit')->with($data);
            } else {
                return redirect()->route('role-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('role-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $this->validate($request, [
                'name' => 'required|unique:roles,name,' . $id,
            ]);
            $data = $request->input();
            $role = \App\Models\Role::find($id);
            if ($role) {
                $role->name = $data['name'];
                $role->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $role->save();

                return redirect()->route('role-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('role-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $role = \App\Models\Role::find($id);
            if ($role) {
                $role->is_deleted = '1';
                $role->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $role->save();
            }
            return redirect()->route('role-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('role-list')->with('failed', 'Record not found.');
        }
    }

}
