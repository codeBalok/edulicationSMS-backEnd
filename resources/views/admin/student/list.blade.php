 
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

<a href="{{ route('generate-nat-file') }}" class="btn btn-primary light light">Donwload .NAT File</a>

<div class="row">
    @if(!empty($student))
    @foreach ($student as $row)

    <div class="col-xl-3 col-lg-4 col-sm-6 contect-card">
        <div class="card">
       
            <div class="card-body">
                <div class="card-use-box">
                    <div class="crd-bx-img">

                        @if($row->profile_image_path!=null)
                        @if($row->profile_image_path)
                        <a target="_blank" href="{{ getStoragePath() . $row->profile_image_path }}" class="btn-link text-primary">Profile Image</a>
                        <img src="{{ getStoragePath() . $row->profile_image_path }}" class="rounded-circle" alt="" style="width: 100px; height: 100px;">
                        @endif
                        @else
                        <img src="images/profile/friends/f1.jpg" class="rounded-circle" alt="">
                        @endif
                        <div class="active"></div>
                    </div>
                    <div class="card__text">
                        <h4 class="mb-0">{{$row->first_name}} {{$row->last_name}}</h4>
                        <p>{{$row->date_of_birth}}</p>
                    </div>
                    <ul class="card__info">
                        <li>
                            <span class="card__info__stats">175</span>
                            <span>Class</span>
                        </li>
                        <li>
                            <span class="card__info__stats">50</span>
                            <span>Roll No</span>
                        </li>
                        <li>
                            <span class="card__info__stats"> {{($row->last_name=='1') ? 'M' : 'F'}}</span>
                            <span>Gender</span>
                        </li>
                        <li>
                            <span class="card__info__stats">{{$row->date_of_joining}}</span>
                            <span>Joining Date</span>
                        </li>
                    </ul>
                    <ul class="post-pos">
                        <li>
                            <span class="card__info__stats">Father's Name: </span>
                            <span>{{$row->middle_name}}</span>
                        </li>
                        <li>
                            <span class="card__info__stats">Mother's Name: </span>
                            <span>{{$row->mother_name}}</span>
                        </li>
                        <li>
                            <span class="card__info__stats">Contact Us: </span>
                            <span>{{$row->contact_no}}</span>
                        </li>
                        <li>
                            <span class="card__info__stats">Student Id: </span>
                            <span>{{$row->student_id}}</span>
                        </li>
                        <li>
                            <span class="card__info__stats">Marital Status: </span>
                            @if($row->marital_status && $marital_status)
                              @foreach($marital_status as $row1)
                                @if($row1->id == $row->marital_status) <span>{{$row1->title}}</span> @endif
                              @endforeach
                            @endif
                            
                        </li>
                        <li>
                            <span class="card__info__stats">Blood Group: </span>
                            @if($row->blood_group && $blood_group)
                              @foreach($blood_group as $row1)
                               @if($row1->id == $row->blood_group) <span>{{$row1->title}}</span> @endif
                              @endforeach
                            @endif
                        </li>

                    </ul>
                    <div>
                        <a href="javascript:void(0)" class="btn btn-primary light light me-2">Message</a>
                        <a href="javascript:void(0)" class="btn btn-secondary light ms-2" >Following</a>
                        <a href="{{ route('edit-student', $row->id) }}" class="btn btn-secondary light ms-2"><i class="fa-solid fa-pencil"></i></a>
                    </div>	
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
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