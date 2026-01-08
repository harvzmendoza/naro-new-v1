@extends('layouts.app')

@section('title', 'Agency Directory - ONAR')

@section('content')
<div class="w-full max-w-[1200px] flex flex-col gap-6 px-4 md:px-10 py-6">
    <!-- Breadcrumbs -->
    <nav class="flex items-center text-sm font-medium text-text-sec-light dark:text-text-sec-dark">
        <a class="hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
        <span class="mx-2 text-gray-400">/</span>
        <span class="text-text-main-light dark:text-white">Agency Directory</span>
    </nav>

    <!-- Page Heading & Intro -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-gray-100 dark:border-gray-800 pb-6">
        <div class="flex flex-col gap-2 max-w-2xl">
            <h1 class="text-3xl md:text-4xl font-black tracking-tight text-text-main-light dark:text-white">Agency Directory</h1>
            <p class="text-text-sec-light dark:text-text-sec-dark text-lg">
                Browse the complete list of government agencies, bureaus, and offices. Access their legal issuances, circulars, and administrative orders directly.
            </p>
        </div>
        <div class="hidden md:block">
            <button class="flex items-center gap-2 text-primary font-semibold hover:underline">
                <span class="material-symbols-outlined text-sm">download</span>
                Download Directory (PDF)
            </button>
        </div>
    </div>

    <!-- Search & Filtering Section -->
    <div class="flex flex-col gap-4 bg-white dark:bg-card-dark p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-800">
        <form method="GET" action="{{ route('agencies') }}" class="flex flex-col gap-4">
            <!-- Top Row: Search and Dropdown -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Agency Search -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-text-main-light dark:text-gray-300 mb-1">Search Agency</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-sec-light dark:text-gray-500">search</span>
                        </div>
                        <input 
                            name="q" 
                            value="{{ $query }}"
                            class="w-full pl-10 pr-4 py-3 bg-background-light dark:bg-background-dark border-none rounded-lg text-text-main-light dark:text-white placeholder-text-sec-light focus:ring-2 focus:ring-primary" 
                            placeholder="Search by agency name or acronym (e.g., 'DOH', 'Health')..." 
                            type="text"
                        />
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="w-full md:w-64">
                    <label class="block text-sm font-medium text-text-main-light dark:text-gray-300 mb-1">Filter by Category</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-sec-light dark:text-gray-500">filter_list</span>
                        </div>
                        <select 
                            name="category" 
                            class="w-full pl-10 pr-8 py-3 bg-background-light dark:bg-background-dark border-none rounded-lg text-text-main-light dark:text-white focus:ring-2 focus:ring-primary appearance-none cursor-pointer"
                            onchange="this.form.submit()"
                        >
                            <option value="">All Categories</option>
                            <option value="department" {{ $category === 'department' ? 'selected' : '' }}>Departments</option>
                            <option value="bureau" {{ $category === 'bureau' ? 'selected' : '' }}>Bureaus</option>
                            <option value="commission" {{ $category === 'commission' ? 'selected' : '' }}>Commissions</option>
                            <option value="office" {{ $category === 'office' ? 'selected' : '' }}>Offices</option>
                            <option value="council" {{ $category === 'council' ? 'selected' : '' }}>Councils</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-text-sec-light dark:text-gray-500">expand_more</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row: Alphabetical Filter -->
            <div class="flex flex-wrap items-center gap-1 pt-2 border-t border-gray-100 dark:border-gray-700 mt-2">
                <span class="text-xs font-bold uppercase text-text-sec-light dark:text-gray-400 mr-2">Quick Jump:</span>
                <a 
                    href="{{ route('agencies', array_merge(request()->except('letter'), ['letter' => 'all'])) }}"
                    class="w-8 h-8 flex items-center justify-center rounded text-sm font-medium {{ ($letter === '' || $letter === 'all') ? 'bg-primary text-white shadow-sm' : 'text-text-sec-light dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary transition-colors' }}"
                >
                    All
                </a>
                @foreach(range('A', 'Z') as $char)
                    <a 
                        href="{{ route('agencies', array_merge(request()->except('letter'), ['letter' => $char])) }}"
                        class="w-8 h-8 flex items-center justify-center rounded text-sm font-medium {{ $letter === $char ? 'bg-primary text-white shadow-sm' : 'text-text-sec-light dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary transition-colors' }}"
                    >
                        {{ $char }}
                    </a>
                @endforeach
            </div>
        </form>
    </div>

    <!-- Results Info -->
    <div class="flex justify-between items-center px-1">
        <p class="text-sm text-text-sec-light dark:text-gray-400">
            Showing <span class="font-bold text-text-main-light dark:text-white">{{ $agencies->firstItem() ?? 0 }}</span> to <span class="font-bold text-text-main-light dark:text-white">{{ $agencies->lastItem() ?? 0 }}</span> of <span class="font-bold text-text-main-light dark:text-white">{{ $agencies->total() }}</span> agencies
        </p>
        <div class="flex items-center gap-2">
            <span class="text-sm text-text-sec-light dark:text-gray-400">Sort by:</span>
            <form method="GET" action="{{ route('agencies') }}" class="inline">
                @foreach(request()->except('sort') as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <select 
                    name="sort" 
                    class="text-sm bg-transparent border-none text-text-main-light dark:text-white font-medium focus:ring-0 cursor-pointer p-0 pr-6"
                    onchange="this.form.submit()"
                >
                    <option value="name_az" {{ $sort === 'name_az' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="issuance_count" {{ $sort === 'issuance_count' ? 'selected' : '' }}>Issuance Count (High-Low)</option>
                    <option value="recently_updated" {{ $sort === 'recently_updated' ? 'selected' : '' }}>Recently Updated</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Agency Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($agencies as $agency)
            <div class="group bg-white dark:bg-card-dark rounded-xl p-5 border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-primary/30 transition-all duration-200 flex flex-col h-full">
                <div class="flex items-start justify-between mb-4">
                    <div class="size-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-primary dark:text-blue-400">
                        @if($agency->logo)
                            <img src="{{ asset('storage/' . $agency->logo) }}" alt="{{ $agency->name }}" class="w-full h-full object-contain rounded-lg">
                        @else
                            <span class="material-symbols-outlined text-2xl">account_balance</span>
                        @endif
                    </div>
                    @if($agency->agency_code)
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                            {{ $agency->agency_code }}
                        </span>
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-text-main-light dark:text-white mb-1 group-hover:text-primary transition-colors">
                        {{ $agency->name }}
                    </h3>
                    <p class="text-sm text-text-sec-light dark:text-gray-400 line-clamp-2 mb-4">
                        {{ $agency->description ?? 'Government agency issuing administrative rules and regulations.' }}
                    </p>
                </div>
                <div class="pt-4 border-t border-gray-50 dark:border-gray-800 flex items-center justify-between mt-auto">
                    <span class="text-xs font-medium text-text-sec-light dark:text-gray-500">
                        {{ number_format($agency->documents_count) }} Issuance{{ $agency->documents_count == 1 ? '' : 's' }}
                    </span>
                    <a 
                        class="text-sm font-semibold text-primary flex items-center gap-1" 
                        href="{{ route('search', ['agency_id' => $agency->id]) }}"
                    >
                        View Docs <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-text-sec-light dark:text-text-sec-dark">No agencies found matching your criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($agencies->hasPages())
        <div class="flex justify-center mt-6">
            <nav class="flex items-center gap-1 bg-white dark:bg-card-dark p-2 rounded-lg shadow-sm border border-gray-100 dark:border-gray-800">
                @if($agencies->onFirstPage())
                    <span class="w-9 h-9 flex items-center justify-center rounded-md text-text-sec-light dark:text-gray-400 opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </span>
                @else
                    <a 
                        href="{{ $agencies->previousPageUrl() }}" 
                        class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-background-light dark:hover:bg-gray-700 text-text-sec-light dark:text-gray-400 transition-colors"
                    >
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>
                @endif

                @foreach($agencies->getUrlRange(1, min(5, $agencies->lastPage())) as $page => $url)
                    @if($page == $agencies->currentPage())
                        <span class="w-9 h-9 flex items-center justify-center rounded-md bg-primary text-white font-medium shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <a 
                            href="{{ $url }}" 
                            class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-background-light dark:hover:bg-gray-700 text-text-sec-light dark:text-gray-400 font-medium transition-colors"
                        >
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if($agencies->hasMorePages())
                    @if($agencies->lastPage() > 5)
                        <span class="w-9 h-9 flex items-center justify-center text-text-sec-light dark:text-gray-500">...</span>
                        <a 
                            href="{{ $agencies->url($agencies->lastPage()) }}" 
                            class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-background-light dark:hover:bg-gray-700 text-text-sec-light dark:text-gray-400 font-medium transition-colors"
                        >
                            {{ $agencies->lastPage() }}
                        </a>
                    @endif
                    <a 
                        href="{{ $agencies->nextPageUrl() }}" 
                        class="w-9 h-9 flex items-center justify-center rounded-md hover:bg-background-light dark:hover:bg-gray-700 text-text-sec-light dark:text-gray-400 transition-colors"
                    >
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                @else
                    <span class="w-9 h-9 flex items-center justify-center rounded-md text-text-sec-light dark:text-gray-400 opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </span>
                @endif
            </nav>
        </div>
    @endif
</div>
@endsection

