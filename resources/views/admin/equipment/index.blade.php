@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center" style="color:#ADFF2F;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Equipment Management</h1>
                        <p class="text-neutral-400">Manage gym equipment data</p>
                    </div>
                </div>
                @can('equipment.manage')
                <a href="{{ route('admin.equipment.create') }}" class="px-4 py-2 rounded-lg font-medium flex items-center space-x-2 text-black" style="background-color:#ADFF2F;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add Equipment</span>
                </a>
                @endcan
            </div>
        </div>

        @if(session('ok'))
        <div class="mb-4 p-3 rounded-md text-black" style="background-color:#ADFF2F;">
            {{ session('ok') }}
        </div>
        @endif

        {{-- Filter --}}
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6 ">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-neutral-400 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <span class="text-sm font-medium text-neutral-400">Filters</span>
            </div>
            <form method="GET" action="{{ route('admin.equipment.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="q" class="block w-full pl-10 pr-3 py-2 border border-neutral-600 rounded-lg bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ $q ?? '' }}" placeholder="Equipment name">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Condition</label>
                    <input type="text" name="kondisi" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ $kondisi ?? '' }}" placeholder="e.g. good">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Purchase Date From</label>
                    <input type="date" name="from" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ $dateFrom ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Purchase Date To</label>
                    <input type="date" name="to" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ $dateTo ?? '' }}">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-neutral-600 hover:bg-neutral-500 text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center space-x-2 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span>Apply</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-neutral-800 shadow sm:rounded-lg overflow-hidden border border-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-600">
                    <thead class="bg-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">Equipment Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">Condition</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">Purchase Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">Maintenance Schedule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">Borrowings</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-neutral-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-neutral-800 divide-y divide-neutral-700/50">
            @forelse($rows as $r)
            <tr class="hover:bg-neutral-700/30 transition duration-200">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                        <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </div>
                    <div class="text-sm font-semibold text-white">{{ $r->nama_alat }}</div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $r->kondisi == 'baik' ? 'bg-[#ADFF2F] text-black' : ($r->kondisi == 'rusak' ? 'bg-red-600/90 text-white' : 'bg-neutral-700 text-neutral-300') }}">
                  {{ $r->kondisi ?: '—' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-300">
                {{ $r->tanggal_pembelian?->format('d M Y') ?? '—' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-300">
                {{ $r->jadwal_perawatan?->format('d M Y') ?? '—' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                    {{ $r->peminjamans_count ?? 0 }} borrows
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                @can('equipment.manage')
                <div class="flex items-center justify-end space-x-2">
                  <a href="{{ route('admin.equipment.edit', $r->equipment_id) }}" class="inline-flex items-center px-3 py-1.5 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-lg transition-all duration-200">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                  </a>
                  <form action="{{ route('admin.equipment.destroy', $r->equipment_id) }}" method="post" class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this equipment?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all duration-200">
                      <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Delete
                    </button>
                  </form>
                </div>
                @else
                <span class="text-neutral-500 text-sm">No actions</span>
                @endcan
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-6 py-16 text-center">
                <div class="flex flex-col items-center">
                  <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background: rgba(173,255,47,0.1);">
                    <svg class="w-8 h-8" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                    </svg>
                  </div>
                  <h3 class="text-xl font-bold text-white mb-2">No equipment found</h3>
                  <p class="text-neutral-400 mb-6">Get started by adding your first equipment.</p>
                  @can('equipment.manage')
                  <a href="{{ route('admin.equipment.create') }}" class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Add Equipment</span>
                  </a>
                  @endcan
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if($rows->hasPages())
      <div class="px-6 py-5 border-t border-neutral-700 bg-neutral-900/30">
        {{ $rows->links() }}
      </div>
      @endif
    </div>
  </div>
</div>
@endsection