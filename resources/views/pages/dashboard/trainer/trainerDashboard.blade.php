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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @if(auth()->user()->hasPermission('schedule.view_all'))
                        <a href="{{ route('trainer.classes.index') }}" class="block p-4 border rounded hover:bg-gray-50">
                            View Classes (schedule.view_all)
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('schedule.create_limited'))
                        <a href="{{ route('trainer.classes.create') }}" class="block p-4 border rounded hover:bg-gray-50">
                            Create Class (schedule.create_limited)
                        </a>
                    @endif

                    @if(auth()->user()->hasPermission('equipment.view_all'))
                        <a href="{{ route('trainer.equipments.index') }}" class="block p-4 border rounded hover:bg-gray-50">
                            View Equipments (equipment.view_all)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
