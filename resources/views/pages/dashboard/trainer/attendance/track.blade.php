<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Track Attendance') }}
            </h2>
            <div class="text-right">
                <p class="text-gray-600">{{ $class->nama_kelas }}</p>
                <p class="text-sm text-gray-500">{{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('trainer.attendance.store', ['class' => $class->class_id]) }}">
                    @csrf
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Members</h3>
                            <div class="grid gap-6">
                                @forelse($members as $member)
                                    <div class="flex items-center justify-between p-4 border rounded-lg bg-gray-50">
                                        <div class="flex items-center space-x-4">
                                            <div>
                                                <h4 class="font-medium text-gray-800">{{ $member->user->name }}</h4>
                                                <p class="text-sm text-gray-500">Member ID: {{ $member->member_id }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="space-x-2">
                                                <label class="inline-flex items-center">
                                                    <input type="radio" 
                                                           name="attendance[{{ $member->member_id }}]" 
                                                           value="hadir"
                                                           class="form-radio text-blue-600"
                                                           checked>
                                                    <span class="ml-2">Present</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" 
                                                           name="attendance[{{ $member->member_id }}]" 
                                                           value="izin"
                                                           class="form-radio text-yellow-600">
                                                    <span class="ml-2">Excused</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" 
                                                           name="attendance[{{ $member->member_id }}]" 
                                                           value="sakit"
                                                           class="form-radio text-orange-600">
                                                    <span class="ml-2">Sick</span>
                                                </label>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" 
                                                           name="attendance[{{ $member->member_id }}]" 
                                                           value="alpa"
                                                           class="form-radio text-red-600">
                                                    <span class="ml-2">Absent</span>
                                                </label>
                                            </div>
                                            <input type="text" 
                                                   name="notes[{{ $member->member_id }}]" 
                                                   placeholder="Add note for this member"
                                                   class="form-input rounded-md shadow-sm mt-1 block w-full">
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-4">
                                        No members found in this class.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="general_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                General Notes
                            </label>
                            <textarea id="general_notes" 
                                      name="general_notes" 
                                      rows="3" 
                                      class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                      placeholder="Add any general notes for this session"></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('trainer.attendance.select-class') }}"
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                Back to Class Selection
                            </a>
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                Save Attendance
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>