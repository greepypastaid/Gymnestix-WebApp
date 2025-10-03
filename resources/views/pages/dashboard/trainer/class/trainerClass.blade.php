<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Classes</h2></x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        <div class="mb-4">
            @if(session('success'))<div class="text-green-600">{{ session('success') }}</div>@endif
            @if(auth()->user()->hasPermission('schedule.create_limited'))
                <a href="{{ route('trainer.classes.create') }}" class="px-3 py-1 bg-blue-600 text-white rounded">Create class</a>
            @endif
        </div>

        @if($classes->count())
            <table class="w-full table-auto border">
                <thead><tr class="bg-gray-100"><th class="p-2">Name</th><th class="p-2">Trainer</th><th class="p-2">Start</th><th class="p-2">Actions</th></tr></thead>
                <tbody>
                @foreach($classes as $c)
                    <tr>
                        <td class="p-2">{{ $c->nama_kelas }}</td>
                        <td class="p-2">{{ $c->trainer->user->nama ?? '-' }}</td>
                        <td class="p-2">{{ $c->waktu_mulai }} - {{ $c->waktu_selesai }}</td>
                        <td class="p-2">
                            @if(auth()->user()->hasPermission('schedule.create_limited'))
                                <a href="{{ route('trainer.classes.edit', $c) }}" class="text-blue-600">Edit</a>
                                <form action="{{ route('trainer.classes.destroy', $c) }}" method="POST" class="inline">@csrf @method('DELETE')<button class="text-red-600 ms-2">Delete</button></form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $classes->links() }}</div>
        @else
            <p>No classes yet.</p>
        @endif
    </div>
</x-app-layout>