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
@foreach ($employment as $employ)
    <form name="edit_employment_frm" id="edit_employment_frm" method="post" action="{{ route('update-employmentdetail', $employ->student_id ) }}">
    @csrf
    <input name="student_id" value="{{$employ->student_id}}" hidden>
        <div style="float:left;padding-left:150px;">
            <div style="padding:5px;width:320px;font-weight:bold;float:left;">Employment</div>
            <div style="padding:0px 20px;float:left;"> 
                <div style="padding:2px 0px;">
                                <div style="padding:2px 0px;">
								    <input type="radio" style="margin-right:4px;" name="labour_status" value="01" {{ $employ->labour_status == 1 ? 'checked' : '' }} >Full-time employee
                                    </div>
                                    <div style="padding:2px 0px;">
								    <input type="radio" style="margin-right:4px;" name="labour_status" value="02" {{ $employ->labour_status == 2 ? 'checked' : '' }} >Part-time employee
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="03" {{ $employ->labour_status == 3 ? 'checked' : '' }} >Self-employed - not employing others
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="04" {{ $employ->labour_status == 4 ? 'checked' : '' }} >Employer
                                    </div>
                                        <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="05" {{ $employ->labour_status == 5 ? 'checked' : '' }} >Employed - unpaid worker in family business
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="06" {{ $employ->labour_status == 6 ? 'checked' : '' }} >Unemployed - seeking full-time work
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="07" {{ $employ->labour_status == 7 ? 'checked' : '' }} >Unemployed seeking part-time work
                                    </div>
                                    <div style="padding:2px 0px;">
                                        <input type="radio" style="margin-right:4px;" name="labour_status" value="08" {{ $employ->labour_status == 8 ? 'checked' : '' }} >Not employed - not seeking employment
                                    </div>
                                </div>
            <div style="clear:both;"></div>
        </div>
 		<div style="clear:both; height:20px;"></div>
		<div style="float:left;padding-left:150px;">
            <div style="padding:5px;width:320px;font-weight:bold;float:left;">Industry of Employment</div>
            <div style="padding:0px 20px;float:left;"> 
            <select class="form-control" name="industryofemploymentid" id="industryofemploymentid"  style="width:320px;">
                                <option value="">Select</option>
                                <option value="A" {{ $employ->industryofemploymentid == 'A' ? 'selected' : '' }}>Agriculture, Forestry and Fishing</option>
                                <option value="B" {{ $employ->industryofemploymentid == 'B' ? 'selected' : '' }}>Mining</option>
                                <option value="C" {{ $employ->industryofemploymentid == 'C' ? 'selected' : '' }}>Manufacturing</option>
                                <option value="D" {{ $employ->industryofemploymentid == 'D' ? 'selected' : '' }}>Electricity, Gas, Water and Waste Services</option>
                                <option value="E" {{ $employ->industryofemploymentid == 'E' ? 'selected' : '' }}>Construction</option>
                                <option value="F" {{ $employ->industryofemploymentid == 'F' ? 'selected' : '' }}>Wholesale Trade</option>
                                <option value="G" {{ $employ->industryofemploymentid == 'G' ? 'selected' : '' }}>Retail Trade</option>
                                <option value="H" {{ $employ->industryofemploymentid == 'H' ? 'selected' : '' }}>Accommodation and Food Services</option>
                                <option value="I" {{ $employ->industryofemploymentid == 'I' ? 'selected' : '' }}>Transport, Postal and Warehousing</option>
                                <option value="J" {{ $employ->industryofemploymentid == 'J' ? 'selected' : '' }}>Information Media and Telecommunications</option>
                                <option value="K" {{ $employ->industryofemploymentid == 'K' ? 'selected' : '' }}>Financial and Insurance Services</option>
                                <option value="L" {{ $employ->industryofemploymentid == 'L' ? 'selected' : '' }}>Rental, Hiring and Real Estate Services</option>
                                <option value="M" {{ $employ->industryofemploymentid == 'M' ? 'selected' : '' }}>Professional, Scientific and Technical Services</option>
                                <option value="N" {{ $employ->industryofemploymentid == 'N' ? 'selected' : '' }}>Administrative and Support Services</option>
                                <option value="O" {{ $employ->industryofemploymentid == 'O' ? 'selected' : '' }}>Public Administration and Safety</option>
                                <option value="P" {{ $employ->industryofemploymentid == 'P' ? 'selected' : '' }}>Education and Training</option>
                                <option value="Q" {{ $employ->industryofemploymentid == 'Q' ? 'selected' : '' }}>Health Care and Social Assistance</option>
                                <option value="R" {{ $employ->industryofemploymentid == 'R' ? 'selected' : '' }}>Arts and Recreation Services</option>
                                <option value="S" {{ $employ->industryofemploymentid == 'S' ? 'selected' : '' }}>Other Services</option>				
                            </select>
            </div>
            <div style="clear:both;"></div>
        </div>
 		<div style="clear:both; height:20px;"></div>
		<div style="float:left;padding-left:150px;">
            <div style="padding:5px;width:320px;font-weight:bold;float:left;">Occupation Identifier</div>
            <div style="padding:0px 20px;float:left;"> 
                        <select class="form-control" name="occupationidentifierid" id="occupationidentifierid"  style="width:320px;">
                            <option value="">Select</option>
                            <option value="1" {{ $employ->occupationidentifierid == 1 ? 'selected' : '' }}>Manager</option>
                            <option value="2" {{ $employ->occupationidentifierid == 2 ? 'selected' : '' }}>Professionals</option>
                            <option value="3" {{ $employ->occupationidentifierid == 3 ? 'selected' : '' }}>Technicians and Trades Workers</option>
                            <option value="4" {{ $employ->occupationidentifierid == 4 ? 'selected' : '' }}>Community and Personal Service Workers</option>
                            <option value="5" {{ $employ->occupationidentifierid == 5 ? 'selected' : '' }}>Clerical and Administrative Workers</option>
                            <option value="6" {{ $employ->occupationidentifierid == 6 ? 'selected' : '' }}>Sales Workers</option>
                            <option value="7" {{ $employ->occupationidentifierid == 7 ? 'selected' : '' }}>Machinery Operators and Drivers</option>
                            <option value="8" {{ $employ->occupationidentifierid == 8 ? 'selected' : '' }}>Labourer’s</option>
                            <option value="9" {{ $employ->occupationidentifierid == 9 ? 'selected' : '' }}>Other</option>				
                        </select>
            </div>
            <div style="clear:both;"></div>
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