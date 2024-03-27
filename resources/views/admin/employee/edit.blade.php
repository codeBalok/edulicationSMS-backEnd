
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update</span></h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Staff Details</h5>
                   
                    <article>
                        <form class="needs-validation" novalidate  method="POST" action="{{ route('update-employee', $employee->id ) }}" enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom01">Date of Joining <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" placeholder="2017-06-04" id="joining_date" name="joining_date" value="{{$employee->joining_date}}">

                                            <div class="invalid-feedback">
                                                Please enter a Date of Joining.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Name <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid First Name.." required name="first_name" value="{{$employee->first_name}}">
                                            <div class="invalid-feedback">
                                                Please enter a First Name.
                                            </div><br>
                                            
                                            
                                            <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid Last Name.." required name="last_name" value="{{$employee->last_name}}">
                                            <div class="invalid-feedback">
                                                Please enter a Last Name.
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset class="mb-3">
                                        <div class="row">
                                            <label class="col-form-label col-sm-3 pt-0">Gender</label>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="1" {{$employee->gender == '1' ? 'checked' : '' }}  >
                                                    <label class="form-check-label">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="2" {{$employee->gender == '2' ? 'checked' : '' }} >
                                                    <label class="form-check-label">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" value="3" {{$employee->gender == '3' ? 'checked' : '' }}>
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
                                            <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="bdate" name="birthdate" value="{{$employee->birthdate}}" >
                                            <div class="invalid-feedback">
                                                Date of Birth.
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="contact_number"> Contact number <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="contact_number" placeholder="212-999-0000" required name="contact_number" value="{{$employee->contact_number}}">
                                            <div class="invalid-feedback">
                                                Please enter a Contact number.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="email">Email <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="email" placeholder="xyz@gmail.com" required name="email" value="{{$employee->email}}" >
                                            <div class="invalid-feedback">
                                                Please enter a Email.
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="address">Address <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="address" placeholder="Address" required name="address" value="{{$employee->address}}">
                                            <div class="invalid-feedback">
                                                Address
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                    <label for="profile_photo">{{ __('field_photo') }}: <span>{{ __('image_size', ['height' => 300, 'width' => 300]) }}</span></label>
                                <input type="file" class="form-control" name="profile_photo" id="profile_photo" value="{{ old('profile_photo') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_photo') }}
                                </div>
                                
                                @if(is_file($employee->profile_photo))
                                    <img src="{{ asset($employee->profile_photo) }}" class="img-fluid" style="max-width: 80px; max-height: 80px;" onerror="this.src='{{ asset('dashboard/images/user/avatar-2.jpg') }}';">
                                @endif
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="validationCustom02">Employee Code<span class="text-danger"></span></label>
                                        <div class="col-lg-6">
                                        <input type="text" class="form-control" id="validationCustom02"  readonly name="employee_code" value="{{$employee->employee_code}}">
                                            <div class="invalid-feedback">
                                                Employee code
                                            </div>
                                        </div>
                                    </div>
</div>
                            <div class="col-xl-6">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Department <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="validationCustom05" name="department_id">
                                                    <!--                                            <option >Please select</option>-->
                                                    @if(!empty($department))
                                                    @foreach ($department as $row)
                                                    <option value="{{$row->id}}" {{ $row->id == $employee->department_id ? 'selected' : '' }}  >{{$row->department_name}}</option>
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
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="salary" required name="salary" value="{{$employee->salary}}" >
                                            <div class="invalid-feedback">
                                                Enter a Salary.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Role <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="validationCustom05" name="role_id">
                                                    <!--                                            <option >Please select</option>-->
                                                    @if(!empty($role))
                                                    @foreach ($role as $row)
                                                    <option value="{{$row->id}}" {{ $row->id == $employee->role_id ? 'selected' : '' }}  >{{$row->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="col-xl-6">
                                <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Department <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="validationCustom05" name="designation_id">
                                                    <!--                                            <option >Please select</option>-->
                                                    @if(!empty($designation))
                                                    @foreach ($designation as $row)
                                                    <option value="{{$row->id}}" {{ $row->id == $employee->designation_id ? 'selected' : '' }}  >{{$row->designation_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                <div class="mb-3 row">
                                    <label class="col-lg-4 col-form-label" for="validationCustom05">Employee Status <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select class="default-select wide form-control" id="validationCustom05" name="employee_status">
                                        <option value="Contract" @if ($employee->employee_status == 'Contract') selected @endif>Contract</option>
                                        <option value="Permanent" @if ($employee->employee_status == 'Permanent') selected @endif>Permanent</option>
                                        <option value="Temporary" @if ($employee->employee_status == 'Temporary') selected @endif>Temporary</option>
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
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Work Shift <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" id="validationCustom05" name="work_shift">
                                                    <!--                                            <option >Please select</option>-->
                                                    <option value="1" @if ($employee->work_shift == '1') selected @endif>Full-Time</option>
                                                    <option value="2" @if ($employee->work_shift == '2') selected @endif>Part-Time</option>
                                        
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
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