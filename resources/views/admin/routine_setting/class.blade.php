<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/print/routine.css') }}" media="screen, print">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('admin/js/print/pcoded.min.js') }}"></script>
<script src="{{ asset('admin/js/print/jQuery.print.min.js') }}"></script>

<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-md-12 col-lg-8">
                <form class="needs-validation" novalidate action="{{ route('routine-setting.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>Class Routine Settings</h5>
                        </div>
                        <div class="card-block">
                          <div class="row">
                            <!-- Form Start -->
                            <input name="id" type="hidden" value="{{ (isset($row->id))?$row->id:-1 }}">
                            <input name="slug" type="hidden" value="class-routine">

                            <div class="form-group col-md-12">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input class="form-control" name="title" id="title" value="{{ isset($row->title)?$row->title:'' }}" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="body" class="form-label">Body</label>
                                <textarea class="form-control texteditor" name="body" id="body">{{ isset($row->body)?$row->body:'' }}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="width" class="form-label">Width <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="width" id="width" value="{{ isset($row->width)?$row->width:'1000px' }}" placeholder="1000px" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_width') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="height" class="form-label">Height <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="height" id="height" value="{{ isset($row->height)?$row->height:'auto' }}" placeholder="auto" required>

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_height') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="logo_left">Logo Left: <span class="text-danger">Best Resolution Height- 200 PX, Width- Any PX</span></label>

                                @if(isset($row->logo_left) && is_file('uploads/print-setting/'.$row->logo_left))
                                <img src="{{ asset('uploads/print-setting/'.$row->logo_left) }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                @endif

                                <input type="file" class="form-control" name="logo_left" id="logo_left" value="{{ old('logo_left') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_logo_left') }}
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="logo_right">Logo Right: <span class="text-danger">Best Resolution Height- 200 PX, Width- Any PX</span></label>

                                @if(isset($row->logo_right) && is_file('uploads/print-setting/'.$row->logo_right))
                                <img src="{{ asset('uploads/print-setting/'.$row->logo_right) }}" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                                @endif
                                
                                <input type="file" class="form-control" name="logo_right" id="logo_right" value="{{ old('logo_right') }}">

                                <div class="invalid-feedback">
                                  {{ __('required_field') }} {{ __('field_logo_right') }}
                                </div>
                            </div>
                            <!-- Form End -->
                          </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary light"><i class="fas fa-check"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection