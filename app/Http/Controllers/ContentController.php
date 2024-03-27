<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Content;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class ContentController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Content List';
        $data['menu_active_tab'] = 'content-list';
        $data['content'] = Content::orderBy('id', 'DESC')->where('status', '1')->where('is_deleted', '0')->get();

        return view('admin.content.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Content';
        $data['menu_active_tab'] = 'add-content';
        $data['content'] = Content::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
        $data['content_type'] = \App\Models\ContentType::where('is_deleted', '0')->where('status', '1')->orderBy('id', 'ASC')->get();
        $data['faculty'] = \App\Models\Faculty::where('is_deleted', '0')->where('status', '1')->orderBy('id', 'ASC')->get();

        return view('admin.content.add')->with($data);
    }

    public function store(Request $request) {
        $data = $request->input();
        try {
            $content = new Content();
            $content->title = $data['title'];
            $content->status = $data['status'];
            $content->content_type = $data['content_type'];
            $content->faculty_id = $data['faculty_id'];
            $content->source_url = $data['source_url'];
            $content->description = $data['description'];
            $content->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
            $content->save();
            return redirect()->route('content-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('content-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Content';
        $data['menu_active_tab'] = 'content-list';
        if ($id) {
            $content = Content::find($id);
            if ($content) {
                $data['content'] = $content;
                $data['content_type'] = \App\Models\ContentType::where('is_deleted', '0')->where('status', '0')->orderBy('id', 'ASC')->get();
                return view('admin.content.edit')->with($data);
            } else {
                return redirect()->route('content-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('content-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {
            $data = $request->input();
            $content = Content::find($id);
            if ($content) {
                $content->title = $data['title'];
                $content->status = $data['status'];
                $content->content_type = $data['content_type'];
                $content->faculty_id = $data['faculty_id'];
                $content->source_url = $data['source_url'];
                $content->description = $data['description'];
                $content->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $content->save();

                return redirect()->route('content-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('content-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $content = Content::find($id);
            if ($content) {
                $content->is_deleted = '1';
                $content->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $content->save();
            }
            return redirect()->route('content-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('content-list')->with('failed', 'Record not found.');
        }
    }

}
