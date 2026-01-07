@extends('layouts.app')

@section('title', 'UP Law Center - National Administrative Register')

@section('content')
    <!-- Hero Section -->
    <div class="w-full bg-card-dark relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img alt="Bocobo Hall - UP Law Center" class="w-full h-full object-cover opacity-10" src="{{ asset('images/bg.jpg') }}"/>
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/20 to-background-dark/40"></div>
        </div>
        <div class="relative z-10 max-w-[960px] mx-auto px-4 py-20 md:py-28 flex flex-col items-center text-center">
            <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 tracking-tight">
                Search the National Administrative Register
            </h1>
            <p class="text-text-sec-dark text-base md:text-lg mb-10 max-w-2xl font-light">
                The official repository of thousands of bulletins, circulars, and issuances from Philippine government agencies.
            </p>
            <!-- Search Component -->
            <div class="w-full max-w-[640px] shadow-2xl rounded-xl overflow-hidden">
                <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row bg-white dark:bg-card-dark rounded-xl p-2 gap-2 border border-white/10">
                    <div class="relative flex-grow group">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-text-sec-light">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input name="q" class="w-full h-12 pl-10 pr-4 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:bg-white dark:focus:bg-background-dark focus:ring-0 text-text-main-light dark:text-white placeholder:text-text-sec-light transition-all text-sm md:text-base" placeholder="Search by keyword, bulletin number, or title..." type="text" value="{{ request('q') }}"/>
                    </div>
                    <div class="flex gap-2">
                        <select name="year" class="h-12 pl-3 pr-8 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:ring-0 text-text-main-light dark:text-white text-sm cursor-pointer w-full md:w-auto">
                            <option value="">All Years</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-primary hover:opacity-90 text-white h-12 px-6 rounded-lg font-bold text-sm md:text-base flex items-center justify-center gap-2 transition-colors min-w-[120px]">
                            Search
                        </button>
                    </div>
                </form>
                <div class="bg-black/20 backdrop-blur-sm px-4 py-2 text-left flex gap-4 text-xs text-white/70">
                    <span>Popular:</span>
                    <a class="hover:text-white underline decoration-white/30" href="{{ route('search', ['q' => 'Tax Reform']) }}">Tax Reform</a>
                    <a class="hover:text-white underline decoration-white/30" href="{{ route('search', ['q' => 'Labor Guidelines']) }}">Labor Guidelines</a>
                    <a class="hover:text-white underline decoration-white/30" href="{{ route('search', ['q' => 'Health Protocols']) }}">Health Protocols</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Agencies Section -->
    <div class="w-full max-w-[1280px] px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark tracking-tight">Issuing Agencies</h2>
                <p class="text-text-sec-light dark:text-text-sec-dark mt-1">Browse documents by government department or bureau.</p>
            </div>
            <a class="hidden md:flex items-center text-primary font-bold text-sm hover:underline gap-1" href="#">
                View all agencies <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        @if($agencies->isEmpty())
            <p class="text-text-sec-light dark:text-text-sec-dark">No agencies found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($agencies as $agency)
                    <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200" href="{{ route('search', ['agency_id' => $agency->id]) }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                                @if($agency->logo)
                                    <img src="{{ asset('storage/' . $agency->logo) }}" alt="{{ $agency->name }} Logo" class="h-full w-full object-contain p-1"/>
                                @else
                                    <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">account_balance</span>
                                @endif
                            </div>
                            <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">{{ $agency->agency_code ?? \Illuminate\Support\Str::limit($agency->name, 3, '') }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">{{ $agency->name }}</h3>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">{{ number_format($agency->documents_count) }} Issuance{{ $agency->documents_count == 1 ? '' : 's' }}</p>
                    </a>
                @endforeach
            </div>
        @endif
        <div class="mt-6 md:hidden">
            <a class="flex items-center justify-center w-full py-3 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-primary font-bold text-sm" href="#">
                View all agencies
            </a>
        </div>
    </div>

    <!-- Recent Issuances Section -->
    <div class="w-full max-w-[1280px] px-4 sm:px-6 lg:px-8 pb-20">
        <div class="bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border-light dark:border-border-dark flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-text-main-light dark:text-text-main-dark">Recently Filed Issuances</h2>
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-1">Updates from the last 7 days</p>
                </div>
                <button class="text-text-sec-light hover:text-primary dark:text-text-sec-dark dark:hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">filter_list</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark font-semibold uppercase text-xs tracking-wider border-b border-border-light dark:border-border-dark">
                        <tr>
                            <th class="px-6 py-4 w-[120px]">Date Filed</th>
                            <th class="px-6 py-4 w-[140px]">Bulletin No.</th>
                            <th class="px-6 py-4">Title / Subject</th>
                            <th class="px-6 py-4 w-[200px]">Issuing Agency</th>
                            <th class="px-6 py-4 w-[100px] text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-light dark:divide-border-dark">
                        @forelse($recentDocuments as $document)
                            <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">
                                    {{ \Carbon\Carbon::parse($document->date_filed ?? $document->created_at)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">{{ $document->issuance_no ?? $document->onar_no ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="{{ $document->title }}">
                                        {{ $document->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($document->agency?->logo)
                                            <img src="{{ asset('storage/' . $document->agency->logo) }}" alt="{{ $document->agency->name }} Logo" class="w-6 h-6 rounded-full object-contain"/>
                                        @else
                                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-800">{{ \Illuminate\Support\Str::limit($document->agency?->name, 1, '') }}</div>
                                        @endif
                                        <span class="text-text-main-light dark:text-text-main-dark">{{ $document->agency?->name ?? 'Unknown Agency' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($document->file)
                                        <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="text-text-sec-light hover:text-primary transition-colors" title="Download PDF">
                                            <span class="material-symbols-outlined text-xl">download</span>
                                        </a>
                                    @else
                                        <button class="text-text-sec-light hover:text-primary transition-colors opacity-50 cursor-not-allowed" title="No file available" disabled>
                                            <span class="material-symbols-outlined text-xl">download</span>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-text-sec-light dark:text-text-sec-dark">
                                    No recent documents found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-border-light dark:border-border-dark flex items-center justify-center bg-background-light/30 dark:bg-background-dark/30">
                <a href="{{ route('search') }}" class="text-primary font-bold text-sm hover:underline">View all recently filed issuances</a>
            </div>
        </div>
    </div>
@endsection
