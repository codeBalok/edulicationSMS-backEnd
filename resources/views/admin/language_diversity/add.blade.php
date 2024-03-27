<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-header">
                <h4 class="card-title">Add Language Diversity</h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                   
                    <article>
                    <div>

                           
<div>
	<form name="add_language_frm" id="add_language_frm" method="post" action="{{ route('store-languagediversity' ) }}">
	
	@csrf

         	
    <div style="padding:5px;float:left;font-weight:bold;width:400px;" align="left">Select Student </div>
         	<div style="padding:0px 5px;float:left;vertical-align:bottom">
             <select class="default-select wide form-control" id="validationCustom05" name="student_id">
                 @if(!empty($students))
                 <option value="">Select Student</option>
                 @foreach($students as $student)
                    
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                 @endforeach
                 @endif
             </select>
			</div>
            <div style="clear:both;height:5px;"></div>
		<div style="float:left;padding-left:150px;"></div>
    		<div style="padding:5px;float:left;font-weight:bold;width:400px;" align="left">Country of Birth? </div>
         	<div style="padding:0px 5px;float:left;vertical-align:bottom">
             <select class="default-select wide form-control" id="validationCustom05" name="birth_country">
                 @if(!empty($countries))
                    @foreach ($countries as $row)
                        <option value="{{$row->name}}">{{$row->name}}</option>
                    @endforeach
                 @endif
             </select>
			</div>
         	<div style="clear:both;height:5px;"></div>
         	<div style="padding:5px; float:left;width:400px;font-weight:bold;">Do you mainly speak English at home?</div>
                    <div style="padding:0px 5px; float:left;vertical-align:bottom">
                        <select class="form-control" name="main_english" id="main_english">
                        
                            <option value="0">Yes</option>
                            <option value="1">No</option> 

                        </select>
                    </div>
         	<div style="clear:both;height:10px;"></div>
         	<div style="padding:5px;font-weight:bold;width:400px;float:left;" align="left">Do you speak a language other than English at home?</div>
         	<div style="padding:5px 5px; width:400px; float:left">
                <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="other_language" id="language_at_home_no" value="1" >
                            <label class="form-check-label" for="language_at_home_no">No, English Only</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="other_language" id="language_at_home_yes" value="0" >
                            <label class="form-check-label" for="language_at_home_yes">Yes, other - Please Specify:</label>
                        </div>
                </div>
                <div id="language_dropdown" style="display: none;">
                    <label style="padding:5px;font-weight:bold;width:400px;float:left;" align="left" for="other_language_name">Select your spoken language:</label>
                    <select class="default-select wide form-control" id="validationCustom05" name="other_language_name">
                                @if(!empty($spoken_language))
                                    @foreach ($spoken_language as $row)
                                        <option value="{{$row->language}}">{{$row->language}}</option>
                                    @endforeach
                                @endif
                            </select>
                </div>
			</div>
         	<div style="clear:both;height:5px;"></div>
        <div id="proficiency_section" style="display: none;">
            <label style="padding:5px;font-weight:bold;width:400px;float:left;" align="left" for="eng_proficiency">Proficiency in English:</label><br>
            <div style="padding:5px 5px; width:400px; float:left">
                <div class="form-check">
                    <div>
                        <input class="form-check-input" type="radio" id="option1" name="eng_proficiency" value="0" >
                        <label class="form-check-label" for="option1">Very Well</label>
                    </div>
                    <div>
                        <input class="form-check-input" type="radio" id="option2" name="eng_proficiency" value="1" >
                        <label class="form-check-label" for="option2">Well</label>
                    </div>
                    <div>
                        <input class="form-check-input" type="radio" id="option3" name="eng_proficiency" value="2" >
                        <label class="form-check-label" for="option3">Not Well</label>
                    </div>
                    <div>
                        <input class="form-check-input" type="radio" id="option4" name="eng_proficiency" value="3" >
                        <label class="form-check-label" for="option4">Not at all</label>
                    </div>
                </div>

                <br>         	
            </div>
            </div>

         	<div style="clear:both;height:5px;"></div>
			
			    <div class="form-group">
                            <div style="padding:5px;font-weight:bold;float:left;width:380px;">Indigenous Status: </div>
                            <div style="padding:5px 20px;float:left;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="indigenous_status" id="aboriginal" value="0" >
                        <label class="form-check-label" for="aboriginal">Yes, Aboriginal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="indigenous_status" id="torres_strait_islander" value="1">
                        <label class="form-check-label" for="torres_strait_islander">Yes, Torres Strait Islander</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="indigenous_status" id="aboriginal_and_torres_strait_islander" value="2" >
                        <label class="form-check-label" for="aboriginal_and_torres_strait_islander">Yes, Aboriginal AND Torres Strait Islander</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="indigenous_status" id="neither" value="3" >
                        <label class="form-check-label" for="neither">No, Neither Aboriginal nor Torres Strait Islander</label>
                    </div>
                </div>
			
 		<div style="clear:both; height:20px;"></div>
        <div align="center">
			<button type="submit" class="btn btn-primary" style="margin:0px 5px;">Save</button>
			
        </div>
	</form>
</div>

                            </article>

                    <article>
                    </article>

                </div>
            </div>
        </div>
    </div>

</div>


<script>
 
    document.addEventListener('DOMContentLoaded', function() {
       
        const proficiencySection = document.getElementById('proficiency_section');
        const languageDropdown = document.getElementById('language_dropdown');

        // Function to update display based on radio button selection
        function updateDisplay() {
			const languageAtHomeRadio = document.querySelector('input[name="other_language"]:checked');
                if (languageAtHomeRadio && languageAtHomeRadio.value === '0') {
                    proficiencySection.style.display = 'block';
                    languageDropdown.style.display = 'block';
                } else {
                    proficiencySection.style.display = 'none';
                    languageDropdown.style.display = 'none';
                }
        }

        // Initial display update
        updateDisplay();

        // Event listener for radio button change
        document.querySelectorAll('input[name="other_language"]').forEach(function(radio) {
            radio.addEventListener('change', updateDisplay);
        });
    });
    
</script>
@endsection