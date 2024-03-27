<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Attendance</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('add-attendance') }}" class="btn btn-primary light">Mark Attendance</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <h5>Filter Attendance</h5>
                    
                    <form class="needs-validation" novalidate method="POST" action="/admin/attendance-list" >
                        @csrf
                        <div class="row">
                            <div class="col-xl-3">
                                <div class="mb-3 row">
                                <label class="row-lg-3 row-form-label" for="department_id"> Department <span class="text-danger">*</span>
                                    </label>
                                    
                                    <div class="col-lg-8">
                                        <select class="default-select wide form-control" id="department_id" name="department_id">
                                            @if(!empty($department))
                                            @foreach ($department as $row)
                                            <option value="{{$row->id}}">{{$row->department_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3 row">
                                <label class="row-lg-3 row-form-label" for="designation_id"> Designation <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="default-select wide form-control" id="designation_id" name="designation_id">
                                            @if(!empty($designation))
                                            @foreach ($designation as $row)
                                            <option value="{{$row->id}}">{{$row->designation_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3 row">
                                <label class="row-lg-3 row-form-label" for="attendancemonth">Select Month:</label>
                                <div class="col-lg-9">
                                <!-- <input type="date" class="form-control" id="attendancedate" name="date_of_attendance"
                                    value="2023-10-20"
                                    min="2023-01-01" max="2023-12-31"> -->
                                    <!-- <input type="month" class="form-control" id="month-picker" name="selected_month" value="{{ date('Y-m') }}"> -->
                                    <input type="month" class="form-control" id="attendancemonth" name="attendancemonth" value="{{ date('Y-m') }}">
                                </div>
</div>
                            </div>
                            <div class="col-xl-3">
                                <div class="mb-3 row">
                                <label class="row-lg-3 col-form-label" for="employee_category_id"> Employee Category <span class="text-danger">*</span>
                                    </label>
                                    <div class="row-lg-9">
                                    <select class="default-select wide form-control" id="employee_category_id" name="employee_category_id">
                                            @if(!empty($employeecategory))
                                            @foreach ($employeecategory as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a one.
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                           
                            
                            
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <div class="col-lg-1 ms-auto">
                                        <button type="submit" id="filterButton" name="filterButton" class="btn btn-primary light">Filter</button>
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
<div id="filtered-data">
        <!-- Display filtered data here -->
    </div>
    <style>
        .employee-table {
    border-collapse: collapse;
    width: 100%;
}

.employee-table th, .employee-table td {
    border: 1px solid black;
    padding: 8px;
}

.employee-table th {
    background-color: #f2f2f2;
}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    
$(document).ready(function () {
        $("#filterButton").click(function (e) {
            e.preventDefault();
            var department_id = $('#department_id').val();
            var designation_id = $('#designation_id').val();
            var attendancemonth = $('#attendancemonth').val();
            var employee_category_id = $('#employee_category_id').val();
           
            $.ajax({
                url: "{{ route('attendance-get') }}",
                type: "POST",
                dataType: "json",
                data: {
                    _token: "{{ csrf_token() }}",
                    department_id: department_id,
                    designation_id: designation_id,
                    attendancemonth: attendancemonth,
                    employee_category_id: employee_category_id,
                },
                success: function (data) {
                    var employees = data.employees;
                    // var month = data.selectedMonth;
                    
                    $('#filtered-data').empty();

        // Example: Generate HTML based on the 'employees' data
        var htmlContent = '<table class="employee-table"><tbody> <th> Employee  </th>  <th> Employee Category </th> <th> Date of attendance </th>';
        employees.forEach(function(employee) {
            
            htmlContent += '<tr><td>' + employee.first_name + ' ' + employee.last_name + ' (' +  employee.employee_code + ') ' + '</td><td>' + employee.name + '</td><td>' + employee.date_of_attendance +'</td></tr>';
            // Adjust the properties based on your actual data structure
        });
        htmlContent += '</tbody></table>';

        // Append the generated HTML to the #filtered-data element
        $('#filtered-data').html(htmlContent);
               
            },
        error: function(data) {
            console.log("error");
        }
    });
});
});
</script>


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
    


