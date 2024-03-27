
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Course List</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('enrollsubject-list') }}" class="btn btn-primary light">Update Enroll Course</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Course List</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-enrollsubject',$row->id) }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
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
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <label class="row-lg-3 col-form-label" for="subject">Select Multiple
                                    </label>
                                    <div class="row-lg-9">
                                    <select class="form-control subject select2" name="subjects[]" id="subject" multiple required>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" @foreach($row->subjects as $selected_subject) {{ $selected_subject->id == $subject->id ? 'selected' : '' }} @endforeach>{{ $subject->code }} - {{ $subject->title }}</option>
                                @endforeach    
                                </select>
                                        <div class="invalid-feedback">
                                            Select Subjects
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            
                        </div>
                       
                        <div class="row">
                          

                            <div class="col-xl-12">
                                <div class="mb-3 row">
                               
                                    <div class="col-xl-12 ms-auto">
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

@stop