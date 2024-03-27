
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Teacher</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="user-create.html" class="btn btn-primary light">Teacher List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Teacher</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-teacher',$teacher->id ) }}" >
                        @csrf

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">First Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid First Name." required name="first_name" value="{{$teacher->first_name}}">
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
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Last Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Last Name." required name="last_name" value="{{$teacher->last_name}}">
                                        <div class="invalid-feedback">
                                            Please enter a Last Name.
                                        </div>
                                        @if($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Subject </label>
                                    <div class="col-lg-8">
                                        @if(!empty($subject))
                                        @foreach ($subject as $k=> $row)
                                        <div class="form-check custom-checkbox mb-3 checkbox-info">
                                            <?php
                                            $checked = '';
                                            if (in_array($row->id, $teacher_subject_arr)) {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <input type="checkbox" class="form-check-input" id="customCheckBox{{$k}}" name="subject_id[]" value="{{$row->id}}" {{$checked}} />
                                            <label class="form-check-label" for="customCheckBox{{$k}}">{{$row->title}}</label>
                                        </div>
                                        @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-xl-4"></div>

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