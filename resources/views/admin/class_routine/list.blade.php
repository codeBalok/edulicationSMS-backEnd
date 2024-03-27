
 
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<style>
  .class-time
  {
    clear: both;
    color: #000;
    padding: 5px;
    margin-top: 5px;
    margin-right: 5px;
    background: #CFF95A;
    box-shadow: 0 10px 18px 0 rgba(69, 90, 100, 0.08);
  }
</style>
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
													<div>
														<h4 class="card-title">Class Routine List</h4>
													</div>
												
												</div>
												<div class="tab-content" id="myTabContent-1">
													<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
														<div class="card-body pt-0">
														<a href="{{ URL::route('add-classroutine') }}" class="btn btn-primary light"><i class="fa-solid fa-plus"></i> Add/Edit</a>
                            <a href="{{ URL::route('classroutine-list') }}" class="btn btn-secondary"><i class="fa-solid fa-arrows-rotate"></i> Refresh</a>
                            

                                  <button type="button" class="btn btn-dark" onclick="document.getElementById('print-routine').submit()">
                                      <i class="fas fa-print"></i> Print
                                  </button>

                                  <form id="print-routine" target="_blank" method="post" action="{{ URL::route('class-routine.print') }}" hidden>
                                      @csrf
                                      <input type="hidden" name="program" value="{{ $selected_program }}">
                                      <input type="hidden" name="session" value="{{ $selected_session }}">
                                      <input type="hidden" name="semester" value="{{ $selected_semester }}">
                                      <input type="hidden" name="section" value="{{ $selected_section }}">
                                  </form>
                                 
															
														</div>
													</div>
													
												</div>	
												<div class="row">
													<div class="col-lg-12">
														<div class="card-body">
															<div class="form-validation">
																<form class="needs-validation" novalidate method="get" action="{{ route('classroutine-list') }}">
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
              <div class="col-sm-12">
                <div class="card">
                    @if(isset($rows))
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="table class-routine-table">
                                <thead>
                                    <tr>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $weekdays = array('1', '2', '3', '4', '5', '6', '7');
                                    @endphp
                                    <tr>
                                        @foreach($weekdays as $weekday)
                                        <td>
                                            @foreach($rows->where('day', $weekday) as $row)
                                            <div class="class-time">
                                            {{ $row->subject->code ?? '' }}<br>
                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->start_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->start_time)) }}
                                            @endif <br/> @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->end_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->end_time)) }}
                                            @endif<br>
                                            {{ __('Room') }}: {{ $row->room->title ?? '' }}<br>
                                            {{ $row->teacher->id }} - {{ $row->teacher->first_name ?? '' }}
                                            </div>
                                            @endforeach
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    @endif

                </div>
              </div>
				</div>
		</div>
										<!-- /Column  -->


                                        
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
@endsection