@props(['paginator'])

@if ($paginator->hasPages())
    <div class="flex flex-col items-center gap-3">
        <nav class="inline-flex rounded-lg bg-[#1f1f1f] overflow-hidden">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-neutral-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-neutral-400 hover:text-[#ADFF2F] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            @endif

            {{-- Page Numbers --}}
            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="px-3 py-2 min-w-[36px] text-center bg-[#ADFF2F] text-black font-semibold text-sm">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-3 py-2 min-w-[36px] text-center text-neutral-400 hover:text-[#ADFF2F] transition-colors text-sm">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-neutral-400 hover:text-[#ADFF2F] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @else
                <span class="px-3 py-2 text-neutral-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </nav>

        {{-- Page Info --}}
        <div class="text-center text-xs text-neutral-500">
            Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </div>
    </div>
@endif
