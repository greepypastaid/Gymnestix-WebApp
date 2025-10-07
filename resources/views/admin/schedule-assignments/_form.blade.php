@csrf
<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Class Name</label>
    <input name="class_name" class="form-control" value="{{ old('class_name', $schedule->class_name ?? '') }}" required>
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Date</label>
    <input type="date" name="class_date" class="form-control" value="{{ old('class_date', isset($schedule) ? $schedule->class_date->format('Y-m-d') : '') }}" required>
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Room</label>
    <input name="room" class="form-control" value="{{ old('room', $schedule->room ?? '') }}">
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">Start</label>
    <input type="time" name="start_time" class="form-control" value="{{ old('start_time', isset($schedule) ? $schedule->start_time->format('H:i') : '') }}" required>
  </div>
  <div class="col-md-3 mb-3">
    <label class="form-label">End</label>
    <input type="time" name="end_time" class="form-control" value="{{ old('end_time', isset($schedule) ? $schedule->end_time->format('H:i') : '') }}" required>
  </div>
</div>
