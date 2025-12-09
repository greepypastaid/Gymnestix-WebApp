@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background: rgba(173,255,47,0.08); color:#ADFF2F;">
                    <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Record Attendance</div>
                    <div class="subtitle">Add new attendance record</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.attendance.index') }}" class="w-full sm:w-auto px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center justify-center space-x-2 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-500/30">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form method="post" action="{{ route('admin.attendance.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Member</label>
                        <select name="user_id" class="input-dark w-full" required>
                            @foreach($members as $m)
                                <option value="{{ $m->user_id }}" @selected(old('user_id') == $m->user_id)>
                                    {{ $m->nama }} — {{ $m->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Date</label>
                        <input type="date" name="attendance_date" class="input-dark w-full" value="{{ old('attendance_date') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Status</label>
                        <select name="status" class="input-dark w-full" required>
                            @foreach(['present','absent','late'] as $st)
                                <option value="{{ $st }}" @selected(old('status', 'present') === $st)>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Check-in</label>
                        <input type="datetime-local" name="check_in_at" class="input-dark w-full" value="{{ old('check_in_at') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Check-out</label>
                        <input type="datetime-local" name="check_out_at" class="input-dark w-full" value="{{ old('check_out_at') }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white mb-2">Class (optional)</label>
                    <select name="class_schedule_id" class="input-dark w-full">
                        <option value="">— None —</option>
                        @if(!empty($classes) && (is_array($classes) || $classes instanceof \Illuminate\Support\Collection))
                            <optgroup label="Classes">
                                @foreach($classes as $c)
                                    <option value="class:{{ $c->class_id }}" @selected(old('class_schedule_id') == 'class:'.$c->class_id)>
                                        {{ $c->nama_kelas }} — {{ \Illuminate\Support\Carbon::parse($c->waktu_mulai)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($c->waktu_selesai)->format('H:i') }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif

                        @if(!empty($schedules) && (is_array($schedules) || $schedules instanceof \Illuminate\Support\Collection))
                            <optgroup label="Schedules">
                                @foreach($schedules as $s)
                                    <option value="schedule:{{ $s->id }}" @selected(old('class_schedule_id') == 'schedule:'.$s->id)>
                                        {{ $s->class_name }}
                                        ({{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }})
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                    <p class="text-xs text-neutral-400 mt-2">If you select a Class (from Classes), it will be recorded as a class reference; selecting a Schedule links to a specific scheduled session.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white mb-2">Notes</label>
                    <input name="notes" class="input-dark w-full" value="{{ old('notes') }}" placeholder="Additional notes">
                </div>

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                    <button type="submit" class="btn-primary-custom inline-flex items-center gap-2 px-6 py-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Save Attendance</span>
                    </button>
                    <a href="{{ route('admin.attendance.index') }}" class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200 w-full sm:w-auto text-center">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
