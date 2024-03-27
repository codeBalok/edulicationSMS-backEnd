
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Assignment</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ URL::route('assignment-list') }}" class="btn btn-primary light">Assignment List</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Edit Assignment</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('update-assignment', $assignment->id ) }}" >
                        @csrf

                        <div class="row">
                            <div class="col-xl-4">
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="validationCustom02">Title <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="validationCustom02" placeholder="Enter Title" required name="title" value="{{$assignment->title}}">
                                        <div class="invalid-feedback">
                                            Please enter a Title.
                                        </div>
                                        @if($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
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

@stop