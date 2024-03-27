
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registration (2023-2024) Form Validation  <span>Total 4 result found - showing records from 1 to 4</span></h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add New Registration</h5>
                    <input type="radio" id="tab1" name="tab" checked>
                    <label for="tab1"> New Student</label>
                    <input type="radio" id="tab2" name="tab">
                    <label for="tab2"> Existing Student</label>
                    <article>
                    <div>
<form class="needs-validation" novalidate  method="POST" action="{{ route('update-student', $student->id ) }}" enctype="multipart/form-data">
                            @csrf
                <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h6><u>Basic Information</u></h6>
                                                    <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label" for="entry_date">Entry Date <span class="text-danger">*</span>
                                        </label>
                                </div>
                                <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <input type="date" class="form-control" placeholder="YYYY-MM-DD" name="entry_date" id="entry_date"  value="{{$student->entry_date}}">

                                    <div class="invalid-feedback">
                                        Please enter a Date of Registration.
                                    </div>
                                    <br>
                                </div>
                            </div>
<!-- change gender as per title selection script -->
<script>
                                
  $('#titleSelect').change(function(){
    // Get the selected title
    var selectedTitle = $(this).val();
    
    // Update the gender textbox based on the selected title
    if(selectedTitle === 'Mr.') {
      $('#genderTextbox').val('Male');
    } else if(selectedTitle === 'Miss') {
      $('#genderTextbox').val('Female');
    } else if(selectedTitle === 'Mrs.') {
      $('#genderTextbox').val('Female');
    } else {
      $('#genderTextbox').val('');
    }
  });
