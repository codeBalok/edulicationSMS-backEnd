
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
    </button>
    <strong>Success!</strong> {{ $message }}
</div>
@endif
<!-- Column  -->
<div class="col-xl-12">
											<div class="card dz-card" id="custom-tab">
												<div class="card-header flex-wrap">
													<h4 class="card-title">Contact Information</h4>
													<ul class="nav nav-tabs dzm-tabs" id="myTab1" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link active " id="home-tab1" data-bs-toggle="tab" data-bs-target="#DefaultTab1" type="button" role="tab" aria-controls="home" aria-selected="true">Preview</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link " id="profile-tab1" data-bs-toggle="tab" data-bs-target="#DefaultTab1-html" type="button" role="tab">HTML</button>
														</li>
													</ul>
												</div>
												<div class="tab-content" id="myTabContent1">
													<div class="tab-pane fade show active" id="DefaultTab1" role="tabpanel" aria-labelledby="home-tab1">
														<div class="card-body pt-0">
															<!-- Nav tabs -->
															<div class="custom-tab-1">
																<ul class="nav nav-tabs">
																	<li class="nav-item">
																		<a class="nav-link active" data-bs-toggle="tab" href="#home1"><i class="la la-user me-2"></i> Student Information</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#profile1"><i class="la la-user me-2"></i> Documents</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#contact1"><i class="la la-phone me-2"></i>  Language & Diversity</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#message1"><i class="la la-envelope me-2"></i> Disability</a>
																	</li>
                                                                    <li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#message2"><i class="la la-user me-2"></i> Schooling</a>
																	</li>
                                                                    <li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#message3"><i class="la la-phone me-2"></i> Qualifications</a>
																	</li>
                                                                    <li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#message4"><i class="la la-envelope me-2"></i> Employement</a>
																	</li>
																</ul>
																<div class="tab-content">
																	<div class="tab-pane fade show active" id="home1" role="tabpanel">
																		<div class="pt-4">
																			<!-- <h4>Personal Information</h4> -->
																			<div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h6>Basic Information</h6>
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Name</label>
                                </div>
                                
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->first_name}}&nbsp;{{$student->last_name}}                 
                                </div>
                            </div>


                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Certificate Name</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->certificate_name}}                       
                                </div>
                            </div>
                
                                                        
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Employee Number</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                    <label class="float-left company_qtip">{{$student->employee_number}}</label>					
                                </div>
                            </div>
                            
                
                
                            <br>
                            <h6>Usual Residence</h6>

                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Building / Property Name</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->residence_building_name}}                       
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Flat / Unit Details</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->residence_flat_details}}                  
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Street Number</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->residence_street_number}}                    
                                </div>
                            </div>
                
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">Street Name</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            {{$student->residence_street_name}}                      
                            </div>
                        </div>
                
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">Suburb</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            {{$student->residence_suburb}}                        
                            </div>
                        </div>
                
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">Country</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            {{$student->residence_country}}                      
                            </div>
                        </div>
                
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">State</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            {{$student->residence_state}}                     
                            </div>
                        </div>
                
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">Post Code<i id="avetPostCodeHint" class="fa fa-info-circle ml-2" aria-hidden="true" title="If not an Australian Postcode use 'OSPC' for AVETMISS purposes."></i>
                                </label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                            {{$student->residence_postal_code}}                       
                            </div>
                        </div>
                                <br>
                        <h6>Postal Address</h6>
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Building / Property Name</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_building_name}}                       
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Flat / Unit Details</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_flat_details}}                 
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Street Number</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_street_number}}                    
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Street Name</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_street_name}}                      
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Suburb</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_suburb}}                        
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Country</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_country}}                      
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">State</label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                {{$student->postal_state}}                     
                                </div>
                            </div>
                
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                        <label class="float-left detail-label">Post Code<i id="avetPostCodeHint" class="fa fa-info-circle ml-2" aria-hidden="true" title="If not an Australian Postcode use 'OSPC' for AVETMISS purposes."></i>
                                        </label>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                    {{$student->postal_post_code}}                       
                                    </div>
                                </div>
                                    <br>
                            </div>
                    
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <h6>Contact Information</h6>
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="float-left detail-label">Email</label>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                <!-- badge badge-success-->
                                <span>{{$student->email_id}} </span>                
                            </div>
                        </div>
        
        
                    <br>
                    <h6>More Information</h6>

                    <div class="form-group form-inline row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="float-left detail-label">Is Learner</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        {{$student->is_learner}}              
                        </div>
                    </div>
        
                    <div class="form-group form-inline row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="float-left detail-label">Is Contact</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        {{$student->is_companycontact}}            
                        </div>
                    </div>
        
                    <div class="form-group form-inline row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="float-left detail-label">Unique ID</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        {{$student->unique_id}}              
                        </div>
                    </div>
        
        
                    <div class="form-group form-inline row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="float-left detail-label">Overseas Client?</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        {{$student->overseas_client}}                   
                        </div>
                    </div>
        
                    <div class="form-group form-inline row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="float-left detail-label">National ID</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                        {{$student->national_id }}                
                        </div>
                    </div>
        
           
                        <!--WWB-220 start-->
                             <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="float-left detail-label">Survey contact status: </label>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                                @foreach($surveystatus as $surveystatus)
                                    {{$surveystatus->status_type}}
                                @endforeach                  
                                </div>
                            </div>
                        <!--WWB-220 end-->
            
                </div><!-- right col-lg-6 col-md-6 col-sm-12 col-12 -->
                <div class="col">
                    <div class="row">
                        <div class="form-group text-center col">
                            <a href="{{ route('edit-student',$student->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
