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
@foreach ($schooling as $school)
  <form name="edit_schooling_frm" id="edit_schooling_frm" method="post" action="{{ route('update-studentschooling', $school->student_id ) }}">
  @csrf
    <input name="student_id" value="{{$school->student_id}}" hidden>
    <div style="float:left;padding-left:150px;">
      <!--new requirement-->
      <div style="padding:5px; width:400px;font-weight:bold;float:left">Still at school?</div>
      <div style="padding:0px 20px;float:left">
        <select class="form-control" name="still_schooling" id="still_schooling">
                <option value="0" {{ $school->still_schooling == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $school->still_schooling == 1 ? 'selected' : '' }}>Yes</option>
        </select>
      </div>
      <div style="height:20px;clear:both;"></div>
      <!--new requirement-->
      <div style="padding:5px;width:400px;font-weight:bold;float:left;">Highest school level completed?</div>
      <div style="padding:0px 20px;float:left;">
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="02" {{ $school->school_level == 2 ? 'checked' : '' }} > Did not go to school
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="08" {{ $school->school_level == 8 ? 'checked' : '' }} > Year 8 or below
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="09"{{ $school->school_level == 9 ? 'checked' : '' }} >Year 9 or equivalent
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="10" {{ $school->school_level == 10 ? 'checked' : '' }} >Completed Year 10
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="11" {{ $school->school_level == 11 ? 'checked' : '' }} >Completed Year 11
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="12" {{ $school->school_level == 12 ? 'checked' : '' }} >Completed Year 12
                    </div>
                    <div style="padding:2px 0px;">
                    <input class="checkbox" type="radio" style="margin-right:4px;" name="school_level" value="00" {{ $school->school_level == 0 ? 'checked' : '' }} >Not specified
                    </div> 
                    <br>     
      <div style="height:20px;clear:both;"></div>
      <div style="padding:5px;width:400px;font-weight:bold;float:left;">Year school level was completed</div>
      <div style="padding:0px 20px;float:left;">
        <div style="padding:2px 0px;">
            <input type="radio" style="margin-right:4px;" name="is_school_completed" id="is_school_completed_yes" value="1" {{ $school->is_school_completed == 1 ? 'checked' : '' }} > Yes
        </div>
        <div id="completion_year_input" style="display: {{ $school->is_school_completed == 1 ? 'block' : 'none' }}">
            <input class="form-control" type="text" name="school_completion_year" id="school_completion_year" value="{{ $school->school_completion_year }}" placeholder="Completion Year">
        </div>
        <br>
        <div style="padding:2px 0px;">
           <input type="radio" style="margin-right:4px;" name="is_school_completed" id="is_school_completed_no" value="0" {{ $school->is_school_completed == 0 ? 'checked' : '' }} > No
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
<script>
    // Get references to the radio buttons and the completion year input
    var isSchoolCompletedYes = document.getElementById('is_school_completed_yes');
    var isSchoolCompletedNo = document.getElementById('is_school_completed_no');
    var completionYearInput = document.getElementById('completion_year_input');

    // Add event listener to the radio buttons to toggle the visibility of the completion year input
    isSchoolCompletedYes.addEventListener('change', function() {
        if (this.checked) {
            completionYearInput.style.display = 'block';
        }
    });

    isSchoolCompletedNo.addEventListener('change', function() {
        if (this.checked) {
            completionYearInput.style.display = 'none';
        }
    });
</script>
@endsection