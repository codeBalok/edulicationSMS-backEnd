 
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="col-lg-12">
											<div class="card dz-card" id="buttons-with-icon">
												<div class="card-header flex-wrap d-flex justify-content-between border-0 ">
													<div>
														<h4 class="card-title">Subject List</h4>
													</div>
												
												</div>
												<div class="tab-content" id="myTabContent-1">
													<div class="tab-pane fade show active" id="Buttons-Icon" role="tabpanel" aria-labelledby="home-tab-1">
														<div class="card-body pt-0">
														<a href="{{ URL::route('add-subject') }}" class="btn btn-primary light"><i class="fa-solid fa-plus"></i> Add New</a>
															<button type="button" class="btn btn-secondary"><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
															<button type="button" class="btn btn-success"><i class="fa fa-download color-warning me-2"></i> Import</button>
														</div>
													</div>
													
												</div>	
												<div class="row">
													<div class="col-lg-12">
														<div class="card-body">
															<div class="form-validation">
																<form class="needs-validation" novalidate method="get" action="{{ route('subject-list') }}">
																	<div class="row">
																		
																			<div class="col-lg-2">
																				<label class="row-lg-4 col-form-label" for="validationCustom05">Faculty
																					<span class="text-danger">*</span>
																				</label>
																				<div class="row-lg-12">
																					<div class="dropdown bootstrap-select default-select wide form-control">
                                                                                    <select class="default-select wide form-control" name="faculty" id="faculty" required>
                                                                                        <option value="0">All</option>
                                                                                        @foreach( $faculties->sortBy('title') as $faculty )
                                                                                        <option value="{{ $faculty->id }}" @if( $selected_faculty == $faculty->id ) selected @endif>{{ $faculty->title }}</option>
                                                                                        @endforeach
                                                                                    </select>
																						
																						<div class="invalid-feedback">
																							Please select a one.
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-2">
																				<label class="row-lg-4 col-form-label" for="validationCustom05">Program
																					<span class="text-danger">*</span>
																				</label>
																				<div class="row-lg-12">
																					<div class="dropdown bootstrap-select default-select wide form-control">
                                                                                    <select class="default-select wide form-control" name="program" id="program" required>
                                                                                            <option value="0">All</option>
                                                                                            @isset($programs)
                                                                                            @foreach($programs->sortBy('title') as $program)
                                                                                            <option value="{{ $program->id }}" @if( $selected_program == $program->id ) selected @endif>{{ $program->title }}</option>
                                                                                            @endforeach
                                                                                            @endisset
                                                                                    </select>
                                                                                            <div class="invalid-feedback">
																							Please select a one.
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-2">
																				<label class="row-lg-4 col-form-label" for="validationCustom05">Course Type
																					<span class="text-danger">*</span>
																				</label>
																				<div class="row-lg-12">
																					<div class="dropdown bootstrap-select default-select wide form-control">
                                                                                    <select class="default-select wide form-control" name="subject_type" id="subject_type">
                                                                                        <option value="">All</option>
                                                                                        <option value="1" @if( $selected_subject_type == 1 ) selected @endif>Compulsory</option>
                                                                                        <option value="2" @if( $selected_subject_type == 2 ) selected @endif>Optional</option>
                                                                                    </select>

																						
																						<div class="invalid-feedback">
																							Please select a one.
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="col-lg-2">
																				<label class="row-lg-4 col-form-label" for="validationCustom05">Class Type
																					<span class="text-danger">*</span>
																				</label>
																				<div class="row-lg-12">
																					<div class="dropdown bootstrap-select default-select wide form-control">
                                                                                    <select class="default-select wide form-control" name="class_type" id="class_type">
                                                                                        <option value="">All</option>
                                                                                        <option value="1" @if( $selected_class_type == 1 ) selected @endif>Theory</option>
                                                                                        <option value="2" @if( $selected_class_type == 2 ) selected @endif>Practical</option>
                                                                                        <option value="3" @if( $selected_class_type == 3 ) selected @endif>Both</option>
                                                                                    </select>
																						
																						<div class="invalid-feedback">
																							Please select a one.
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			
																		
																			
																			
																			<div class="col-lg-2 pt-4">
																				
																				<div class="col-lg-8 ms-auto">
																					<button type="submit" class="btn btn-primary light"><i class="fas fa-search"></i>  Filter</button>
																				</div>
																			</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>	
											</div>
										</div>
										<!-- /Column  -->
<div class="col-xl-12">
    <div class="card dz-card" id="accordion-four">
        <!-- <div class="card-header flex-wrap d-flex justify-content-between"> -->
            <!-- <div>
                <h4 class="card-title">Employee</h4>
            </div> -->
            <!-- <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{ URL::route('add-employee') }}" class="btn btn-primary light">Add Employee </a>
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
            </ul>	 -->
        <!-- </div> -->

        <!-- /tab-content -->	
        <div class="tab-content" id="myTabContent-3">
            <div class="tab-pane fade show active" id="withoutBorder" role="tabpanel" aria-labelledby="home-tab-3">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table id="example4" class="display table" style="min-width: 845px">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>C.H.</th>
                                    <th>Course Type</th>
									<th>Class Type</th>
									<th>Program</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach( $rows as $key => $row )

                                <tr>
								
									<td>{{ $key + 1 }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->code }}</td>
									<td>{{ $row->credit_hour }}</td>
                                    <td>@if( $row->subject_type == 1 )
                                            {{ __('subject_type_compulsory') }}
                                            @elseif( $row->subject_type == 0 )
                                            {{ __('subject_type_optional') }}
                                            @endif</td>
                                            <td>
                                            @if( $row->class_type == 1 )
                                            {{ __('class_type_theory') }}
                                            @elseif( $row->class_type == 2 )
                                            {{ __('class_type_practical') }}
                                            @elseif( $row->class_type == 3 )
                                            {{ __('class_type_both') }}
                                            @endif
                                        </td>
									
                                    <!-- <td><span class="badge badge-sm  badge-info light">{{$row->em}}</span></td> -->
                                   
                                    <td>
                                            @foreach($row->programs->sortBy('title') as $program)
                                                <span class="badge badge-info">{{ $program->title }}</span>
                                                <br/>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if( $row->status == 1 )
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('edit-subject',$row->id) }}" class="btn btn-primary light shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('delete-subject',$row->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                               

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