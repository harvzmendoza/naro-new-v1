@extends('layouts.app')

@section('title', ($document->issuance_no ?: 'Document') . ' - ONAR UP Law Center')

@push('styles')
<style>
    /* Custom scrollbar for cleaner look */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #334155;
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }

    .typography p {
        margin-bottom: 1.5rem;
        line-height: 1.8;
        color: #334155; /* slate-700 */
    }

    .dark .typography p {
        color: #cbd5e1; /* slate-300 */
    }

    .typography h3 {
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-size: 1.25rem;
        color: #0f172a; /* slate-900 */
    }

    .dark .typography h3 {
        color: #f8fafc; /* slate-50 */
    }

    .typography ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .typography li {
        margin-bottom: 0.5rem;
        color: #334155;
    }

    .dark .typography li {
        color: #cbd5e1;
    }
</style>
@endpush

@section('content')
<div class="w-full max-w-7xl mx-auto px-4 lg:px-8 py-8">
    <!-- Breadcrumbs -->
    <nav class="flex flex-wrap items-center gap-2 text-sm mb-8 text-slate-500 dark:text-slate-400">
        <a class="hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        <a class="hover:text-primary transition-colors" href="{{ route('search') }}">Issuances</a>
        @if($document->doc_year)
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('search', ['year' => $document->doc_year]) }}">{{ $document->doc_year }}</a>
        @endif
        @if($document->agency)
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="font-medium text-slate-900 dark:text-white">{{ $document->agency->name }}</span>
        @endif
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left Column: Document (8 cols) -->
        <div class="lg:col-span-8 flex flex-col gap-6">
            <!-- Document Header Card -->
            <section class="bg-white dark:bg-card-dark rounded-xl p-6 md:p-8 shadow-sm border border-slate-200 dark:border-slate-800 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                    <span class="material-symbols-outlined text-[120px] text-slate-400">gavel</span>
                </div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div class="flex flex-wrap gap-3 items-center">
                        @if($document->publish)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                <span class="size-2 rounded-full bg-green-500 animate-pulse"></span>
                                Active Status
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-900/30 dark:text-gray-400">
                                <span class="size-2 rounded-full bg-gray-500"></span>
                                Draft
                            </span>
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                            Public Access
                        </span>
                    </div>
                    <div>
                        @if($document->issuance_no)
                            <p class="text-slate-500 dark:text-slate-400 text-sm md:text-base font-medium uppercase tracking-wide mb-2">{{ $document->issuance_no }}</p>
                        @endif
                        <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white leading-tight tracking-tight">{{ $document->title }}</h1>
                    </div>
                </div>
            </section>

            <!-- Document Body -->
            <article class="bg-white dark:bg-card-dark rounded-xl p-8 md:p-12 shadow-sm border border-slate-200 dark:border-slate-800 min-h-[800px]">
                <div class="typography">
                    @if($document->content)
                        {!! nl2br(e($document->content)) !!}
                    @else
                        <p class="text-slate-500 dark:text-slate-400 italic">No content available for this document.</p>
                    @endif

                    <div class="my-12 flex justify-center">
                        <div class="h-px w-24 bg-slate-300 dark:bg-slate-700"></div>
                    </div>

                    <p class="italic text-center text-sm text-slate-500 dark:text-slate-400">
                        Certified True Copy<br/>
                        Office of the National Administrative Register<br/>
                        University of the Philippines Law Center
                    </p>
                </div>
            </article>
        </div>

        <!-- Right Column: Sidebar (4 cols) -->
        <aside class="lg:col-span-4 flex flex-col gap-6 sticky top-24">
            <!-- Action Toolbar -->
            <div class="bg-white dark:bg-card-dark rounded-xl p-5 shadow-sm border border-slate-200 dark:border-slate-800">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Actions</h3>
                <div class="flex flex-col gap-3">
                    @if($document->file)
                        <a href="{{ asset('storage/' . $document->file) }}" target="_blank" class="flex items-center justify-center gap-2 w-full bg-primary hover:opacity-90 text-white font-medium py-3 px-4 rounded-lg transition-opacity shadow-md shadow-blue-500/20">
                            <span class="material-symbols-outlined">download</span>
                            Download PDF
                        </a>
                    @else
                        <button disabled class="flex items-center justify-center gap-2 w-full bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 font-medium py-3 px-4 rounded-lg cursor-not-allowed">
                            <span class="material-symbols-outlined">download</span>
                            Download PDF
                        </button>
                    @endif
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="window.print()" class="flex items-center justify-center gap-2 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-medium py-2.5 px-4 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-[20px]">print</span>
                            Print
                        </button>
                        <button onclick="navigator.share ? navigator.share({title: '{{ addslashes($document->title) }}', url: window.location.href}) : navigator.clipboard.writeText(window.location.href)" class="flex items-center justify-center gap-2 w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 font-medium py-2.5 px-4 rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-[20px]">share</span>
                            Share
                        </button>
                    </div>
                    <button onclick="navigator.clipboard.writeText('{{ addslashes($document->issuance_no ?: $document->title) }}')" class="flex items-center justify-center gap-2 w-full text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary text-sm font-medium py-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">content_copy</span>
                        Copy Citation
                    </button>
                </div>
            </div>

            <!-- Metadata Panel -->
            <div class="bg-white dark:bg-card-dark rounded-xl p-0 shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider">Document Details</h3>
                </div>
                <div class="p-5 flex flex-col gap-5">
                    @if($document->agency)
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Issuing Body</span>
                            <div class="flex items-start gap-3">
                                @if($document->agency->logo)
                                    <div class="mt-1 bg-white p-1 rounded border border-slate-100 dark:border-slate-700 shadow-sm size-8 flex items-center justify-center">
                                        <img class="w-full h-full object-contain" alt="{{ $document->agency->name }} logo" src="{{ asset('storage/' . $document->agency->logo) }}"/>
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-slate-900 dark:text-white leading-tight">{{ $document->agency->name }}</span>
                            </div>
                        </div>
                        <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        @if($document->date_filed)
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date Filed</span>
                                <span class="text-sm font-medium text-slate-900 dark:text-white">
                                    @php
                                        try {
                                            $date = \Carbon\Carbon::parse($document->date_filed);
                                            echo $date->format('M d, Y');
                                        } catch (\Exception $e) {
                                            echo $document->date_filed;
                                        }
                                    @endphp
                                </span>
                            </div>
                        @endif
                        @if($document->doc_date)
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Effectivity</span>
                                <span class="text-sm font-medium text-slate-900 dark:text-white">
                                    @php
                                        try {
                                            $date = \Carbon\Carbon::parse($document->doc_date);
                                            echo $date->format('M d, Y');
                                        } catch (\Exception $e) {
                                            echo $document->doc_date;
                                        }
                                    @endphp
                                </span>
                            </div>
                        @endif
                    </div>

                    @if($document->issuanceType || $document->tags)
                        <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                    @endif

                    @if($document->issuanceType)
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Document Type</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $document->issuanceType->name }}</span>
                        </div>
                    @endif

                    @if($document->tags)
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Tags</span>
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach(explode(',', $document->tags) as $tag)
                                    <span class="px-2 py-1 rounded bg-slate-100 dark:bg-slate-800 text-xs text-slate-600 dark:text-slate-300">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($document->onar_no)
                        <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">ONAR No.</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $document->onar_no }}</span>
                        </div>
                    @endif

                    @if($document->subject)
                        <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Subject</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $document->subject }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Related Issuances Widget -->
            @if($relatedDocuments->count() > 0)
                <div class="bg-white dark:bg-card-dark rounded-xl p-5 shadow-sm border border-slate-200 dark:border-slate-800">
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Related Issuances</h3>
                    <div class="flex flex-col gap-4">
                        @foreach($relatedDocuments->take(5) as $relatedDoc)
                            <a class="group block" href="{{ route('documents.show', $relatedDoc) }}">
                                @if($relatedDoc->issuance_no)
                                    <span class="text-xs text-slate-500 dark:text-slate-400 block mb-1">{{ $relatedDoc->issuance_no }}</span>
                                @endif
                                <p class="text-sm font-medium text-primary group-hover:underline leading-snug">{{ Str::limit($relatedDoc->title, 60) }}</p>
                            </a>
                            @if(!$loop->last)
                                <div class="h-px bg-slate-100 dark:bg-slate-800"></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </div>
</div>
@endsection

