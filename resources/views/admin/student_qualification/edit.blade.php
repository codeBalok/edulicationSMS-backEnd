@extends('admin.layout.header')

<!-- Specify content -->
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
           
            <div class="card-body">
                <div class="form-validation">
                   
                    <article>
                    <div>
<div>
<div>
@foreach ($schoolqualification as $qualifications)
	<form name="edit_qualification_frm" id="edit_qualification_frm" method="post" action="{{ route('update-studentqualification', $qualifications->student_id ) }}">
    @csrf
    <input name="student_id" value="{{$qualifications->student_id}}" hidden>
		<div style="float:left;padding-left:150px;">
			<div style="padding:5px;width:400px;font-weight:bold;float:left">Completed any of the following qualifications?</div>
			<div style="padding:0px 20px; float:left">
				<select class="form-control" name="qualification_completed" id="qualification_completed">
                <option value="0" {{ $qualifications->qualification_completed == 0 ? 'selected' : '' }}>Not Provided</option>
                <option value="1" {{ $qualifications->qualification_completed == 1 ? 'selected' : '' }}>Yes</option>
                <option value="2" {{ $qualifications->qualification_completed == 2 ? 'selected' : '' }}>No</option>
				</select>
				</div>
				<div style="clear:both;height:20px;"></div>
			
				<div style="padding:5px;font-weight:bold;width:400px;float:left;">Highest level of qualification you hold? </div>
				<div style="padding:5px 20px;line-height:20px;float:left;">
                @foreach ([
    "008" => "Bachelor Degree or Higher Degree level",
    "410" => "Advanced Diploma or Associate Degree Level",
    "420" => "Diploma (or Associate Diploma) Level",
    "511" => "Certificate IV (or advanced certificate/technician)",
    "514" => "Certificate III (or trade certificate)",
    "521" => "Certificate II",
    "990" => "Certificates other than the above",
    "524" => "Certificate I",
] as $value => $label)
    <input type="checkbox" class="custom-checkbox" style="margin-right:4px;" name="qualification_level[]" value="{{ $value }}" {{ is_array($qualificationlevel) && in_array($value, $qualificationlevel) ? 'checked' : '' }}>
    {{ $label }} <br>
@endforeach

@if(!is_array($qualificationlevel))
    <p>No qualification levels retrieved from the database.</p>
@endif      		
                                    </div>
			</div>
		<div style="clear:both; height:20px;"></div>
		<div align="center">
			<button type="submit" class="btn btn-primary" style="margin:0px 5px;">Save</button>
			
		</div>
	</form>
    @endforeach
</div>
</article>

<article>
</article>

</div>
</div>
</div>
</div>

</div>
@endsection