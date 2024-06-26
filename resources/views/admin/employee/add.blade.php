
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">New Staff</span></h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add New Registration</h5>
                    
                    <article>
                        <form class="needs-validation" novalidate  method="POST" action="{{ route('store-employee') }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Date of Joining <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" placeholder="YYYY-MM-DD" id="validationCustom01" name="joining_date" value="{{ old('joining_date') }}" required>
                                           
                                            <div class="invalid-feedback">
                                            Please enter a valid Date of Joining in the format YYYY-MM-DD.
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
                                            
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid Last Name.." required name="last_name">
                                            <div class="invalid-feedback">
                                                Please enter a Last Name.
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset class="mb-3 ">
                                        <div class="row">
                                            <label class="col-form-label col-sm-3 pt-0">Gender</label>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="1" checked>
                                                    <label class="form-check-label">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="2">
                                                    <label class="form-check-label">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="3">
                                                    <label class="form-check-label">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="birthdate">Date of Birth <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" placeholder="2017-06-04" id="birthdate" name="birthdate" required>
                                            <div class="invalid-feedback">
                                                Date of Birth.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom05">Role<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="default-select wide form-control" id="validationCustom05" name="role_id">
                                            @if(!empty($data['role']))
                                                @foreach ($data['role'] as $row)
                                                <option value="{{$row->id}}">{{$row->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom05"> Department <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <select class="default-select wide form-control" id="validationCustom05" name="department_id">
                                                @if(!empty($data['department']))
                                                @foreach ($data['department'] as $row)
                                                <option value="{{$row->id}}">{{$row->department_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a one.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Salary<span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="salary" required name="salary" >
                                            <div class="invalid-feedback">
                                                Enter a Salary.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="contact_number"> Contact number <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="contact_number" placeholder="212-999-0000" required name="contact_number">
                                            <div class="invalid-feedback">
                                                Please enter a Contact number.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="email">Email Id <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="email" placeholder="xyz@gmail.com" required name="email">
                                            <div class="invalid-feedback">
                                                Please enter a Email.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Address <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="validationCustom02" placeholder="Address" name="address" required>
                                            <div class="invalid-feedback">
                                                Address
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Profile Photo<span class="text-danger">*</span></label>
                                        <div class="col-lg-6">
                                        <input type="file" class="form-control" id="validationCustom02"  required name="image">
                                            <div class="invalid-feedback">
                                                Profile Photo
                                            </div>
                                        </div>
                                    </div>
                                    
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="validationCustom05">Employee Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="default-select wide form-control" id="validationCustom05" name="employee_status">
                                            <option value="Contract">Contract</option>
                                            <option value="Permanent">Permanent</option>
                                            <option value="Temporary">Temporary</option>
                                           
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="validationCustom05">Work Shift <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="default-select wide form-control" id="validationCustom05" name="work_shift">
                                            <!--<option value="1">Full-Time</option>-->
                                            <!--<option value="2">Part-Time</option>-->
                                                @if(!empty($data['work_shift_type']))
                                                @foreach ($data['work_shift_type'] as $row)
                                                <option value="{{$row->id}}">{{$row->title}}</option>
                                                @endforeach
                                                @endif
                                            <!-- @if(!empty($role))
                                            @foreach ($role as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                            @endif -->
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                

                                </div>
                                <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom05"> Designation <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="validationCustom05" name="designation_id">
                                                    @if(!empty($data['designation']))
                                                    @foreach ($data['designation'] as $row)
                                                    <option value="{{$row->id}}">{{$row->designation_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                               
                                        
                                        <div class="col-xl-12">
                                            <div class="mb-3 row">
                                                    <div class="col-lg-12 ms-auto">
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