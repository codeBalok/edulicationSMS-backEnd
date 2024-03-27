
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Subject</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('subject-list') }}" class="btn btn-primary light">Subject list</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Subject</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-subject') }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Title <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Title." required name="title">
                                        <div class="invalid-feedback">
                                            Please enter a Title.
                                        </div>
                                        @if($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="code">Code <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="code" placeholder="Your valid Code." required name="code">
                                        <div class="invalid-feedback">
                                            Please enter a Code.
                                        </div>
                                        @if($errors->has('code'))
                                        <div class="error">{{ $errors->first('code') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="credit_hour">Credit Hours <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="credit_hour" placeholder="Your valid Credit Hours." required name="credit_hour">
                                        <div class="invalid-feedback">
                                            Please enter a credit hour.
                                        </div>
                                        @if($errors->has('credit_hour'))
                                        <div class="error">{{ $errors->first('credit_hour') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="subject_type">Subject Type <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                    <select class="form-control" name="subject_type" id="subject_type" required>
                                        <option value="">Select</option>
                                        <option value="1" @if( old('subject_type') == 1 ) selected @endif>Compulsory</option>
                                        <option value="0" @if( old('subject_type') == 0 && old('subject_type') != null ) selected @endif>Optional</option>
                                    </select>
                                    </div>
                                    <div class="invalid-feedback">
                                    Select Subject type
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="class_type">Class Type <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                    <select class="form-control" name="class_type" id="class_type" required>
                                        <option value="">{{ __('select') }}</option>
                                        <option value="1" @if( old('class_type') == 1 ) selected @endif>Theory</option>
                                        <option value="2" @if( old('class_type') == 2 ) selected @endif>Practical</option>
                                        <option value="3" @if( old('class_type') == 3 ) selected @endif>Both</option>
                                    </select>
                                    </div>
                                    <div class="invalid-feedback">
                                    Select Class type
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12"></div>

                        @foreach($faculties as $index => $faculty)
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <span class="badge badge-primary">{{ $faculty->title }}</span><br/>

                                    @foreach($faculty->programs->where('status', 1)->sortBy('title') as $key => $program)
                                    <br/>
                                    <div class="checkbox d-inline">
                                        <input type="checkbox" name="programs[]" id="program-{{ $key }}-{{ $index }}" value="{{ $program->id }}" @if( old('programs[]') == $program->id ) checked @endif>
                                        <label for="program-{{ $key }}-{{ $index }}" class="cr">{{ $program->title }}</label>
                                    </div>
                                    @endforeach

                                    <div class="invalid-feedback">
                                    {{ __('required_field') }} {{ __('field_program') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">

                            <div class="col-xl-4"></div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-8 ms-auto">
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