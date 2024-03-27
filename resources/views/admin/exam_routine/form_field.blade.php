<div class="form-group col-md-3">
      <label for="subject">Subject <span>*</span></label>
      <select class="form-control select2" name="subject" id="subject" required>
            <option value="">Select</option>
            @foreach( $subjects as $subject )
            <option value="{{ $subject->id }}" @if(old('subject') == $subject->id) selected @endif>{{ $subject->code }} - {{ $subject->title }}</option>
            @endforeach
      </select>

      <div class="invalid-feedback">
      Required Subject
      </div>
</div>
<div class="form-group col-md-3">
      <label for="teachers">Teacher <span>*</span></label>
      <select class="form-control select2" name="teachers[]" id="teachers" multiple required>
            @foreach( $teachers as $teacher )
            <option value="{{ $teacher->id }}" @if(old('teacher') == $teacher->id) selected @endif>{{ $teacher->staff_id }} - {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
            @endforeach
      </select>

      <div class="invalid-feedback">
      Required Teacher
      </div>
</div>
<div class="form-group col-md-3">
      <label for="rooms">Room No <span>*</span></label>
      <select class="form-control select2" name="rooms[]" id="rooms" multiple required>
            @foreach( $rooms as $room )
            <option value="{{ $room->id }}" @if(old('room') == $room->id) selected @endif>{{ $room->title }}</option>
            @endforeach
      </select>

      <div class="invalid-feedback">
      Required Room No
      </div>
</div>
<div class="form-group col-md-3">
      <label for="date">Date <span>*</span></label>
      <input type="date" class="form-control date" name="date" id="date" required>

      <div class="invalid-feedback">
     Required Date
      </div>
</div>
<div class="form-group col-md-3">
      <label for="start_time">Time From<span>*</span></label>
      <input type="time" class="form-control time" name="start_time" id="start_time" required>

      <div class="invalid-feedback">
      Required Time From
      </div>
</div>
<div class="form-group col-md-3">
      <label for="end_time">Time To<span>*</span></label>
      <input type="time" class="form-control time" name="end_time" id="end_time" required>

      <div class="invalid-feedback">
      Required Time To
      </div>
</div>