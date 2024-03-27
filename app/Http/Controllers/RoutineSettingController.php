<?php

namespace App\Http\Controllers;

use App\Models\PrintSetting;

use Illuminate\Http\Request;
use File;
use Intervention\Image\Facades\Image;



class RoutineSettingController extends Controller
{
    
    //

    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_class_routine', 1).' '.trans_choice('module_setting', 1);
        $this->access = 'routine-setting';
    }

    public function class()
    {
        //
       
        $data['access'] = $this->access;
        
        $data['row'] = PrintSetting::where('slug', 'class-routine')->first();

        return view('admin.routine_setting.class', $data);
    }

    public function exam()
    {
        //
        $data['title'] = trans_choice('module_exam_routine', 1).' '.trans_choice('module_setting', 1);
       
        $data['access'] = $this->access;
        
        $data['row'] = PrintSetting::where('slug', 'exam-routine')->first();

        return view('admin.routine_setting.exam')->with($data);
    }
    public function uploadImage(Request $request, $attach, $directory, $width, $height) {

        // File upload, fit and store inside public folder 
        if($request->hasFile($attach)){

            // Valid extension check
            $valid_extensions = array('jpg','jpeg','png','gif','ico','svg','webp');
            $file_ext = $request->file($attach)->getClientOriginalExtension();
            if(in_array($file_ext, $valid_extensions, true))
            {

            //Upload New File
            $filenameWithExt = $request->file($attach)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file($attach)->getClientOriginalExtension();
            $fileNameToStore = str_replace([' ','-','&','#','$','%','^',';',':'],'_',$filename).'_'.time().'.'.$extension;

            //Crete Folder Location
            $path = public_path('uploads/'.$directory.'/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here ($width width, $height height)
            $thumbnailpath = $path.$fileNameToStore;
            $img = Image::make($request->file($attach)->getRealPath())->resize($width, $height, function ($constraint) { $constraint->aspectRatio(); $constraint->upsize(); })->save($thumbnailpath);

            }
            else {
                $fileNameToStore = Null;
            }
        }
        else{
            $fileNameToStore = Null;
        }


        return $fileNameToStore;
    }


    public function updateImage(Request $request, $attach, $directory, $width, $height, $model, $field) {

        // File upload, fit and store inside public folder 
        if($request->hasFile($attach)){

            // Valid extension check
            $valid_extensions = array('jpg','jpeg','png','gif','ico','svg','webp');
            $file_ext = $request->file($attach)->getClientOriginalExtension();
            if(in_array($file_ext, $valid_extensions, true))
            {

            $old_attach = public_path('uploads/'.$directory.'/'.$model->$field);
            if(File::isFile($old_attach)){
                File::delete($old_attach);
            }

            //Upload New File
            $filenameWithExt = $request->file($attach)->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file($attach)->getClientOriginalExtension();
            $fileNameToStore = str_replace([' ','-','&','#','$','%','^',';',':'],'_',$filename).'_'.time().'.'.$extension;

            //Crete Folder Location
            $path = public_path('uploads/'.$directory.'/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here ($width width, $height height)
            $thumbnailpath = $path.$fileNameToStore;
            $img = Image::make($request->file($attach)->getRealPath())->resize($width, $height, function ($constraint) { $constraint->aspectRatio(); $constraint->upsize(); })->save($thumbnailpath);

            }
            else {
                $fileNameToStore = $model->$field;
            }
        }
        else{
            $fileNameToStore = $model->$field;
        }


        return $fileNameToStore;
    }

    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'logo_left' => 'nullable|image',
            'logo_right' => 'nullable|image',
            'background' => 'nullable|image',
        ]);

        // Student Photo
        if($request->student_photo == null || $request->student_photo != 1){
            $student_photo = 0;
        }
        else {
            $student_photo = 1;
        }

        // Barcode
        if($request->barcode == null || $request->barcode != 1){
            $barcode = 0;
        }
        else {
            $barcode = 1;
        }


        $id = $request->id;

        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $printSetting = new PrintSetting;

            $printSetting->slug = $request->slug;
            $printSetting->title = $request->title;
            $printSetting->header_left = $request->header_left;
            $printSetting->header_center = $request->header_center;
            $printSetting->header_right = $request->header_right;
            $printSetting->body = $request->body;
            $printSetting->footer_left = $request->footer_left;
            $printSetting->footer_center = $request->footer_center;
            $printSetting->footer_right = $request->footer_right;
            $printSetting->logo_left = $this->uploadImage($request, 'logo_left', 'uploads/print-setting', Null, 200);
            $printSetting->logo_right = $this->uploadImage($request, 'logo_right', 'uploads/print-setting', Null, 200);
            $printSetting->background = $this->uploadImage($request, 'background', 'uploads/print-setting', 800, Null);
            $printSetting->width = $request->width;
            $printSetting->height = $request->height;
            $printSetting->student_photo = $student_photo;
            $printSetting->barcode = $barcode;
            $printSetting->save();
        }
        else{
            // Update Data
            $printSetting = PrintSetting::find($id);

            $printSetting->slug = $request->slug;
            $printSetting->title = $request->title;
            $printSetting->header_left = $request->header_left;
            $printSetting->header_center = $request->header_center;
            $printSetting->header_right = $request->header_right;
            $printSetting->body = $request->body;
            $printSetting->footer_left = $request->footer_left;
            $printSetting->footer_center = $request->footer_center;
            $printSetting->footer_right = $request->footer_right;
            $printSetting->logo_left = $this->updateImage($request, 'logo_left', 'uploads/print-setting', Null, 200, $printSetting, 'logo_left');
            $printSetting->logo_right = $this->updateImage($request, 'logo_right', 'uploads/print-setting', Null, 200, $printSetting, 'logo_right');
            $printSetting->background = $this->updateImage($request, 'background', 'uploads/print-setting', 800, Null, $printSetting, 'background');
            $printSetting->width = $request->width;
            $printSetting->height = $request->height;
            $printSetting->student_photo = $student_photo;
            $printSetting->barcode = $barcode;
            $printSetting->save();
        }


        session()->flash('Success', ('Record Updated successfully'));

        return redirect()->back();
    }
}
