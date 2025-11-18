@csrf
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium text-white mb-2">Class Name</label>
        <input name="class_name" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('class_name', $schedule->class_name ?? '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-white mb-2">Date</label>
        <input type="date" name="class_date" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('class_date', isset($schedule) ? $schedule->class_date->format('Y-m-d') : '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-white mb-2">Room</label>
        <input name="room" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('room', $schedule->room ?? '') }}">
    </div>
    <div>
        <label class="block text-sm font-medium text-white mb-2">Start</label>
        <input type="time" name="start_time" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('start_time', isset($schedule) ? $schedule->start_time->format('H:i') : '') }}" required>
    </div>
    <div>
        <label class="block text-sm font-medium text-white mb-2">End</label>
        <input type="time" name="end_time" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ old('end_time', isset($schedule) ? $schedule->end_time->format('H:i') : '') }}" required>
    </div>
</div>