<div class="tab-pane fade" id="profile1">
    <div class="pt-4">
        <h4>Upload Document</h4>
            <div class="col-xl-12">
                <div class="card dz-card" id="accordion-four">
                    <div class="card-header flex-wrap d-flex justify-content-between">
                    
                    </div>
                    <div id="documentList">
                    <div class="float-right d-inline"><button  class="btn btn-primary">Create Document</button></div>
                            <table width="100%" class="table table-striped" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                                <thead>
                                    <tr>
                                        <th style="padding-left:30px;">Document Name</th>
                                        <th>File Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($document as $document)
                                    <tr>
                                        <td>{{ $document->document_name  }}</td>
                                        <td>{{ $document->file_name}}</td>
                                        <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit-document',$document->id) }}" class="btn btn-primary light shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('delete-document',$document->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            <a href="{{ route('download-document', ['id' => $document->id]) }}" class="btn btn-info light shadow btn-xs sharp"><i class="fa fa-download"></i></a>
                                        </div>
                                        </td> 
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>  
        
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <form action="{{ route('store-document',$student->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group form-inline row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                <label class="row-lg-4 col-form-label">Upload a Document</label>
                                            </div>
                                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                            <input class="form-control" type="file" id="formFile" name="files[]" multiple>
                                                                
<br>
                                            </div>
                                        </div>
                                        <div class="form-group form-inline row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                <label class="row-lg-4 col-form-label">Document Name</label>
                                            </div>
                                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                            <input class="form-control" type="text" id="document_name" name="document_name" multiple>
                                                 <br>               

                                            </div>
                                        </div>
                                        <div class="form-group form-inline row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                                <div class="form-group text-center col">
                                                <button type="submit" class="btn btn-primary light">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>    
            </div>
    </div>
