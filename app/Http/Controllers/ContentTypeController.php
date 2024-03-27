<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\ContentType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class ContentTypeController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Content List';
        $data['menu_active_tab'] = 'content-type-list';
        $data['content_type'] = ContentType::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.content_type.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Content';
        $data['menu_active_tab'] = 'add-content-type';
        $data['content_type'] = ContentType::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['subject'] = \App\Models\Subject::where('is_deleted', '0')->orderBy('id', 'ASC')->get();

        return view('admin.content_type.add')->with($data);
    }

    public function store(Request $request) {

        $data = $request->input();
        try {
            $content_type = new ContentType();
            $content_type->title = $data['title'];
            $content_type->status = $data['status'];
            $content_type->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
            $content_type->save();
            return redirect()->route('content-type-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('content-type-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Content Type';
        $data['menu_active_tab'] = 'content-type-list';
        if ($id) {
            $content_type = ContentType::find($id);
            if ($content_type) {
                $data['content_type'] = $content_type;
                return view('admin.content_type.edit')->with($data);
            } else {
                return redirect()->route('content-type-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('content-type-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $data = $request->input();
            $content_type = ContentType::find($id);
            if ($content_type) {
                $content_type->title = $data['title'];
                $content_type->status = $data['status'];
                $content_type->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $content_type->save();

                return redirect()->route('content-type-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('content-type-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $content_type = ContentType::find($id);
            if ($content_type) {
                $content_type->is_deleted = '1';
                $content_type->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $content_type->save();
            }
            return redirect()->route('content-type-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('content-type-list')->with('failed', 'Record not found.');
        }
    }

}
