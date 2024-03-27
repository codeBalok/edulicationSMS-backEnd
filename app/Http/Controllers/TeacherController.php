<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class TeacherController extends Controller {

    public function list() {
        $data = [];
        $data['title'] = 'Teacher List';
        $data['menu_active_tab'] = 'teacher-list';
        $data['teacher'] = Teacher::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        return view('admin.teacher.list')->with($data);
    }

    public function add(Request $request) {
        $data = [];
        $data['title'] = 'Add Teacher';
        $data['menu_active_tab'] = 'add-teacher';
        $data['teacher'] = Teacher::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
        $data['subject'] = \App\Models\Subject::where('is_deleted', '0')->orderBy('id', 'ASC')->get();

        return view('admin.teacher.add')->with($data);
    }

    public function store(Request $request) {

        $data = $request->input();
        try {
            $teacher = new \App\Models\Teacher();
            $teacher->first_name = $data['first_name'];
            $teacher->last_name = $data['last_name'];
            $teacher->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
            $teacher->save();
            if (isset($teacher->id)) {
                $teacher_id = $teacher->id;
                if (isset($request->subject_id)) {
                    $subject_id = $request->subject_id;
                    foreach ($subject_id as $key => $row) {
                        $teacher_subject = new \App\Models\TeacherSubject();
                        $teacher_subject->teacher_id = $teacher_id;
                        $teacher_subject->subject_id = $row;
                        $teacher_subject->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                        $teacher_subject->save();
                    }
                }
            }
            return redirect()->route('teacher-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('teacher-list')->with('failed', 'Record not added.');
        }
    }

    public function edit(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Teacher';
        $data['menu_active_tab'] = 'teacher-list';
        if ($id) {
            $teacher = \App\Models\Teacher::find($id);
            $data['teacher'] = Teacher::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($teacher) {
                $data['teacher'] = $teacher;
                $data['subject'] = \App\Models\Subject::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
                $teacher_subject = \App\Models\TeacherSubject::where('teacher_id', $id)->where('is_deleted', '0')->orderBy('id', 'ASC')->get()->toArray();
                $teacher_subject_arr = array_column($teacher_subject, 'subject_id');
                $data['teacher_subject_arr'] = $teacher_subject_arr;
                return view('admin.teacher.edit')->with($data);
            } else {
                return redirect()->route('teacher-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('teacher-list')->with('failed', 'Record not found.');
        }
    }

    public function update(Request $request, $id) {
        if ($id) {

            $data = $request->input();
            $teacher = \App\Models\Teacher::find($id);
            if ($teacher) {
                $teacher->first_name = $data['first_name'];
                $teacher->last_name = $data['last_name'];
                $teacher->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $teacher->save();
                if ($id) {
                    $subject_id = array();
                    if (isset($request->subject_id)) {
                        $subject_id = $request->subject_id;
                        if (!empty($subject_id)) {
                            foreach ($subject_id as $key => $row) {

                                if ($row != null) {
                                    $teacher_subject = \App\Models\TeacherSubject::where('teacher_id', $id)->where('subject_id', $row)->where('is_deleted', '0')->first();
                                }
                                if ($teacher_subject) {
                                    $teacher_subject->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                                } else {
                                    $teacher_subject = new \App\Models\TeacherSubject();
                                    $teacher_subject->teacher_id = $id;
                                    $teacher_subject->subject_id = $row;
                                    $teacher_subject->created_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                                }
                                $teacher_subject->save();
                            }
                        }
                    }
                    $teacher_subject_result = \App\Models\TeacherSubject::where('teacher_id', $id)->where('is_deleted', '0')->get()->toArray();
                    $subject_id_arr = array_column($teacher_subject_result, 'subject_id');
                    $difference_arr = array_diff($subject_id_arr, $subject_id);
                    if (!empty($difference_arr)) {
                        foreach ($difference_arr as $key => $row) {
                            $teacher_subject_first = \App\Models\TeacherSubject::where('subject_id', $row)->where('is_deleted', '0')->first();
                            if ($teacher_subject_first) {
                                $teacher_subject_first->is_deleted = '1';
                                $teacher_subject_first->save();
                            }
                        }
                    }
                }
                return redirect()->route('teacher-list')->with('success', 'Record Updated.');
            } else {
                return redirect()->route('teacher-list')->with('failed', 'Record not found.');
            }
        }
    }

    public function delete($id) {
        if ($id) {
            $teacher = \App\Models\Teacher::find($id);
            if ($teacher) {
                $teacher->is_deleted = '1';
                $teacher->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $teacher->save();
            }
            return redirect()->route('teacher-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('teacher-list')->with('failed', 'Record not found.');
        }
    }

}
