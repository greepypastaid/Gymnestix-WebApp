<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trainer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="font-medium mb-4">Trainer Tools</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if(auth()->user()->hasPermission('schedule.view_all'))
                        <a href="{{ route('trainer.classes.index') }}" class="block p-4 border rounded hover:bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">Manage Classes</div>
                                    <div class="text-sm text-gray-500">View and manage gym classes</div>
                                </div>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('equipment.view_all'))
                        <a href="{{ route('trainer.equipments.index') }}" class="block p-4 border rounded hover:bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">Equipment Status</div>
                                    <div class="text-sm text-gray-500">Monitor gym equipment</div>
                                </div>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('attendance.track') || auth()->user()->hasPermission('attendance.view_all'))
                        <a href="{{ route('trainer.attendance.select-class') }}" class="block p-4 border rounded hover:bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">Attendance</div>
                                    <div class="text-sm text-gray-500">Track member attendance</div>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('trainer.attendance.view_all') }}" class="block p-4 border rounded hover:bg-gray-50">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">View Attendance</div>
                                    <div class="text-sm text-gray-500">View all attendance records</div>
                                </div>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('workout.view_member'))
                        <a href="#" onclick="showMemberSelector()" class="block p-4 border rounded hover:bg-gray-50 cursor-pointer">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium">Workout Tracker</div>
                                    <div class="text-sm text-gray-500">View member progress</div>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Member Selector Modal -->
    <div id="memberModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Select Member</h3>
                    <button onclick="closeMemberModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @php
                        $user = auth()->user();
                        $trainer = $user?->trainer;

                        // Members who have booking history for this trainer's classes
                        $historyMembers = collect();
                        if ($trainer) {
                            $historyMembers = \App\Models\Member::whereHas('bookings', function($q) use ($trainer) {
                                $q->whereHas('class', function($qq) use ($trainer) {
                                    $qq->where('trainer_id', $trainer->trainer_id);
                                });
                            })->with('user')->get();
                        }

                        // All members (for search fallback)
                        $allMembers = \App\Models\Member::with('user')->get();

                        // Precompute arrays safe for @json
                        $allMembersData = $allMembers->map(function($m) {
                            return [
                                'member_id' => $m->member_id,
                                'name' => $m->user->nama ?? 'Member',
                                'email' => $m->user->email ?? '',
                            ];
                        })->toArray();

                        $historyMembersData = $historyMembers->map(function($m) {
                            return [
                                'member_id' => $m->member_id,
                                'name' => $m->user->nama ?? 'Member',
                                'email' => $m->user->email ?? '',
                            ];
                        })->toArray();
                    @endphp

                    <div class="sticky top-0 bg-white dark:bg-gray-800 z-20 p-3 border-b border-gray-200 dark:border-gray-700">
                        <input id="memberSearch" type="text" placeholder="Search members by name or email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div id="memberList">
                        @if($historyMembers->isNotEmpty())
                            @foreach($historyMembers as $member)
                                <a href="{{ url('trainer/members/'.$member->member_id.'/workouts') }}"
                                   class="block p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                <span class="text-white font-medium text-sm">
                                                    {{ substr($member->user->nama ?? 'M', 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $member->user->nama ?? 'Member' }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $member->user->email ?? '' }}
                                            </p>
                                        </div>
                                        <div class="ml-auto">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No recent members found</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No members have attended your classes yet.</p>
                            </div>
                        @endif
                    </div>
                        <script id="allMembersData" type="application/json">{!! json_encode($allMembersData, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) !!}</script>
                        <script id="historyMembersData" type="application/json">{!! json_encode($historyMembersData, JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) !!}</script>

                        <script>
                        (function initMemberSelector(){
                            const allMembersEl = document.getElementById('allMembersData');
                            const historyMembersEl = document.getElementById('historyMembersData');
                            const memberListEl = document.getElementById('memberList');
                            const searchEl = document.getElementById('memberSearch');

                            if (!allMembersEl || !historyMembersEl || !memberListEl || !searchEl) return;

                            const allMembers = JSON.parse(allMembersEl.textContent || '[]');
                            const historyMembers = JSON.parse(historyMembersEl.textContent || '[]');

                            function renderMembers(list) {
                                if (!list.length) {
                                    memberListEl.innerHTML = `
                                        <div class="text-center py-8">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No members found</h3>
                                        </div>
                                    `;
                                    return;
                                }

                                memberListEl.innerHTML = list.map(m => `
                                    <a href="/trainer/members/${m.member_id}/workouts" class="block p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">${(m.name || 'M').charAt(0)}</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${m.name}</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">${m.email}</p>
                                            </div>
                                            <div class="ml-auto">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                `).join('');
                            }

                            searchEl.addEventListener('input', function() {
                                const q = this.value.trim().toLowerCase();
                                if (!q) {
                                    // show history members
                                    renderMembers(historyMembers);
                                    return;
                                }

                                // search across all members
                                const results = allMembers.filter(m => (m.name || '').toLowerCase().includes(q) || (m.email || '').toLowerCase().includes(q));
                                renderMembers(results);
                            });

                            // initial render
                            renderMembers(historyMembers.length ? historyMembers : allMembers);
                        })();
                        </script>
            </div>
        </div>
    </div>

    <script>
        function showMemberSelector() {
            document.getElementById('memberModal').classList.remove('hidden');
        }

        function closeMemberModal() {
            document.getElementById('memberModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('memberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMemberModal();
            }
        });
    </script>
</x-app-layout>
