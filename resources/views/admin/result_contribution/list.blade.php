<!-- Extends template page-->
@extends('admin.layout.header')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
    </button>
    <strong>{{ $message }}</strong> 
</div>
@else
<div class="alert alert-primary alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="fa-solid fa-xmark"></i></span>
    </button>
    <strong>{{ $message }}</strong>
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Result Contribution</h4>
                <span class="text-dark">Total contribution of final result must be equal to 100%</span>
                
            </div>
           
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add/Edit Contribution</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-resultcontribution') }}" >
                        @csrf 
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                <input name="id" type="hidden" value="{{ (isset($row)) ? $row->id : '-1' }}">

                                    @foreach($exams as $key => $exam)
                                    <input type="text" name="exams[]" value="{{ $exam->id }}" hidden>
                                    <label class="row-lg-6 col-form-label" for="exam-{{ $key }}">{{ $exam->title }} (%)<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                        
                                    <input type="text"  class="form-control" name="contributions[]" id="exam-{{ $key }}" value="{{ round($exam->contribution, 2) }}" required>
                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="attendances">Attendance (%) <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                        <input type="text" class="form-control" name="attendances" id="attendances" value="{{ isset($row->attendances)?round($row->attendances, 2):'' }}" required>
                                        @error('attendances')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>

                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="assignments">Assignments (%) <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                        <input type="text" class="form-control" name="assignments" id="assignments" value="{{ isset($row->assignments)?round($row->assignments, 2):'' }}" required>
                                        @error('assignments')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                    <div class="col-lg-6">
                                        <label class="row-lg-3 col-form-label" for="activities">Activities (%) <span class="text-danger">*</span></label>
                                        <div class="row-lg-6">
                                        <input type="text" class="form-control" name="activities" id="activities" value="{{ isset($row->activities)?round($row->activities, 2):'' }}" required>
                                        @error('activities')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                            </div>
                            <div class="col-xl-12">
                                <div class="mb-3 row">
                                    <div class="col-lg-2 ms-auto">
                                        <button type="submit" class="btn btn-primary light">@isset($row) <i class="fas fa-check"></i> {{ __('Update') }} @else <i class="fas fa-check"></i> {{ __('Save') }} @endif</button>
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
@endsection