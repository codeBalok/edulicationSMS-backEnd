<div class="card-block" id="inputFormField">
      <div class="row">
            <div class="form-group col-md-2">
                  <label for="subject">Course <span>*</span></label>
                  <select class="form-control select2" name="subject[]" id="subject" required>
                        <option value="">Select</option>
                        @foreach( $subjects as $subject )
                        <option value="{{ $subject->id }}" @if(old('subject') == $subject->id) selected @endif>{{ $subject->code }} - {{ $subject->title }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                  Course Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="teacher">Teacher <span>*</span></label>
                  <select class="form-control select2" name="teacher[]" id="teacher" required>
                        <option value="">Select</option>
                        @foreach( $teachers as $teacher )
                        <option value="{{ $teacher->id }}" @if(old('teacher') == $teacher->id) selected @endif>{{ $teacher->staff_id }} - {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                  Teacher Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="room">Room No. <span>*</span></label>
                  <select class="form-control select2" name="room[]" id="room" required>
                        <option value="">Select</option>
                        @foreach( $rooms as $room )
                        <option value="{{ $room->id }}" @if(old('room') == $room->id) selected @endif>{{ $room->title }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                 Room No. Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="start_time">Time From<span>*</span></label>
                  <input type="time" class="form-control time" name="start_time[]" id="start_time" required>

                  <div class="invalid-feedback">
                  Time From Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="end_time">Time To <span>*</span></label>
                  <input type="time" class="form-control time" name="end_time[]" id="end_time" required>

                  <div class="invalid-feedback">
                  To Time Required
                  </div>
            </div>
            <div class="form-group col-md-2 mt-1 pt-1">
                  <button id="removeField" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Remove</button>
            </div>
      </div>
</div>