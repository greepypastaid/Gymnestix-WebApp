<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Equipments</h2></x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        @if(session('success'))<div class="text-green-600">{{ session('success') }}</div>@endif
        @if(auth()->user()->hasPermission('equipment.manage'))
            <a href="{{ route('trainer.equipments.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Create Equipment</a>
        @endif

        <div class="mt-4">
            @if($equipments->count())
                <table class="w-full table-auto border">
                    <thead><tr class="bg-gray-100"><th class="p-2">Nama</th><th class="p-2">Kondisi</th><th class="p-2">Beli</th><th class="p-2">Perawatan</th><th class="p-2">Actions</th></tr></thead>
                    <tbody>
                    @foreach($equipments as $e)
                        <tr>
                            <td class="p-2">{{ $e->nama_alat }}</td>
                            <td class="p-2">{{ $e->kondisi }}</td>
                            <td class="p-2">{{ $e->tanggal_pembelian?->format('Y-m-d') }}</td>
                            <td class="p-2">{{ $e->jadwal_perawatan?->format('Y-m-d') }}</td>
                            <td class="p-2">
                                @if(auth()->user()->hasPermission('equipment.manage'))
                                    <a href="{{ route('trainer.equipments.edit', $e) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('trainer.equipments.destroy', $e) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600 ms-2">Delete</button></form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">{{ $equipments->links() }}</div>
            @else
                <p>No equipments found.</p>
            @endif
        </div>
    </div>
</x-app-layout>