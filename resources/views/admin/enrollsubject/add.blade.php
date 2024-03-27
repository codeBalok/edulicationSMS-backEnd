
<!-- Extends template page-->
@extends('admin.layout.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Enroll Subject</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('enrollsubject-list') }}" class="btn btn-primary light">Enroll Subject list</a>
                    </li>

                </ul>
                
            </div>
           
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Enroll Subject</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-enrollsubject') }}" >
                        @csrf
                      
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <label class="row-lg-6 col-form-label" for="faculty">faculty<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <select class="form-control faculty" name="faculty" id="faculty" required>
                                        <option value="">Select</option>
                                        @if(isset($faculties))
                                        @foreach( $faculties->sortBy('title') as $faculty )
                                        <option value="{{ $faculty->id }}" @isset($row) {{ $row->program->faculty_id == $faculty->id ? 'selected' : '' }} @endisset>{{ $faculty->title }}</option>
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
                            </div>
                        
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <label class="row-lg-6 col-form-label" for="program">Program<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <select class="form-control program" name="program" id="program" required>
                                        <option value="">Select</option>
                                        @if(isset($programs))
                                        @foreach( $programs->sortBy('title') as $program )
                                        <option value="{{ $program->id }}" @isset($row) {{ $row->program_id == $program->id ? 'selected' : '' }} @endisset>{{ $program->title }}</option>
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
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                <label class="row-lg-6 col-form-label" for="semester">Semester <span class="text-danger">*</span></label>

                                <div class="row-lg-8">
                                <select class="form-control semester" name="semester" id="semester" required>
                                    <option value="">Select</option>
                                    @if(isset($semesters))
                                    @foreach( $semesters->sortBy('id') as $semester )
                                    <option value="{{ $semester->id }}" @isset($row) {{ $row->semester_id == $semester->id ? 'selected' : '' }} @endisset>{{ $semester->title }}</option>
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
             
                            
                            <div class="col-xl-8">
                                <div class="mb-3 row">
                                    <div class="col-lg-8">
                                   
                                        <label  class="row-lg-6 col-form-label" for="section">Section <span class="text-danger">*</span></label>

                                          <div class="row-lg-8">
                                            <select class="form-control section" name="section" id="section" required>
                                                <option value="">Select</option>
                                                @if(isset($sections))
                                                @foreach( $sections->sortBy('title') as $section )
                                                <option value="{{ $section->id }}" @isset($row) {{ $row->section_id == $section->id ? 'selected' : '' }} @endisset>{{ $section->title }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('section')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                        </div>
                          </div>
                        </div>
</div>
             
                            `
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                              <div class="col-lg-8">
                                                <label  class="row-lg-6 col-form-label" for="subject">Subject <span class="text-danger">*</span></label>

                                                    <div class="row-lg-8">
                                                      <select class="form-control subject select2" name="subjects[]" id="subject" multiple required>
                                                      </select>
                                                      @error('subject')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                    </div>
                                              </div> </div> 
               
                            

                       
                        <div class="row">

                            <div class="col-xl-4">
                                

                            </div>
                            


                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <div class="col-lg-2 ms-auto">
                                        <button type="submit" class="btn btn-primary light">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@section('customjs')
<script src="https://code.jquery.com/jquery.min.js"></script>

<script type="text/javascript">
    "use strict";
    $(".faculty").on('change',function(e){
      e.preventDefault();
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
            $('.program').append('<option value="">{{ __("select") }}</option>');
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
      e.preventDefault();
      var semester=$(".semester");
      var subject=$(".subject");
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

      $.ajax({
        type:'POST',
        url: "{{ route('filter-subject') }}",
        data:{
          _token:$('input[name=_token]').val(),
          program:$(this).val()
        },
        success:function(response){
            // var jsonData=JSON.parse(response);
            $('option', subject).remove();
            $.each(response, function(){
              $('<option/>', {
                'value': this.id,
                'text': this.code +' - '+ this.title
              }).appendTo('.subject');
            });
          }

      });
    });

    $(".semester").on('change',function(e){
      e.preventDefault();
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            // [ Single Select ] start
            $(". select2").select2();

            // [ Multi Select ] start
            $(".select2-multiple").select2({
                placeholder: "{{ __('select') }}"
            });
        });
        "use strict";
        // checkbox all-check-button selector
        $(".all_check").on('click',function(e){
            if($(this).is(":checked")){
                // check all checkbox
                $(".program").prop('checked', true);
            }
            else if($(this).is(":not(:checked)")){
                // uncheck all checkbox
                $(".program").prop('checked', false);
            }
        });
    </script>

<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated');
                    }, false);
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
<!-- Daterangepicker -->
<!-- momment js is must -->
<!--<script src="./vendor/moment/moment.min.js"></script>-->
<script src="{{ asset('admin/vendor/moment/moment.min.js')}}"></script>
<!--<script src="./vendor/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<script src="{{ asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- clockpicker -->
<script src="./vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<script src="./vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="./vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="./vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="./vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- pickdate -->
<!--<script src="./vendor/pickadate/picker.js"></script>-->
<script src="{{ asset('admin/vendor/pickadate/picker.js')}}"></script>
<script src="./vendor/pickadate/picker.time.js"></script>
<!--<script src="./vendor/pickadate/picker.date.js"></script>-->
<script src="{{ asset('admin/vendor/pickadate/picker.date.js')}}"></script>


<!-- Daterangepicker -->
<!--<script src="./js/plugins-init/bs-daterange-picker-init.js"></script>-->
<script src="{{ asset('admin/js/plugins-init/bs-daterange-picker-init.js')}}"></script>

<!-- Clockpicker init -->
<script src="./js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="./js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<!--<script src="./js/plugins-init/material-date-picker-init.js"></script>-->
<script src="{{ asset('admin/js/plugins-init/material-date-picker-init.js')}}"></script>

<!-- Pickdate -->
<script src="./js/plugins-init/pickadate-init.js"></script>

<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

        <!--<script src="./js/custom.js"></script>-->
<script src="{{ asset('admin/js/custom.js')}}"></script>
<!--<script src="./js/deznav-init.js"></script>-->
<script src="{{ asset('admin/js/deznav-init.js')}}"></script>
@endsection
@stop