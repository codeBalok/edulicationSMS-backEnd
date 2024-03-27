
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Grade</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('grade-list') }}" class="btn btn-primary light">Grade list</a>
                    </li>

                </ul>
                
            </div>
           
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Grade</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-grade') }}" >
                        @csrf
                      
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <label class="row-lg-6 col-form-label" for="grade">Grade<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control  @error('grade') is-invalid @enderror" id="grade" placeholder="Enter Grade"  value="{{ old('grade') }}" required name="grade">
                                    @error('grade')
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
                                        <label class="row-lg-3 col-form-label" for="point">Point <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                        <input type="text" class="form-control @error('point') is-invalid @enderror" id="point" placeholder="Enter Point"  value="{{ old('point') }}" required name="point">
                                        @error('point')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                            
<div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="min_marks">Min. Marks<span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                            <input type="text" class="form-control  @error('min_marks') is-invalid @enderror" id="min_marks" placeholder=" Enter min. marks" value="{{ old('min_marks') }}" required name="min_marks">
                                            @error('min_marks')
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
                                    <label class="row-lg-6 col-form-label" for="max_marks">Max. Marks <span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control @error('max_marks') is-invalid @enderror" id="max_marks" placeholder="Enter Max. Marks" value="{{ old('max_marks') }}" required name="max_marks">
                                    @error('max_marks')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                       
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#isEmployee').click(function() {
                if ($(this).is(':checked')) {
                    $('#employeeDropdown').show();
                } else {
                    $('#employeeDropdown').hide();
                }
            });
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