@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.1); color:#ADFF2F;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit Equipment</h1>
                        <p class="text-neutral-400">Update equipment information</p>
                    </div>
                </div>
                <a href="{{ route('admin.equipment.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center space-x-2 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-500/30">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="bg-neutral-800 shadow sm:rounded-lg p-6">
            <form action="{{ route('admin.equipment.update', $row->equipment_id) }}" method="post" class="space-y-6">
                @csrf @method('PUT')
                @include('admin.equipment._form', ['row' => $row])
            </form>
        </div>
    </div>
</div>
@endsection
