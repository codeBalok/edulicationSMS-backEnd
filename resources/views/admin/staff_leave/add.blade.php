
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Apply Leave</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('staffleave-list') }}" class="btn btn-primary light">Staff Leave List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Staff Leave</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-staffleave') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="row-lg-3 col-form-label" for="apply_date">Apply Date <span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                        <input type="date" class="form-control"  name="apply_date" id="apply_date" value="{{ date('Y-m-d') }}" readonly required>
                                        <div class="invalid-feedback">
                                            Please Select Apply Date.
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="row-lg-3 col-form-label" for="type">Leave Type <span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="">Select</option>
                                        @foreach( $types as $type )
                                        <option value="{{ $type->id }}" @if(old('type') == $type->id) selected @endif>{{ $type->title }}</option>
                                        @endforeach
                                    </select>
                                        <div class="invalid-feedback">
                                            Please Select Apply Date.
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                           
                            <div class="row">
    <div class="col-xl-12">
        <div class="mb-3 row">
            <div class="col-lg-4">
                <label class="row-lg-3 col-form-label" for="from_date">Start Date <span class="text-danger">*</span></label>
                <div class="row-lg-8">
                    <input type="date" class="form-control date" name="from_date" id="from_date" value="{{ old('from_date') }}" required>
                    <div class="invalid-feedback">
                        Please Select Start Date.
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <label class="row-lg-3 col-form-label" for="pay_type">Pay Type<span class="text-danger">*</span></label>
                <div class="row-lg-8">
                    <select class="form-control" name="pay_type" id="pay_type" required>
                        <option value="">Select</option>
                        <option value="1" @if(old('pay_type') == 1) selected @endif>Paid Leave</option>
                        <option value="2" @if(old('pay_type') == 2) selected @endif>Unpaid Leave</option>
                    </select>
                    <div class="invalid-feedback">
                        Please Select Pay Type.
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <label class="row-lg-3 col-form-label" for="to_date">End Date <span class="text-danger">*</span></label>
                <div class="row-lg-8">
                    <input type="date" class="form-control date" name="to_date" id="to_date" value="{{ old('to_date') }}" required>
                    <div class="invalid-feedback">
                        Please Select End Date.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="row-lg-3 col-form-label" for="reason">Reason <span class="text-danger">*</span></label>
                                            <div class="row-lg-8">
                                            <textarea class="form-control" name="reason" id="reason">{{ old('reason') }}</textarea>

                                                
                                                <div class="invalid-feedback">
                                                    Please Enter Reason.
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="row-lg-3 col-form-label" for="attach">Attach <span class="text-danger">*</span></label>
                                            <div class="row-lg-8">
                                            <input type="file" class="form-control" name="attach" id="attach" value="{{ old('attach') }}">

                                                
                                                <div class="invalid-feedback">
                                                    Please Enter Reason.
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