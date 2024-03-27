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

<div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">
        <div class="card-header flex-wrap d-flex justify-content-between">
           
        </div>
        <div id="documentList">
		<div class="float-right d-inline"><button  class="btn btn-primary">Create Document</button></div>
                <table width="100%" class="table table-striped" border="0" cellpadding="0" cellspacing="0" style="margin-top:20px;">
                    <thead>
                        <tr>
                            <th style="padding-left:30px;">Document Name</th>
                            <th>File Name</th>
                            <th>Uploaded By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
	    </div>
        </div>  
        <div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">
        <div class="card-header flex-wrap d-flex justify-content-between">
                <div>
                    <h4 class="card-title">Upload Document</h4>
                </div>
                <form action="/store-document" method="post" enctype="multipart/form-data">
                    @csrf
                    <input class="form-control" type="file" name="files[]" multiple>
                    <button class="btn btn-primary" type="submit">Upload Document</button>
                </form>
              
        </div>
    </div>
</div>


</div>
</div>
@stop