</div>

	        <div class="tab-pane fade" id="contact1">
                <div class="pt-4">
                        <h4>Language And Diversity</h4>
                </div>
	            <div style="float:left;padding-left:150px;">
                 @foreach($languagediversity as $language)
                    <div style="padding:5px;float:left;font-weight:bold;width:400px;" align="left">Country of Birth? </div>
                    <div style="padding:5px 5px;float:left;vertical-align:bottom">
                    {{ $language->birth_country}}	</div>
                    <div style="clear:both;"></div>
                    <div style="padding:5px;float:left;width:400px;font-weight:bold;">Do you mainly speak English at home?</div>
            
                    <div style="padding:5px 5px;float:left;vertical-align:bottom">
                                
                    @if($language->main_english==0)
                    <label>Yes</label>
                    @else
                    <label>No</label>
                    @endif
                        <br>
                    
                    </div>
                    <div style="clear:both;height:5px;"></div>
                        <div style="padding:5px;float:left;font-weight:bold;width:400px;" align="left">Do you speak a language other than English at home?</div>
                            <div style="padding:5px 5px;width:250px;float:left">

                            
                                <input type="checkbox" name="other_language" value="1" {{ $language->other_language == 1 ? 'checked' : '' }} disabled>
                                <label>No, English only</label>
                                <br>
                                <input type="checkbox" name="other_language" value="0" {{ $language->other_language == 0 ? 'checked' : '' }} disabled>
                                <label>Yes, other - Please specify</label>
                                <br>

                            </div> 
                            <div style="clear:both;height:5px;"></div>
                                <br>
                            <div style="padding:5px;font-weight:bold;width:400px;float:left" align="left">Indigenous Status: </div>
                            <div style="padding:5px 5px;width:250px;float:left">
                            
                            <input type="checkbox" name="indigenous_status" value="0" {{ $language->indigenous_status == 0 ? 'checked' : '' }} disabled>
                            <label>Yes, Aboriginal</label>
                            <br>
                            <input type="checkbox" name="indigenous_status" value="1" {{ $language->indigenous_status == 1 ? 'checked' : '' }} disabled>
                            <label>Yes, Torres Strait Islander</label>
                            <br>
                            <input type="checkbox" name="indigenous_status" value="2" {{ $language->indigenous_status == 2 ? 'checked' : '' }} disabled>
                            <label>Yes, Aboriginal AND Torres Strait Islander</label>
                            <br>
                            <input type="checkbox" name="indigenous_status" value="3" {{ $language->indigenous_status == 3 ? 'checked' : '' }} disabled>
                            <label>No, Neither Aboriginal nor Torres Strait Islander</label>
                            <br>
                                
                            </div>
                            </div>
                            <div style="clear:both;height:20px;"></div>
                                <div style="clear:both;text-align:center">
                            
                                    <a type="button" href="{{ route('edit-languagediversity', $language->id) }}" class="btn btn-primary">Edit</a>
                                    
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>

<div class="tab-pane fade" id="message1">
<div class="pt-4">
<h4>Disability Details</h4>
<div>
	<div style="float:left;padding-left:50px;">
    @foreach ($disability_details as $disability) 
		<div style="padding:5px;float:left;width:500px;font-weight:bold;">Has a disability, impairment or long-term condition?</div>
                    <div style="padding:5px 5px;float:left;vertical-align:bottom">
                    
                           
                                        @if($disability->is_disability==0)
                                        <label>No</label>
                                        @else
                                        <label>Yes</label>
                                        @endif
                                            <br>
                           
                    </div>
            
                <div style="clear:both;height:5px;"></div>
                <div style="padding:5px;font-weight:bold;width:480px;float:left;">If Yes, please indicate the areas of disability, impairment or long-term condition: </div>
                <div style="padding:5px 20px;line-height:20px;float:left;">
                  
                    <div style="padding:5px 20px;line-height:20px;float:left;">
                        
                    @foreach ($disability_types as $disabilityType)
                    <input type="checkbox" name="area_of_disability[]" value="{{$disabilityType->type}}" {{ in_array($disabilityType->type, $selectedDisability) ? 'checked' : '' }} disabled>
                    <label>{{$disabilityType->type}}</label><br>
                    @endforeach
                    
                    </div>
                   
                </div>
        </div>
   
        <div style="clear:both;height:5px;"></div>	
                
        <div style="clear:both; text-align:center">
        <a type="button" href="{{ route('edit-disabilitydetail', $student->id) }}" class="btn btn-primary">Edit</a>
        </div>
        @endforeach
</div>    
</div>
</div>
</div>

<div class="tab-pane fade" id="message2">
	<div class="pt-4">
		<h4>Student Schooling</h4>
