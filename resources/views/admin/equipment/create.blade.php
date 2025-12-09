@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Add New Equipment</div>
                    <div class="subtitle">Create a new equipment record</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.equipment.index') }}" class="bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="card-dark mb-6 p-4 border-l-4 border-red-500">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form action="{{ route('admin.equipment.store') }}" method="post" class="space-y-6">
                @csrf
                @include('admin.equipment._form', ['row' => null])
            </form>
        </div>
    </div>
</div>
@endsection
