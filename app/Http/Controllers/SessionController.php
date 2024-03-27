<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Session;
use Exception;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    //
    public function sessionList() {
        $data = [];
        $data['title'] = 'Session List';
        $data['menu_active_tab'] = 'session-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
            $data['rows'] = Session::orderBy('id', 'desc')->get();

        return view('admin.session.list')->with($data);
    }


    public function addSession(Request $request) {
        $data = [];
        $data['title'] = 'Add session';
        $data['menu_active_tab'] = 'session-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
        $data['rows'] = Session::orderBy('id', 'desc')->get();
        return view('admin.session.add')->with($data);
    }

    public function storeSession(Request $request) {

        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:sessions,title',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'programs' => 'required',
        ]);
       
         // Insert Data
            try {
               
                 // Insert Data
                $session = new Session;
                $session->title = $request->title;
                $session->start_date = $request->start_date;
                $session->end_date = $request->end_date;
                $session->current = 1;
                $session->save();

                // Unset current
                Session::where('id', '!=', $session->id)->update([
                    'current' => 0
                ]);

                $session->programs()->attach($request->programs);
        
                        
                return redirect()->route('session-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('session-list')->with('failed', 'Record not added.');
            }

        }

        public function editSession(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Session';
            $data['menu_active_tab'] = 'Session-list';
            if ($id) {
                $session = Session::find($id);
                $data['session'] = Session::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
                $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')->get();
                if ($session) {
                    $data['session'] = $session;
                    
                    
                    return view('admin.session.edit')->with($data);
                } else {
                    return redirect()->route('session-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('session-list')->with('failed', 'Record not found.');
            }
        }
        public function updateSession(Request $request, $id) {
            //field validation
            
            $request->validate([
                'title' => 'required|max:191|unique:sessions,title,'.$id,
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'programs' => 'required',
            ]);

            // Your existing logic to update the record
            $data = Session::find($id);

            // Update Data
           
            $data->title = $request->title;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->status = $request->status;
            $data->save();

            $data->programs()->sync($request->programs);
     
         // Redirect or respond accordingly
         return redirect()->route('session-list')->with('success', 'Session updated successfully');
             }
         
         public function deleteSession($id) {
             if ($id) {
                 $session = Session::find($id);
                 if ($session) {
                     $session->is_deleted = '1';
                     
                     $session->save();
                 }
                 return redirect()->route('session-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('session-list')->with('failed', 'Record not found.');
             }
         }
        public function current($id)
        {   
            try{
            // Set current
            Session::where('id', '=', $id)->update([
                'current' => 1,
                'status' => 1
            ]); 
    
            // Unset current
            Session::where('id', '!=', $id)->update([
                'current' => 0
            ]);
    
            return redirect()->route('session-list')->with('success', ' Updated successfully.');
        }
        catch(Exception $e)
        {
            return redirect()->route('session-list')->with('failed', 'Record not updated.');
        }
        }
    
}
