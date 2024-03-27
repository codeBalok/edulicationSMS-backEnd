<!-- Extends template page-->
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
@foreach ($disabilitydetails as $disabilitydetail)
	<form name="edit_disability_frm" id="edit_disability_frm" method="post" action="{{ route('update-disabilitydetail', $disabilitydetail->student_id ) }}" >
    @csrf
    <input name="student_id" value="{{$disabilitydetail->student_id}}" hidden>
		<div style="float:left;padding-left:50px;">
			<div style="padding:5px;float:left;width:500px; font-weight:bold;">Has a disability, impairment or long-term condition?</div>
			<div style="padding:0px 5px; float:left; vertical-align:bottom">
            <select class="form-control" name="is_disability" id="is_disability">
                <option value="0" {{ $disabilitydetail->is_disability == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $disabilitydetail->is_disability == 1 ? 'selected' : '' }}>Yes</option>
            </select>
			</div>
			<div style="clear:both;height:10px;"></div>
			<div style="padding:5px;font-weight:bold;width:480px;float:left;">If Yes, please indicate the areas of disability, impairment or long-term condition: </div>
			<div style="padding:5px 20px;line-height:20px;float:left;">
            @foreach ($disability_types as $disabilityType)
                    <input type="checkbox" name="area_of_disability[]" value="{{$disabilityType->type}}" {{ in_array($disabilityType->type, $selectedDisability) ? 'checked' : '' }}>
                    <label>{{$disabilityType->type}}</label><br>
                    @endforeach
		</div>
		<div style="clear:both;height:10px;"></div>
				<div id="medicalnote" style="padding:0px 20px;">
			<div style="padding:5px;font-weight:bold;width:480px;float:left;">Medical Note: </div>
 			<textarea class="form_control" name="medical_note" id="medical_note" style="width:200px; height:100px;"></textarea>
    </div>
		    <div style="clear:both;height:30px;"></div>
		<div align="center">
			<button type="submit" class="btn btn-primary" style="margin:0px 5px;">Save</button>
			<button type="button" class="btn btn-primary" style="margin:0px 5px;" onclick="unsaved=true;editDisability(514361, 'view');">Cancel</button>
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