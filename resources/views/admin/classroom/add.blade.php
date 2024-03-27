
<!-- Extends template page-->
@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create Class Room</h4>
                <ul class="nav nav-tabs dzm-tabs" id="myTab-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('classroom-list') }}" class="btn btn-primary light">Class Room list</a>
                    </li>

                </ul>
                
            </div>
           
            <div class="card-body">
                <div class="form-validation">
                    <h5>Add Class Room</h5>

                    <form class="needs-validation" novalidate method="POST" action="{{ route('store-classroom') }}" >
                        @csrf
                      
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3 row">
                                <div class="col-lg-6">
                                    <label class="row-lg-6 col-form-label" for="title">Room No<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control  @error('roomno') is-invalid @enderror" id="roomno" placeholder="Enter Room No"  value="{{ old('roomno') }}" required name="roomno">
                                    @error('roomno')
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
                                    <label class="row-lg-6 col-form-label" for="floor">Floor<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control  @error('floor') is-invalid @enderror" id="floor" placeholder="Enter Floor"  value="{{ old('floor') }}" required name="floor">
                                    @error('floor')
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
                                    <label class="row-lg-6 col-form-label" for="capacity">Capacity<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control  @error('capacity') is-invalid @enderror" id="capacity" placeholder="Enter Capacity"  value="{{ old('capacity') }}" required name="capacity">
                                    @error('capacity')
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
                                    <label class="row-lg-6 col-form-label" for="type">Type<span class="text-danger">*</span></label>
                                    <div class="row-lg-8">
                                    <input type="text" class="form-control  @error('type') is-invalid @enderror" id="type" placeholder="Enter Type"  value="{{ old('type') }}" required name="type">
                                    @error('type')
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
                                        <button type="submit" class="btn btn-primary light">Submit</button>
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

@section('customjs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
        <script type="text/javascript">
        'use strict';
        $(document).ready(function() {
            // [ Single Select ] start
            $(".select2").select2();

            // [ Multi Select ] start
            $(".select2-multiple").select2({
                placeholder: "{{ __('select') }}"
            });
        });
        "use strict";
        // checkbox all-check-button selector
        $(".all_check").on('click',function(e){
            if($(this).is(":checked")){
                // check all checkbox
                $(".program").prop('checked', true);
            }
            else if($(this).is(":not(:checked)")){
                // uncheck all checkbox
                $(".program").prop('checked', false);
            }
        });
    </script>

<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated');
                    }, false);
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
<!-- Daterangepicker -->
<!-- momment js is must -->
<!--<script src="./vendor/moment/moment.min.js"></script>-->
<script src="{{ asset('admin/vendor/moment/moment.min.js')}}"></script>
<!--<script src="./vendor/bootstrap-daterangepicker/daterangepicker.js"></script>-->
<script src="{{ asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- clockpicker -->
<script src="./vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<!-- asColorPicker -->
<script src="./vendor/jquery-asColor/jquery-asColor.min.js"></script>
<script src="./vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
<script src="./vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
<!-- Material color picker -->
<script src="./vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- pickdate -->
<!--<script src="./vendor/pickadate/picker.js"></script>-->
<script src="{{ asset('admin/vendor/pickadate/picker.js')}}"></script>
<script src="./vendor/pickadate/picker.time.js"></script>
<!--<script src="./vendor/pickadate/picker.date.js"></script>-->
<script src="{{ asset('admin/vendor/pickadate/picker.date.js')}}"></script>


<!-- Daterangepicker -->
<!--<script src="./js/plugins-init/bs-daterange-picker-init.js"></script>-->
<script src="{{ asset('admin/js/plugins-init/bs-daterange-picker-init.js')}}"></script>

<!-- Clockpicker init -->
<script src="./js/plugins-init/clock-picker-init.js"></script>
<!-- asColorPicker init -->
<script src="./js/plugins-init/jquery-asColorPicker.init.js"></script>
<!-- Material color picker init -->
<!--<script src="./js/plugins-init/material-date-picker-init.js"></script>-->
<script src="{{ asset('admin/js/plugins-init/material-date-picker-init.js')}}"></script>

<!-- Pickdate -->
<script src="./js/plugins-init/pickadate-init.js"></script>

<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

        <!--<script src="./js/custom.js"></script>-->
<script src="{{ asset('admin/js/custom.js')}}"></script>
<!--<script src="./js/deznav-init.js"></script>-->
<script src="{{ asset('admin/js/deznav-init.js')}}"></script>
@endsection
@stop