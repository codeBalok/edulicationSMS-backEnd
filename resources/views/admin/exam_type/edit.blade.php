
<!-- Extends template page-->
@extends('admin.layout.header')
<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Exam Type</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('examtype-list') }}" class="btn btn-primary light">Exam Type List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Exam type</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-examtype',$examtype->id) }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Title <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="title" required name="title" value="{{$examtype->title}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Marks <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Marks" required name="marks" value="{{$examtype->marks}}">
                                        <div class="invalid-feedback">
                                            Please enter an Marks.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <div class="row">
                        <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Contribution </label>
                                    <div class="col-lg-9">
                                    <input type="text" class="form-control" id="contribution" name="contribution" required value="{{$examtype->contribution}}">
                                        <div class="invalid-feedback">
                                            Please enter a Contribution.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Status</label>
                                    <div class="col-lg-9">
                                    <!-- <input type="checkbox" name="status" id="status" value="1" {{ $examtype->status == 1 ? 'checked' : ($examtype->status == 2 ? 'unchecked' : '') }}/> -->
                                    <input class="form-check-input" type="checkbox" name="status" value="1" id="statusCheckbox" {{ $examtype->status == 1 ? 'checked' : '' }}>
                                    
                                    </div>
                                </div>
                            </div>
                    </div>
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