<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Equipment Management
        </h2>
    </x-slot>

    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-neutral-800 p-6 border-l-4 border-[#ADFF2F] rounded-2xl text-white shadow-xl">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <div>
                <h1 class="text-3xl font-bold text-white">Equipment Overview</h1>
                <p class="mt-1 text-neutral-400">Monitor equipment status and report issues for maintenance</p>
            </div>

            <!-- Equipment List -->
            <div class="bg-neutral-800 rounded-2xl shadow-2xl overflow-hidden border border-neutral-700">
                @if($equipments->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-700">
                            <thead class="bg-neutral-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Equipment Name
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Condition
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Purchase Date
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Maintenance Date
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-neutral-800 divide-y divide-neutral-700/50">
                                @foreach($equipments as $equipment)
                                    <tr class="hover:bg-neutral-700/30 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
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
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $equipment->kondisi == 'Baik' ? 'bg-[#ADFF2F] text-black' : 'bg-red-600 text-white' }}">
                                                {{ $equipment->kondisi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-neutral-400">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $equipment->tanggal_pembelian->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-neutral-400">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $equipment->jadwal_perawatan->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-neutral-700">
                        {{ $equipments->links() }}
                    </div>
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
            </div>
        </div>
    </div>

    <!-- Report Equipment Modal -->
    <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
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
            // fokus ke textarea untuk UX
            if (desc) desc.focus();
        }

        function closeModal() {
            const modal = document.getElementById('reportModal');
            const form = document.getElementById('reportForm');
            if (!modal) return;
            modal.classList.add('hidden');
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
</x-app-layout>