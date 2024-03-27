
<!-- Extends template page-->
@extends('admin.layout.header')
<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Designation</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('designation-list') }}" class="btn btn-primary light">Designation List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Designation</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-designation',$designation->id) }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Name <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Your valid Designation Name." required name="designation_name" value="{{$designation->designation_name}}">
                                        <div class="invalid-feedback">
                                            Please enter a Name.
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
                                    <input type="text" class="form-control" id="description" name="description" required value="{{$designation->description}}">
                                        <div class="invalid-feedback">
                                            Please enter a Description.
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-xl-6">
                                         <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="validationCustom05">Department <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-9">
                                                <select class="default-select wide form-control" id="validationCustom05" name="department_id">
                                                    <!--                                            <option >Please select</option>-->
                                                    @if(!empty($department))
                                                    @foreach ($department as $row)
                                                    <option value="{{$row->id}}" {{ $row->id == $designation->department_id ? 'selected' : '' }}  >{{$row->department_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
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