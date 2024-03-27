 
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
                <h4 class="card-title">Leave Request Detail</h4>
            </div>
            <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ URL::route('add-leaverequest') }}" class="btn btn-primary light">Reuest Leave</a>
                </li>
               
            </ul>	
        </div>

        <!-- /tab-content -->	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
            <div>
                <div class="page-titles">
                    <div class="row">
                        <div class="col-xl-12">
                            <h5 class="text-sm">Leave Request #1  {{$employee->first_name}} {{$employee->last_name}}</h5>
                        </div> 
   
                        </div>
                    </div> 
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card border-right">
                <div class="card-body">
                    <h4 class="card-title m-3">Leave Request Detail</h4> 
                    <div class="table-responsive">
                        <table class="table table-sm custom-show-table">
                            <tbody>
                                <tr>
                                <td>Name</td> 
                                <td>{{$employee->first_name}}  {{$employee->last_name}}</td>
                                </tr> 
                                <tr>
                                <td>Code</td> 
                                <td>{{$employee->employee_code}}</td>
                                </tr> 
                                <tr>
                                    <td>Designation</td>
                                     <td>{{$designation->designation_name}}</td>
                                    </tr> 
                                    <tr>
                                        <td>Period</td>
                                         <td>{{$leaverequest->start_date}} to {{$leaverequest->end_date}}</td>
                                        </tr> 
                            @php
                                $start = new DateTime($leaverequest->start_date);
                                $end = new DateTime($leaverequest->end_date);
                                $interval = $start->diff($end);
                                $countDays = $interval->days;
                            @endphp
                                        <tr>
                                            <td>Count</td> 
                                            <td>
                                            {{$countDays}}
											</td></tr> 
                                            <tr>
                                            <td>Status</td>
                                            @if(!empty($leaverequestdetail))
    @if($leaverequestdetail->status==1)
        <td><span class="badge badge-sm light badge-primary">Pending</span></td>
    @elseif($leaverequestdetail->status==2)
        <td><span class="badge badge-sm light badge-success">Approved</span></td>
    @elseif($leaverequestdetail->status==3)
        <td><span class="badge badge-sm light badge-danger">Rejected</span></td>
    @else
        <td><span class="badge badge-sm light badge-warning">Cancelled</span></td>
    @endif
@else
    <td><span class="badge badge-sm light badge-primary">Pending</span></td>
@endif
                                            </tr> 
                                            <tr><td>Reason</td> <td>{{$leaverequest->reason}}</td></tr> 
                                            <tr><td>Requested by</td> <td>
												{{$user->username}}
											</td></tr> 
                                            <tr>
                                                <td>Created at</td> 
                                                <td>{{ \Carbon\Carbon::parse($leaverequest->created_at)->format('Y-m-d H:i') }}</td>
                                            </tr> 
                                            <tr>
                                                <td>Last Updated at</td> 
                                                <td>{{ \Carbon\Carbon::parse($leaverequest->updated_at)->format('Y-m-d H:i') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!----> 
                                <h4 class="card-title m-3">Leave Allocation</h4> 
                                <div class="table-responsive">
                                    <table class="table table-sm custom-show-table">
                                        <tbody>
                                            <tr>
                                                <td>Period</td>
                                                 <td>{{$leave_allocation->start_date}} to {{$leave_allocation->end_date}}</td>
                                                </tr> 
                                                <tr>
                                                    <td>{{$leavetype->name}}</td> 
                                                    <td>{{$leave_allocation->leave_allotted}}/10</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12 col-sm-6">
                                <div class="card">
                                    <div class="card-body border-right p-4">
                                        <form action="{{ route('add-leaverequest-detail')}}" class="needs-validation" novalidate method="POST">
                                        @csrf   
                                        <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        
                                                    <input type="hidden" id="employee_leave_request_id" name="employee_leave_request_id" value="{{$leaverequest->id}}">
                                                    <input type="hidden" id="employee_id" name="employee_id" value="{{$employee->id}}">
                                                    <input type="hidden" id="designation_id" name="designation_id" value="{{$designation->id}}">
                                                    <input type="hidden" id="approver_user_id" name="approver_user_id" value="{{$user->id}}">
                                                        <label for="">Status</label>
                                                         <select name="status" class="form-control">
                                                            <option value="null">Select One</option>
                                                             <option value="1">
                                                    Pending
                                                  </option><option value="2">
                                                    Approved
                                                  </option><option value="3">
                                                    Rejected
                                                  </option><option value="4">
                                                    Cancelled
                                                  </option></select> <!---->
                                                </div>
                                            </div> 
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="">Comment</label>

                                                     <textarea rows="3" placeholder="Comment" name="comment" class="form-control">
                                                    </textarea> <!---->
                                                   
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                        </br>
                                            <button type="submit" class="btn btn-primary light">Update</button>
                                        </div>
                                    </form>
                                     <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Comment</th>
                                                    <th>Updated by</th>
                                                    <th>Last Updated at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                   
                                                    @if(!empty($leavedetaillist))
                                                    @foreach ($leavedetaillist as $row)
                                                    <tr>
                                                        <td>{{$row->status}} </td>
                                                        <td>{{$row->comment}} </td> 
                                                        <td>{{$row->approver_username}} </td> 
                                                        <td>{{$row->updated_at}} </td>
                                                    </tr>
                                                    @endforeach
                                                     @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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