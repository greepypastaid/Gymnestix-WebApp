@csrf
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium text-white mb-2">Member</label>
        <select name="user_id" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            @foreach($members as $m)
                <option value="{{ $m->user_id }}" @selected(old('user_id', $attendance->user_id ?? '') == $m->user_id)>
                    {{ $m->nama }} — {{ $m->email }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-white mb-2">Date</label>
        <input type="date" name="attendance_date" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
               value="{{ old('attendance_date', isset($attendance)?$attendance->attendance_date->format('Y-m-d'):'') }}" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-white mb-2">Status</label>
        <select name="status" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            @foreach(['present','absent','late'] as $st)
                <option value="{{ $st }}" @selected(old('status', $attendance->status ?? 'present') === $st)>
                    {{ ucfirst($st) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-white mb-2">Class (optional)</label>
        <select name="class_schedule_id" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
        <label class="block text-sm font-medium text-white mb-2">Check-in</label>
        <input type="datetime-local" name="check_in_at" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
               value="{{ old('check_in_at', isset($attendance)&&$attendance->check_in_at ? $attendance->check_in_at->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-white mb-2">Check-out</label>
        <input type="datetime-local" name="check_out_at" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
               value="{{ old('check_out_at', isset($attendance)&&$attendance->check_out_at ? $attendance->check_out_at->format('Y-m-d\TH:i') : '') }}">
    </div>

    <div class="md:col-span-2 lg:col-span-3">
        <label class="block text-sm font-medium text-white mb-2">Notes</label>
        <input name="notes" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('notes', $attendance->notes ?? '') }}">
    </div>
</div>
