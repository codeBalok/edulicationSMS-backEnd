
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Leave Request</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('leaverequest-list') }}" class="btn btn-primary light">Leave Request list</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Leave Request</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-leaverequest') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                        <!-- <input type="checkbox" id="isEmployee" name="isEmployee"> Apply Leave for Other Employee
                            <br><br> -->
                            <div class="col-xl-4">
                                <!-- <div class="mb-3 row" id="employeeDropdown" style="display:none"> -->
                                    <div class ="mb-3 row">
                                    <label class="row-lg-4 col-form-label" for="employee_id">Employee Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="row-lg-8" >
                                        <select class="default-select wide form-control" id="employee_id" name="employee_id">
                                        <option value="">Select Employee</option>
                                            @if(!empty($employee))
                                            @foreach ($employee as $row)
                                            <option value="{{$row->id}}">{{$row->first_name}}&nbsp;{{$row->last_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="row-lg-4 col-form-label" for="leave_type_id">Leave Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="row-lg-8" >
                                        <select class="default-select wide form-control" id="leave_type_id" name="leave_type_id">
                                        
                                            @if(!empty($leavetype))
                                            @foreach ($leavetype as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="validationCustom03">Start Date <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                            <input type="date" class="form-control" id="validationCustom03" placeholder="startdate" required name="start_date">
                                            <div class="invalid-feedback">
                                                Please enter an Start Date
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="validationCustom03">End Date <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                            <input type="date" class="form-control" id="validationCustom03" placeholder="enddate" required name="end_date">
                                            <div class="invalid-feedback">
                                                Please enter an End Date
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                      <label class="row-lg-3 col-form-label" for="validationCustom03">Status <span class="text-danger">*</span></label>
                                            <div class="row-lg-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="status" value="1" id="statusCheckbox" {{ old('status') == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="statusCheckbox">
                                                        Active
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                        
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <label class="row-lg-12 col-form-label" for="validationCustom02">Reason </label>
                                    <div class="row-lg-12">
                                        <textarea class="form-txtarea form-control" rows="3" id="reason" name="reason" required ></textarea>
                                        <div class="invalid-feedback">
                                            Please enter a Reason.
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="col-lg-3 col-form-label" for="leave_document" class="control-label col-sm-3">Upload File <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                            <input type="file" class= "form-control" name="leave_document" accept=".pdf,.doc,.docx">
                                            </div>
                                        </div>
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
    <!-- <script>
        $(document).ready(function() {
            $('#isEmployee').click(function() {
                if ($(this).is(':checked')) {
                    $('#employeeDropdown').show();
                } else {
                    $('#employeeDropdown').hide();
                }
            });
        });
    </script> -->

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