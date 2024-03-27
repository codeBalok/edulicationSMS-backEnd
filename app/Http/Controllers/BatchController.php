<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Program;
use Exception;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    //

    public function batchList() {
        $data = [];
        $data['title'] = 'Batch List';
        $data['menu_active_tab'] = 'batch-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
            $data['rows'] = Batch::orderBy('id', 'desc')->get();

        return view('admin.batch.list')->with($data);
    }


    public function addBatch(Request $request) {
        $data = [];
        $data['title'] = 'Add batch';
        $data['menu_active_tab'] = 'batch-list';
        $data['programs'] = Program::where('status', '1')
        ->orderBy('title', 'asc')->get();
        $data['rows'] = Batch::orderBy('id', 'desc')->get();
        return view('admin.batch.add')->with($data);
    }

    public function storeBatch(Request $request) {

        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:batches,title',
            'start_date' => 'required|date',
            'programs' => 'required',
        ]);

       
         // Insert Data
            try {
               
                $batch = new Batch;
                $batch->title = $request->title;
                $batch->start_date = $request->start_date;
                $batch->save();
        
                $batch->programs()->attach($request->programs);
        
                        
                return redirect()->route('batch-list')->with('success', 'Record added successfully.');
            } catch (Exception $e) {
               // dd($e);
                return redirect()->route('batch-list')->with('failed', 'Record not added.');
            }
        }
    
        public function editBatch(Request $request, $id) {
            $data = [];
            $data['title'] = 'Edit Batch';
            $data['menu_active_tab'] = 'Batch-list';
            if ($id) {
                $batch = Batch::find($id);
                $data['programs'] = Program::where('status', '1')
                ->orderBy('title', 'asc')->get();

                $data['batch'] = Batch::where('is_deleted', '0')->orderBy('id', 'ASC')->get();
               
                if ($batch) {
                    $data['batch'] = $batch;
                    
                    
                    return view('admin.batch.edit')->with($data);
                } else {
                    return redirect()->route('batch-list')->with('failed', 'Record not found.');
                }
            } else {
                return redirect()->route('batch-list')->with('failed', 'Record not found.');
            }
        }
        public function updateBatch(Request $request, $id) {
            //field validation
            $request->validate([
                'title' => 'required|max:191|unique:batches,title,'.$id,
                'start_date' => 'required|date',
                'programs' => 'required',
            ]);

            // Your existing logic to update the record
            $data = Batch::find($id);

            // Update Data
            $data->title = $request->title;
            $data->start_date = $request->start_date;
            $data->status = $request->status;
            $data->save();

            $data->programs()->sync($request->programs);
     
         // Redirect or respond accordingly
         return redirect()->route('batch-list')->with('success', 'Batch updated successfully');
             }
         
         public function deleteBatch($id) {
             if ($id) {
                 $batch = Batch::find($id);
                 if ($batch) {
                     $batch->is_deleted = '1';
                     
                     $batch->save();
                 }
                 return redirect()->route('batch-list')->with('success', 'Record deleted.');
             } else {
                 return redirect()->route('batch-list')->with('failed', 'Record not found.');
             }
         }
}
