
<!-- Extends template page-->
@extends('admin.layout.header')
<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Category</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('coursecategory-list') }}" class="btn btn-primary light">Category List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Category</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-coursecategory',$coursecategory->id) }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Category Name." required name="name" value="{{$coursecategory->name}}">
                                        <div class="invalid-feedback">
                                            Please enter a Course Category Name.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                        <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Description </label>
                                    <div class="col-lg-9">
                                    <input type="text" class="form-control" id="description" name="description" required value="{{$coursecategory->description}}">
                                        <div class="invalid-feedback">
                                            Please enter a Description.
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                         <div class="mb-3 row">
                                         <label class="col-lg-3 col-form-label" for="status">Status<span class="text-danger">*</span>
                                        </label>
                       
                                    <div class="col-lg-6">
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" @if( $coursecategory->status == 1 ) selected @endif>Active</option>
                                            <option value="0" @if( $coursecategory->status == 0 ) selected @endif>Inactive</option>
                                        </select>
                                    </div>
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