<div>
      <div style="float:left;padding-left:150px;">
        @foreach ($schooling as $school) 
            <div style="padding:5px;width:400px;font-weight:bold;float:left">Still at school?</div>
            <div style="padding:5px 20px; float:left">
            @if($school->still_schooling==0)
                                                <label>No</label>
                                                @else
                                                <label>Yes</label>
                                                @endif    
            </div>
            <br>
    
             <div style="padding:5px;width:400px;font-weight:bold;float:left;">Highest school level completed?</div>
                <div style="padding:0px 20px;float:left;">  
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="02" {{ $school->school_level == 2 ? 'checked' : '' }} disabled> Did not go to school
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="08" {{ $school->school_level == 8 ? 'checked' : '' }} disabled> Year 8 or below
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="09"{{ $school->school_level == 9 ? 'checked' : '' }} disabled>Year 9 or equivalent
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="10" {{ $school->school_level == 10 ? 'checked' : '' }} disabled>Completed Year 10
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="11" {{ $school->school_level == 11 ? 'checked' : '' }} disabled>Completed Year 11
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="12" {{ $school->school_level == 12 ? 'checked' : '' }} disabled>Completed Year 12
                    </div>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="school_level" value="00" {{ $school->school_level == 0 ? 'checked' : '' }} disabled>Not specified
                    </div> 
                    <br>     
                </div>
            <br>
            <div style="padding:5px;width:400px;font-weight:bold;float:left;">Year school level was completed: </div>
                <div style="padding:0px 20px;float:left;">
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="is_school_completed" id="is_school_completed_yes" value="1" {{ $school->is_school_completed == 1 ? 'checked' : '' }} disabled> Yes
                    </div>
                    <div id="completion_year_input" style="display: {{ $school->is_school_completed == 1 ? 'block' : 'none' }}">
                        <input class="form-control" type="text" name="school_completion_year" id="school_completion_year" value="{{ $school->school_completion_year }}" placeholder="Completion Year" readonly>
                    </div>
                    <br>
                    <div style="padding:2px 0px;">
                    <input type="radio" style="margin-right:4px;" name="is_school_completed" id="is_school_completed_no" value="0" {{ $school->is_school_completed == 0 ? 'checked' : '' }} disabled> No
                    </div>
                   
                </div>
            <br>
        @endforeach
    </div>
    <div style="clear:both; height:20px;"></div>
		<div style="clear:both; text-align:center">
        <a type="button" href="{{ route('edit-studentschooling', $student->id) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
