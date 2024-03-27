<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Assignment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class AssignmentController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Assignment List';
        $data['menu_active_tab'] = 'assignment-list';
        $data['assignment'] = Assignment::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.assignment.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Assignment';
        $data['menu_active_tab'] = 'add-assignment';
        $data['assignment'] = Assignment::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['assignment'] = \App\Models\Faculty::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['subject'] = \App\Models\Subject::where('is_deleted', '0')->orderBy('id', 'ASC')->get();

        return view('admin.assignment.add')->with($data);
    }

    public function store(Request $request) {

        $data = $request->input();
        try {
            $assignment = new Assignment();
            $assignment->title = $data['title'];
            $assignment->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
            $assignment->save();
            return redirect()->route('assignment-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('assignment-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Assignment';
        $data['menu_active_tab'] = 'assignment-list';
        if ($id) {
            $assignment = Assignment::find($id);
            if ($assignment) {
                $data['assignment'] = $assignment;
                return view('admin.assignment.edit')->with($data);
            } else {
                return redirect()->route('assignment-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('assignment-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $data = $request->input();
            $assignment = Assignment::find($id);
            if ($assignment) {
                $assignment->title = $data['title'];
                $assignment->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $assignment->save();

                return redirect()->route('assignment-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('assignment-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $assignment = Assignment::find($id);
            if ($assignment) {
                $assignment->is_deleted = '1';
                $assignment->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $assignment->save();
            }
            return redirect()->route('assignment-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('assignment-list')->with('failed', 'Record not found.');
        }
    }

}