</script>

                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label" for="title">Title <span class="text-danger">*</span>
                                        </label>
                                </div>
                                <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <select class="default-select wide form-control" id="titleSelect" name="title">
                                    <option>Select</option>
                                            <option value="0">Mr.</option>
                                            <option value="1">Miss</option>
                                            <option value="2">Mrs.</option>
                                            <br>
                                </select>
                                    <br>
                                </div>
                            </div>
                            
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">First Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="first_name"  placeholder="Your valid First Name.." required name="first_name" value="{{$student->first_name}}">
                                            <div class="invalid-feedback">
                                                Please enter a First Name.
                                            </div>
                                            <br>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Middle Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="middle_name"  placeholder="Your valid Middle Name.." required name="middle_name" value="{{$student->middle_name}}">
                                            <div class="invalid-feedback">
                                                Please enter a Middle Name.
                                            </div>
                                            <br>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Last Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="last_name"  placeholder="Your valid Last Name.." required name="last_name" value="{{$student->last_name}}">
                                            <div class="invalid-feedback">
                                                Please enter a Last Name.
                                            </div>
                                            <br>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Preferred Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <input type="text" value="{{$student->preferred_name}}" name="preferred_name" id="preferred_name" class="input_text1 form-control" maxlength="100">
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Certificate Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <input type="text" value="{{$student->certificate_name}}" name="certificate_name" id="certificate_name" class="input_text1 form-control" maxlength="100"><br>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="row-lg-4 col-form-label" for="gender">Gender <span class="text-danger">*</span>
                                        </label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                               
                                <input type="text" class="form-control" id="genderTextbox" name="gender" placeholder="Gender" readonly>
                                </select>
                                <br>
                            </div>
                        </div>

                                                    <!-- <input type="hidden" name="scheduleId" id="scheduleId" value="0"> -->
                                                        <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label" for="date_of_birth">Date of Birth <span class="text-danger">*</span>
                                        </label>
                                </div>
                                <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="date_of_birth" name="date_of_birth" value="{{$student->date_of_birth}}" >
                                            <div class="invalid-feedback">
                                                Date of Birth.
                                            </div>
                                            <br>
                                </div>
                            </div>
                            
						<div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="row-lg-4 col-form-label" for="employee_number"> Employee number 
                                        </label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="employee_no" placeholder="Employee No"  name="employee_number" value="{{$student->employee_number}}">
                                            <div class="invalid-feedback">
                                                Please enter a Employee number.
                                            </div>
                            </div>
                        </div>
						
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <label class="row-lg-4 col-form-label" for="employee_group">Employee Group 
                                        </label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="employee_group" placeholder="Employee Group"  name="employee_group" value="{{$student->employee_group}}" >
                                            <div class="invalid-feedback">
                                                Please enter a Employee group.
                                            </div>
                            </div>
                        </div>
						
						<div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">                                
								
							</div>
                           
                        </div>
						
                        <div style="clear:both; height:5px;"></div>
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Role</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <select class="default-select wide form-control" style="width:171px;" id="role" name="role">
                            @foreach ($role as $row)
                                       <option value="{{$row->id}}">{{$row->name}}</option>
                                       @endforeach
                            </select>
                            </div>
                        </div>
                        <br>
                        <!-- Usual Residence Section -->
                        <h6><u>Usual Residence</u></h6>
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Building / Property Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input class="form-control" type="text" id="buildingNameResidence" placeholder="Building Name" name="residence_building_name" value="{{$student->residence_building_name}}"  maxlength="30">
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Flat / Unit Details</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input class="form-control" type="text" id="flatDetailsResidence" name="residence_flat_details" placeholder="Flat Details" value="{{$student->residence_flat_details}}" maxlength="30">
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Street Number</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input class="form-control" type="text" id="streetnumberResidence" name="residence_street_number" value="{{$student->residence_street_number}}" maxlength="30">
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Street Name</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input class="form-control" type="text" id="streetnameResidence" name="residence_street_name" value="{{$student->residence_street_name}}" ><br>
                                                    
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Suburb</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input class="form-control" type="text" id="suburbResidence" name="residence_suburb" value="{{$student->residence_suburb}}" maxlength="30">
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Country</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <select name="residence_country" style="width:171px;" id="country" class="input_text_1 form-control">
                                    <option value="">Select</option>     <!-- bug 4176 -->
                                    <option value="Adelie Land (France)">Adelie Land (France)</option><option value="Afghanistan">Afghanistan</option><option value="Africa, nfd">Africa, nfd</option><option value="Aland Islands">Aland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Americas">Americas</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Argentinian Antarctic Territory">Argentinian Antarctic Territory</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Asia, nfd">Asia, nfd</option><option value="At Sea">At Sea</option><option value="Australia">Australia</option><option value="Australia (includes External Territories)">Australia (includes External Territories)</option><option value="Australian Antarctic Territory">Australian Antarctic Territory</option><option value="Australian External Territories, nec">Australian External Territories, nec</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="British Antarctic Territory">British Antarctic Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma (Republic of the Union of Myanmar)">Burma (Republic of the Union of Myanmar)</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Caribbean">Caribbean</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Central America">Central America</option><option value="Central and West Africa">Central and West Africa</option><option value="Central Asia">Central Asia</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="Chilean Antarctic Territory">Chilean Antarctic Territory</option><option value="China (excludes SARs and Taiwan)">China (excludes SARs and Taiwan)</option><option value="Chinese Asia (includes Mongolia)">Chinese Asia (includes Mongolia)</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, Democratic Republic of">Congo, Democratic Republic of</option><option value="Congo, Republic of ">Congo, Republic of </option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d" ivoire'="">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Curacao">Curacao</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Asia, nfd">East Asia, nfd</option><option value="Eastern Europe">Eastern Europe</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="England">England</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Europe, nfd">Europe, nfd</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Former USSR, nfd">Former USSR, nfd</option><option value="Former Yugoslav Republic of Macedonia (FYROM)">Former Yugoslav Republic of Macedonia (FYROM)</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Gaza Strip and West Bank">Gaza Strip and West Bank</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Holy See">Holy See</option><option value="Honduras">Honduras</option><option value="Hong Kong (SAR of China)">Hong Kong (SAR of China)</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="Inadequately Described">Inadequately Described</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Japan and the Koreas">Japan and the Koreas</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People" s="" republic="" of="" (north)'="">Korea, Democratic People's Republic of (North)</option><option value="Korea, Republic of (South)">Korea, Republic of (South)</option><option value="Kosovo">Kosovo</option><option value="Kurdistan, nfd">Kurdistan, nfd</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau (SAR of China)">Macau (SAR of China)</option><option value="Madagascar">Madagascar</option><option value="Mainland South-East Asia">Mainland South-East Asia</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Maritime South-East Asia">Maritime South-East Asia</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Melanesia">Melanesia</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Middle East">Middle East</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="North Africa">North Africa</option><option value="North Africa and the Middle East">North Africa and the Middle East</option><option value="North-East Asia">North-East Asia</option><option value="North-West Europe">North-West Europe</option><option value="Northern America">Northern America</option><option value="Northern Europe">Northern Europe</option><option value="Northern Ireland">Northern Ireland</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Not Specified">Not Specified</option><option value="Oceania and Antarctica">Oceania and Antarctica</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn Islands">Pitcairn Islands</option><option value="Poland">Poland</option><option value="Polynesia (excludes Hawaii)">Polynesia (excludes Hawaii)</option><option value="Polynesia (excludes Hawaii), nec">Polynesia (excludes Hawaii), nec</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Queen Maud Land (Norway)">Queen Maud Land (Norway)</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Ross Dependency (New Zealand)">Ross Dependency (New Zealand)</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Samoa">Samoa</option><option value="Samoa, American">Samoa, American</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Scotland">Scotland</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South America">South America</option><option value="South America, nec">South America, nec</option><option value="South Eastern Europe">South Eastern Europe</option><option value="South Sudan">South Sudan</option><option value="South-East Asia">South-East Asia</option><option value="Southern and Central Asia">Southern and Central Asia</option><option value="Southern and East Africa">Southern and East Africa</option><option value="Southern and East Africa, nec">Southern and East Africa, nec</option><option value="Southern and Eastern Europe">Southern and Eastern Europe</option><option value="Southern Asia">Southern Asia</option><option value="Southern Europe">Southern Europe</option><option value="Spain">Spain</option><option value="Spanish North Africa">Spanish North Africa</option><option value="Sri Lanka">Sri Lanka</option><option value="St Barthelemy">St Barthelemy</option><option value="St Helena">St Helena</option><option value="St Kitts and Nevis">St Kitts and Nevis</option><option value="St Lucia">St Lucia</option><option value="St Martin (French part)">St Martin (French part)</option><option value="St Pierre and Miquelon">St Pierre and Miquelon</option><option value="St Vincent and the Grenadines">St Vincent and the Grenadines</option><option value="Sub-Saharan Africa">Sub-Saharan Africa</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom, Channel Islands and Isle of Man">United Kingdom, Channel Islands and Isle of Man</option><option value="United States of America">United States of America</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Vietnam">Vietnam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, United States">Virgin Islands, United States</option><option value="Wales">Wales</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Europe">Western Europe</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>
                                 </select>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">State</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <select name="residence_state" style="width: 171px; display: inline;" id="stateSelect" class="input_text1 form-control">
                                    <option value=""></option>     <!-- bug 4176 -->
                                    <option value="All">All</option><option value="New South Wales">New South Wales</option><option value="Victoria">Victoria</option><option value="Queensland">Queensland</option><option value="South Australia">South Australia</option><option value="Western Australia">Western Australia</option><option value="Tasmania">Tasmania</option><option value="Northern Territory">Northern Territory</option><option value="Australian Capital Territory">Australian Capital Territory</option><option value="Other Australian Territories or Dependencies">Other Australian Territories or Dependencies</option><option value="Other (Overseas)">Other (Overseas)</option><option value="Fee for Service">Fee for Service</option>                                </select>
                                <div style="height:5px"></div>

                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Post Code<i class="fa fa-info-circle ml-2" aria-hidden="true" title="If not an Australian Postcode use 'OSPC' for AVETMISS purposes."></i></label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                                                    <input type="text" value="{{$student->residence_postal_code}}" name="residence_postal_code" id="postcode" class="input_text1 form-control" maxlength="4">
                                                                </div>
                        </div>    
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <h6><u>Contact Information</u></h6>
                        <div class="form-group form-inline row" id="preferredTxt" style="visibility:hidden;">
                            
                            <div class="col-10">
                                <label class="row-lg-4 col-form-label float-right"></label>
                            </div>
                            <div class="col-2">
                                <label class="row-lg-4 col-form-label">Preferred Phone</label>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Mobile</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <input type="text" style="margin-right:5px;" value="{{$student->mobile_no}}" name="mobile_no" id="mobile_number"  class="input_text1 form-control" maxlength="20">
                               
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Business Phone</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <input type="text" style="margin-right:5px;" value="{{$student->business_phone}}" name="business_phone" id="business" onkeyup="onKeyUpInput('business')" class="input_text1 form-control" maxlength="20">
                               
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Home Phone</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <input type="text" style="margin-right:5px;" value="{{$student->home_phone}}" name="home_phone" id="home" onkeyup="onKeyUpInput('home')" class="input_text1 form-control" maxlength="20">
                               
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Emergency Contact No </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                                <input type="text" value="{{$student->emergency_contact_no}}" name="emergency_contact_no" id="emergency_contact_no" class="input_text1 form-control" maxlength="20">
                            </div>
                        </div>

                        <div class="form-group form-inline row" id="preferredEmailTxt" style="visibility: visible;">
                            
                            <div class="col-10">
                                <label class="row-lg-4 col-form-label float-right"></label>
                            </div>
                            <div class="col-4">
                                <label class="row-lg-4 col-form-label">Preferred Email</label>
                            </div>
                        </div>

                        <div class="form-group form-inline row">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Email Id</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-12 col-12">
                            <input type="text" class="form-control" id="email_id" onkeyup="onKeyUpInput('email_id')" placeholder="Email" required name="email_id" value="{{$student->email_id}}">&nbsp;&nbsp;&nbsp;
                               
                        </div>

                        

                        
                        <br>
                        <h6><u>More Information</u></h6>
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Is Learner?</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <select id="is_learner" style="width:171px" class="default-select wide form-control" name="is_learner">
                                        <option value="1" {{ $student->is_learner == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $student->is_learner == 0 ? 'selected' : '' }}>No</option>
                                        </select><br>
                                            <div class="invalid-feedback">
                                                Is Learner?
                                            </div>
                                       
                            </div>
                        </div>
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Is Company Contact?</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <select id="is_companycontact" class="default-select wide form-control" name="is_companycontact">
                                        <option value="1" {{ $student->is_companycontact == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $student->is_companycontact == 0 ? 'selected' : '' }}>No</option>
                                        </select><br>
                                            <div class="invalid-feedback">
                                               Select Is Any Company Contact
                                            </div>
                                      
                            </div>
                        </div>
                        
                        
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Unique Student Identifier (case sensitive) <i class="fa fa-info-circle ml-2" aria-hidden="true" id="avetUniqueStudentIdentifier" title="An alpha-numeric code unique to each new and continuing student undertaking nationally recognised VET courses."></i></label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <input type="text" class="form-control" id="USI_no" placeholder="USI No" required name="USI_no" value="{{$student->USI_no}}" maxlength="10">
                                            <div class="invalid-feedback">
                                            USI no
                                            </div>
                                <a href="" target="_blank"><i title="Create USI" class="fa fa-plus-circle fa-2x mr-2 text-info" aria-hidden="true"></i></a></div>
                        </div>

						<div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Name Type For USI Validation</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <select id="nametype" class="default-select wide form-control" name="name_type">
                                        <option value="1" {{ $student->name_type == 1 ? 'selected' : '' }}>Use Single Name(Last Name Only)</option>
                                        <option value="0" {{ $student->name_type == 0 ? 'selected' : '' }}>Use First Name & Last Name</option>
                                            
                                        </select><br>
                                            <div class="invalid-feedback">
                                                Name Type
                                            </div>
                            </div>
                        </div>
						
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Overseas Client?</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                            <select id="overseas_client" class="default-select wide form-control" name="overseas_client">
                                        <option value="1" {{ $student->overseas_client == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ $student->overseas_client == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                            </div>
                        </div>

                        
                        <!-- <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label">Education Agent</label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <select name="educationAgent" id="educationAgent" class="input_text1 form-control" style="width:200px">
                                    <option value="0">-- Please select an agent --</option>   
                                                                    </select>
                            </div>
                        </div> -->
                       

                                                    <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="row-lg-4 col-form-label">National ID</label>
                                </div>
                                <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                    <input type="text" value="{{$student->national_id}}" name="national_id" id="national_id" class="form-control" maxlength="10" readonly="true">
                                </div>
                            </div>
                            
                                                            
                            <!--//WWB-220 Start -->
                            <div class="form-group form-inline row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                    <label class="row-lg-4 col-form-label">Survey contact status: </label>
                                </div>
                                <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                <select class="default-select wide form-control" style="width:171px;" id="survey_contact_status" name="survey_contact_status">
                                       
                                           
                                       @foreach ($surveystatus as $row)
                                       <option value="{{$row->id}}">{{$row->status_type}}</option>
                                       @endforeach
                                       
                                   </select><br>
                                       <div class="invalid-feedback">
                                           Survey Contact Status
                                       </div>
                                </div>
                            </div>
                            <!--//WWB-220 End -->
                            <div style="clear:both;height:30px">&nbsp;</div>
                            				<div class="form-group form-inline row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">	&nbsp;
					</div>
				</div>
				<div class="form-group form-inline row">
					<div class="col-lg-3 col-md-3 col-sm-12 col-12">
						<label class="row-lg-4 col-form-label">Upload a Photo of this Person  (225 x 225)</label>
					</div>
					<div class="row-lg-9 col-md-9 col-sm-12 col-12">
                    <input class="form-control" type="file" id="formFile" name="person_photo">
                                            @if($student->profile_image_path)
                                            <a target="_blank" href="{{ getStoragePath() . $student->profile_image_path }}" class="btn-link text-primary">Person Photo</a>
                                            @endif

					</div>
				</div>

            </div>
        </div>        
        <br>
        <h6 style="display:inline;"><u>Postal Address</u></h6> (if different from above)
        <br>
        <br>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Building / Property Name</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="postal_building_name" id="buildingName_postal" class="input_text1 form-control" maxlength="30">
                    </div>
                </div>
            </div>
			</div>
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Flat / Unit Details</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="postal_flat_details" id="postal_flat_details" class="input_text1 form-control" maxlength="30">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Street Number</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="postal_street_number" id="streetNumber_postal" class="input_text1 form-control" maxlength="30">
                    </div>
                </div>
            </div>
			</div>
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Street Name</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="postal_street_name" id="streetName_postal" class="input_text1 form-control" maxlength="30">
                    </div>
                </div>
            </div>
        </div>

			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Suburb</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="postal_suburb" id="suburb_postal" class="input_text1 form-control" maxlength="30">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Country</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <select style="width:171px;" name="postal_country" id="country_postal" class="input_text_1 form-control">
                            <option value=""></option> 
                            <option value="Adelie Land (France)">Adelie Land (France)</option><option value="Afghanistan">Afghanistan</option><option value="Africa, nfd">Africa, nfd</option><option value="Aland Islands">Aland Islands</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="Americas">Americas</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Argentinian Antarctic Territory">Argentinian Antarctic Territory</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Asia, nfd">Asia, nfd</option><option value="At Sea">At Sea</option><option value="Australia">Australia</option><option value="Australia (includes External Territories)">Australia (includes External Territories)</option><option value="Australian Antarctic Territory">Australian Antarctic Territory</option><option value="Australian External Territories, nec">Australian External Territories, nec</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option><option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="British Antarctic Territory">British Antarctic Territory</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burma (Republic of the Union of Myanmar)">Burma (Republic of the Union of Myanmar)</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Caribbean">Caribbean</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Central America">Central America</option><option value="Central and West Africa">Central and West Africa</option><option value="Central Asia">Central Asia</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="Chilean Antarctic Territory">Chilean Antarctic Territory</option><option value="China (excludes SARs and Taiwan)">China (excludes SARs and Taiwan)</option><option value="Chinese Asia (includes Mongolia)">Chinese Asia (includes Mongolia)</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo, Democratic Republic of">Congo, Democratic Republic of</option><option value="Congo, Republic of ">Congo, Republic of </option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d" ivoire'="">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Curacao">Curacao</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Asia, nfd">East Asia, nfd</option><option value="Eastern Europe">Eastern Europe</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="England">England</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Europe, nfd">Europe, nfd</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Former USSR, nfd">Former USSR, nfd</option><option value="Former Yugoslav Republic of Macedonia (FYROM)">Former Yugoslav Republic of Macedonia (FYROM)</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Gaza Strip and West Bank">Gaza Strip and West Bank</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Holy See">Holy See</option><option value="Honduras">Honduras</option><option value="Hong Kong (SAR of China)">Hong Kong (SAR of China)</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="Inadequately Described">Inadequately Described</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Japan and the Koreas">Japan and the Koreas</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea, Democratic People" s="" republic="" of="" (north)'="">Korea, Democratic People's Republic of (North)</option><option value="Korea, Republic of (South)">Korea, Republic of (South)</option><option value="Kosovo">Kosovo</option><option value="Kurdistan, nfd">Kurdistan, nfd</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau (SAR of China)">Macau (SAR of China)</option><option value="Madagascar">Madagascar</option><option value="Mainland South-East Asia">Mainland South-East Asia</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Maritime South-East Asia">Maritime South-East Asia</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Melanesia">Melanesia</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Middle East">Middle East</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="North Africa">North Africa</option><option value="North Africa and the Middle East">North Africa and the Middle East</option><option value="North-East Asia">North-East Asia</option><option value="North-West Europe">North-West Europe</option><option value="Northern America">Northern America</option><option value="Northern Europe">Northern Europe</option><option value="Northern Ireland">Northern Ireland</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Norway">Norway</option><option value="Not Specified">Not Specified</option><option value="Oceania and Antarctica">Oceania and Antarctica</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn Islands">Pitcairn Islands</option><option value="Poland">Poland</option><option value="Polynesia (excludes Hawaii)">Polynesia (excludes Hawaii)</option><option value="Polynesia (excludes Hawaii), nec">Polynesia (excludes Hawaii), nec</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Queen Maud Land (Norway)">Queen Maud Land (Norway)</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Ross Dependency (New Zealand)">Ross Dependency (New Zealand)</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Samoa">Samoa</option><option value="Samoa, American">Samoa, American</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Scotland">Scotland</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South America">South America</option><option value="South America, nec">South America, nec</option><option value="South Eastern Europe">South Eastern Europe</option><option value="South Sudan">South Sudan</option><option value="South-East Asia">South-East Asia</option><option value="Southern and Central Asia">Southern and Central Asia</option><option value="Southern and East Africa">Southern and East Africa</option><option value="Southern and East Africa, nec">Southern and East Africa, nec</option><option value="Southern and Eastern Europe">Southern and Eastern Europe</option><option value="Southern Asia">Southern Asia</option><option value="Southern Europe">Southern Europe</option><option value="Spain">Spain</option><option value="Spanish North Africa">Spanish North Africa</option><option value="Sri Lanka">Sri Lanka</option><option value="St Barthelemy">St Barthelemy</option><option value="St Helena">St Helena</option><option value="St Kitts and Nevis">St Kitts and Nevis</option><option value="St Lucia">St Lucia</option><option value="St Martin (French part)">St Martin (French part)</option><option value="St Pierre and Miquelon">St Pierre and Miquelon</option><option value="St Vincent and the Grenadines">St Vincent and the Grenadines</option><option value="Sub-Saharan Africa">Sub-Saharan Africa</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom, Channel Islands and Isle of Man">United Kingdom, Channel Islands and Isle of Man</option><option value="United States of America">United States of America</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option><option value="Vietnam">Vietnam</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Virgin Islands, United States">Virgin Islands, United States</option><option value="Wales">Wales</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Europe">Western Europe</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>                        </select>
                    </div>
                </div>
            </div>
			</div>
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">State</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <select style="width: 171px; display: inline;" name="stateSelect_postal" id="stateSelect_postal" class="input_text1 form-control">
                            <option value=""></option>    
                            <option value="All">All</option><option value="New South Wales">New South Wales</option><option value="Victoria">Victoria</option><option value="Queensland">Queensland</option><option value="South Australia">South Australia</option><option value="Western Australia">Western Australia</option><option value="Tasmania">Tasmania</option><option value="Northern Territory">Northern Territory</option><option value="Australian Capital Territory">Australian Capital Territory</option><option value="Other Australian Territories or Dependencies">Other Australian Territories or Dependencies</option><option value="Other (Overseas)">Other (Overseas)</option><option value="Fee for Service">Fee for Service</option>                        </select>
                        <div style="height:5px"></div>
                        <input style="width: 171px; display: none;" name="postal_state" id="state_postal" class="input_text1 form-control" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Post Code <i id="avetPostCodeHint2" class="fa fa-info-circle ml-2" aria-hidden="true" title="If not an Australian Postcode use 'OSPC' for AVETMISS purposes."></i></label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                                    <input type="text" value="" name="postal_post_code" id="postalCode_postal" class="input_text1 form-control" maxlength="4">
                                                </div>
                </div>
            </div>
            
        </div>
        <!-- <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Address Line 1 <br>(Field no longer used)</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="address1" id="address1" class="input_text1 form-control" maxlength="50" readonly="">
                    </div>
                </div>
            </div>
			</div>
			<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label">Address Line 2 <br>(Field no longer used)</label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        <input type="text" value="" name="address2" id="address2" class="input_text1 form-control" maxlength="60" readonly="">
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group form-inline row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                        <label class="row-lg-4 col-form-label" for="validationCustom02">Marital Status<span class="text-danger"></span></label>
                    </div>
                    <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                        @if($marital_status)
                                <select class="form-control" name="marital_status" id="marital_status">
                                    <option value="">{{ __('select') }}</option>
                                    @foreach($marital_status as $row)
                                    <option value="{{$row->id}}" @if($row->id == $student->marital_status)selected @endif>{{$row->title }}</option>
                                    @endforeach
                                </select>
                                    <div class="invalid-feedback">
                                    Marital Status
                                    </div>
                            @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group form-inline row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <label class="row-lg-4 col-form-label" for="validationCustom02">Blood Group<span class="text-danger"></span></label>
                            </div>
                            <div class="row-lg-9 col-md-9 col-sm-12 col-12">
                                @if($blood_group)
                                    <select class="form-control" name="blood_group" id="blood_group">
                                        <option value="">{{ __('select') }}</option>
                                            @foreach($blood_group as $row)
                                            <option value="{{$row->id}}" @if($row->id == $student->blood_group)selected @endif>{{$row->title }}</option>
                                            @endforeach
                                    </select>
                                <div class="invalid-feedback">
                                    Blood Group
                                </div>
                                @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                <div class="form-group text-center col">
                <button type="submit" class="btn btn-primary light">Submit</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            </div>
        </div>
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


<style>
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #a0cf1a;
        color: white;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   
$(document).ready(function(){
  $('#postalForm').hide(); // Initially hide the postal address form
  
  // Add event listener to checkbox to show/hide postal address fields
  $('#differentPostalAddress').change(function(){
    if($(this).is(':checked')) {
      $('#postalForm').show();
    } else {
      $('#postalForm').hide();
    }
  });


  // Add event listener to the dropdown
  $('#titleSelect').change(function(){
    // Get the selected title
    var selectedTitle = $(this).val();
    //alert(selectedTitle);
    // Update the gender textbox based on the selected title
    if(selectedTitle === '0') {
      $('#genderTextbox').val('Male');
    } else if(selectedTitle === '1') {
      $('#genderTextbox').val('Female');
    } else if(selectedTitle === '2') {
      $('#genderTextbox').val('Female');
    } else {
      $('#genderTextbox').val('');
    }
  });
});
</script>
@section('customjs')
<!--select2 js-->

<script src="{{ asset('admin/vendor/select2/js/select2.full.min.js')}}"></script>
 <script type="text/javascript">
        
        $(document).ready(function() {
            // [ Single Select ] start
            $(".select2").select2();

            // [ Multi Select ] start
            $(".select2-multiple").select2({
                placeholder: "select multiple"
            });
        });

</script>


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
                })
    })()


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


@endsection
@stop