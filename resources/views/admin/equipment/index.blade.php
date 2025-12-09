@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
              <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            <div>
              <div class="title">Equipment Management</div>
              <div class="subtitle">Manage gym equipment data</div>
            </div>
          </div>
          <div class="ml-auto">
            @can('equipment.manage')
            <a href="{{ route('admin.equipment.create') }}" class="btn-primary-custom px-4 py-2 rounded-lg font-medium flex items-center justify-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              <span>Add Equipment</span>
            </a>
            @endcan
          </div>
        </div>

        @if(session('ok'))
        <div class="card-dark mb-6 p-4 border-l-4 border-[#ADFF2F]">
            <p class="text-white">{{ session('ok') }}</p>
        </div>
        @endif

        {{-- Filter --}}
        <div class="card-dark p-6 mb-6">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-400">Filters</span>
            </div>
            <form method="GET" action="{{ route('admin.equipment.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Search</label>
                    <input type="text" name="q" class="input-dark w-full" value="{{ $q ?? '' }}" placeholder="Equipment name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Condition</label>
                    <input type="text" name="kondisi" class="input-dark w-full" value="{{ $kondisi ?? '' }}" placeholder="e.g. good">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Purchase Date From</label>
                    <input type="date" name="from" class="input-dark w-full" value="{{ $dateFrom ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Purchase Date To</label>
                    <input type="date" name="to" class="input-dark w-full" value="{{ $dateTo ?? '' }}">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white px-4 py-2 rounded-lg font-medium flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span>Apply</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Table / Mobile List --}}
        <div class="card-dark overflow-hidden">
          <!-- Mobile: list cards -->
          <div class="md:hidden p-4 space-y-3">
            @forelse($rows as $r)
              <div class="card-dark p-4">
                <div class="flex items-center justify-between mb-3">
                  <div>
                    <div class="text-sm font-semibold text-white">{{ $r->nama_alat }}</div>
                    <div class="text-xs text-gray-400 mt-1">{{ $r->tanggal_pembelian?->format('d M Y') ?? '—' }}</div>
                  </div>
                  <div>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-lg {{ $r->kondisi == 'baik' ? 'bg-[#ADFF2F]/20 text-[#ADFF2F]' : ($r->kondisi == 'rusak' ? 'bg-red-500/20 text-red-400' : 'bg-[#1f1f1f] text-gray-400') }}">{{ $r->kondisi ?: '—' }}</span>
                  </div>
                </div>
                <div class="flex gap-2">
                  @can('equipment.manage')
                    <a href="{{ route('admin.equipment.edit', $r->equipment_id) }}" class="flex-1 text-center px-3 py-2 btn-primary-custom rounded-lg text-sm font-medium">Edit</a>
                    <form action="{{ route('admin.equipment.destroy', $r->equipment_id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this equipment?')" class="flex-1">
                      @csrf @method('DELETE')
                      <button type="submit" class="w-full px-3 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg text-sm font-medium transition-all">Delete</button>
                    </form>
                  @else
                    <span class="text-gray-400 text-xs">No actions</span>
                  @endcan
                </div>
              </div>
            @empty
              <div class="p-8 text-center text-gray-400">No equipment found</div>
            @endforelse
          </div>

            <!-- Desktop: table -->
            <div class="hidden md:block overflow-x-auto">
            <table class="table-minimal">
                <thead>
                  <tr>
                    <th>Equipment Name</th>
                    <th>Condition</th>
                    <th>Purchase Date</th>
                    <th>Maintenance Schedule</th>
                    <th>Borrowings</th>
                    <th class="text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
            @forelse($rows as $r)
            <tr class="hover:bg-neutral-700/20 transition duration-150">
              <td>
                <div class="text-sm font-medium text-white">{{ $r->nama_alat }}</div>
              </td>
              <td>
                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-lg {{ $r->kondisi == 'baik' ? 'bg-[#ADFF2F]/20 text-[#ADFF2F]' : ($r->kondisi == 'rusak' ? 'bg-red-500/20 text-red-400' : 'bg-[#1f1f1f] text-gray-400') }}">
                  {{ $r->kondisi ?: '—' }}
                </span>
              </td>
              <td class="muted">
                {{ $r->tanggal_pembelian?->format('d M Y') ?? '—' }}
              </td>
              <td class="muted">
                {{ $r->jadwal_perawatan?->format('d M Y') ?? '—' }}
              </td>
              <td>
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-[#1f1f1f] text-gray-400">
                    {{ $r->peminjamans_count ?? 0 }} borrows
                </span>
              </td>
              <td class="text-right">
                @can('equipment.manage')
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('admin.equipment.edit', $r->equipment_id) }}" class="btn-primary-custom inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-lg transition-all">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                  </a>
                  <form action="{{ route('admin.equipment.destroy', $r->equipment_id) }}" method="post" class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this equipment?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs font-medium rounded-lg transition-all">
                      <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                      Delete
                    </button>
                  </form>
                </div>
                @else
                <span class="text-gray-400 text-sm">No actions</span>
                @endcan
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-6 py-16 text-center">
                <div class="flex flex-col items-center">
                  <svg class="w-16 h-16 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m8-5v2m0 0v2m0-2h2m-2 0h-2"></path>
                  </svg>
                  <h3 class="text-lg font-semibold text-white mb-1">No equipment found</h3>
                  <p class="text-gray-400 mb-6">Get started by adding your first equipment.</p>
                  @can('equipment.manage')
                  <a href="{{ route('admin.equipment.create') }}" class="btn-primary-custom inline-flex items-center px-6 py-2.5 font-medium rounded-lg">
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
                <div class="px-6 py-4 border-t border-[#2a2a2a]">
                    {{ $rows->links() }}
                </div>
            @endif
    </div>
  </div>
</div>
@endsection