 
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Quick Received</h4>

            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Quick Received</h5>

                    <form class="needs-validation" novalidate  method="POST" action="{{ route('fees-student-quick-received-store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xl-6">
                      
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Student ID <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control select2" name="student" id="student" required>
                                                <option value="">{{ __('select') }}</option>
                                                @foreach( $students as $student )
                                                <option value="{{ $student->id }}" @if(old('student') == $student->id) selected @endif>{{ $student->student->student_id ?? '' }} - {{ $student->student->first_name ?? '' }} {{ $student->student->last_name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter a student id.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Due Date<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control date" name="due_date" id="due_date" value="{{ date('Y-m-d') }}" required>
                                            <div class="invalid-feedback">
                                                Please enter due date.
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Fee ($)<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control autonumber" name="fee_amount" id="fee_amount" value="{{ old('fee_amount') ?? 0 }}" onkeyup="feesCalculator()" required>
                                            <div class="invalid-feedback">
                                                Please enter a fee.
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Net Amount ($)<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control autonumber" name="paid_amount" id="paid_amount" value="{{ old('paid_amount') ?? 0 }}" onkeyup="feesCalculator()" readonly required>
                                            <div class="invalid-feedback">
                                                Please enter a net amount.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Note<span class="text-danger"></span>
                                        </label>
                                        <div class="col-lg-6">
                                             <textarea class="form-control" name="note" id="note">{!! old('note') !!}</textarea>

                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-xl-6">

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Fees Type: <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="category" id="category" required>
                                                <option value="">{{ __('select') }}</option>
                                                @foreach( $categories as $category )
                                                <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->title }}</option>
                                                @endforeach
                                            </select>

                                            <div class="invalid-feedback">
                                                Please enter a fees type.
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Pay Date<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                             <input type="date" class="form-control date" name="pay_date" id="pay_date" value="{{ date('Y-m-d') }}" required>
                                            <div class="invalid-feedback">
                                                Please enter a pay date.
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Discount ($)<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                             <input type="text" class="form-control autonumber" name="discount_amount" id="discount_amount" value="{{ old('discount_amount') ?? 0 }}" onkeyup="feesCalculator()" required>
                                            <div class="invalid-feedback">
                                                Please enter a Discount.
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Fine ($)<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                             <input type="text" class="form-control autonumber" name="fine_amount" id="fine_amount" value="{{ old('fine_amount') ?? 0 }}" onkeyup="feesCalculator()" required>
                                            <div class="invalid-feedback">
                                                Please enter a fine.
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Method<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="form-control" name="payment_method" id="payment_method" required>
                                                <option value="">{{ __('select') }}</option>
                                                <option value="1" @if( old('payment_method') == 1 ) selected @endif>Card</option>
                                                <option value="2" @if( old('payment_method') == 2 ) selected @endif>Cash</option>
                                                <option value="3" @if( old('payment_method') == 3 ) selected @endif>Cheque</option>
                                                <option value="4" @if( old('payment_method') == 4 ) selected @endif>Bank</option>
                                                <option value="5" @if( old('payment_method') == 5 ) selected @endif>E-Wallet</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter a method.
                                            </div>

                                        </div>
                                    </div>

                                    
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


<style>
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #a0cf1a;
        color: white;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container .select2-selection--single {
        height: 38px;
        border-radius: 8px !important;
    }
</style>

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



<!--select2 js-->

<script src="{{ asset('admin/vendor/select2/js/select2.full.min.js')}}"></script>
 <script type="text/javascript">
        
        $(document).ready(function() {
            // [ Single Select ] start
            $(".select2").select2();

            // [ Multi Select ] start
            $(".select2-multiple").select2({
                placeholder: "select multiple"
            });
        });

</script>


    <script type="text/javascript">
        "use strict";
        function feesCalculator() {
          var fee_amount = $("input[name='fee_amount']").val();
          var fine_amount = $("input[name='fine_amount']").val();
          var discount_amount = $("input[name='discount_amount']").val();
          var paid_amount = $("input[name='paid_amount']").val();
          
          //
          if (isNaN(parseFloat(fee_amount))) fee_amount = 0;
          if (isNaN(parseFloat(fine_amount))) fine_amount = 0;
          if (isNaN(parseFloat(discount_amount))) discount_amount = 0;
          $("input[name='fee_amount']").val(fee_amount);
          $("input[name='fine_amount']").val(fine_amount);
          $("input[name='discount_amount']").val(discount_amount);

          // Set Value
          var net_total = (parseFloat(fee_amount) - parseFloat(discount_amount)) + parseFloat(fine_amount);
          $("input[name='paid_amount']").val(net_total);
        }
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