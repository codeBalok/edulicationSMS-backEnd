 
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
<div class="col-lg-12">
	<div class="card dz-card" id="buttons-with-icon">
		<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
			<div>
				<h4 class="card-title">Fees Master List</h4>
			</div>
		
		</div>
		<div class="tab-content" id="myTabContent-1">
			<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
				<div class="card-body pt-0">
				<a href="{{ URL::route('add-fees-master') }}" class="btn btn-primary light"><i class="fa-solid fa-plus"></i> Assign</a>
					<button type="button" class="btn btn-secondary"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
				</div>
			</div>
			
		</div>	
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<div class="form-validation">
						<form class="needs-validation" novalidate method="get" action="{{ route('list-fees-master') }}">
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
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Fees Type
											<span class="text-danger">*</span>
										</label>
										<div class="row-lg-12">
											
												<select class="select form-control category" id="validationCustom05" tabindex="null" name="category">
												<option value="0">{{ __('all') }}</option>
											       @foreach( $categories as $category )
                                                    <option value="{{ $category->id }}" @if( $selected_category == $category->id) selected @endif>{{ $category->title }}</option>
                                                    @endforeach
												</select>
												
												<div class="invalid-feedback">
													Please select a Fees Type.
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
<div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">

        <!-- /tab-content -->	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="example4" class="display table" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th>Fees Type</th>
                                    <th>Amount</th>
                                    <th>Assign Date</th>
                                    <th>Due Date</th>
                                    <th>Student</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($rows))
                                @foreach ($rows as $key => $row)

                                <tr>
								
									<td>{{ $key + 1 }}</td>
                                    <td>{{ $row->category->title ?? '' }}</td>
                                    <td>
                                        {{ number_format((float)$row->amount, 2, '.', '') }} $
                                            @if($row->type == 1)
                                            <span class="badge badge-pill badge-primary">Fixed</span>
                                            @elseif($row->type == 2)
                                            <span class="badge badge-pill badge-dark">Per Credit</span>
                                            @endif
                                    </td>
									   <td>
                                             {{ date("Y-m-d", strtotime($row->assign_date)) }}
                                        </td>
                                        <td>
                                             {{ date("Y-m-d", strtotime($row->due_date)) }}
                                        </td>
                                        <td>{{ $row->studentEnrolls->count() }}</td>
                                        <td>
                                            <button type="button" class="btn btn-icon btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#showModal-{{ $row->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!--  Show modal -->
                               
                                            
                                                <!-- Show modal content -->
                                        <div id="showModal-{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel">{{ __('modal_view') }} {{ $title }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Details View Start -->
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p><mark class="text-primary">{{ __('field_fees_type') }}:</mark> {{ $row->category->title ?? '' }}</p><hr/>
                                                                    
                                                                    <p><mark class="text-primary">{{ __('field_amount') }}:</mark> 
                                                                    {{ number_format((float)$row->amount, 2, '.', '') }}  
                                                                        $
                                    
                                                                        @if($row->type == 1)
                                                                        <span class="badge badge-pill badge-primary">Fixed</span>
                                                                        @elseif($row->type == 2)
                                                                        <span class="badge badge-pill badge-dark">Per Credit</span>
                                                                        @endif
                                                                    </p><hr/>
                                    
                                                                    <p><mark class="text-primary">{{ __('field_assign') }} {{ __('field_date') }}:</mark> 
                                                                        {{ date("Y-m-d", strtotime($row->assign_date)) }}
                                                                    </p><hr/>
                                    
                                                                    <p><mark class="text-primary">{{ __('field_due_date') }}:</mark> 
                                                                        {{ date("Y-m-d", strtotime($row->due_date)) }}
                                                                    </p><hr/>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p><mark class="text-primary">{{ __('field_faculty') }}:</mark> 
                                                                        @if($row->faculty_id == 0)
                                                                        {{ __('all') }}
                                                                        @endif
                                                                        @if(isset($row->faculty->title))
                                                                        {{ $row->faculty->title }}
                                                                        @endif
                                                                    </p><hr/>
                                    
                                                                    <p><mark class="text-primary">{{ __('field_program') }}:</mark> 
                                                                        @if($row->program_id == 0)
                                                                        {{ __('all') }}
                                                                        @endif
                                                                        @if(isset($row->program->title))
                                                                        {{ $row->program->title }}
                                                                        @endif
                                                                    </p><hr/>
                                                                    
                                                                    <p><mark class="text-primary">{{ __('field_session') }}:</mark> 
                                                                        @if($row->session_id == 0)
                                                                        {{ __('all') }}
                                                                        @endif
                                                                        @if(isset($row->session->title))
                                                                        {{ $row->session->title }}
                                                                        @endif
                                                                    </p><hr/>
                                    
                                                                    <p><mark class="text-primary">{{ __('field_semester') }}:</mark> 
                                                                        @if($row->semester_id == 0)
                                                                        {{ __('all') }}
                                                                        @endif
                                                                        @if(isset($row->semester->title))
                                                                        {{ $row->semester->title }}
                                                                        @endif
                                                                    </p><hr/>
                                    
                                                                    <p><mark class="text-primary">{{ __('field_section') }}:</mark> 
                                                                        @if($row->section_id == 0)
                                                                        {{ __('all') }}
                                                                        @endif
                                                                        @if(isset($row->section->title))
                                                                        {{ $row->section->title }}
                                                                        @endif
                                                                    </p><hr/>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p><mark class="text-primary">{{ __('field_student') }} {{ __('list') }}:</mark> 
                                                                        @foreach($row->studentEnrolls as $key => $student)
                                                                        <a href="#" target="_blank">
                                                                          <span class="badge badge-pill badge-primary">#{{ $student->student->student_id }}</span>
                                                                        </a>
                                                                        @endforeach
                                                                    </p><hr/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Details View End -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('btn_close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                        </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /tab-content -->	

    </div>
</div>
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



<style>
    select.select {
    appearance: revert;
}
</style>




@stop