<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Trainer Dashboard') }}
        </h2>
    </x-slot>
    <div class="min-h-screen bg-black py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-neutral-800 to-neutral-900 rounded-2xl p-8 mb-8 border border-neutral-700 shadow-2xl">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ auth()->user()->nama }}!</h1>
                        <p class="text-neutral-400 text-lg">Manage your classes and track member progress</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                            <svg class="w-10 h-10 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-white mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if(auth()->user()->hasPermission('schedule.view_all') || auth()->user()->isTrainer())
                        <a href="{{ route('trainer.classes.index') }}" class="group">
                            <div class="bg-neutral-800 rounded-xl p-6 border border-neutral-700 hover:border-green-500 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 h-full">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(173, 255, 47, 0.1);">
                                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-neutral-500 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-white font-semibold text-lg mb-2">Manage Classes</h3>
                                <p class="text-neutral-400 text-sm">View and manage your gym classes</p>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('equipment.view_all') || auth()->user()->isTrainer())
                        <a href="{{ route('trainer.equipments.index') }}" class="group">
                            <div class="bg-neutral-800 rounded-xl p-6 border border-neutral-700 hover:border-green-500 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 h-full">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(173, 255, 47, 0.1);">
                                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-neutral-500 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-white font-semibold text-lg mb-2">Equipment Status</h3>
                                <p class="text-neutral-400 text-sm">Monitor gym equipment condition</p>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('attendance.track') || auth()->user()->hasPermission('attendance.view_all') || auth()->user()->isTrainer())
                        <a href="{{ route('trainer.attendance.select-class') }}" class="group">
                            <div class="bg-neutral-800 rounded-xl p-6 border border-neutral-700 hover:border-green-500 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 h-full">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(173, 255, 47, 0.1);">
                                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-neutral-500 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-white font-semibold text-lg mb-2">Track Attendance</h3>
                                <p class="text-neutral-400 text-sm">Mark member attendance</p>
                            </div>
                        </a>
                        <a href="{{ route('trainer.attendance.view_all') }}" class="group">
                            <div class="bg-neutral-800 rounded-xl p-6 border border-neutral-700 hover:border-green-500 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 h-full">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(173, 255, 47, 0.1);">
                                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-neutral-500 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-white font-semibold text-lg mb-2">View Records</h3>
                                <p class="text-neutral-400 text-sm">All attendance history</p>
                            </div>
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('workout.view_member') || auth()->user()->isTrainer())
                        <a href="#" onclick="showMemberSelector()" class="group cursor-pointer">
                            <div class="bg-neutral-800 rounded-xl p-6 border border-neutral-700 hover:border-green-500 transition-all duration-300 hover:shadow-xl hover:shadow-green-500/10 h-full">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: rgba(173, 255, 47, 0.1);">
                                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <svg class="w-5 h-5 text-neutral-500 group-hover:text-green-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                                <h3 class="text-white font-semibold text-lg mb-2">Workout Tracker</h3>
                                <p class="text-neutral-400 text-sm">View member progress</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Member Selector Modal -->
    <div id="memberModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center">
        <div class="bg-neutral-800 rounded-2xl shadow-2xl w-full max-w-md border border-neutral-700 mx-4">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-white">Select Member</h3>
                    <button onclick="closeMemberModal()" class="text-neutral-400 hover:text-white transition duration-200 hover:bg-neutral-700 rounded-lg p-2">
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

                    <div class="sticky top-0 bg-neutral-800 z-20 p-4 border-b border-neutral-700 rounded-t-2xl">
                        <input id="memberSearch" type="text" placeholder="Search members by name or email..." class="w-full px-4 py-3 border border-neutral-600 rounded-lg bg-neutral-700 text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200" />
                    </div>

                    <div id="memberList" class="max-h-96 overflow-y-auto"
                        @if($historyMembers->isNotEmpty())
                            <div class="p-4 bg-neutral-700/50 border-b border-neutral-700">
                                <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Your Members</p>
                            </div>
                            @foreach($historyMembers as $member)
                                <a href="{{ url('trainer/members/'.$member->member_id.'/workouts') }}"
                                   class="block px-4 py-3 hover:bg-neutral-700 text-white transition duration-200 border-b border-neutral-700/50 last:border-0">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                <span class="text-black font-bold text-lg">
                                                    {{ substr($member->user->nama ?? 'M', 0, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <p class="text-sm font-semibold text-white">
                                                {{ $member->user->nama ?? 'Member' }}
                                            </p>
                                            <p class="text-xs text-neutral-400 mt-0.5">
                                                {{ $member->user->email ?? '' }}
                                            </p>
                                        </div>
                                        <div class="ml-auto">
                                            <svg class="w-5 h-5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center py-12 px-4">
                                <div class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4" style="background: rgba(173, 255, 47, 0.1);">
                                    <svg class="h-8 w-8" style="color:#ADFF2F;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-base font-semibold text-white mb-1">No Members Yet</h3>
                                <p class="text-sm text-neutral-400">No members have attended your classes yet.</p>
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
                                            <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <h3 class="mt-2 text-sm font-medium text-white">No members found</h3>
                                        </div>
                                    `;
                                    return;
                                }

                                memberListEl.innerHTML = list.map(m => `
                                    <a href="/trainer/members/${m.member_id}/workouts" class="block px-4 py-3 hover:bg-neutral-700 text-white transition duration-200 border-b border-neutral-700/50 last:border-0">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                    <span class="text-black font-bold text-lg">${(m.name || 'M').charAt(0)}</span>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <p class="text-sm font-semibold text-white">${m.name}</p>
                                                <p class="text-xs text-neutral-400 mt-0.5">${m.email}</p>
                                            </div>
                                            <div class="ml-auto">
                                                <svg class="w-5 h-5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            document.getElementById('memberModal').style.display = 'flex';
        }

        function closeMemberModal() {
            document.getElementById('memberModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('memberModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeMemberModal();
            }
        });
    </script>
</x-app-layout>
