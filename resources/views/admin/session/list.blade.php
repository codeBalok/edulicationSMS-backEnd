 
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
            <div>
                <h4 class="card-title">Session List</h4>
            </div>
            <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ URL::route('add-session') }}" class="btn btn-primary light">Add Session</a>
                </li>
               
            </ul>	
        </div>
        <!-- /tab-content -->	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="example4" class="display table" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Program</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $rows as $key => $row )

                                <tr>
                                    <td>{{$row->title}}</td>
                                    <td>@if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->start_date)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->start_date)) }}
                                            @endif
                                            <br/>
                                            @if(isset($setting->date_format))
                                            {{ date($setting->date_format, strtotime($row->end_date)) }}
                                            @else
                                            {{ date("Y-m-d", strtotime($row->end_date)) }}
                                            @endif
                                    </td>
                                    
                                    <td>  @foreach($row->programs as $key => $program)
                                            <span class="badge badge-primary">{{ $program->title }}</span><br>
                                            @endforeach
                                   
                                    <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">InActive</span>
                                            @endif
                                        </td>
                                    <td>
                                        <div class="d-flex">
                                        @if( $row->current == 1 )
                                            <span class="btn btn-success btn-sm">Current</span>
                                            @else
                                            <a href="{{ route(('session-list').'.current', $row->id) }}" class="btn btn-secondary btn-sm">Make Current</a>
                                            @endif
                                            <a href="{{ route('edit-session',$row->id) }}" class="btn btn-primary light shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('delete-session',$row->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /tab-content -->	
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