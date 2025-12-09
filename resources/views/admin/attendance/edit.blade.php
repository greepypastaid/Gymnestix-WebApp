@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        {{-- Header --}}
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Edit Attendance</div>
                    <div class="subtitle">Update attendance information</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.attendance.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        @if($errors->any())
        <div class="card-dark p-4 border-l-4 border-red-500">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach($errors->all() as $e)
                    <li class="text-sm">{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form method="post" action="{{ route('admin.attendance.update', $attendance) }}">
                @csrf 
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Member</label>
                        <select name="user_id" class="input-dark w-full" required>
                            @foreach($members as $m)
                                <option value="{{ $m->user_id }}" @selected(old('user_id', $attendance->user_id ?? '') == $m->user_id)>
                                    {{ $m->nama }} — {{ $m->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Date</label>
                        {{-- REVISI PENTING DI SINI: Pakai tanda tanya (?->) --}}
                           <input type="date" name="attendance_date" class="input-dark w-full" 
                               value="{{ old('attendance_date', $attendance->attendance_date?->format('Y-m-d') ?? '') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Status</label>
                        <select name="status" class="input-dark w-full" required>
                            @foreach(['present','absent','late'] as $st)
                                <option value="{{ $st }}" @selected(old('status', $attendance->status ?? 'present') === $st)>
                                    {{ ucfirst($st) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Check-in</label>
                        {{-- REVISI: Pakai tanda tanya (?->) --}}
                           <input type="datetime-local" name="check_in_at" class="input-dark w-full" 
                               value="{{ old('check_in_at', $attendance->check_in_at?->format('Y-m-d\TH:i') ?? '') }}">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Check-out</label>
                        {{-- REVISI: Pakai tanda tanya (?->) --}}
                           <input type="datetime-local" name="check_out_at" class="input-dark w-full" 
                               value="{{ old('check_out_at', $attendance->check_out_at?->format('Y-m-d\TH:i') ?? '') }}">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white mb-2">Class (optional)</label>
                    @php
                        $selected = old('class_schedule_id', ($attendance->class_id ? 'class:'.$attendance->class_id : ($attendance->class_schedule_id ? 'schedule:'.$attendance->class_schedule_id : '')));
                    @endphp
                    <select name="class_schedule_id" class="input-dark w-full">
                        <option value="">— None —</option>

                        @if(!empty($classes) && (is_array($classes) || $classes instanceof \Illuminate\Support\Collection))
                                <optgroup label="Classes">
                                    @foreach($classes as $c)
                                        <option value="class:{{ $c->class_id }}" @selected($selected == 'class:'.$c->class_id)>
                                            {{ $c->nama_kelas }} — {{ \Illuminate\Support\Carbon::parse($c->waktu_mulai)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($c->waktu_selesai)->format('H:i') }}
                                        </option>
                                    @endforeach
                                </optgroup>
                        @endif

                        @if(!empty($schedules) && (is_array($schedules) || $schedules instanceof \Illuminate\Support\Collection))
                                <optgroup label="Schedules">
                                    @foreach($schedules as $s)
                                        <option value="schedule:{{ $s->id }}" @selected($selected == 'schedule:'.$s->id)>
                                            {{ $s->class_name }}
                                            ({{ \Illuminate\Support\Carbon::parse($s->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($s->end_time)->format('H:i') }})
                                        </option>
                                    @endforeach
                                </optgroup>
                        @endif
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-white mb-2">Notes</label>
                    <input name="notes" class="input-dark w-full" value="{{ old('notes', $attendance->notes ?? '') }}" placeholder="Additional notes">
                </div>

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                    <button type="submit" class="btn-primary-custom w-full sm:w-auto flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Update Attendance</span>
                    </button>
                    <a href="{{ route('admin.attendance.index') }}" class="w-full sm:w-auto text-center px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection