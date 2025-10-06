<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(auth()->user()->hasPermission('attendance.track') || auth()->user()->hasPermission('attendance.view_all'))
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Attendance Management</h3>
                            <div class="space-y-2">
                                @if(auth()->user()->hasPermission('attendance.track'))
                                    <div>
                                        <a href="{{ route('trainer.attendance.track') }}" class="text-indigo-600 hover:text-indigo-900">
                                            Track Attendance
                                        </a>
                                    </div>
                                @endif
                                @if(auth()->user()->hasPermission('attendance.view_all'))
                                    <div>
                                        <a href="{{ route('trainer.attendance.view_all') }}" class="text-indigo-600 hover:text-indigo-900">
                                            View All Attendance
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <div>
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
