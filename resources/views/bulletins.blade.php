@extends('layouts.app')

@section('title', 'Bulletins – UP Law Center - National Administrative Register')

@section('content')
    <div class="max-w-[1440px] mx-auto w-full px-4 md:px-10 py-5 flex-1 flex flex-col">
        {{-- Breadcrumbs --}}
        <div class="flex flex-wrap gap-2 py-2 mb-4">
            <a class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal hover:text-primary" href="{{ url('/') }}">Home</a>
            <span class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal">/</span>
            <a class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal hover:text-primary" href="{{ route('bulletins') }}">Bulletins</a>
            @if($currentSection)
                <span class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal">/</span>
                <span class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal hover:text-primary">
                    {{ $currentSection->volume_name }}
                </span>
                <span class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal">/</span>
                <span class="text-text-main-light dark:text-text-main-dark text-sm font-medium leading-normal">
                    No. {{ $currentSection->book_name }}
                </span>
            @endif
        </div>

        {{-- Page Heading --}}
        <div class="flex flex-col gap-6 mb-8">
            <div class="flex flex-wrap justify-between gap-4">
                <div class="flex flex-col gap-2 max-w-3xl">
                    <h1 class="text-text-main-light dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-[-0.033em]">
                        Browse Bulletins by Volume
                    </h1>
                    <p class="text-text-sec-light dark:text-text-sec-dark text-base font-normal leading-normal">
                        Navigate the complete archive of the National Administrative Register organized by volume and book.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {{-- Sidebar: Volume Archive --}}
            <aside class="lg:col-span-3 flex flex-col gap-6">
                <div class="bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 border-b border-border-light dark:border-border-dark bg-gray-50 dark:bg-background-dark/50">
                        <h2 class="font-bold text-text-main-light dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">library_books</span>
                            Volume Archive
                        </h2>
                    </div>

                    <div class="flex flex-col p-2 max-h-[calc(100vh-250px)] overflow-y-auto custom-scrollbar">
                        @forelse($sectionsByVolume as $volumeName => $volumeSections)
                            @php
                                $isCurrentVolume = $currentSection && $currentSection->volume_name === $volumeName;
                            @endphp
                            <details class="group" {{ $isCurrentVolume ? 'open' : '' }}>
                                <summary class="flex cursor-pointer items-center justify-between rounded-lg px-3 py-2.5 font-semibold text-text-main-light hover:bg-gray-100 dark:text-white dark:hover:bg-background-dark transition-colors">
                                    <span class="flex items-center gap-2 text-sm">
                                        <span class="material-symbols-outlined text-[20px] text-gray-400 group-open:text-primary">
                                            {{ $isCurrentVolume ? 'folder_open' : 'folder' }}
                                        </span>
                                        {{ $volumeName }}
                                    </span>
                                    <span class="material-symbols-outlined text-[20px] text-gray-400 transition-transform group-open:rotate-180">expand_more</span>
                                </summary>

                                <div class="mt-1 flex flex-col gap-1 pb-2 pl-4 border-l-2 border-gray-100 dark:border-gray-700 ml-5">
                                    @foreach($volumeSections as $section)
                                        @php
                                            $isActive = $currentSection && $currentSection->id === $section->id;
                                        @endphp
                                        <a
                                            href="{{ route('bulletins', ['section' => $section->id]) }}"
                                            class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium transition-colors
                                                {{ $isActive
                                                    ? 'bg-blue-50 dark:bg-blue-900/20 text-primary dark:text-blue-300 font-bold'
                                                    : 'text-text-sec-light dark:text-text-sec-dark hover:text-primary hover:bg-gray-50 dark:hover:bg-background-dark/50' }}"
                                        >
                                            <span class="material-symbols-outlined text-[18px]">
                                                {{ $isActive ? 'book_2' : 'book' }}
                                            </span>
                                            <span class="flex-1">
                                                No. {{ $section->book_name }}
                                                @if($section->issuance_from && $section->issuance_to)
                                                    <span class="block text-xs text-text-sec-light dark:text-text-sec-dark mt-0.5">
                                                        {{ \Carbon\Carbon::parse($section->issuance_from)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($section->issuance_to)->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </span>
                                            @if($section->documents_count > 0)
                                                <span class="inline-flex items-center justify-center min-w-[24px] h-5 px-1.5 rounded-full bg-gray-100 dark:bg-gray-700 text-xs font-semibold text-text-sec-light dark:text-text-sec-dark">
                                                    {{ $section->documents_count }}
                                                </span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </details>
                        @empty
                            <p class="px-4 py-3 text-sm text-text-sec-light dark:text-text-sec-dark">
                                No bulletins have been created yet.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl border border-blue-100 dark:border-blue-800">
                    <h3 class="text-primary dark:text-blue-300 font-bold text-sm mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                        About Volumes
                    </h3>
                    <p class="text-xs text-text-sec-light dark:blue-200 leading-relaxed">
                        The ONAR Bulletin is published periodically. Each Volume represents a collection of books,
                        and each Book represents a portion of that volume containing all filed administrative issuances.
                    </p>
                </div>
            </aside>

            {{-- Main content: current bulletin --}}
            <main class="lg:col-span-9 flex flex-col gap-6">
                @if($currentSection)
                    {{-- Bulletin summary card --}}
                    <div class="flex flex-col md:flex-row gap-6 p-6 bg-white dark:bg-card-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark">
                        <div class="shrink-0 flex items-center justify-center w-24 h-32 bg-gradient-to-br from-red-900 to-red-950 rounded-lg shadow-lg text-white flex-col">
                            <span class="text-xs font-medium opacity-80"> {{ $currentSection->volume_name }}</span>
                            <span class="text-3xl font-bold">No. {{ $currentSection->book_name }}</span>
                        </div>

                        <div class="flex flex-col flex-1 gap-4">
                            <div class="flex flex-col gap-1">
                                <div class="flex flex-wrap items-center gap-3">
                                    <h2 class="text-2xl font-bold text-text-main-light dark:text-white">
                                        {{ $currentSection->volume_name }}, No. {{ $currentSection->book_name }}
                                    </h2>
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700 dark:bg-green-900/40 dark:text-green-300 border border-green-200 dark:border-green-800">
                                        <span class="material-symbols-outlined text-[18px] mr-1">check_circle</span>
                                        Active
                                    </span>
                                </div>
                                @if($currentSection->issuance_from && $currentSection->issuance_to)
                                    <p class="text-text-sec-light dark:text-text-sec-dark text-sm">
                                        Covering period:
                                        <span class="font-bold text-text-main-light dark:text-white">
                                            {{ \Carbon\Carbon::parse($currentSection->issuance_from)->format('F d, Y') }} – {{ \Carbon\Carbon::parse($currentSection->issuance_to)->format('F d, Y') }}
                                        </span>
                                    </p>
                                @endif
                            </div>

                            <p class="text-sm text-text-sec-light dark:text-text-sec-dark">
                                This book contains administrative orders, memorandum circulars, and other issuances filed
                                with the Office of the National Administrative Register that belong to this bulletin.
                            </p>

                            <div class="flex flex-wrap gap-3 mt-auto pt-2">
                                {{-- Placeholder actions; wire up when PDF or search-in-book is available --}}
                                <button type="button" class="flex items-center gap-2 px-4 py-2 bg-text-main-light dark:bg-white text-white dark:text-text-main-light rounded-lg text-sm font-bold hover:opacity-90 transition-opacity">
                                    <span class="material-symbols-outlined text-[18px]">download</span>
                                    Download Bulletin PDF
                                </button>
                                <a
                                    href="{{ route('search', ['section_id' => $currentSection->id]) }}"
                                    class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-background-dark border border-border-light dark:border-border-dark text-text-main-light dark:text-white rounded-lg text-sm font-medium hover:bg-gray-50 dark:hover:bg-background-dark/80 transition-colors"
                                >
                                    <span class="material-symbols-outlined text-[18px]">search</span>
                                    Search in Issuances
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Table of contents header --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-border-light dark:border-border-dark mt-2">
                        <h3 class="text-text-main-light dark:text-white font-bold text-lg">
                            Table of Contents
                            <span class="text-sm font-normal text-text-sec-light dark:text-text-sec-dark ml-2">
                                ({{ $documents->total() }} Issuances)
                            </span>
                        </h3>

                        <form method="GET" action="{{ route('bulletins') }}" class="flex items-center gap-3">
                            <input type="hidden" name="section" value="{{ $currentSection->id }}">
                            <span class="text-sm text-text-sec-light dark:text-text-sec-dark">Sort by:</span>
                            <div class="relative">
                                <select
                                    name="sort"
                                    class="appearance-none bg-background-light dark:bg-background-dark border-none rounded py-1.5 pl-3 pr-8 text-sm font-medium text-text-main-light dark:text-white cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors focus:ring-0"
                                    onchange="this.form.submit()"
                                >
                                    <option value="page" {{ $sort === 'page' ? 'selected' : '' }}>Date Filed (Newest)</option>
                                    <option value="date_asc" {{ $sort === 'date_asc' ? 'selected' : '' }}>Date Filed (Oldest)</option>
                                    <option value="agency" {{ $sort === 'agency' ? 'selected' : '' }}>Agency (A–Z)</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-2 top-1.5 text-[18px] pointer-events-none">
                                    expand_more
                                </span>
                            </div>
                        </form>
                    </div>

                    {{-- Documents list --}}
                    <div class="flex flex-col gap-4">
                        @forelse($documents as $document)
                            <div class="group flex flex-col gap-4 rounded-lg border border-border-light bg-white p-5 shadow-sm transition-all hover:shadow-md hover:border-blue-200 dark:border-border-dark dark:bg-card-dark dark:hover:border-blue-900">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex flex-wrap gap-2 items-center">
                                            @if($document->agency)
                                                <span class="inline-flex items-center rounded bg-background-light px-2 py-0.5 text-xs font-semibold text-text-main-light dark:bg-background-dark dark:text-text-main-dark">
                                                    <span class="material-symbols-outlined text-[14px] mr-1">account_balance</span>
                                                    {{ $document->agency->name }}
                                                </span>
                                            @endif

                                            @if($document->issuanceType)
                                                @php
                                                    $colors = [
                                                        ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'dark-bg' => 'dark:bg-blue-900/40', 'dark-text' => 'dark:text-blue-300'],
                                                        ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'dark-bg' => 'dark:bg-green-900/40', 'dark-text' => 'dark:text-green-300'],
                                                        ['bg' => 'bg-purple-50', 'text' => 'text-purple-700', 'dark-bg' => 'dark:bg-purple-900/40', 'dark-text' => 'dark:text-purple-300'],
                                                        ['bg' => 'bg-orange-50', 'text' => 'text-orange-700', 'dark-bg' => 'dark:bg-orange-900/40', 'dark-text' => 'dark:text-orange-300'],
                                                        ['bg' => 'bg-pink-50', 'text' => 'text-pink-700', 'dark-bg' => 'dark:bg-pink-900/40', 'dark-text' => 'dark:text-pink-300'],
                                                        ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-700', 'dark-bg' => 'dark:bg-indigo-900/40', 'dark-text' => 'dark:text-indigo-300'],
                                                    ];
                                                    $colorIndex = $document->issuanceType->id % count($colors);
                                                    $color = $colors[$colorIndex];
                                                @endphp
                                                <span class="inline-flex items-center rounded {{ $color['bg'] }} px-2 py-0.5 text-xs font-semibold {{ $color['text'] }} {{ $color['dark-bg'] }} {{ $color['dark-text'] }}">
                                                    {{ $document->issuanceType->name }}
                                                </span>
                                            @endif
                                        </div>

                                        <a
                                            href="{{ route('documents.show', $document) }}"
                                            class="text-lg md:text-xl font-bold leading-tight text-text-main-light hover:text-primary dark:text-white transition-colors"
                                        >
                                            @if($document->issuance_no)
                                                {{ $document->issuance_no }}:
                                            @endif
                                            {{ $document->title ?? 'Untitled document' }}
                                        </a>
                                    </div>

                                    <div class="shrink-0 flex flex-col items-end gap-1">
                                        @if($document->date_filed || $document->created_at)
                                            <span class="flex items-center text-sm font-medium text-text-sec-light dark:text-text-sec-dark">
                                                <span class="material-symbols-outlined text-[16px] mr-1">calendar_today</span>
                                                {{ \Illuminate\Support\Carbon::parse($document->date_filed ?? $document->created_at)->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($document->subject)
                                    <p class="text-sm md:text-base text-text-sec-light dark:text-text-sec-dark line-clamp-2">
                                        {{ $document->subject }}
                                    </p>
                                @elseif($document->content)
                                    <p class="text-sm md:text-base text-text-sec-light dark:text-text-sec-dark line-clamp-2">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($document->content), 220) }}
                                    </p>
                                @endif

                                <div class="flex items-center gap-4 pt-2 border-t border-dashed border-border-light dark:border-border-dark mt-1">
                                    <a href="{{ route('documents.show', $document) }}" class="flex items-center gap-1.5 text-sm font-medium text-primary hover:underline">
                                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        View Details
                                    </a>

                                    @if($document->file)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($document->file) }}" class="flex items-center gap-1.5 text-sm font-medium text-text-sec-light hover:text-text-main-light dark:text-text-sec-dark dark:hover:text-white transition-colors">
                                            <span class="material-symbols-outlined text-[18px]">download</span>
                                            Download PDF
                                        </a>
                                    @endif

                                    @if($document->issuance_no)
                                        <span class="text-xs text-text-sec-light ml-auto">
                                            Ref: {{ $document->issuance_no }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-4">
                                No issuances are listed in this bulletin yet.
                            </p>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    @if($documents->hasPages())
                        <div class="flex items-center justify-center mt-8 pb-6">
                            <div class="flex items-center gap-2">
                                {{-- Previous Button --}}
                                @if($documents->onFirstPage())
                                    <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark cursor-not-allowed">
                                        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                                    </span>
                                @else
                                    <a href="{{ $documents->previousPageUrl() }}" class="flex h-10 w-10 items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:border-primary hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                                    </a>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)
                                    @if($page == $documents->currentPage())
                                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white font-medium">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="flex h-10 w-10 items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:border-primary hover:text-primary transition-colors">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Next Button --}}
                                @if($documents->hasMorePages())
                                    <a href="{{ $documents->nextPageUrl() }}" class="flex h-10 w-10 items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:border-primary hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                                    </a>
                                @else
                                    <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-border-light dark:border-border-dark bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark cursor-not-allowed">
                                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark">
                        No bulletins are available yet.
                    </p>
                @endif
            </main>
        </div>
    </div>
@endsection


