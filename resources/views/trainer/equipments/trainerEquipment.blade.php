@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
        <div class="w-full mx-auto space-y-6">
            @if(session('success'))
                <div class="card-dark p-4 border-l-4 border-[#ADFF2F]">
                    <p class="text-white font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="card-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                        <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a1 1 0 00-1-1h-3V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2H5a1 1 0 00-1 1v6"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="title">Equipment Overview</div>
                        <div class="subtitle">Monitor equipment status and report issues for maintenance</div>
                    </div>
                </div>
                <div class="ml-auto">
                    <!-- placeholder for actions if needed -->
                </div>
            </div>

            <!-- Search Bar -->
            <div class="card-dark p-4">
                <form method="GET" action="{{ route('trainer.equipments.index') }}" class="flex gap-3">
                    <div class="flex-1 relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by equipment name or condition..." class="input-dark w-full pl-10 pr-4 py-2.5">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <select name="kondisi" class="input-dark px-4 py-2.5 w-48">
                        <option value="">All Conditions</option>
                        <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    </select>
                    <button type="submit" class="btn-primary-custom px-6">Search</button>
                    @if(request('search') || request('kondisi'))
                        <a href="{{ route('trainer.equipments.index') }}" class="btn-secondary px-6">Clear</a>
                    @endif
                </form>
            </div>

            <div class="card-dark overflow-hidden">
                @if($equipments->count())
                    <div class="md:hidden p-4 space-y-3">
                        @foreach($equipments as $equipment)
                            <div class="bg-[#1f1f1f] p-4 rounded-lg border border-[#2a2a2a]">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="text-sm font-semibold text-white">{{ $equipment->nama_alat }}</div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-lg {{ $equipment->kondisi == 'Baik' ? 'bg-[#ADFF2F]/20 text-[#ADFF2F]' : 'bg-red-500/20 text-red-400' }}">{{ $equipment->kondisi }}</span>
                                </div>
                                <div class="text-xs text-gray-400 mb-3 space-y-1">
                                    <div>Purchase: {{ $equipment->tanggal_pembelian->format('d M Y') }}</div>
                                    <div>Maintenance: {{ $equipment->jadwal_perawatan->format('d M Y') }}</div>
                                </div>
                                @if($equipment->kondisi == 'Baik')
                                    <button onclick="reportEquipment('{{ $equipment->equipment_id }}', '{{ $equipment->nama_alat }}')" class="w-full px-4 py-2 bg-orange-500/10 hover:bg-orange-500/20 text-orange-400 rounded-lg font-medium transition">Report Issue</button>
                                @else
                                    <div class="w-full px-4 py-2 bg-red-500/10 text-red-400 rounded-lg text-center font-medium">Already Reported</div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop: table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="table-minimal">
                            <thead>
                                <tr>
                                    <th>Equipment Name</th>
                                    <th>Condition</th>
                                    <th>Purchase Date</th>
                                    <th>Maintenance Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($equipments as $equipment)
                                    <tr class="hover:bg-neutral-700/20 transition duration-150">
                                        <td>
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div class="text-sm font-semibold text-white">
                                                    {{ $equipment->nama_alat }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $equipment->kondisi == 'Baik' ? 'bg-[#ADFF2F] text-black' : 'bg-red-600 text-white' }}">
                                                {{ $equipment->kondisi }}
                                            </span>
                                        </td>
                                        <td class="muted">
                                            <div class="flex items-center text-sm text-neutral-400">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $equipment->tanggal_pembelian->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="muted">
                                            <div class="flex items-center text-sm text-neutral-400">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $equipment->jadwal_perawatan->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($equipment->kondisi == 'Baik')
                                                <button
                                                    onclick="reportEquipment('{{ $equipment->equipment_id }}', '{{ $equipment->nama_alat }}')"
                                                    class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                    Report Issue
                                                </button>
                                            @else
                                                <span class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Already Reported
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- old pagination removed in favor of unified component below -->
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-white">No equipment found</h3>
                        <p class="mt-1 text-sm text-neutral-400">Get started by adding your first equipment.</p>
                        <div class="mt-6">
                            <p class="text-sm text-neutral-400">
                                Contact admin to add new equipment to the gym.
                            </p>
                        </div>
                    </div>
                @endif

                <!-- Pagination -->
                @if($equipments instanceof \Illuminate\Pagination\LengthAwarePaginator && $equipments->hasPages())
                    <div class="px-6 py-4 border-t border-[#2a2a2a]">
                        <x-pagination :paginator="$equipments" />
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Report Equipment Modal -->
    <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 items-center justify-center hidden">
        <div class="bg-neutral-800 rounded-lg shadow-xl w-80 max-w-sm border border-neutral-700 mx-4">
            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-white">Report Equipment Issue</h3>
                    <button onclick="closeModal()" class="text-neutral-400 hover:text-white transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form id="reportForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-white mb-2">Equipment:</label>
                        <p id="equipmentName" class="text-sm text-white bg-neutral-700 px-3 py-2 rounded border border-neutral-600"></p>
                    </div>

                    <div class="mb-4">
                        <label for="reportDescription" class="block text-sm font-medium text-white mb-2">
                            Issue Description:
                        </label>
                        <textarea
                            id="reportDescription"
                            name="report_description"
                            rows="3"
                            class="w-full px-3 py-2 border border-neutral-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white"
                            placeholder="Describe the issue with this equipment..."
                            required
                        ></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button
                            type="button"
                            onclick="closeModal()"
                            class="px-4 py-2 bg-neutral-600 hover:bg-neutral-500 text-white rounded-md transition duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition duration-200"
                        >
                            Report Issue
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function reportEquipment(equipmentId, equipmentName) {
            const modal = document.getElementById('reportModal');
            const form = document.getElementById('reportForm');
            const nameEl = document.getElementById('equipmentName');
            const desc = document.getElementById('reportDescription');

            if (!modal || !form || !nameEl) return;

            nameEl.textContent = equipmentName;
            form.action = `/trainer/equipments/${equipmentId}/report`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // fokus ke textarea untuk UX
            if (desc) desc.focus();
        }

        function closeModal() {
            const modal = document.getElementById('reportModal');
            const form = document.getElementById('reportForm');
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (form) form.reset();
        }

        // Close modal when clicking outside
        const _reportModal = document.getElementById('reportModal');
        if (_reportModal) {
            _reportModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        }
    </script>
@endsection