@csrf
<div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Member</label>
    <select name="user_id" class="form-select" required>
      @foreach($members as $m)
        <option value="{{ $m->user_id }}" @selected(old('user_id', $attendance->user_id ?? '') == $m->user_id)>
          {{ $m->nama }} — {{ $m->email }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label">Date</label>
    <input type="date" name="attendance_date" class="form-control"
           value="{{ old('attendance_date', isset($attendance)?$attendance->attendance_date->format('Y-m-d'):'') }}" required>
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
      @foreach(['present','absent','late'] as $st)
        <option value="{{ $st }}" @selected(old('status', $attendance->status ?? 'present') === $st)>
          {{ ucfirst($st) }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6 mb-3">
    <label class="form-label">Class (optional)</label>
    <select name="class_schedule_id" class="form-select">
      <option value="">— None —</option>
      @foreach($schedules as $s)
        <option value="{{ $s->id }}" @selected(old('class_schedule_id', $attendance->class_schedule_id ?? '') == $s->id)>
          {{ $s->class_name }} — {{ \Illuminate\Support\Carbon::parse($s->class_date)->format('d M Y') }}
          ({{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }})
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label">Check-in</label>
    <input type="datetime-local" name="check_in_at" class="form-control"
           value="{{ old('check_in_at', isset($attendance)&&$attendance->check_in_at ? $attendance->check_in_at->format('Y-m-d\TH:i') : '') }}">
  </div>

  <div class="col-md-3 mb-3">
    <label class="form-label">Check-out</label>
    <input type="datetime-local" name="check_out_at" class="form-control"
           value="{{ old('check_out_at', isset($attendance)&&$attendance->check_out_at ? $attendance->check_out_at->format('Y-m-d\TH:i') : '') }}">
  </div>

  <div class="col-12 mb-3">
    <label class="form-label">Notes</label>
    <input name="notes" class="form-control" value="{{ old('notes', $attendance->notes ?? '') }}">
  </div>
</div>
