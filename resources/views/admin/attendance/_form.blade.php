@csrf
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Member</label>
        <select name="user_id" class="input-dark w-full" required>
            @foreach($members as $m)
                <option value="{{ $m->user_id }}" @selected(old('user_id', $attendance->user_id ?? '') == $m->user_id)>
                    {{ $m->nama }} — {{ $m->email }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Date</label>
        <input type="date" name="attendance_date" class="input-dark w-full"
               value="{{ old('attendance_date', isset($attendance)?$attendance->attendance_date->format('Y-m-d'):'') }}" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
        <select name="status" class="input-dark w-full" required>
            @foreach(['present','absent','late'] as $st)
                <option value="{{ $st }}" @selected(old('status', $attendance->status ?? 'present') === $st)>
                    {{ ucfirst($st) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-gray-400 mb-2">Class (optional)</label>
        <select name="class_schedule_id" class="input-dark w-full">
            <option value="">— None —</option>
            @foreach($schedules as $s)
                <option value="{{ $s->id }}" @selected(old('class_schedule_id', $attendance->class_schedule_id ?? '') == $s->id)>
                    {{ $s->class_name }} — {{ \Illuminate\Support\Carbon::parse($s->class_date)->format('d M Y') }}
                    ({{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Check-in</label>
        <input type="datetime-local" name="check_in_at" class="input-dark w-full"
               value="{{ old('check_in_at', isset($attendance)&&$attendance->check_in_at ? $attendance->check_in_at->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Check-out</label>
        <input type="datetime-local" name="check_out_at" class="input-dark w-full"
               value="{{ old('check_out_at', isset($attendance)&&$attendance->check_out_at ? $attendance->check_out_at->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-gray-400 mb-2">Notes</label>
        <input name="notes" class="input-dark w-full" value="{{ old('notes', $attendance->notes ?? '') }}">
    </div>
</div>

<div class="flex items-center gap-4 pt-6">
    <button type="submit" class="btn-primary-custom flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        {{ isset($attendance) ? 'Update' : 'Create' }} Attendance
    </button>
    <a href="{{ route('admin.attendance.index') }}" class="px-6 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition">Cancel</a>
</div>
