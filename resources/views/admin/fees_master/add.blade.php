 
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="col-lg-12">
	<div class="card dz-card" id="buttons-with-icon">
		<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
			<div>
				<h4 class="card-title">Assign Fee</h4>
			</div>
		
		</div>
		<div class="tab-content" id="myTabContent-1">
			<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
				<div class="card-body pt-0">
				<a href="{{ URL::route('list-fees-master') }}" class="btn btn-primary light"><i class="fas fa-arrow-left"></i> Back</a>
					<button type="button" class="btn btn-secondary"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
				</div>
			</div>
			
		</div>	
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<div class="form-validation">
						<form class="needs-validation" novalidate method="get" action="{{ route('add-fees-master') }}">
						    @csrf
							<div class="row">
								
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Faculty
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control faculty" id="department" name="faculty" tabindex="null">
												<option value="0">{{ __('all') }}</option>
													@foreach( $faculties as $faculty )
													
													<option value="{{ $faculty->id }}" @if( $selected_faculty == $faculty->id) selected @endif>{{ $faculty->title }}</option>
													@endforeach
												</select>
												
												<div class="invalid-feedback">
													Please select a faculty.
												</div>
											
										</div>
									</div>
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Program
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control program" id="program" name="program">
												<option value="0">{{ __('all') }}</option>
												@if(isset($programs))
                                        		@foreach( $programs->sortBy('title') as $program )
                                        		<option value="{{ $program->id }}" @if( $selected_program == $program->id) selected @endif>{{ $program->title }}</option>
                                        		@endforeach
                                        		@endif
												</select>
												
												<div class="invalid-feedback">
													Please select a Program.
												</div>
											
										</div>
									</div>
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Session
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control session" id="validationCustom05" tabindex="null" name="session">
												<option value="0">{{ __('all') }}</option>
													@if(isset($sessions))
                                            		@foreach( $sessions->sortByDesc('id') as $session )
                                            		<option value="{{ $session->id }}" @if( $selected_session == $session->id) selected @endif>{{ $session->title }}</option>
                                            		@endforeach
                                            		@endif
												</select>
												
												<div class="invalid-feedback">
													Please select a Session.
												</div>
											
										</div>
									</div>
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Semester
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control semester" id="validationCustom05" tabindex="null" name="semester">
												<option value="0">{{ __('all') }}</option>
													@if(isset($semesters))
                                            		@foreach( $semesters->sortBy('id') as $semester )
                                            		<option value="{{ $semester->id }}" @if( $selected_semester == $semester->id) selected @endif>{{ $semester->title }}</option>
                                            		@endforeach
                                            		@endif
												</select>
												
												<div class="invalid-feedback">
													Please select a Semester.
												</div>
											
										</div>
									</div>
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Section
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control section" id="validationCustom05" tabindex="null" name="section">
												<option value="0">{{ __('all') }}</option>
													@if(isset($sections))
                                            		@foreach( $sections->sortBy('title') as $section )
                                            		<option value="{{ $section->id }}" @if( $selected_section == $section->id) selected @endif>{{ $section->title }}</option>
                                            		@endforeach
                                            		@endif
												</select>
												
												<div class="invalid-feedback">
													Please select a Section.
												</div>
											
										</div>
									</div>


									<div class="col-lg-2 pt-4">
										
										<div class="col-lg-8 ms-auto">
											<button type="submit" class="btn btn-primary light"><i class="fas fa-search"></i>  Search</button>
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
<!-- /Column  -->
@if(isset($rows))
@if(count($rows) > 0)
<form class="needs-validation" novalidate method="post" action="{{ route('store-fees-master') }}">
 @csrf
		 
<div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">
		
        	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                <div class="card-body pt-0">
                    
                    <input type="text" name="faculty" value="{{ $selected_faculty }}" hidden>
                    <input type="text" name="program" value="{{ $selected_program }}" hidden>
                    <input type="text" name="session" value="{{ $selected_session }}" hidden>
                    <input type="text" name="semester" value="{{ $selected_semester }}" hidden>
                    <input type="text" name="section" value="{{ $selected_section }}" hidden>
                    
                    <div class="table-responsive">
                        <table id="example4" class="display table" style="min-width: 845px">
