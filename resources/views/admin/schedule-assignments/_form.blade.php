@csrf
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Class Name</label>
        <input name="class_name" class="input-dark w-full" value="{{ old('class_name', $schedule->class_name ?? '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Date</label>
        <input type="date" name="class_date" class="input-dark w-full" value="{{ old('class_date', isset($schedule) ? $schedule->class_date->format('Y-m-d') : '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Room</label>
        <input name="room" class="input-dark w-full" value="{{ old('room', $schedule->room ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">Start</label>
        <input type="time" name="start_time" class="input-dark w-full" value="{{ old('start_time', isset($schedule) ? $schedule->start_time->format('H:i') : '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-400 mb-2">End</label>
        <input type="time" name="end_time" class="input-dark w-full" value="{{ old('end_time', isset($schedule) ? $schedule->end_time->format('H:i') : '') }}" required>
    </div>
</div>
