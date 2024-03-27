<div class="card-block" id="deleteRoutine-{{ $row->id }}">
      <div class="row">
            @isset($row)
            <input type="text" name="routine_id[]" value="{{ $row->id }}" hidden>
            <input type="checkbox" id="delete_routine-{{ $row->id }}" name="delete_routine[]" value="{{ $row->id }}" hidden>
            @endisset

            <div class="form-group col-md-2">
                  <label for="subject">Subject <span>*</span></label>
                  <select class="form-control select2" name="subject[]" id="subject" required>
                        <option value="">Select</option>
                        @foreach( $subjects as $subject )
                        <option value="{{ $subject->id }}" @isset($row) {{ $row->subject_id == $subject->id ? 'selected' : '' }} @endisset>{{ $subject->code }} - {{ $subject->title }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                 Suject Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="teacher">Teacher <span>*</span></label>
                  <select class="form-control select2" name="teacher[]" id="teacher" required>
                        <option value="">Select</option>
                        @foreach( $teachers as $teacher )
                        <option value="{{ $teacher->id }}" @isset($row) {{ $row->teacher_id == $teacher->id ? 'selected' : '' }} @endisset>{{ $teacher->staff_id }} - {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                  Teacher Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="room">Room No <span>*</span></label>
                  <select class="form-control select2" name="room[]" id="room" required>
                        <option value="">{{ __('select') }}</option>
                        @foreach( $rooms as $room )
                        <option value="{{ $room->id }}" @isset($row) {{ $row->room_id == $room->id ? 'selected' : '' }} @endisset>{{ $room->title }}</option>
                        @endforeach
                  </select>

                  <div class="invalid-feedback">
                  Room No Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="start_time">Time From <span>*</span></label>
                  <input type="time" class="form-control time" name="start_time[]" id="start_time" value="{{ $row->start_time }}" required>

                  <div class="invalid-feedback">
                  Time From Required
                  </div>
            </div>
            <div class="form-group col-md-2">
                  <label for="end_time">Time To <span>*</span></label>
                  <input type="time" class="form-control time" name="end_time[]" id="end_time" value="{{ $row->end_time }}" required>

                  <div class="invalid-feedback">
                  Time To Required
                  </div>
            </div>
            
            @isset($row)
            <div class="form-group col-md-2">
                  <div class="btn btn-danger btn-filter" onclick="deleteRoutine({{ $row->id }})">
                        <span><i class="fas fa-trash-alt"></i> Remove</span>
                  </div>
            </div>
            @endisset
      </div>
</div>