</div>
</div>
    <div class="tab-pane fade" id="message3">
		<div class="pt-4">
		    <h4>Qualifications</h4>
            <div> 
                <div style="float:left;padding-left:150px;">
                  @foreach ($qualification as $qualifications) 
                             <div style="padding:5px;width:400px;font-weight:bold;float:left">Completed any of the following qualifications?</div>
                                <div style="padding:5px 20px;float:left">
                                    @if($qualifications->qualification_completed==0)
                                        <label>Not Provided</label>
                                    @elseif($qualifications->qualification_completed==1)
                                        <label>Yes</label>
                                    @else
                                        <label>No</label>
                                    @endif      
                               </div>
                     <div style="clear:both;height:10px;"></div>
                        <div style="padding:5px;font-weight:bold;width:400px;float:left;">Highest level of qualification you hold? </div>
                            <div style="padding:5px 20px;line-height:20px;float:left;">
                            @foreach ([
                                "008" => "Bachelor Degree or Higher Degree level",
                                "410" => "Advanced Diploma or Associate Degree Level",
                                "420" => "Diploma (or Associate Diploma) Level",
                                "511" => "Certificate IV (or advanced certificate/technician)",
                                "514" => "Certificate III (or trade certificate)",
                                "521" => "Certificate II",
                                "990" => "Certificates other than the above",
                                "524" => "Certificate I",
                                ] as $value => $label)
                                <input type="checkbox" class="custom-checkbox" style="margin-right:4px;" name="qualification_level[]" value="{{ $value }}" {{ is_array($qualificationlevel) && in_array($value, $qualificationlevel) ? 'checked' : '' }} disabled="">
                                {{ $label }} <br>
                            @endforeach

                        @if(!is_array($qualificationlevel))
                            <p>No qualification levels retrieved from the database.</p>
                        @endif      
                        </div>

                  @endforeach
                </div>
                <div style="clear:both; text-align:center">
            <a type="button" href="{{ route('edit-studentqualification', $student->id) }}" class="btn btn-primary">Edit</a>
            </div>

            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="message4">
		<div class="pt-4">
			<h4>Emplyoment</h4>
		<div>
                        <div style="float:left;padding-left:150px;">
                        @foreach ($employment as $employ) 
                            <div style="padding:5px;width:320px;font-weight:bold;float:left;">Employment</div>
                                <div style="padding:0px 20px;float:left;">  
                                    <div style="padding:2px 0px;">
								    <input type="radio" style="margin-right:4px;" name="labour_status" value="01" {{ $employ->labour_status == 1 ? 'checked' : '' }} disabled="">Full-time employee
                                    </div>
                                    <div style="padding:2px 0px;">
								    <input type="radio" style="margin-right:4px;" name="labour_status" value="02" {{ $employ->labour_status == 2 ? 'checked' : '' }} disabled="">Part-time employee
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="03" {{ $employ->labour_status == 3 ? 'checked' : '' }} disabled="">Self-employed - not employing others
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="04" {{ $employ->labour_status == 4 ? 'checked' : '' }} disabled="">Employer
                                    </div>
                                        <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="05" {{ $employ->labour_status == 5 ? 'checked' : '' }} disabled="">Employed - unpaid worker in family business
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="06" {{ $employ->labour_status == 6 ? 'checked' : '' }} disabled="">Unemployed - seeking full-time work
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="07" {{ $employ->labour_status == 7 ? 'checked' : '' }} disabled="">Unemployed seeking part-time work
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="08" {{ $employ->labour_status == 8 ? 'checked' : '' }} disabled="">Not employed - not seeking employment
                                    </div>        
                                 </div>
                            <div style="clear:both;"></div>     
                        </div>
                <div style="clear:both; height:20px;"></div>
                    <div style="float:left;padding-left:150px;">
                            <div style="padding:5px;width:320px;font-weight:bold;float:left;">Industry of Employment</div>
                            <div style="padding:0px 20px;float:left;"> 
                                <select class="form-control" name="industryofemploymentid" id="industryofemploymentid" disabled="" style="width:320px;">
                                <option value="">Select</option>
                                <option value="A" {{ $employ->industryofemploymentid == 'A' ? 'selected' : '' }}>Agriculture, Forestry and Fishing</option>
                                <option value="B" {{ $employ->industryofemploymentid == 'B' ? 'selected' : '' }}>Mining</option>
                                <option value="C" {{ $employ->industryofemploymentid == 'C' ? 'selected' : '' }}>Manufacturing</option>
                                <option value="D" {{ $employ->industryofemploymentid == 'D' ? 'selected' : '' }}>Electricity, Gas, Water and Waste Services</option>
                                <option value="E" {{ $employ->industryofemploymentid == 'E' ? 'selected' : '' }}>Construction</option>
                                <option value="F" {{ $employ->industryofemploymentid == 'F' ? 'selected' : '' }}>Wholesale Trade</option>
                                <option value="G" {{ $employ->industryofemploymentid == 'G' ? 'selected' : '' }}>Retail Trade</option>
                                <option value="H" {{ $employ->industryofemploymentid == 'H' ? 'selected' : '' }}>Accommodation and Food Services</option>
                                <option value="I" {{ $employ->industryofemploymentid == 'I' ? 'selected' : '' }}>Transport, Postal and Warehousing</option>
                                <option value="J" {{ $employ->industryofemploymentid == 'J' ? 'selected' : '' }}>Information Media and Telecommunications</option>
                                <option value="K" {{ $employ->industryofemploymentid == 'K' ? 'selected' : '' }}>Financial and Insurance Services</option>
                                <option value="L" {{ $employ->industryofemploymentid == 'L' ? 'selected' : '' }}>Rental, Hiring and Real Estate Services</option>
                                <option value="M" {{ $employ->industryofemploymentid == 'M' ? 'selected' : '' }}>Professional, Scientific and Technical Services</option>
                                <option value="N" {{ $employ->industryofemploymentid == 'N' ? 'selected' : '' }}>Administrative and Support Services</option>
                                <option value="O" {{ $employ->industryofemploymentid == 'O' ? 'selected' : '' }}>Public Administration and Safety</option>
                                <option value="P" {{ $employ->industryofemploymentid == 'P' ? 'selected' : '' }}>Education and Training</option>
                                <option value="Q" {{ $employ->industryofemploymentid == 'Q' ? 'selected' : '' }}>Health Care and Social Assistance</option>
                                <option value="R" {{ $employ->industryofemploymentid == 'R' ? 'selected' : '' }}>Arts and Recreation Services</option>
                                <option value="S" {{ $employ->industryofemploymentid == 'S' ? 'selected' : '' }}>Other Services</option>				
                            </select>
                            </div>
                   <div style="clear:both;"></div>
                    </div>
                    <div style="clear:both; height:20px;"></div>
                    <div style="float:left;padding-left:150px;">
                        <div style="padding:5px;width:320px;font-weight:bold;float:left;">Occupation Identifier</div>
                        <div style="padding:0px 20px;float:left;"> 
                            <select class="form-control" name="occupationidentifierid" id="occupationidentifierid" disabled="" style="width:320px;">
                            <option value="">Select</option>
                            <option value="1" {{ $employ->occupationidentifierid == 1 ? 'selected' : '' }}>Manager</option>
                            <option value="2" {{ $employ->occupationidentifierid == 2 ? 'selected' : '' }}>Professionals</option>
                            <option value="3" {{ $employ->occupationidentifierid == 3 ? 'selected' : '' }}>Technicians and Trades Workers</option>
                            <option value="4" {{ $employ->occupationidentifierid == 4 ? 'selected' : '' }}>Community and Personal Service Workers</option>
                            <option value="5" {{ $employ->occupationidentifierid == 5 ? 'selected' : '' }}>Clerical and Administrative Workers</option>
                            <option value="6" {{ $employ->occupationidentifierid == 6 ? 'selected' : '' }}>Sales Workers</option>
                            <option value="7" {{ $employ->occupationidentifierid == 7 ? 'selected' : '' }}>Machinery Operators and Drivers</option>
                            <option value="8" {{ $employ->occupationidentifierid == 8 ? 'selected' : '' }}>Labourer’s</option>
                            <option value="9" {{ $employ->occupationidentifierid == 9 ? 'selected' : '' }}>Other</option>				
                        </select>
                        </div>
                        <div style="clear:both;"></div>
                    @endforeach 
                        </div>
 		    <div style="clear:both; height:20px;"></div>
                <div style="clear:both; text-align:center">
                <a type="button" href="{{ route('edit-employmentdetail', $student->id) }}" class="btn btn-primary">Edit</a>	            
                </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane fade " id="DefaultTab1-html" role="tabpanel" aria-labelledby="home-tab1">
	<div class="card-body p-0 code-area">
		<pre class="m-0"> <code class="language-html">&lt;!-- Nav tabs --&gt;
		&lt;div class="custom-tab-1"&gt;
			&lt;ul class="nav nav-tabs"&gt;
				&lt;li class="nav-item"&gt;
					&lt;a class="nav-link active" data-bs-toggle="tab" href="#home1"&gt;&lt;i class="la la-home me-2"&gt;&lt;/i&gt; Home&lt;/a&gt;
				&lt;/li&gt;
				&lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#profile1"&gt;&lt;i class="la la-user me-2"&gt;&lt;/i&gt; Profile&lt;/a&gt;
				&lt;/li&gt;
				&lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#contact1"&gt;&lt;i class="la la-phone me-2"&gt;&lt;/i&gt;  Contact&lt;/a&gt;
				&lt;/li&gt;
				&lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#message1"&gt;&lt;i class="la la-envelope me-2"&gt;&lt;/i&gt; Message&lt;/a&gt;
				&lt;/li&gt;
                &lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#message2"&gt;&lt;i class="la la-envelope me-2"&gt;&lt;/i&gt; Message&lt;/a&gt;
				&lt;/li&gt;
                &lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#message3"&gt;&lt;i class="la la-envelope me-2"&gt;&lt;/i&gt; Message&lt;/a&gt;
				&lt;/li&gt;
                &lt;li class="nav-item"&gt;
					&lt;a class="nav-link" data-bs-toggle="tab" href="#message4"&gt;&lt;i class="la la-envelope me-2"&gt;&lt;/i&gt; Message&lt;/a&gt;
				&lt;/li&gt;
			&lt;/ul&gt;
			&lt;div class="tab-content"&gt;
				&lt;div class="tab-pane fade show active" id="home1" role="tabpanel"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is home title&lt;/h4&gt;
						&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
						&lt;/p&gt;
						&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;div class="tab-pane fade" id="profile1"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is profile title&lt;/h4&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;div class="tab-pane fade" id="contact1"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is contact title&lt;/h4&gt;
						&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
						&lt;/p&gt;
						&lt;p&gt;Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;div class="tab-pane fade" id="message1"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is message title&lt;/h4&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
                &lt;div class="tab-pane fade" id="message2"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is message title&lt;/h4&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
                &lt;div class="tab-pane fade" id="message3"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is message title&lt;/h4&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
                &lt;div class="tab-pane fade" id="message4"&gt;
					&lt;div class="pt-4"&gt;
						&lt;h4&gt;This is message title&lt;/h4&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
						&lt;p&gt;Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
						&lt;/p&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
		&lt;/div&gt;</code></pre>
	</div>
