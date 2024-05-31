<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avetmiss;
use App\Models\Template;
use App\Models\BackgroundTemplate;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ImageController;
use Exception;
class CompanyController extends Controller
{
   public function avetmisssetting(){
    try {
        // Return the view
        return view('admin.company.avetmisssetting');
    } catch (Exception $e) {
        // Handle the error and redirect back with an error message
        return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page.');
    }
   }
   public function saveAvetmiss(Request $request){
      try {
         $avetmiss = new Avetmiss();
         
         // Set the attributes for the new record
         $avetmiss->contact = $request->contact;
         $avetmiss->companyIdentifier = $request->companyIdentifier;
         $avetmiss->companyType = $request->companyType;
         $avetmiss->isManagingAgent = $request->isManagingAgent;
         $avetmiss->authorityIdentifier = $request->authorityIdentifier;
         $avetmiss->authorityName = $request->authorityName;
         $avetmiss->address1 = $request->address1;
         $avetmiss->address2 = $request->address2;
         $avetmiss->suburb = $request->suburb;
         $avetmiss->state = $request->state;
         $avetmiss->pcode = $request->pcode;
         $avetmiss->tcontactf = $request->tcontactf;
         $avetmiss->temail = $request->temail;
         $avetmiss->tphone = $request->tphone;
         $avetmiss->tfax = $request->tfax;
         $avetmiss->chkRptState = json_encode($request->chkRptState);
         $avetmiss->statecompanyIdentifier = json_encode($request->statecompanyIdentifier);
         $avetmiss->fundingSourceDescription = json_encode($request->fundingSourceDescription);
         $avetmiss->fundingSourceState = json_encode($request->fundingSourceState);
         $avetmiss->save();
         return redirect()->route('company.avetmissSetting');
    
     } catch (\Exception $e) {
        
         // Optionally, display an error message or take other actions
         echo "An error occurred while creating the record: " . $e->getMessage();
     }

   }
   public function certificate(Request $request){
      try {
            
        $certificateId = $request->query('makeDefault');
        if($certificateId != null){
            $certificate = Template::find($certificateId);
            if ($certificate) {
                // Set the certificate as default (example logic)
                $certificate->is_default = true;
                $certificate->save();

                // Optionally, unset other certificates as default
                Template::where('id', '!=', $certificateId)->update(['is_default' => false]);

                // Return a success response
                return view('admin.company.certificate',compact('templates'));
            } else {
                return view('admin.company.certificate',compact('templates'));

            }
        }else{
            $templates = Template::get();
            return view('admin.company.certificate',compact('templates'));
        }
     } catch (\Exception $e) {
         Log::error('Error rendering AVETMISS setting view: ' . $e->getMessage());
 
         // Optionally, you can redirect to a different page or show an error message
         return redirect()->back()->with('error', 'An error occurred while loading the AVETMISS settings page. Please try again later.');
     }
   }
   public function template(Request $request){  
        //  dd($request);
        try {
            // Create a new template instance
            $template = new Template;
            $template->newCertificateName = $request->newCertificateName;
            $template->save();

            // Redirect to the edit route with success message
            return redirect()->route('certificate.template.edit', $template->id)->with('success', 'Template created successfully.');
        } catch (Exception $e) {
            // Redirect back with error message
            return redirect()->back()->with('error', 'An error occurred while creating the template.');
        }

   }

   public function templateEdit($id){
    try {
        $template = Template::where('id', $id)->first();
        if (!$template) {
            throw new \Exception('Template not found');
        }
        return view('admin.company.certificateEdit', compact('template'));
    } catch (\Exception $e) {
        // Handle the exception, log it or display an error message
        return redirect()->back()->with('error', $e->getMessage());
    }
   }

   public function template_update(Request $request,$id){ 
    try {
        // Find the template by ID
        $template = Template::find($id);

        // Validate if the template is found
        if (!$template) {
            return redirect()->back()->with('error', 'Template not found.');
        }

        // Update template fields
        $template->newCertificateName = $request->newCertificateName;
        $template->leading_text = $request->leading_text;
        $template->orientation = $request->orientation;
        $template->size = $request->size;
        $template->trailing_text = $request->trailing_text;

        // Handle image upload
        $myimage = "null";
        if (!is_null($request->image)) {
            $image = new ImageController;
            $myimage = $image->files($request->image);
            $template->image = $myimage;
        }

        // Prepare signing authority data
        $text1 = [];
        $text1['signing_authority_name'] = $request->signing_authority_name;
        $text1['signing_authority_title'] = $request->signing_authority_title;

        $text2 = [];
        $text2['secound_signing_name'] = $request->secound_signing_name;
        $text2['secound_signing_title'] = $request->secound_signing_title;

        $template->signing_authority = json_encode($text1);
        $template->secound_signing = json_encode($text2);

        // Save the updated template
        $template->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Template updated successfully.');
    } catch (Exception $e) {
        // Redirect back with error message
        return redirect()->back()->with('error', 'An error occurred while updating the template.');
    }
        }

        public function background(Request $request){
           
            try {
                $background = new BackgroundTemplate;
                $myimage = "null";
    
                if (!is_null($request->image)) {
                    $image = new ImageController;
                    $myimage = $image->files($request->image);
                    $background->image = $myimage;
                }
    
                $background->templates_id = $request->templates_id;
                $background->name = $request->template;
                $background->dpi = $request->dpi;
                $background->added_by = $request->added_by;
                $background->save();
    
                return redirect()->route('background-template.index')->with('success', 'Background template created successfully.');
            } catch (Exception $e) {
                return redirect()->route('background-template.index')->with('error', 'An error occurred while creating the background template.');
            }

        }

        public function clone($id){
            try {
                // Validate the parameter
                if (is_numeric($id)) {
                    // Find the certificate by ID
                    $certificate = Template::find($id);
                    if ($certificate) {
                        // Copy the certificate
                        $newCertificate = $certificate->replicate();
                        $newCertificate->save();
    
                        return redirect()->route('company.certificate')->with('success', 'Certificate copied successfully.');
                    } else {
                        return redirect()->route('company.certificate')->with('error', 'Certificate not found.');
                    }
                } else {
                    return redirect()->route('company.certificate')->with('error', 'Invalid certificate ID.');
                }
            } catch (Exception $e) {
                return redirect()->route('company.certificate')->with('error', 'An error occurred while copying the certificate.');
            }

        }

        public function templatedestroy($id){
                    // dd($id);
                    try {
                        // Validate the parameter
                        if (is_numeric($id)) {
                            // Find the template by ID
                            $template = Template::find($id);
                            if ($template) {
                                // Delete the template
                                $template->delete();
            
                                return redirect()->route('company.certificate')->with('success', 'Template deleted successfully.');
                            } else {
                                return redirect()->route('company.certificate')->with('error', 'Template not found.');
                            }
                        } else {
                            return redirect()->route('company.certificate')->with('error', 'Invalid template ID.');
                        }
                    } catch (Exception $e) {
                        return redirect()->route('company.certificate')->with('error', 'An error occurred while deleting the template.');
                    }

        }
    }