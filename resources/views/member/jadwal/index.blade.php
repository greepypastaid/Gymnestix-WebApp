@extends('landing_page.layouts.app')

@section('title', 'Jadwalku')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 my-10">

    <h1 class="text-2xl sm:text-3xl font-bold text-white mb-6">
        Jadwal Kelas – {{ $month->translatedFormat('F Y') }}
    </h1>

    {{-- Kalender --}}
    <div class="grid grid-cols-7 gap-2 sm:gap-4 text-center text-xs sm:text-sm font-semibold text-gray-300 mb-4">
        <div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div><div>Min</div>
    </div>

    @php
        $start = $month->copy()->startOfMonth()->startOfWeek();
        $end   = $month->copy()->endOfMonth()->endOfWeek();
        $period = \Carbon\CarbonPeriod::create($start, $end);
        $eventsByDate = collect($events)->groupBy('date');
    @endphp

    <div class="grid grid-cols-7 gap-2 sm:gap-3">
        @foreach ($period as $day)
            <div class="border border-[#2a2a2a] rounded-lg p-1.5 sm:p-3 {{ $day->isCurrentDay() ? 'bg-[#ADFF2F]/20 border-[#ADFF2F]' : 'bg-[#1f1f1f]' }}">
                
                <div class="text-xs sm:text-sm font-semibold {{ $day->month !== $month->month ? 'text-gray-500' : 'text-white' }}">
                    {{ $day->format('d') }}
                </div>

                {{-- Event / Kelas --}}
                @if ($eventsByDate->has($day->format('Y-m-d')))
                    @foreach ($eventsByDate[$day->format('Y-m-d')] as $event)
                        <div class="mt-2 p-2 bg-[#ADFF2F]/20 text-[#ADFF2F] rounded-md text-xs text-left border border-[#ADFF2F]/30">
                            <strong>{{ $event['class']->nama_kelas }}</strong><br>
                            {{ \Carbon\Carbon::parse($event['class']->waktu_mulai)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($event['class']->waktu_selesai)->format('H:i') }}
                        </div>
                    @endforeach
                @endif
            
            </div>
        @endforeach
    </div>

</div>
@endsection
