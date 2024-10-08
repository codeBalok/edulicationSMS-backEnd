<!-- Extends template page-->
@extends('admin.layout.header')
<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit School</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('school-list') }}" class="btn btn-primary light">School List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit School</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-school',$school->id ) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Name." required name="name" value="{{$school->name}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Name.
                                        </div>
                                        @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Address <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Address." required name="address" value="{{$school->address}}">
                                        <div class="invalid-feedback">
                                            Please enter a Address.
                                        </div>
                                        @if($errors->has('address'))
                                        <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Your valid Email" required name="email" value="{{$school->email}}">
                                        <div class="invalid-feedback">
                                            Please enter a Email.
                                        </div>
                                        @if($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Phone No<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Phone No" required name="phone_no" value="{{$school->phone_no}}">
                                        <div class="invalid-feedback">
                                            Please enter a Phone No.
                                        </div>
                                        @if($errors->has('phone_no'))
                                        <div class="error">{{ $errors->first('phone_no') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom05">Logo </label>
                                    <div class="col-lg-8">
                                        <input name="logo" id="logo" type="file" class="form-control" data-error="Valid Image is required." />
                                        @if($school->logo_path)
                                        <a target="_blank" href="{{ asset($school->logo_path) }}" class="btn-link text-primary">Logo</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Note</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Note" name="note" value="{{$school->note}}" />
                                        <div class="invalid-feedback">
                                            Please enter a Note.
                                        </div>
                                        @if($errors->has('note'))
                                        <div class="error">{{ $errors->first('note') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        @if(sizeof($school_contact_person) >=1)
                        @foreach ($school_contact_person as $key_scp=> $row)
                        <?php $key_scp_val = ++$key_scp; ?>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <h2 class=" col-form-label">Contact Person {{$key_scp_val}}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="First Name." name="first_name_{{$key_scp_val}}" value="{{$row->first_name}}" />
                                        <div class="invalid-feedback">Please enter a First Name.</div>
                                        @if($errors->has("first_name_$key_scp_val"))
                                        <div class="error">{{ $errors->first("first_name_$key_scp_val") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name." name="last_name_{{$key_scp_val}}" value="{{$row->last_name}}" />
                                        <div class="invalid-feedback">Please enter a Last Name.</div>
                                        @if($errors->has("last_name_$key_scp_val"))
                                        <div class="error">{{ $errors->first("last_name_$key_scp_val") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row"></div>
                            </div>
                        </div>
                        {{-- @dd($row) --}}
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Select Role</label>
                                    <div class="col-lg-8">
                                        <select class="form-select" aria-label="Default select example" name="position">
                                            <option selected>Open this select Role</option>
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
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email" name="email_{{$key_scp_val}}" value="{{$row->email}}" />
                                        <div class="invalid-feedback">Please enter a Email.</div>
                                        @if($errors->has("email_$key_scp_val"))
                                        <div class="error">{{ $errors->first("email_$key_scp_val") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Phone no</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Phone no." name="phone_no_{{$key_scp_val}}" value="{{$row->phone_no}}" />
                                        <div class="invalid-feedback">Please enter a Phone no.</div>
                                        @if($errors->has("phone_no_$key_scp_val"))
                                        <div class="error">{{ $errors->first("phone_no_$key_scp_val") }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        @endforeach
                        @else
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <h2 class=" col-form-label">Contact Person 1</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="First Name." name="first_name_1" />
                                        <div class="invalid-feedback">Please enter a First Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name." name="last_name_1">
                                        <div class="invalid-feedback">Please enter a Last Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Position</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Position" name="position_1">
                                        <div class="invalid-feedback">Please enter a Position.</div>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02" placeholder="Email" name="email_1" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                        <div class="invalid-feedback">Please enter a Email.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Phone no</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Phone no." name="phone_no_1">
                                        <div class="invalid-feedback">Please enter a Phone no.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <h2 class=" col-form-label">Contact Person 2</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="First Name." name="first_name_2">
                                        <div class="invalid-feedback">Please enter a First Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name." name="last_name_2">
                                        <div class="invalid-feedback">Please enter a Last Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Position</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Position" name="position_2">
                                        <div class="invalid-feedback">Please enter a Position.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02" placeholder="Email" name="email_2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                        <div class="invalid-feedback">Please enter a Email.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Phone no</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Phone no." name="phone_no_2">
                                        <div class="invalid-feedback">Please enter a Phone no.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <h2 class=" col-form-label">Contact Person 3</h2>
                                </div>
                            </div>
                        </div> jifif
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="First Name." name="first_name_3">
                                        <div class="invalid-feedback">Please enter a First Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name." name="last_name_3">
                                        <div class="invalid-feedback">Please enter a Last Name.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Position</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Position" name="position_3">
                                        <div class="invalid-feedback">Please enter a Position.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email</label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email_3">
                                        <div class="invalid-feedback">Please enter a Email.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Phone no</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Phone no." name="phone_no_3">
                                        <div class="invalid-feedback">Please enter a Phone no.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
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