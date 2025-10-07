<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Permissions
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <a href="{{ route('permissions.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md">
                        + Tambah Permission
                    </a>
                    @if(session('success'))
                        <div class="text-green-600 font-medium">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <table class="min-w-full border text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Display Name</th>
                            <th class="px-4 py-2 border">Group</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ $permission->name }}</td>
                            <td class="border px-4 py-2">{{ $permission->display_name }}</td>
                            <td class="border px-4 py-2">{{ $permission->group ?? '-' }}</td>
                            <td class="border px-4 py-2">
                                <span class="px-2 py-1 text-xs font-semibold rounded-md 
                                    {{ $permission->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $permission->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('permissions.edit', $permission->id) }}" 
                                   class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md mr-2">
                                   Edit
                                </a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md"
                                        onclick="return confirm('Yakin ingin hapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
