
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Super Admin</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('super-admin-list') }}" class="btn btn-primary light">Super Admin List</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Super Admin</h5>
                    <form action="{{ route('store-super-admin' ) }}" class="needs-validation"  method="POST"  novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Select Role<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <select class="form-select" id="validationServer04" name="role" aria-describedby="validationServer04Feedback" required>
                                            <option selected  value="">Choose...</option>
                                            @foreach ($role as $ro)
                                            <option value="{{$ro->id}}">{{ $ro->name }}</option>
                                        @endforeach
                                          </select>
                                        <div class="invalid-feedback">
                                            Please Select a Role.
                                        </div>
                                        @if($errors->has('role'))
                                            <div class="error">{{ $errors->first('role') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Last Name." required name="first_name" value="{{ old('first_name') }}">
                                        <div class="invalid-feedback">
                                            Please enter a First Name.
                                        </div>
                                        @if($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Last Name." required name="last_name" value="{{ old('last_name') }}"> 
                                        <div class="invalid-feedback">
                                            Please enter a Last Name.
                                        </div>
                                        @if($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" max="25" placeholder="Your valid Email" required name="email" value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            Please enter a Email.
                                        </div>
                                        @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Username
                                        <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid Username" name="username" value="{{ old('username') }}" required>
                                        <div class="invalid-feedback">
                                            Please enter a Username.
                                        </div>
                                        @if($errors->has('username'))
                                        <div class="error">{{ $errors->first('username') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <div class="row">
                                        <label class="col-form-label col-sm-4 pt-0">Gender</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="1" checked >
                                                <label class="form-check-label">
                                                    Male
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="2">
                                                <label class="form-check-label">
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4"></div>

                            <!--                            <div class="col-xl-4">
                                                            <div class="mb-3 row">
                                                                <label class="col-lg-3 col-form-label" for="validationCustom02">password <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <input type="password" class="form-control" id="validationCustom02"  placeholder="password" required>
                                                                    <div class="invalid-feedback">
                                                                        password
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <!-- <div class="col-xl-4">
                                                            <div class="mb-3 row">
                                                                <label class="col-lg-3 col-form-label" for="validationCustom02">Confirm Password <span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <input type="password" class="form-control" id="validationCustom02"  placeholder="Confirm Password" required>
                                                                    <div class="invalid-feedback">
                                                                        Confirm Password
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>-->
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