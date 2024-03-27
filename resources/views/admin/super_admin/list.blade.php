 
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
                <h4 class="card-title">User</h4>
            </div>
            <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ URL::route('add-super-admin') }}" class="btn btn-primary light">Add Super Admin</a>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="btn btn-primary light btn-icon-md"><i class="fa fa-filter"></i></button>
                </li>
                <li class="nav-item" role="presentation">
                    <div class="dropdown ms-auto">
                        <a href="#" class="btn btn-primary light light light sharp " data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item"><i class="fa fa-print text-primary me-2"></i> Print</li>
                            <li class="dropdown-item"><i class="fa fa-file-pdf text-primary me-2"></i> Generate PDF</li>
                            <li class="dropdown-item"><i class="fa fa-file-excel text-primary me-2"></i> Export to Excel</li>
                        </ul>
                    </div>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Name</th>
                                    <th>Create  date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($user))
                                @foreach ($user as $row)

                                <tr>
                                    <td>{{$row->first_name}} {{$row->last_name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->username}}</td>
                                    <td>2011/04/25</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit-super-admin',$row->id) }}" class="btn btn-primary light shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('delete-super-admin',$row->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade " id="withoutBorder-html" role="tabpanel" aria-labelledby="home-tab-3">
                <div class="card-body pt-0 p-0 code-area">
                    <pre class="mb-0"><code class="language-html">&lt;div class="table-responsive"&gt;
					&lt;table id="example4" class="display table" style="min-width: 845px"&gt;
						&lt;thead&gt;
							&lt;tr&gt;
								&lt;th&gt;Roll No&lt;/th&gt;
								&lt;th&gt;Student Name&lt;/th&gt;
								&lt;th&gt;Invoice number&lt;/th&gt;
								&lt;th&gt;Fees Type &lt;/th&gt;
								&lt;th&gt;Payment Type &lt;/th&gt;
								&lt;th&gt;Status &lt;/th&gt;
								&lt;th&gt;Date&lt;/th&gt;
								&lt;th&gt;Amount&lt;/th&gt;
							&lt;/tr&gt;
						&lt;/thead&gt;
						&lt;tbody&gt;
							&lt;tr&gt;
								&lt;td&gt;01&lt;/td&gt;
								&lt;td&gt;Tiger Nixon&lt;/td&gt;
								&lt;td&gt;#54605&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/04/25&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;02&lt;/td&gt;
								&lt;td&gt;Garrett Winters&lt;/td&gt;
								&lt;td&gt;#54687&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/07/25&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;03&lt;/td&gt;
								&lt;td&gt;Ashton Cox&lt;/td&gt;
								&lt;td&gt;#35672&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2009/01/12&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;04&lt;/td&gt;
								&lt;td&gt;Cedric Kelly&lt;/td&gt;
								&lt;td&gt;#57984&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/03/29&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;05&lt;/td&gt;
								&lt;td&gt;Airi Satou&lt;/td&gt;
								&lt;td&gt;#12453&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2008/11/28&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;06&lt;/td&gt;
								&lt;td&gt;Brielle Williamson&lt;/td&gt;
								&lt;td&gt;#59723&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/12/02&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;07&lt;/td&gt;
								&lt;td&gt;Herrod Chandler&lt;/td&gt;
								&lt;td&gt;#98726&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/08/06&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;08&lt;/td&gt;
								&lt;td&gt;Rhona Davidson&lt;/td&gt;
								&lt;td&gt;#98721&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/10/14&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;09&lt;/td&gt;
								&lt;td&gt;Colleen Hurst&lt;/td&gt;
								&lt;td&gt;#54605&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2009/09/15&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;10&lt;/td&gt;
								&lt;td&gt;Sonya Frost&lt;/td&gt;
								&lt;td&gt;#98734&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2008/12/13&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;11&lt;/td&gt;
								&lt;td&gt;Jena Gaines&lt;/td&gt;
								&lt;td&gt;#12457&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2008/12/19&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;12&lt;/td&gt;
								&lt;td&gt;Quinn Flynn&lt;/td&gt;
								&lt;td&gt;#36987&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2013/03/03&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;13&lt;/td&gt;
								&lt;td&gt;Charde Marshall&lt;/td&gt;
								&lt;td&gt;#98756&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2008/10/16&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;14&lt;/td&gt;
								&lt;td&gt;Haley Kennedy&lt;/td&gt;
								&lt;td&gt;#98754&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/12/18&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;15&lt;/td&gt;
								&lt;td&gt;Tatyana Fitzpatrick&lt;/td&gt;
								&lt;td&gt;#65248&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/03/17&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;16&lt;/td&gt;
								&lt;td&gt;Michael Silva&lt;/td&gt;
								&lt;td&gt;#75943&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/11/27&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;17&lt;/td&gt;
								&lt;td&gt;Paul Byrd&lt;/td&gt;
								&lt;td&gt;#87954&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/06/09&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;18&lt;/td&gt;
								&lt;td&gt;Gloria Little&lt;/td&gt;
								&lt;td&gt;#98746&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2009/04/10&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;19&lt;/td&gt;
								&lt;td&gt;Bradley Greer&lt;/td&gt;
								&lt;td&gt;#98674&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/10/13&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;20&lt;/td&gt;
								&lt;td&gt;Dai Rios&lt;/td&gt;
								&lt;td&gt;#69875&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2012/09/26&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;21&lt;/td&gt;
								&lt;td&gt;Jenette Caldwell&lt;/td&gt;
								&lt;td&gt;#54678&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/09/03&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;22&lt;/td&gt;
								&lt;td&gt;Yuri Berry&lt;/td&gt;
								&lt;td&gt;#98756&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2009/06/25&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;23&lt;/td&gt;
								&lt;td&gt;Caesar Vance&lt;/td&gt;
								&lt;td&gt;#86754&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/12/12&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;24&lt;/td&gt;
								&lt;td&gt;Doris Wilder&lt;/td&gt;
								&lt;td&gt;#34251&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/09/20&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;25&lt;/td&gt;
								&lt;td&gt;Angelica Ramos&lt;/td&gt;
								&lt;td&gt;#65874&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2009/10/09&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;26&lt;/td&gt;
								&lt;td&gt;Gavin Joyce&lt;/td&gt;
								&lt;td&gt;#54605&lt;/td&gt;
								&lt;td&gt;Female&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/12/22&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;27&lt;/td&gt;
								&lt;td&gt;Jennifer Chang&lt;/td&gt;
								&lt;td&gt;#54605&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/11/14&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;28&lt;/td&gt;
								&lt;td&gt;Brenden Wagner&lt;/td&gt;
								&lt;td&gt;#45687&lt;/td&gt;
								&lt;td&gt;Library&lt;/td&gt;
								&lt;td&gt;Cheque&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-danger"&gt;Udpaid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/06/07&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;29&lt;/td&gt;
								&lt;td&gt;Fiona Green&lt;/td&gt;
								&lt;td&gt;#23456&lt;/td&gt;
								&lt;td&gt;Tuition&lt;/td&gt;
								&lt;td&gt;Cash&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-success"&gt;Paid&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2010/03/11&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
							&lt;tr&gt;
								&lt;td&gt;30&lt;/td&gt;
								&lt;td&gt;Shou Itou&lt;/td&gt;
								&lt;td&gt;#54605&lt;/td&gt;
								&lt;td&gt;Annual&lt;/td&gt;
								&lt;td&gt;Credit Card&lt;/td&gt;
								&lt;td&gt;&lt;span class="badge badge-sm light badge-warning"&gt;Panding&lt;/span&gt;&lt;/td&gt;
								&lt;td&gt;2011/08/14&lt;/td&gt;
								&lt;td&gt;&lt;strong&gt;120$&lt;/strong&gt;&lt;/td&gt;
							&lt;/tr&gt;
						&lt;/tbody&gt;
					&lt;/table&gt;
				&lt;/div&gt;</code></pre>
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