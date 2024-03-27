
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Session</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('session-list') }}" class="btn btn-primary light">Session List</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Session</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-session',$session->id) }}" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="title">Title <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="title" placeholder="Your valid title." required name="title" value="{{$session->title}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="start_date">Start Date<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="start_date"  required name="start_date" value="{{$session->start_date}}">
                                        <div class="invalid-feedback">
                                            Please enter a Start Date.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="end_date">End Date<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="end_date"  required name="end_date" value="{{$session->end_date}}">
                                        <div class="invalid-feedback">
                                            Please enter a End Date.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="col-xl-4">
                            <div class="mb-3 row">
                            <label class="col-lg-3 col-form-label" for="program">Assign Programs <span class="text-danger">*</span></label><br/>

                            @foreach($programs as $key => $program)
                        <br/>
                        <div class="checkbox d-inline">
                            <input type="checkbox" name="programs[]" id="program-{{ $key }}-{{ $session->id }}" value="{{ $program->id }}"

                            @foreach($session->programs as $selected_program)
                                @if($selected_program->id == $program->id) checked @endif 
                            @endforeach

                            >
                            <label for="program-{{ $key }}-{{ $session->id }}" class="cr">{{ $program->title }}</label>
                        </div>
                        @endforeach

                        <div class="invalid-feedback">
                          Select Program
                        </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                            <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="status">Status<span class="text-danger">*</span>
                                        </label>
                       
                                    <div class="col-lg-9">
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" @if( $session->status == 1 ) selected @endif>Active</option>
                                            <option value="0" @if( $session->status == 0 ) selected @endif>Inactive</option>
                                        </select>
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