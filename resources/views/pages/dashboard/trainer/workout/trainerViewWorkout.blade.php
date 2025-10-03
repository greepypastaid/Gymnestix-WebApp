<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Workouts for {{ $member->user->nama ?? 'Member' }}</h2></x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if($progresses->count())
            <table class="w-full table-auto border">
                <thead><tr class="bg-gray-100"><th class="p-2">Tanggal</th><th class="p-2">Jenis</th><th class="p-2">Repetisi</th><th class="p-2">Durasi</th><th class="p-2">Berat</th></tr></thead>
                <tbody>
                @foreach($progresses as $p)
                    <tr>
                        <td class="p-2">{{ $p->tanggal->format('Y-m-d') }}</td>
                        <td class="p-2">{{ $p->jenis_latihan }}</td>
                        <td class="p-2">{{ $p->catatan_repetisi }}</td>
                        <td class="p-2">{{ $p->catatan_durasi }}</td>
                        <td class="p-2">{{ $p->catatan_berat }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No workout progress for this member.</p>
        @endif
    </div>
</x-app-layout>