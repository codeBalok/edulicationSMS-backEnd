<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')

<!-- Start Content-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Card ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add / Edit Exam Routine</h5>
                    </div>
           
                    <div class="tab-content" id="myTabContent-1">
													<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
														<div class="card-body pt-0 mt-2">
                                                        <a href="{{ URL::route('examroutine-list') }}" class="btn btn-primary light"><i class="fas fa-arrow-left"></i> back</a>
                                                        <a href="{{ URL::route('add-examroutine') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i> refresh</a>
															
														</div>
													</div>
													
												</div>
                                                <div class="row">
													<div class="col-lg-12">
														<div class="card-body">
															<div class="form-validation">
																<form class="needs-validation" novalidate method="get" action="{{ route('add-examroutine') }}">
                                    <div class="row">
                                        <div class="col-xl-3">
                                            <div class="mb-3 row">
                               
                                              <label class="row-lg-6 col-form-label" for="faculty">faculty<span class="text-danger">*</span></label>
                                                    <div class="row-lg-8">
                                                        <select class="form-control faculty" name="faculty" id="faculty" required>
                                                            <option value="">{{ __('select') }}</option>
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
                                                            <option value="">{{ __('select') }}</option>
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
                                                <select class="form-control type" name="type" id="type" required>
                                                        <option value="">Select</option>
                                                        @foreach( $types as $type )
                                                        <option value="{{ $type->id }}" @if( $selected_type == $type->id) selected @endif>{{ $type->title }}</option>
                                                        @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Select Type
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
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    @isset($rows)
                    <div class="card-block">
                        
                        @isset($rows)
                        @foreach($rows as $row)

                        <form class="needs-validation mt-5" novalidate action="{{ route('update-examroutine', $row->id) }}" method="post" id="fields" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="row">

                                @include('admin.exam_routine.form_edit')

                                <input type="text" name="program" value="{{ $selected_program }}" hidden>
                                <input type="text" name="session" value="{{ $selected_session }}" hidden>
                                <input type="text" name="semester" value="{{ $selected_semester }}" hidden>
                                <input type="text" name="section" value="{{ $selected_section }}" hidden>
                                <input type="text" name="type" value="{{ $selected_type }}" hidden>

                                <div class="form-group col-6 col-md-3">
                                    <button type="submit" class="btn btn-success btn-filter"><i class="fas fa-check"></i> Update</button>
                                </div>

                                
                                <div class="form-group col-6 col-md-3">
                                    <button type="button" class="btn btn-danger btn-filter" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $row->id }}">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                              

                            </div>
                        </form>

                        
                        <!-- Include Delete modal -->
                        @include('admin.exam_routine.delete')
                        
                        @endforeach
                        @endisset

                        <form action="{{ route('store-examroutine') }}" class="needs-validation mt-5 btn-submit" novalidate method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            
                            @include('admin.exam_routine.form_field')

                            <input type="text" name="program" value="{{ $selected_program }}" hidden>
                            <input type="text" name="session" value="{{ $selected_session }}" hidden>
                            <input type="text" name="semester" value="{{ $selected_semester }}" hidden>
                            <input type="text" name="section" value="{{ $selected_section }}" hidden>
                            <input type="text" name="type" value="{{ $selected_type }}" hidden>

                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-success btn-filter"><i class="fas fa-check"></i> Save</button>
                            </div>
                        </div>
                        </form>
                   </div>
                   @endisset
                </div>
                
            </div>
            <!-- [ Card ] end -->
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
            $('.session').append('<option value="">Select</option>');
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
            $('.semester').append('<option value="">Select</option>');
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
            $('.section').append('<option value="">Select</option>');
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
    (function ($) {
        "use strict";
        // add Field
        $(document).on('click', '#addField', function () {
            var tab = $(this).attr('data-bs-tab');
            var html = '';
            html += '<hr/>';
            html += '<div id="inputFormField" class="card-block">';
            html += '<div class="row">';
            html += '<div class="form-group col-md-2"><label for="subject">Subject<span>*</span></label><select class="form-control select2" name="subject[]" id="subject" required><option value="">Select</option> @isset($subjects) @foreach( $subjects as $subject ) <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->title }}</option> @endforeach @endisset </select> <div class="invalid-feedback"> {{ __('required_field') }} {{ __('field_subject') }}</div></div>';
            html += '<div class="form-group col-md-2"><label for="teacher">Teacher <span>*</span></label> <select class="form-control select2" name="teacher[]" id="teacher"><option value="">Select</option> @isset($teachers) @foreach( $teachers as $teacher ) <option value="{{ $teacher->id }}">{{ $teacher->staff_id }} - {{ $teacher->first_name }} {{ $teacher->last_name }}</option> @endforeach @endisset </select> <div class="invalid-feedback"> {{ __('required_field') }} {{ __('field_teacher') }} </div> </div>';
            html += '<div class="form-group col-md-2"> <label for="room">Room No <span>*</span></label> <select class="form-control select2" name="room[]" id="room" required> <option value="">Select</option> @isset($rooms) @foreach( $rooms as $room ) <option value="{{ $room->id }}">{{ $room->title }}</option> @endforeach @endisset </select> <div class="invalid-feedback"> {{ __('required_field') }} {{ __('field_room') }} {{ __('field_no') }} </div> </div>';
            html += '<div class="form-group col-md-2"> <label for="start_time">Time From <span>*</span></label><input type="time" class="form-control time" name="start_time[]" id="start_time" required><div class="invalid-feedback"> </div></div>';
            html += '<div class="form-group col-md-2"> <label for="end_time">Time To <span>*</span></label> <input type="time" class="form-control time" name="end_time[]" id="end_time" required> <div class="invalid-feedback"> {{ __('required_field') }} {{ __('field_time') }} {{ __('field_to') }} </div> </div>';
            html += '<div class="form-group col-md-2"><button id="removeField" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button></div>';
            html += '</div>';

            $('#newField-'+tab).append(html);

            // Time Picker
            $('.time').bootstrapMaterialDatePicker({
                date: false,
                shortTime: true,
                format: 'HH:mm'
            });
        });

        // remove Field
        $(document).on('click', '#removeField', function () {
            $(this).closest('#inputFormField').remove();

            // Time Picker
            $('.time').bootstrapMaterialDatePicker({
                date: false,
                shortTime: true,
                format: 'HH:mm'
            });
        });
    }(jQuery));


    // Delete Routine
    function deleteRoutine(id) {
        $("#deleteRoutine-"+id).hide();
        $("#delete_routine-"+id).attr("checked", "checked");
    }
</script>
@endsection