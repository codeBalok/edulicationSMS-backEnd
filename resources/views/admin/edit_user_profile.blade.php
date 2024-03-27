
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
                <h4 class="card-title"><?php echo (isset($title)) ? $title : ''; ?></h4>

            </div>

            <div class="card-body">
                <div class="form-validation">
                    <h5><?php echo (isset($title)) ? $title : ''; ?></h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-user-profile',$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02"  placeholder="Your valid First Name.." required name="first_name" value="{{$user->first_name}}">
                                        <div class="invalid-feedback">
                                            Please enter a First Name.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control" id="validationCustom02"  placeholder="Your valid Email" required name="email" value="{{$user->email}}">
                                        <div class="invalid-feedback">
                                            Please enter a Email.
                                        </div>
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
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Username" required name="username" value="{{$user->username}}">
                                        <div class="invalid-feedback">
                                            Please enter a Username.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom05">Role <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <label class=" col-form-label" for="validationCustom05">{{$user_role->name}} </label> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <div class="row">
                                        <label class="col-form-label col-sm-4 pt-0">Gender</label>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" value="1" checked >
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom05">Profile Image </label>
                                    <div class="col-lg-8">
                                        <input name="profile_image" id="profile_image" type="file" class="form-control" data-error="Valid Image is required."  >

                                        @if($user->profile_image_path)
                                        <a target="_blank" href="{{ getStoragePath() . $user->profile_image_path }}" class="btn-link text-primary">Profile Image</a>
                                        @endif
                                    </div>
                                </div>
                            </div>


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