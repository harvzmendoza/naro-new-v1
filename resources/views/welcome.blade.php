@extends('layouts.app')

@section('title', 'UP Law Center - National Administrative Register')

@section('content')
    <!-- Hero Section -->
    <div class="w-full bg-card-dark relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0" style='background-image: linear-gradient(rgba(128, 0, 32, 0.85), rgba(16, 22, 34, 0.9))'>
            <img alt="Bocobo Hall - UP Law Center" class="w-full h-full object-cover opacity-10" src="{{ asset('images/bg.jpg') }}"/>
        </div>
        <!-- Live Indicator -->
        <div class="relative z-10 max-w-[960px] mx-auto px-4 py-20 md:py-24 flex flex-col items-center text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-xs font-medium text-white mb-6 backdrop-blur-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                Updated daily with new issuances
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 tracking-tight">
                Search the National Administrative Register
            </h1>
            <p class="text-text-sec-dark text-base md:text-lg mb-10 max-w-2xl font-light">
                The official repository of thousands of bulletins, circulars, and issuances from Philippine government agencies.
            </p>
            <!-- Search Component -->
            <div class="w-full max-w-[720px] shadow-2xl rounded-xl overflow-hidden relative z-20">
                <form action="{{ route('search') }}" method="GET" class="flex flex-col md:flex-row bg-white dark:bg-card-dark rounded-xl p-2 gap-2 border border-white/10">
                    <div class="relative flex-grow group">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-text-sec-light">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input name="q" class="w-full h-12 pl-10 pr-4 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:bg-white dark:focus:bg-background-dark focus:ring-0 text-text-main-light dark:text-white placeholder:text-text-sec-light transition-all text-sm md:text-base" placeholder="Search by keyword, bulletin number, or title..." type="text" value="{{ request('q') }}"/>
                    </div>
                    <div class="flex gap-2">
                        <select name="year" class="h-12 pl-3 pr-8 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:ring-0 text-text-main-light dark:text-white text-sm cursor-pointer w-full md:w-auto min-w-[120px]">
                            <option value="">All Years</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white h-12 px-6 rounded-lg font-bold text-sm md:text-base flex items-center justify-center gap-2 transition-colors min-w-[120px]">
                            Search
                        </button>
                    </div>
                </form>
                <div class="bg-black/20 backdrop-blur-sm px-4 py-3 text-left flex flex-wrap gap-x-4 gap-y-2 text-xs text-white/70 items-center">
                    <span class="font-semibold text-white/90">Common Searches:</span>
                    <a class="hover:text-white hover:underline decoration-white/30 transition-all" href="{{ route('search', ['q' => 'Tax Reform']) }}">Tax Reform</a>
                    <a class="hover:text-white hover:underline decoration-white/30 transition-all" href="{{ route('search', ['q' => 'Labor Guidelines']) }}">Labor Guidelines</a>
                    <a class="hover:text-white hover:underline decoration-white/30 transition-all" href="{{ route('search', ['q' => 'Health Protocols']) }}">Health Protocols</a>
                    <a class="hover:text-white hover:underline decoration-white/30 transition-all" href="{{ route('search', ['q' => 'Customs Tariffs']) }}">Customs Tariffs</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Bulletin Volumes Section -->
    @if($latestVolumes->isNotEmpty())
    <div class="w-full bg-white dark:bg-card-dark border-b border-border-light dark:border-border-dark">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark tracking-tight">Latest Bulletin Volumes</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark mt-1">Recently published compilations by volume and book number.</p>
                </div>
                <a class="hidden md:flex items-center text-primary font-bold text-sm hover:underline gap-1" href="{{ route('bulletins') }}">
                    Browse all bulletins <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestVolumes as $volume)
                    <div class="bg-background-light dark:bg-background-dark rounded-xl p-5 border border-border-light dark:border-border-dark hover:border-primary/50 transition-colors group cursor-pointer relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
                            <span class="material-symbols-outlined text-6xl">library_books</span>
                        </div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-white dark:bg-card-dark flex items-center justify-center shadow-sm text-primary border border-border-light dark:border-border-dark">
                                <span class="material-symbols-outlined">menu_book</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-text-main-light dark:text-text-main-dark">{{ $volume['volume_name'] }}</h3>
                                <p class="text-xs text-text-sec-light dark:text-text-sec-dark font-mono">No. {{ $volume['book_name'] }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            @if($volume['period_start'] && $volume['period_end'])
                                <div class="flex justify-between text-xs">
                                    <span class="text-text-sec-light dark:text-text-sec-dark">Period Covered:</span>
                                    <span class="font-medium text-text-main-light dark:text-text-main-dark">
                                        {{ \Carbon\Carbon::parse($volume['period_start'])->format('M') }} - {{ \Carbon\Carbon::parse($volume['period_end'])->format('M Y') }}
                                    </span>
                                </div>
                            @endif
                            <div class="flex justify-between text-xs">
                                <span class="text-text-sec-light dark:text-text-sec-dark">Issuances:</span>
                                <span class="font-medium text-text-main-light dark:text-text-main-dark">{{ number_format($volume['document_count']) }} Docs</span>
                            </div>
                        </div>
                        <a href="{{ route('bulletins', ['section' => $volume['id']]) }}" class="block w-full py-2 bg-white dark:bg-card-dark border border-border-light dark:border-border-dark rounded-lg text-xs font-bold text-primary group-hover:bg-primary group-hover:text-white group-hover:border-primary transition-all text-center">
                            View Content
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- AI-Powered Summaries Section -->
    @if($aiSummaries->isNotEmpty())
    <div class="w-full ai-gradient border-b border-border-light dark:border-border-dark">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-accent-ai text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wide">New Feature</span>
                        <span class="material-symbols-outlined text-accent-ai text-lg">auto_awesome</span>
                    </div>
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark tracking-tight">AI-Powered Summaries</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark mt-1 max-w-xl">
                        Quickly understand complex regulations. Our AI generates concise summaries of lengthy issuances for faster review.
                    </p>
                </div>
                <a class="text-sm font-bold text-accent-ai hover:text-accent-ai/80 flex items-center gap-1 transition-colors" href="{{ route('help') }}">
                    How it works <span class="material-symbols-outlined text-sm">help</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($aiSummaries as $document)
                    <div class="bg-white dark:bg-card-dark rounded-xl p-6 border border-indigo-100 dark:border-indigo-900/30 shadow-sm hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-mono text-text-sec-light dark:text-text-sec-dark bg-background-light dark:bg-background-dark px-2 py-1 rounded">{{ $document->issuance_no ?? 'N/A' }}</span>
                            <span class="material-symbols-outlined text-accent-ai text-lg">smart_toy</span>
                        </div>
                        <h3 class="font-bold text-text-main-light dark:text-text-main-dark mb-2 text-sm line-clamp-1">{{ $document->title }}</h3>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark mb-4 line-clamp-3 leading-relaxed">
                            {{ $document->subject ?? \Illuminate\Support\Str::limit($document->content ?? 'No summary available.', 150) }}
                        </p>
                        <a class="text-xs font-bold text-accent-ai flex items-center gap-1 hover:underline" href="{{ route('documents.show', $document) }}">
                            Read full summary <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Agencies Section -->
    <div class="w-full max-w-[1280px] px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark tracking-tight">Issuing Agencies</h2>
                <p class="text-text-sec-light dark:text-text-sec-dark mt-1">Quick access to agency-specific documents.</p>
            </div>
            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3 items-center">
                <div class="relative w-full sm:w-[300px]">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-text-sec-light">
                        <span class="material-symbols-outlined text-lg">search</span>
                    </span>
                    <input class="w-full pl-9 pr-4 py-2 text-sm rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark focus:ring-1 focus:ring-primary focus:border-primary transition-all" placeholder="Find an agency..." type="text" id="agency-search" onkeyup="filterAgencies()"/>
                </div>
                <a class="hidden md:flex items-center text-primary font-bold text-sm hover:underline gap-1 whitespace-nowrap" href="{{ route('agencies') }}">
                    Agency Directory <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
        @if($agencies->isEmpty())
            <p class="text-text-sec-light dark:text-text-sec-dark">No agencies found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="agencies-grid">
                @foreach($agencies as $agency)
                    <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 agency-card" href="{{ route('search', ['agency_id' => $agency->id]) }}" data-name="{{ strtolower($agency->name) }}" data-code="{{ strtolower($agency->agency_code ?? '') }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">account_balance</span>
                            </div>
                            @if($agency->agency_code)
                                <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">{{ $agency->agency_code }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">{{ $agency->name }}</h3>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">{{ number_format($agency->documents_count) }} Issuance{{ $agency->documents_count == 1 ? '' : 's' }}</p>
                    </a>
                @endforeach
            </div>
        @endif
        <div class="mt-6 md:hidden">
            <a class="flex items-center justify-center w-full py-3 rounded-lg border border-border-light dark:border-border-dark bg-white dark:bg-card-dark text-primary font-bold text-sm" href="{{ route('agencies') }}">
                View Agency Directory
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
                                    <a class="font-medium text-primary hover:underline line-clamp-2" href="{{ route('documents.show', $document) }}" title="{{ $document->title }}">
                                        {{ $document->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center text-[10px] font-bold text-yellow-800">
                                            {{ strtoupper(substr($document->agency?->name ?? 'U', 0, 1)) }}
                                        </div>
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

    @push('scripts')
    <script>
        function filterAgencies() {
            const input = document.getElementById('agency-search');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.agency-card');
            
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const code = card.getAttribute('data-code');
                if (name.includes(filter) || code.includes(filter)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    @endpush
@endsection
