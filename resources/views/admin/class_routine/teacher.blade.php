<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<style>
  .class-time
  {
    clear: both;
    color: #000;
    padding: 5px;
    margin-top: 5px;
    margin-right: 5px;
    background: #CFF95A;
    box-shadow: 0 10px 18px 0 rgba(69, 90, 100, 0.08);
  }
</style>
<!-- Start Content-->
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Teacher Routine</h5>
                    </div>
                    <div class="card-block">
                        <form class="needs-validation" novalidate method="get" action="{{ route('class-routine.teacher') }}">
                       
                            <div class="mb-3 row">
                                <div class="form-group col-md-3">
                                    <label class="col-lg-3 col-form-label" for="teacher">Staff Id <span class="text-danger">*</span></label>
                                    <select class="default-select wide form-control" name="teacher" id="teacher" required>
                                        <option value="">Select</option>
                                        @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if($selected_staff == $teacher->id) selected @endif>{{ $teacher->staff_id }} - {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">
                                      Staff Id Required
                                    </div>
                                </div>
                                <div class="col-lg-2 pt-4">											
                                    <div class="col-lg-8 ms-auto">
                                        <button type="submit" class="btn btn-primary light"><i class="fas fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>


                    @if(isset($rows))
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table class="table class-routine-table">
                                <thead>
                                    <tr>
                                        <th>Saturday</th>
                                        <th>Sunday</th>
                                        <th>Monday</th>
                                        <th>Tuesday</th>
                                        <th>Wednesday</th>
                                        <th>Thursday</th>
                                        <th>Friday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $weekdays = array('1', '2', '3', '4', '5', '6', '7');
                                    @endphp
                                    <tr>
                                        @foreach($weekdays as $weekday)
                                        <td>
                                            @foreach($rows->where('day', $weekday) as $row)
                                            <div class="class-time">
                                            {{ $row->subject->code ?? '' }}<br>
                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->start_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->start_time)) }}
                                            @endif <br> @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($row->end_time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($row->end_time)) }}
                                            @endif<br>
                                            {{ __('field_room') }}: {{ $row->room->title ?? '' }}<br>
                                            {{ $row->teacher->staff_id }} - {{ $row->teacher->first_name ?? '' }}
                                            </div>
                                            @endforeach
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection