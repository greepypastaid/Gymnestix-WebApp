@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">Equipment Details</h1>
                    <p class="text-gray-400 mt-1">View equipment information</p>
                </div>
                <a href="{{ route('admin.equipment.index') }}" class="bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        {{-- Equipment Details --}}
        <div class="card-dark p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Equipment Name</label>
                    <p class="text-white">{{ $row->nama_alat }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Condition</label>
                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-lg {{ $row->kondisi == 'baik' ? 'bg-[#ADFF2F]/20 text-[#ADFF2F]' : ($row->kondisi == 'rusak' ? 'bg-red-500/20 text-red-400' : 'bg-[#1f1f1f] text-gray-400') }}">
                        {{ ucfirst($row->kondisi ?: '—') }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Purchase Date</label>
                    <p class="text-white">{{ $row->tanggal_pembelian?->format('d M Y') ?? '—' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Maintenance Schedule</label>
                    <p class="text-white">{{ $row->jadwal_perawatan?->format('d M Y') ?? '—' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Total Borrowings</label>
                    <p class="text-white">{{ $row->peminjamans_count ?? 0 }} times</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Created At</label>
                    <p class="text-white">{{ $row->created_at?->format('d M Y H:i') ?? '—' }}</p>
                </div>
            </div>

            {{-- Action Buttons --}}
            @can('equipment.manage')
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-[#2a2a2a]">
                <a href="{{ route('admin.equipment.edit', $row->equipment_id) }}" class="btn-primary-custom px-6 py-2.5 rounded-lg font-medium flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit Equipment</span>
                </a>
                <form action="{{ route('admin.equipment.destroy', $row->equipment_id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this equipment?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full px-6 py-2.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg font-medium flex items-center justify-center gap-2 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <span>Delete Equipment</span>
                    </button>
                </form>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
