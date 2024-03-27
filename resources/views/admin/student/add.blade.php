
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Registration (2023-2024) Form Validation  <span>Total 4 result found - showing records from 1 to 4</span></h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add New Registration</h5>
                    <input type="radio" id="tab1" name="tab" checked>
                    <label for="tab1"> New Student</label>
                    <input type="radio" id="tab2" name="tab">
                    <label for="tab2"> Existing Student</label>
                    <article>
                        <form class="needs-validation" novalidate  method="POST" action="{{ route('store-student') }}" >
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Date of Registration <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" placeholder="Select Date" id="entry_date" name="entry_date">

                                            <div class="invalid-feedback">
                                                Please enter a Date of Registration.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid First Name.." required name="first_name">
                                            <div class="invalid-feedback">
                                                Please enter a First Name.
                                            </div><br>
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid Middle Name.." required name="middle_name">
                                            <div class="invalid-feedback">
                                                Please enter a Middle Name.
                                            </div>
                                            <br>
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid Last Name.." required name="last_name">
                                            <div class="invalid-feedback">
                                                Please enter a Last Name.
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="contact"> Contact <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                        <select class ="form-control" name="contact" id="contact">
                                            <option value="email">Email</option>
                                            <option value="home">Home</option>
                                            <option value="office">Office</option>
                                            <option value="mobile">Mobile</option>
                                        </select>
                                            <div class="invalid-feedback">
                                                Please Select Contact
                                            </div>
                                              @if($errors->has('contact'))
                                        <div class="error">{{ $errors->first('contact') }}</div>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="contact_info">Contact Info <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                        <div id="contact_input">
                                            <!-- Email Input -->
                                            <input class="form-control"  type="email" name="email_id" id="email_input" placeholder="Email" >

                                            <!-- Home Input -->
                                            <input class="form-control"  type="text" name="home_phone" id="home_input" placeholder="Home" style="display:none;">

                                            <!-- Office Input -->
                                            <input class="form-control"  type="text" name="business_phone" id="office_input" placeholder="Office" style="display:none;">

                                            <!-- Mobile Input -->
                                            <input class="form-control"  type="text" name="mobile_no" id="mobile_input" placeholder="Mobile" style="display:none;">
                                        </div>
                                            <div class="invalid-feedback">
                                                Please enter a Contact Info.
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
                    </article>

                    <article>
                    </article>

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
</style>
<script>
    // Function to toggle the visibility of input fields based on the selected option
    document.getElementById("contact").addEventListener("change", function() {
        var selectedOption = this.value;
        document.getElementById("email_input").style.display = "none";
        document.getElementById("home_input").style.display = "none";
        document.getElementById("office_input").style.display = "none";
        document.getElementById("mobile_input").style.display = "none";

        // Display the corresponding input field
        if (selectedOption === "email") {
            document.getElementById("email_input").style.display = "block";
        } else if (selectedOption === "home") {
            document.getElementById("home_input").style.display = "block";
        } else if (selectedOption === "office") {
            document.getElementById("office_input").style.display = "block";
        } else if (selectedOption === "mobile") {
            document.getElementById("mobile_input").style.display = "block";
        }
    });
</script>

@section('customjs')
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


@endsection

@stop