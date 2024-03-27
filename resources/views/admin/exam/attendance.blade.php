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
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-lg-12">
		<div class="card dz-card" id="buttons-with-icon">
												<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
													
														<h4 class="card-title">Exam Attendance</h4>
														<a href="" class="btn btn-dark btn-sm float-right"><i class="fas fa-upload"></i> Import</a>
													
												
												</div>
												
												<div class="row">
													<div class="col-lg-12">
														<div class="card-body">
															<div class="form-validation">
																<form class="needs-validation" novalidate method="get" action="{{ route('examattendance-list') }}">
																		<div class="row">
																			<div class="col-xl-3">
																				<div class="mb-3 row">
																
																				<label class="row-lg-6 col-form-label" for="faculty">faculty<span class="text-danger">*</span></label>
																						<div class="row-lg-8">
																							<select class="form-control faculty" name="faculty" id="faculty" required>
																								<option value="">Select</option>
																								@if(isset($faculties))
																								@foreach( $faculties->sortBy('title') as $faculty )
																								<option value="{{ $faculty->id }}" @if( $selected_faculty == $faculty->id) selected @endif>{{ $faculty->title }}</option>
																								@endforeach
																								@endif
																							</select>
																							@error('faculty')
																							<span class="invalid-feedback" role="alert">
																								<strong>{{ $message }}</strong>
																							</span>
																							@enderror
																						</div>
																				</div>
																			</div>  
															
															
																			<div class="col-xl-3">
																				<div class="mb-3 row">
																	
																					<label class="row-lg-6 col-form-label" for="program">Program<span class="text-danger">*</span></label>
																						<div class="row-lg-8">
																							<select class="form-control program" name="program" id="program" required>
																								<option value="">Select</option>
																								@if(isset($programs))
																								@foreach( $programs->sortBy('title') as $program )
																								<option value="{{ $program->id }}" @if( $selected_program == $program->id) selected @endif>{{ $program->title }}</option>
																								@endforeach
																								@endif
																							</select>
																							@error('program')
																							<span class="invalid-feedback" role="alert">
																								<strong>{{ $message }}</strong>
																							</span>
																							@enderror
																					</div>
																				</div>
																			</div>


																		<div class="col-xl-3">
																			<div class="mb-3 row">
																		
																				<label class="row-lg-6 col-form-label" for="session">Session <span class="text-danger">*</span></label>

																				<div class="row-lg-8">
																							<select class="form-control session" name="session" id="session" required>
																								<option value="">{{ __('select') }}</option>
																								@if(isset($sessions))
																								@foreach( $sessions->sortByDesc('id') as $session )
																								<option value="{{ $session->id }}" @if( $selected_session == $session->id) selected @endif>{{ $session->title }}</option>
																								@endforeach
																								@endif
																							</select>
																							@error('session')
																							<span class="invalid-feedback" role="alert">
																								<strong>{{ $message }}</strong>
																							</span>
																							@enderror
																					</div>
																				</div>
																			</div>
												
																
																		<div class="col-xl-3">
																			<div class="mb-3 row">
																		
																	
																				<label  class="row-lg-6 col-form-label" for="semester">Semester <span class="text-danger">*</span></label>

																							<div class="row-lg-8">
																									<select class="form-control semester" name="semester" id="semester" required>
																										<option value="">{{ __('select') }}</option>
																										@if(isset($semesters))
																										@foreach( $semesters->sortBy('id') as $semester )
																										<option value="{{ $semester->id }}" @if( $selected_semester == $semester->id) selected @endif>{{ $semester->title }}</option>
																										@endforeach
																										@endif
																								</select>
																								@error('semester')
																										<span class="invalid-feedback" role="alert">
																											<strong>{{ $message }}</strong>
																										</span>
																										@enderror
																							</div>
																					</div>
																			</div>

																		<div class="col-xl-3">
																			<div class="mb-3 row">
																				<label class="row-lg-3 col-form-label" for="subject">Subject
																				</label>
																				<div class="row-lg-8">
																					<select class="form-control section" name="section" id="section" required>
																							<option value="">{{ __('select') }}</option>
																							@if(isset($sections))
																							@foreach( $sections->sortBy('title') as $section )
																							<option value="{{ $section->id }}" @if( $selected_section == $section->id) selected @endif>{{ $section->title }}</option>
																							@endforeach
																							@endif   
																					</select>
																					<div class="invalid-feedback">
																						Select Section
																					</div>
																				</div>
																			</div>
																		</div>	

																		<div class="col-xl-3">
																			<div class="mb-3 row">
																				<label class="row-lg-3 col-form-label" for="type">Type
																				</label>
																				<div class="row-lg-8">
																				<select class="form-control" name="type" id="type" required>
																					<option value="">{{ __('select') }}</option>
																					@foreach( $types as $type )
																					<option value="{{ $type->id }}" @if( $selected_type == $type->id) selected @endif>{{ $type->title }}</option>
																					@endforeach
																				</select>
																					<div class="invalid-feedback">
																						Select Section
																					</div>
																				</div>
																			</div>
																		</div>	
																												<div class="col-lg-2 pt-4">
																													
																													<div class="col-lg-8 ms-auto">
																														<button type="submit" class="btn btn-primary light"><i class="fas fa-search"></i>  Filter</button>
																													</div>
																												</div>

																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>	
  								<!-- End Column-->
								  <div class="col-sm-12">
                <div class="card">
                    @if(isset($rows))
                    <div class="card-block">
                        @if(isset($attendances))
                        @if(count($attendances) > 0)
                        <div class="alert alert-success" role="alert">
                            {{ __('attendance_taken') }}
                        </div>
                        @else
                        <div class="alert alert-danger" role="alert">
                            {{ __('attendance_not_taken') }}
                        </div>
                        @endif
                        @endif
                    </div>
                    @endif
                    
                    @if(isset($rows))
                    <div class="card-header">
                        <div class="form-group d-inline">
                            <div class="radio radio-primary d-inline">
                                <input type="radio" name="all_check" id="attendance-p" class="all_present">
                                <label for="attendance-p" class="cr">{{ __('all') }} {{ __('attendance_present') }}</label>
                            </div>
                        </div>
                        <div class="form-group d-inline">
                            <div class="radio radio-danger d-inline">
                                <input type="radio" name="all_check" id="attendance-a" class="all_absent">
                                <label for="attendance-a" class="cr">{{ __('all') }} {{ __('attendance_absent') }}</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <form class="needs-validation" novalidate action="{{ route($route.'.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if(isset($attendances))
                    @foreach($attendances as $attendance)
                        @if($loop->first)
                        @php
                            $check_data = $attendance;
                        @endphp
                        @endif
                    @endforeach
                    @endif
                    
                    <div class="card-block">
                        <div class="row">
                            <div class="form-group col-sm-6 col-md-3">
                                <label for="date">{{ __('field_date') }} <span>*</span></label>
                                <input type="date" class="form-control date" name="date" id="date" value="{{ $check_data->date ?? '' }}" required>
                                    
                                <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_date') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="subject" value="{{ $selected_subject }}">
                    <input type="hidden" name="type" value="{{ $selected_type }}">
                    <input type="hidden" name="attendances" class="attendances" value="">

                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="display table nowrap table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('field_student_id') }}</th>
                                        <th>{{ __('field_name') }}</th>
                                        <th>{{ __('field_attendance') }}</th>
                                        <th>{{ __('field_subject') }}</th>
                                        <th>{{ __('field_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $subjects as $subject )
                                    @if($subject->id == $selected_subject)
                                    @php
                                        $cur_subject = $subject->code;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @foreach( $types as $type )
                                    @if($type->id == $selected_type)
                                    @php
                                        $cur_type = $type->title;
                                    @endphp
                                    @endif
                                    @endforeach
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>
                                            @isset($row->student->student_id)
                                            <a href="{{ route('admin.student.show', $row->student->id) }}">
                                            #{{ $row->student->student_id ?? '' }}
                                            </a>
                                            @endisset
                                        </td>
                                        <td>{{ $row->student->first_name ?? '' }} {{ $row->student->last_name ?? '' }}</td>
                                        <td>
                                        <input type="text" name="students[]" value="{{ $row->id }}" hidden>

                                        <div class="form-group d-inline">
                                            <div class="radio radio-primary d-inline">
                                                <input class="c-present" type="radio" data_id="{{ $row->id }}"name="attendances-{{ $key }}" id="attendance-p-{{ $key }}" value="1" required 

                                                @if(isset($attendances))
                                                @foreach($attendances as $attendance)
                                                    @if($attendance->student_enroll_id == $row->id && $attendance->attendance == 1)
                                                        checked
                                                    @endif
                                                @endforeach
                                                @endif
                                                >
                                                <label for="attendance-p-{{ $key }}" class="cr">{{ __('attendance_present') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-inline">
                                            <div class="radio radio-danger d-inline">
                                                <input class="c-absent" type="radio" data_id="{{ $row->id }}"name="attendances-{{ $key }}" id="attendance-a-{{ $key }}" value="2" required 

                                                @if(isset($attendances))
                                                @foreach($attendances as $attendance)
                                                    @if($attendance->student_enroll_id == $row->id && $attendance->attendance == 2)
                                                        checked
                                                    @endif
                                                @endforeach
                                                @endif
                                                >
                                                <label for="attendance-a-{{ $key }}" class="cr">{{ __('attendance_absent') }}</label>
                                            </div>
                                        </div>
                                        </td>
                                        <td>{{ $cur_subject ?? '' }}</td>
                                        <td>{{ $cur_type ?? '' }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    
                    @if(count($rows) < 1)
                    <div class="card-block">
                        <h5>{{ __('no_result_found') }}</h5>
                    </div>
                    @endif

                    @if(count($rows) > 0)
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success update"><i class="fas fa-check"></i> {{ __('btn_update') }}</button>
                    </div>
                    @endif
                    </form>
                    @endif

                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->


<script src="https://code.jquery.com/jquery.min.js"></script>

<script type="text/javascript">
    "use strict";
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
            // var jsonData=JSON.parse(response);
            $('option', program).remove();
            $('.program').append('<option value="">Select</option>');
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
            $('.session').append('<option value="">{{ __("select") }}</option>');
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
            $('.semester').append('<option value="">{{ __("select") }}</option>');
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
            $('.section').append('<option value="">{{ __("select") }}</option>');
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
    $(document).ready(function() {
        $(".update").on('click',function(e){
            var attendances = [];
            $.each($("input[data_id]:checked"), function(){
                attendances.push($(this).val());
            });

            $(".attendances").val( attendances.join(',') );
        });
    });


    // checkbox all-check-button selector
    $(".all_present").on('click',function(e){
        if($(this).is(":checked")){
            // check all checkbox
            $(".c-present").prop('checked', true);
        }
        else if($(this).is(":not(:checked)")){
            // uncheck all checkbox
            $(".c-present").prop('checked', false);
        }
    });
    $(".all_absent").on('click',function(e){
        if($(this).is(":checked")){
            // check all checkbox
            $(".c-absent").prop('checked', true);
        }
        else if($(this).is(":not(:checked)")){
            // uncheck all checkbox
            $(".c-absent").prop('checked', false);
        }
    });
</script>
@endsection
		