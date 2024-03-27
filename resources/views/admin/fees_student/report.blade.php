 
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
				<h4 class="card-title">Fees Report</h4>
			</div>
		
		</div>
	
		<div class="row">
			<div class="col-lg-12">
				<div class="card-body">
					<div class="form-validation">
						<form class="needs-validation" novalidate method="get" action="{{ route('fees-student-report') }}">
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
													@if(isset($categories))
											       @foreach( $categories as $category )
                                                    <option value="{{ $category->id }}" @if( $selected_category == $category->id) selected @endif>{{ $category->title }}</option>
                                                    @endforeach
                                                    @endif
												</select>
												
												<div class="invalid-feedback">
													Please select a Fees Type.
												</div>
											
										</div>
									</div>
									<div class="col-lg-2">
										<label class="row-lg-4 col-form-label" for="validationCustom05">Student ID
											
										</label>
										<div class="row-lg-12">
											
											<input type="text" class="form-control" name="student_id" id="student_id" value="{{ $selected_student_id }}">
											
											<div class="invalid-feedback">
												Please enter student id.
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
    @if(isset($rows))
        <!-- /tab-content -->	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="example4" class="display table" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt</th>
									<th>Student ID</th>
                                    <th>Fees Type</th>
                                    <th>Fee</th>
                                    <th>Discount</th>
                                    <th>Fine</th>
									<th>Net Amount</th>
									<th>Pay Date</th>
									<th>Status</th>
									<th>Method</th>
									<th>Note</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                  @foreach( $rows as $key => $row )
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_pad($row->id, 6, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            @isset($row->studentEnroll->student->student_id)
                                            <a href="#">
                                            #{{ $row->studentEnroll->student->student_id ?? '' }}
                                            </a>
                                            @endisset
                                        </td>
                                        <td>{{ $row->category->title ?? '' }}</td>
                                        <td>
                                         {{ number_format((float)$row->fee_amount, 2, '.', '') }} 
                                           $
                                        </td>
                                        <td>
                                         {{ number_format((float)$row->discount_amount, 2, '.', '') }} 
                                            $
                                        </td>
                                        <td>
                                         {{ number_format((float)$row->fine_amount, 2, '.', '') }} 
                                           $
                                        </td>
                                        <td>
                                         {{ number_format((float)$row->paid_amount, 2, '.', '') }} 
                                           $
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                          {{ date("Y-m-d", strtotime($row->pay_date)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->status == 1)
                                            <span class="badge badge-pill badge-success">Paid</span>
                                            @elseif($row->status == 2)
                                            <span class="badge badge-pill badge-danger">Canceled</span>
                                            @else
                                            <span class="badge badge-pill badge-primary">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if( $row->payment_method == 1 )
                                            {{ __('Card') }}
                                            @elseif( $row->payment_method == 2 )
                                            {{ __('Cash') }}
                                            @elseif( $row->payment_method == 3 )
                                            {{ __('Cheque') }}
                                            @elseif( $row->payment_method == 4 )
                                            {{ __('Bank') }}
                                            @elseif( $row->payment_method == 5 )
                                            {{ __('E-Wallet') }}
                                            @endif
                                        </td>
                                        <td>{!! $row->note !!}</td>
                                        <td>
                                            @if($row->status == 0)
                                            <button type="button" class="btn btn-icon btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#payModal-{{ $row->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <!-- Include Pay modal -->
                                            @include($view.'.pay')

                                            @elseif($row->status == 1)
                                           
                                            
                                            <a href="#" class="btn btn-icon btn-dark btn-sm" onclick="PopupWin('{{ route('fees-student-print', ['id' => $row->id]) }}', '{{ $title }}', 1000, 600);">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            
                                          
                                            
                                            
                                            <button type="button" class="btn btn-icon btn-danger btn-sm" title="{{ __('unpaid') }}" data-bs-toggle="modal" data-bs-target="#unpayModal-{{ $row->id }}">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                            <!-- Include Unpay modal -->
                                            
                                            
                                                <!-- UnPay modal -->
                                            <div class="modal fade" id="unpayModal-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="UnpayModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                  <form action="{{ route('fees-student-unpay', $row->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <h5 class="modal-title" id="UnpayModalLabel">{{ __('are you sure') }}</h5>
                                                            <p class="text-danger mt-2">{{ __('You want to undo this?') }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> {{ __('close') }}</button>
                                                            <button type="submit" class="btn btn-danger"><i class="fas fa-check"></i> {{ __('confirm') }}</button>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                  </form>
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            
                                            
                                          @endif
                                           
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /tab-content -->	
@endif
    </div>
</div>

<div class="modal fade" id="basicModal">
    <div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<div class="modal-header">
    			<h5 class="modal-title">Modal title</h5>
    			<button type="button" class="btn-close" data-bs-dismiss="modal">
    				<i class="fa-solid fa-xmark"></i>
    			</button>
    		</div>
    		<div class="modal-body">Modal body text goes here.</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
    			<button type="button" class="btn btn-primary light">Save changes</button>
    		</div>
    	</div>
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
<script type="text/javascript">
        "use strict";
        function PopupWin(pageURL, pageTitle, popupWinWidth, popupWinHeight) {
            var left = (screen.width - popupWinWidth) / 2;
            var top = (screen.height - popupWinHeight) / 4;

            var myWindow = window.open(pageURL, pageTitle, 'resizable=yes, width=' + popupWinWidth + ', height=' + popupWinHeight + ', top=' + top + ', left=' + left);
        };
    </script>


<style>
    select.select {
    appearance: revert;
}
</style>




@stop