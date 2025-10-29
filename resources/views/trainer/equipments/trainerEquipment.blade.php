<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Equipment Management
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-neutral-800 p-4 border border-neutral-700 rounded-lg text-white">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Info Banner -->
            <div class="bg-neutral-800 p-4 border border-neutral-700 rounded-lg text-white">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">Equipment Overview</span>
                    <span class="ml-2 text-neutral-400">- Report equipment issues to admin for maintenance</span>
                </div>
            </div>

            <!-- Equipment List -->
            <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                @if($equipments->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-700">
                            <thead class="bg-neutral-900">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Equipment Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Condition
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Purchase Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Maintenance Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                                @foreach($equipments as $equipment)
                                    <tr class="hover:bg-neutral-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">
                                                {{ $equipment->nama_alat }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $equipment->kondisi == 'Baik' ? 'bg-[#ADFF2F] text-black' : 'bg-red-600 text-white' }}">
                                                {{ $equipment->kondisi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400">
                                            {{ $equipment->tanggal_pembelian->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400">
                                            {{ $equipment->jadwal_perawatan->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($equipment->kondisi == 'Baik')
                                                <button
                                                    onclick="reportEquipment('{{ $equipment->equipment_id }}', '{{ $equipment->nama_alat }}')"
                                                    class="inline-flex items-center px-3 py-1 bg-orange-600 hover:bg-orange-700 text-white text-xs font-medium rounded-full transition duration-200">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                                    </svg>
                                                    Report Issue
                                                </button>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded-full">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center" style="display: none;">
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
            document.getElementById('equipmentName').textContent = equipmentName;
            document.getElementById('reportForm').action = `/trainer/equipments/${equipmentId}/report`;
            document.getElementById('reportModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('reportModal').classList.add('hidden');
            document.getElementById('reportDescription').value = '';
        }

        // Close modal when clicking outside
        document.getElementById('reportModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</x-app-layout>