@extends('layouts.app')

@section('title', 'Search Results - UP Law Center - National Administrative Register')

@section('content')
<div class="max-w-[1440px] mx-auto w-full px-4 md:px-10 py-5 flex-1 flex flex-col">
    <!-- Breadcrumbs -->
    <div class="flex flex-wrap gap-2 py-2 mb-4">
        <a class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal hover:text-primary" href="{{ url('/') }}">Home</a>
        <span class="text-text-sec-light dark:text-text-sec-dark text-sm font-medium leading-normal">/</span>
        <span class="text-text-main-light dark:text-text-main-dark text-sm font-medium leading-normal">Search Results</span>
    </div>

    <!-- Page Heading & Search Dashboard -->
    <div class="flex flex-col gap-6 mb-8">
        <div class="flex flex-wrap justify-between gap-4">
            <div class="flex flex-col gap-2 max-w-2xl">
                <h1 class="text-text-main-light dark:text-white text-3xl md:text-4xl font-black leading-tight tracking-tight">Browse National Administrative Register</h1>
                <p class="text-text-sec-light dark:text-text-sec-dark text-base font-normal leading-normal">Explore the complete collection of legal bulletins, department orders, and administrative issuances.</p>
            </div>
        </div>

        <!-- Search Bar Area -->
        <div class="bg-white dark:bg-card-dark p-4 md:p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <label class="flex flex-col w-full md:flex-[2]">
                    <p class="text-text-main-light dark:text-text-main-dark text-sm font-medium leading-normal pb-2">Search keywords</p>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $query }}" 
                            class="w-full h-12 px-4 pr-12 rounded-lg 
                                border border-border-light dark:border-border-dark 
                                bg-white dark:bg-background-dark 
                                text-text-main-light dark:text-white 
                                placeholder:text-text-sec-light 
                                focus:border-primary focus:ring-1 focus:ring-primary 
                                outline-none transition-all" 
                            placeholder="e.g., Department Order regarding PhilHealth"
                        />

                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 
                                    text-text-sec-light pointer-events-none">
                            search
                        </span>
                    </div>
                </label>
                <label class="flex flex-col w-full md:flex-1">
                    <p class="text-text-main-light dark:text-text-main-dark text-sm font-medium leading-normal pb-2">Reference Number</p>
                    <input 
                        type="text" 
                        name="reference_no" 
                        value="{{ $referenceNo ?? '' }}" 
                        class="w-full rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-background-dark text-text-main-light dark:text-white h-12 px-4 placeholder:text-text-sec-light focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" 
                        placeholder="e.g., 2023-005"
                    />
                </label>
                @if($selectedAgencyId)
                    <input type="hidden" name="agency_id" value="{{ $selectedAgencyId }}">
                @endif
                @foreach($selectedIssuanceTypeIds as $typeId)
                    <input type="hidden" name="issuance_type_id[]" value="{{ $typeId }}">
                @endforeach
                @if($dateFrom)
                    <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                @endif
                @if($dateTo)
                    <input type="hidden" name="date_to" value="{{ $dateTo }}">
                @endif
                @if(request('year'))
                    <input type="hidden" name="year" value="{{ request('year') }}">
                @endif
                <input type="hidden" name="sort" value="{{ $sort }}">
                <button type="submit" class="w-full md:w-auto h-12 px-8 bg-primary hover:opacity-90 text-white font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">filter_list</span>
                    Search
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Sidebar Filters -->
        <aside class="lg:col-span-3 flex flex-col gap-6">
            <!-- Mobile Filter Toggle (Visible only on small screens) -->
            <button class="lg:hidden w-full flex items-center justify-between p-4 bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-lg shadow-sm" onclick="toggleMobileFilters()">
                <span class="font-bold text-text-main-light dark:text-white">Filters</span>
                <span class="material-symbols-outlined">tune</span>
            </button>

            <div id="mobile-filters" class="hidden lg:flex flex-col gap-6">
                <!-- Date Range Filter -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-text-main-light dark:text-white text-base font-bold">Publication Year</h3>
                    <form method="GET" action="{{ route('search') }}" id="year-filter-form">
                        <input type="hidden" name="q" value="{{ $query }}">
                        <input type="hidden" name="reference_no" value="{{ $referenceNo ?? '' }}">
                        @if($selectedAgencyId)
                            <input type="hidden" name="agency_id" value="{{ $selectedAgencyId }}">
                        @endif
                        @foreach($selectedIssuanceTypeIds as $typeId)
                            <input type="hidden" name="issuance_type_id[]" value="{{ $typeId }}">
                        @endforeach
                        @if($dateFrom)
                            <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                        @endif
                        @if($dateTo)
                            <input type="hidden" name="date_to" value="{{ $dateTo }}">
                        @endif
                        <input type="hidden" name="sort" value="{{ $sort }}">
                        <div class="flex items-center gap-2">
                            <input 
                                class="w-full rounded border border-border-light dark:border-border-dark bg-white dark:bg-background-dark px-3 py-2 text-sm focus:border-primary outline-none dark:text-white" 
                                placeholder="From" 
                                type="number" 
                                name="year_from" 
                                value="{{ request('year_from') }}"
                                onchange="document.getElementById('year-filter-form').submit()"
                            />
                            <span class="text-text-sec-light">-</span>
                            <input 
                                class="w-full rounded border border-border-light dark:border-border-dark bg-white dark:bg-background-dark px-3 py-2 text-sm focus:border-primary outline-none dark:text-white" 
                                placeholder="To" 
                                type="number" 
                                name="year_to" 
                                value="{{ request('year_to') }}"
                                onchange="document.getElementById('year-filter-form').submit()"
                            />
                        </div>
                    </form>
                    @if(!empty($availableYears))
                        <div class="flex flex-wrap gap-2 mt-1">
                            @foreach(array_slice($availableYears, 0, 3) as $availableYear)
                                <a href="{{ route('search', array_merge(request()->except(['year', 'page']), ['year' => $availableYear])) }}" class="px-3 py-1 bg-background-light dark:bg-background-dark rounded text-xs font-medium text-text-sec-light dark:text-text-sec-dark hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                    {{ $availableYear }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <hr class="border-border-light dark:border-border-dark"/>

                <!-- Issuance Type Filter -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-text-main-light dark:text-white text-base font-bold">Issuance Type</h3>
                    <form method="GET" action="{{ route('search') }}" id="issuance-type-form">
                        <input type="hidden" name="q" value="{{ $query }}">
                        <input type="hidden" name="reference_no" value="{{ $referenceNo ?? '' }}">
                        @if($selectedAgencyId)
                            <input type="hidden" name="agency_id" value="{{ $selectedAgencyId }}">
                        @endif
                        @if($dateFrom)
                            <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                        @endif
                        @if($dateTo)
                            <input type="hidden" name="date_to" value="{{ $dateTo }}">
                        @endif
                        @if(request('year'))
                            <input type="hidden" name="year" value="{{ request('year') }}">
                        @endif
                        <input type="hidden" name="sort" value="{{ $sort }}">

                        <div class="relative">
                            <input 
                                class="w-full rounded border border-border-light dark:border-border-dark bg-white dark:bg-background-dark pl-8 pr-3 py-2 text-sm focus:border-primary outline-none dark:text-white placeholder:text-text-sec-light" 
                                placeholder="Filter issuance types..." 
                                type="text" 
                                id="issuance-type-search" 
                                onkeyup="filterIssuanceTypes()"
                            />
                            <span class="material-symbols-outlined absolute left-2 top-2 text-[18px] text-text-sec-light">search</span>
                        </div>

                        <div class="max-h-64 overflow-y-auto flex flex-col gap-2 pr-2 mt-2" id="issuance-type-list">
                            @foreach($issuanceTypes as $type)
                                @php
                                    $typeCount = \App\Models\Document::where('issuance_type_id', $type->id)->count();
                                @endphp
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input 
                                        class="size-4 rounded border-gray-300 text-primary focus:ring-primary" 
                                        type="checkbox" 
                                        name="issuance_type_id[]" 
                                        value="{{ $type->id }}" 
                                        {{ in_array($type->id, $selectedIssuanceTypeIds) ? 'checked' : '' }} 
                                        onchange="document.getElementById('issuance-type-form').submit()"
                                    />
                                    <span class="text-sm text-text-sec-light dark:text-gray-300 group-hover:text-primary transition-colors flex-1">{{ $type->name }}</span>
                                    <span class="text-xs text-text-sec-light dark:text-gray-400">{{ $typeCount }}</span>
                                </label>
                            @endforeach
                        </div>
                    </form>
                </div>

                <hr class="border-border-light dark:border-border-dark"/>

                <!-- Agency Filter -->
                <div class="flex flex-col gap-3">
                    <h3 class="text-text-main-light dark:text-white text-base font-bold">Issuing Agency</h3>
                    <form method="GET" action="{{ route('search') }}" id="agency-form">
                        <input type="hidden" name="q" value="{{ $query }}">
                        <input type="hidden" name="reference_no" value="{{ $referenceNo ?? '' }}">
                        @foreach($selectedIssuanceTypeIds as $typeId)
                            <input type="hidden" name="issuance_type_id[]" value="{{ $typeId }}">
                        @endforeach
                        @if($dateFrom)
                            <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                        @endif
                        @if($dateTo)
                            <input type="hidden" name="date_to" value="{{ $dateTo }}">
                        @endif
                        @if(request('year'))
                            <input type="hidden" name="year" value="{{ request('year') }}">
                        @endif
                        <input type="hidden" name="sort" value="{{ $sort }}">

                        <div class="relative">
                            <input 
                                class="w-full rounded border border-border-light dark:border-border-dark bg-white dark:bg-background-dark pl-8 pr-3 py-2 text-sm focus:border-primary outline-none dark:text-white placeholder:text-text-sec-light" 
                                placeholder="Filter agencies..." 
                                type="text" 
                                id="agency-search" 
                                onkeyup="filterAgencies()"
                            />
                            <span class="material-symbols-outlined absolute left-2 top-2 text-[18px] text-text-sec-light">search</span>
                        </div>

                        <div class="max-h-64 overflow-y-auto flex flex-col gap-2 pr-2 mt-2" id="agency-list">
                            @foreach($agencies as $agency)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input 
                                        class="size-4 rounded border-gray-300 text-primary focus:ring-primary" 
                                        type="radio" 
                                        name="agency_id" 
                                        value="{{ $agency->id }}" 
                                        {{ $selectedAgencyId == $agency->id ? 'checked' : '' }} 
                                        onchange="document.getElementById('agency-form').submit()"
                                    />
                                    <span class="text-sm text-text-sec-light dark:text-gray-300 group-hover:text-primary transition-colors">{{ $agency->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </form>
                </div>

                <button onclick="applyFilters()" class="w-full py-2 bg-text-main-light dark:bg-white text-white dark:text-text-main-light font-bold rounded hover:opacity-90 transition-opacity">
                    Apply Filters
                </button>
            </div>
        </aside>

        <!-- Results Column -->
        <main class="lg:col-span-9 flex flex-col gap-6">
            <!-- Results Control Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-border-light dark:border-border-dark">
                <p class="text-text-main-light dark:text-text-main-dark font-medium">
                    Showing <span class="font-bold">{{ $documents->firstItem() ?? 0 }}-{{ $documents->lastItem() ?? 0 }}</span> of <span class="font-bold">{{ number_format($documents->total()) }}</span> bulletins
                </p>
                <div class="flex items-center gap-3">
                    <span class="text-sm text-text-sec-light dark:text-text-sec-dark">Sort by:</span>
                    <form method="GET" action="{{ route('search') }}" id="sort-form">
                        <input type="hidden" name="q" value="{{ $query }}">
                        <input type="hidden" name="reference_no" value="{{ $referenceNo ?? '' }}">
                        @if($selectedAgencyId)
                            <input type="hidden" name="agency_id" value="{{ $selectedAgencyId }}">
                        @endif
                        @foreach($selectedIssuanceTypeIds as $typeId)
                            <input type="hidden" name="issuance_type_id[]" value="{{ $typeId }}">
                        @endforeach
                        @if($dateFrom)
                            <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                        @endif
                        @if($dateTo)
                            <input type="hidden" name="date_to" value="{{ $dateTo }}">
                        @endif
                        @if(request('year'))
                            <input type="hidden" name="year" value="{{ request('year') }}">
                        @endif
                        <div class="relative">
                            <select 
                                class="appearance-none bg-background-light dark:bg-background-dark border-none rounded py-1.5 pl-3 pr-8 text-sm font-medium text-text-main-light dark:text-white cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors focus:ring-0" 
                                name="sort" 
                                onchange="document.getElementById('sort-form').submit()"
                            >
                                <option value="relevance" {{ $sort === 'relevance' ? 'selected' : '' }}>Relevance</option>
                                <option value="date_newest" {{ $sort === 'date_newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="date_oldest" {{ $sort === 'date_oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="title_az" {{ $sort === 'title_az' ? 'selected' : '' }}>Title (A-Z)</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-2 top-1.5 text-[18px] pointer-events-none text-text-sec-light">expand_more</span>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Active Filters (Chips) -->
            @if($selectedAgencyId || !empty($selectedIssuanceTypeIds) || request('year') || $dateFrom || $dateTo)
                <div class="flex flex-wrap gap-2">
                    @if(request('year'))
                        <a href="{{ route('search', array_merge(request()->except(['year', 'page']))) }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/10 dark:bg-primary/20 pl-3 pr-2 border border-primary/20 dark:border-primary/30">
                            <p class="text-primary dark:text-primary text-sm font-medium leading-normal">Year: {{ request('year') }}</p>
                            <span class="material-symbols-outlined text-primary dark:text-primary text-[16px] hover:text-red-500 transition-colors">close</span>
                        </a>
                    @endif
                    @if($selectedAgencyId)
                        @php
                            $selectedAgency = $agencies->firstWhere('id', $selectedAgencyId);
                        @endphp
                        @if($selectedAgency)
                            <a href="{{ route('search', array_merge(request()->except(['agency_id', 'page']))) }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/10 dark:bg-primary/20 pl-3 pr-2 border border-primary/20 dark:border-primary/30">
                                <p class="text-primary dark:text-primary text-sm font-medium leading-normal">Agency: {{ $selectedAgency->agency_code ?? $selectedAgency->name }}</p>
                                <span class="material-symbols-outlined text-primary dark:text-primary text-[16px] hover:text-red-500 transition-colors">close</span>
                            </a>
                        @endif
                    @endif
                    @foreach($selectedIssuanceTypeIds as $typeId)
                        @php
                            $selectedType = $issuanceTypes->firstWhere('id', $typeId);
                        @endphp
                        @if($selectedType)
                            <a href="{{ route('search', array_merge(request()->except(['issuance_type_id', 'page']), ['issuance_type_id' => array_values(array_diff($selectedIssuanceTypeIds, [$typeId]))])) }}" class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/10 dark:bg-primary/20 pl-3 pr-2 border border-primary/20 dark:border-primary/30">
                                <p class="text-primary dark:text-primary text-sm font-medium leading-normal">Type: {{ $selectedType->name }}</p>
                                <span class="material-symbols-outlined text-primary dark:text-primary text-[16px] hover:text-red-500 transition-colors">close</span>
                            </a>
                        @endif
                    @endforeach
                    <a href="{{ route('search', ['q' => $query, 'reference_no' => $referenceNo ?? '']) }}" class="text-sm text-text-sec-light hover:text-primary underline ml-2">Clear all</a>
                </div>
            @endif

            <!-- Bulletin List -->
            <div class="flex flex-col gap-4">
                @forelse($documents as $document)
                    @php
                        $issuanceType = $document->issuanceType;
                        $typeColors = [
                            'Administrative Order' => ['bg' => 'bg-blue-50 dark:bg-blue-900/40', 'text' => 'text-blue-700 dark:text-blue-300'],
                            'Memorandum Circular' => ['bg' => 'bg-purple-50 dark:bg-purple-900/40', 'text' => 'text-purple-700 dark:text-purple-300'],
                            'Republic Act' => ['bg' => 'bg-green-50 dark:bg-green-900/40', 'text' => 'text-green-700 dark:text-green-300'],
                            'Department Order' => ['bg' => 'bg-primary/10 dark:bg-primary/20', 'text' => 'text-primary dark:text-primary'],
                        ];
                        $typeName = $issuanceType?->name ?? 'Issuance';
                        $typeColor = $typeColors[$typeName] ?? ['bg' => 'bg-gray-50 dark:bg-gray-900/30', 'text' => 'text-gray-700 dark:text-gray-300'];
                        $issuanceNo = $document->issuance_no ?? $document->onar_no ?? 'N/A';
                        $dateFiled = $document->date_filed ? (is_numeric($document->date_filed) ? \Carbon\Carbon::parse($document->date_filed)->format('M d, Y') : $document->date_filed) : ($document->created_at ? $document->created_at->format('M d, Y') : 'N/A');
                        $agencyName = $document->agency?->name ?? 'Unknown Agency';
                        $excerpt = $document->subject ?? $document->content ?? '';
                        if ($excerpt && $query) {
                            $excerpt = str_ireplace($query, "<span class=\"bg-yellow-100 dark:bg-yellow-900/40 dark:text-yellow-100 font-medium px-0.5 rounded\">{$query}</span>", $excerpt);
                            $excerpt = \Illuminate\Support\Str::limit($excerpt, 200);
                        } else {
                            $excerpt = \Illuminate\Support\Str::limit($excerpt, 200);
                        }
                    @endphp
                    <div class="group flex flex-col gap-4 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark p-5 shadow-sm transition-all hover:shadow-md hover:border-primary/50 dark:hover:border-primary/30">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div class="flex flex-col gap-2 flex-1">
                                <div class="flex flex-wrap gap-2 items-center">
                                    <span class="inline-flex items-center rounded bg-background-light dark:bg-background-dark px-2 py-0.5 text-xs font-semibold text-text-main-light dark:text-text-main-dark">
                                        <span class="material-symbols-outlined text-[14px] mr-1">account_balance</span>
                                        {{ $agencyName }}
                                    </span>
                                    <span class="inline-flex items-center rounded {{ $typeColor['bg'] }} px-2 py-0.5 text-xs font-semibold {{ $typeColor['text'] }}">
                                        {{ $typeName }}
                                    </span>
                                </div>
                                <a href="{{ route('documents.show', $document) }}" class="text-lg md:text-xl font-bold leading-tight text-text-main-light hover:text-primary dark:text-white transition-colors w-full">
                                    {{ $document->title }}
                                </a>
                            </div>
                            <div class="shrink-0 flex flex-col items-start md:items-end gap-1">
                                <span class="flex items-center text-xs sm:text-sm font-medium text-text-sec-light dark:text-text-sec-dark">
                                    <span class="material-symbols-outlined text-[14px] sm:text-[16px] mr-1">calendar_today</span>
                                    {{ $dateFiled }}
                                </span>
                            </div>
                        </div>
                        @if($excerpt)
                            <p class="text-sm md:text-base text-text-sec-light dark:text-gray-300 line-clamp-2">
                                {!! $excerpt !!}
                            </p>
                        @endif
                        <div class="flex items-center gap-4 pt-2 border-t border-dashed border-border-light dark:border-border-dark mt-1">
                            <a href="{{ route('documents.show', $document) }}" class="flex items-center gap-1.5 text-sm font-medium text-primary hover:text-primary-dark transition-colors">
                                <span class="material-symbols-outlined text-[18px]">visibility</span> <span class="hidden sm:inline">View Details</span>
                            </a>
                            @if($document->file)
                                <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="flex items-center gap-1.5 text-sm font-medium text-text-sec-light hover:text-text-main-light dark:text-text-sec-dark dark:hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">download</span> <span class="hidden sm:inline">Download PDF</span>
                                </a>
                            @else
                                <button class="flex items-center gap-1.5 text-sm font-medium text-text-sec-light dark:text-text-sec-dark opacity-50 cursor-not-allowed" disabled>
                                    <span class="material-symbols-outlined text-[18px]">download</span> <span class="hidden sm:inline">Download PDF</span>
                                </button>
                            @endif
                            <span class="text-xs text-text-sec-light dark:text-text-sec-dark ml-auto">Ref: {{ $issuanceNo }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-card-dark p-12 rounded-lg border border-border-light dark:border-border-dark text-center">
                        <p class="text-text-sec-light dark:text-text-sec-dark text-lg mb-2">No documents found</p>
                        <p class="text-text-sec-light dark:text-text-sec-dark text-sm">Try adjusting your search criteria or filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="flex items-center justify-center gap-2 mt-8 pb-10">
                    @if($documents->onFirstPage())
                        <button class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark disabled:opacity-50" disabled>
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    @else
                        <a href="{{ $documents->previousPageUrl() }}" class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </a>
                    @endif

                    @foreach($documents->getUrlRange(1, min(5, $documents->lastPage())) as $page => $url)
                        @if($page == $documents->currentPage())
                            <span class="flex items-center justify-center size-10 rounded-lg bg-primary text-white font-medium shadow-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark font-medium transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($documents->lastPage() > 5)
                        <span class="text-text-sec-light dark:text-text-sec-dark px-2">...</span>
                        <a href="{{ $documents->url($documents->lastPage()) }}" class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark font-medium transition-colors">{{ $documents->lastPage() }}</a>
                    @endif

                    @if($documents->hasMorePages())
                        <a href="{{ $documents->nextPageUrl() }}" class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark transition-colors">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </a>
                    @else
                        <button class="flex items-center justify-center size-10 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-text-main-light dark:text-white hover:bg-background-light dark:hover:bg-background-dark disabled:opacity-50" disabled>
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    @endif
                </div>
            @endif
        </main>
    </div>
</div>

@push('scripts')
<script>
    function filterAgencies() {
        const input = document.getElementById('agency-search');
        const filter = input.value.toLowerCase();
        const agencyList = document.getElementById('agency-list');
        const labels = agencyList.getElementsByTagName('label');

        for (let i = 0; i < labels.length; i++) {
            const text = labels[i].textContent || labels[i].innerText;
            if (text.toLowerCase().indexOf(filter) > -1) {
                labels[i].style.display = '';
            } else {
                labels[i].style.display = 'none';
            }
        }
    }

    function filterIssuanceTypes() {
        const input = document.getElementById('issuance-type-search');
        const filter = input.value.toLowerCase();
        const issuanceTypeList = document.getElementById('issuance-type-list');
        const labels = issuanceTypeList.getElementsByTagName('label');

        for (let i = 0; i < labels.length; i++) {
            const text = labels[i].textContent || labels[i].innerText;
            if (text.toLowerCase().indexOf(filter) > -1) {
                labels[i].style.display = '';
            } else {
                labels[i].style.display = 'none';
            }
        }
    }

    function toggleMobileFilters() {
        const filters = document.getElementById('mobile-filters');
        filters.classList.toggle('hidden');
    }

    function applyFilters() {
        // This function can be used to submit all filter forms at once if needed
        // For now, individual forms handle their own submissions
    }
</script>
@endpush
@endsection