</div>
</div>

</div>
</div>
										<!-- /Column  -->
										<!-- Column  -->
<div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">
        <div class="card-header flex-wrap d-flex justify-content-between">
            <div>
                <h4 class="card-title">Student List</h4>
            </div>
            <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ URL::route('add-student') }}" class="btn btn-primary light">Add Student</a>
                </li>
              
        </div>

        <!-- /tab-content -->
       

    </div>
</div>


<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                });
    })();


    $('[name=tab]').each(function (i, d) {
        var p = $(this).prop('checked');
//   console.log(p);
        if (p) {
            $('article').eq(i)
                    .addClass('on');
        }
    });

    $('[name=tab]').on('change', function () {
        var p = $(this).prop('checked');

        // $(type).index(this) == nth-of-type
        var i = $('[name=tab]').index(this);

        $('article').removeClass('on');
        $('article').eq(i).addClass('on');
    });
</script>

<style>
    span.custom_inactive {
        background: #f44236;
        color: #fff;
        padding: 3px 10px;
        border-radius: 6px;
    }
    
    span.custom_active {
        background: #1de9b6;
        color: #fff;
        padding: 3px 10px;
        border-radius: 6px;
    }
</style>

  <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="./js/custom.js"></script>
	<script src="./js/deznav-init.js"></script>
	
    
	
	<!-- code-highlight -->
	<script src="./js/highlight.min.js"></script>
	<script>hljs.highlightAll();
	hljs.configure({ ignoreUnescapedHTML: true })
		
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', (event) => {
			document.querySelectorAll('pre code').forEach((el) => {
				hljs.highlightElement(el);
			});
			});
	</script>



<script>
    // Get references to the radio buttons and the completion year input
    var isSchoolCompletedYes = document.getElementById('is_school_completed_yes');
    var isSchoolCompletedNo = document.getElementById('is_school_completed_no');
    var completionYearInput = document.getElementById('completion_year_input');

    // Add event listener to the radio buttons to toggle the visibility of the completion year input
    isSchoolCompletedYes.addEventListener('change', function() {
        if (this.checked) {
            completionYearInput.style.display = 'block';
        }
    });

    isSchoolCompletedNo.addEventListener('change', function() {
        if (this.checked) {
            completionYearInput.style.display = 'none';
        }
    });
</script>
@endsection