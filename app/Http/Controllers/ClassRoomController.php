<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Program;
use Exception;
use Illuminate\Http\Request;
use Str;

class ClassRoomController extends Controller
{
    //
    public function classroomList() {
        $data = [];
        $data['title'] = 'Classroom List';
        $data['menu_active_tab'] = 'classroom-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
            $data['rows'] = ClassRoom::orderBy('id', 'desc')->get();

        return view('admin.classroom.list')->with($data);
    }


    public function addClassroom(Request $request) {
        $data = [];
        $data['title'] = 'Add classroom';
        $data['menu_active_tab'] = 'classroom-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
        $data['rows'] = ClassRoom::orderBy('id', 'desc')->get();
        return view('admin.classroom.add')->with($data);
    }

    public function storeClassroom(Request $request) {

       // Field Validation
       $request->validate([
        'roomno' => 'required|max:191|unique:class_rooms,title',
        'capacity' => 'nullable|numeric',
    ]);

       
         // Insert Data
            try {
               
               // Insert Data
        $classRoom = new ClassRoom;
        $classRoom->title = $request->roomno;
        $classRoom->slug = Str::slug($request->roomno, '-');
        $classRoom->floor = $request->floor;
        $classRoom->capacity = $request->capacity;
        $classRoom->type = $request->type;
        $classRoom->description = $request->description;
        //dd($classRoom);
        $classRoom->save();

        // Attach
        $classRoom->programs()->attach($request->programs);
        
                        
                return redirect()->route('classroom-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('classroom-list')->with('failed', 'Record not added.');
            }
        }

        public function editClassroom(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Classroom';
            $data['menu_active_tab'] = 'Classroom-list';
            if ($id) {
                $classroom = ClassRoom::find($id);
                $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')->get();

                $data['classroom'] = ClassRoom::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($classroom) {
                    $data['classroom'] = $classroom;
                    
                    
                    return view('admin.classroom.edit')->with($data);
                } else {
                    return redirect()->route('classroom-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('classroom-list')->with('failed', 'Record not found.');
            }
        }
        public function updateClassroom(Request $request, $id) {
            //field validation
            $request->validate([
                'roomno' => 'required|max:191|unique:class_rooms,title,'.$id,
                'capacity' => 'nullable|numeric',
            ]);
    

            

           // Update Data
            $data = ClassRoom::findOrFail($id);
            $data->title = $request->roomno;
            $data->slug = Str::slug($request->roomno, '-');
            $data->floor = $request->floor;
            $data->capacity = $request->capacity;
            $data->type = $request->type;
            $data->description = $request->description;
            $data->status = $request->status;
            $data->save();

                // Attach Update
                $data->programs()->sync($request->programs);
            
         // Redirect or respond accordingly
         return redirect()->route('classroom-list')->with('success', 'classroom updated successfully');
             }
         
         public function deleteClassroom($id) {
             if ($id) {
                $classroom = ClassRoom::find($id);
                 if ($classroom) {
                    $classroom->is_deleted = '1';
                     
                    $classroom->save();
                 }
                 return redirect()->route('classroom-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('classroom-list')->with('failed', 'Record not found.');
             }
         }
}