<thead>
                                    <tr>
                                        <th>
                                            <div class="checkbox checkbox-success d-inline">
                                                <input type="checkbox" id="checkbox" class="all_select" checked>
                                                <label for="checkbox" class="cr" style="margin-bottom: 0px;"></label>
                                            </div>
                                        </th>
                                        <th>Student ID</th>
                                        <th>C.H.</th>
                                        <th>Program</th>
                                        <th>Session</th>
                                        <th>Semester</th>
                                        <th>Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>
                                            <div class="checkbox checkbox-primary d-inline">
                                                <input type="checkbox" name="students[]" id="checkbox-{{ $row->id }}" value="{{ $row->id }}" checked>
                                                <label for="checkbox-{{ $row->id }}" class="cr"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#">
                                            #{{ $row->student->student_id ?? '' }}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $total_credits = 0;
                                                foreach($row->subjects as $subject){
                                                    $total_credits = $total_credits + $subject->credit_hour;
                                                }
                                            @endphp
                                            {{ $total_credits }}
                                        </td>
                                        <td>{{ $row->program->shortcode ?? '' }}</td>
                                        <td>{{ $row->session->title ?? '' }}</td>
                                        <td>{{ $row->semester->title ?? '' }}</td>
                                        <td>{{ $row->section->title ?? '' }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        	
    </div>
</div>

   <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                <div class="form-validation">
                    
                            <div class="row">

                                <div class="col-xl-6">
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Fees Type<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                        <select class="form-control" name="category" id="category" required>
                                            <option value="">{{ __('select') }}</option>
                                            @foreach( $categories as $category )
                                            <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                            @endforeach
                                        </select>
                                            <div class="invalid-feedback">
                                                Please enter a Fees Type.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Assign Dat<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" name="assign_date" id="assign_date" value="{{ date('Y-m-d') }}" readonly required>
                                            <div class="invalid-feedback">
                                                Please enter a Assign Date.
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Due Date <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control date" name="due_date" id="due_date" value="{{ date('Y-m-d') }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a Due Date.
                                            </div>

                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="col-xl-6">
                                    <fieldset class="mb-3">
                                        <div class="row">
                                            <!--<label class="col-form-label col-sm-3 pt-0">Gender</label>-->
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type" value="1" checked>
                                                    <label class="form-check-label">
                                                        Fixed
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type" value="2">
                                                    <label class="form-check-label">
                                                        Per Credit
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="emergency_contact_no">Amount<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                        <input type="number" class="form-control autonumber" name="amount" id="amount" value="" required>
                                            <div class="invalid-feedback">
                                                Please select amount.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <div class="col-lg-8 ms-auto">
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary light">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        

                </div>
            </div>
        </div>
    </div>
</form>
@endif
@endif

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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


<script type="text/javascript">
 $(".faculty").on('change',function(e){
     
      e.preventDefault(e);
      var program=$(".program");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-program') }}",
        data:{
          _token:$('input[name=_token]').val(),
          faculty:$(this).val()
        },
        success:function(response){
              console.log("Okk");
            // var jsonData=JSON.parse(response);
            $('option', program).remove();
            $('.program').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.program');
            });
          }

      });
    });
    
        $(".program").on('change',function(e){
      e.preventDefault(e);
      var session=$(".session");
      var semester=$(".semester");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-session') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', session).remove();
            $('.session').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.session');
            });
          }

      });

      $.ajax({
        type:'POST',
        url: "{{ route('filter-semester') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', semester).remove();
            $('.semester').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.semester');
            });
          }

      });
    });

    $(".semester").on('change',function(e){
      e.preventDefault(e);
      var section=$(".section");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url: "{{ route('filter-section') }}",
        data:{
          _token:$('input[name=_token]').val(),
          semester:$(this).val(),
          program:$('.program option:selected').val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', section).remove();
            $('.section').append('<option value="">{{ __("all") }}</option>');
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.title
              }).appendTo('.section');
            });
          }

      });
    });

</script>

<script type="text/javascript">
"use strict";
// checkbox all-check-button selector
$(".all_select").on('click',function(e){
    if($(this).is(":checked")){
        // check all checkbox
        $("input:checkbox").prop('checked', true);
    }
    else if($(this).is(":not(:checked)")){
        // uncheck all checkbox
        $("input:checkbox").prop('checked', false);
    }
});
</script>


<style>
    select.select {
    appearance: revert;
}
</style>




@stop