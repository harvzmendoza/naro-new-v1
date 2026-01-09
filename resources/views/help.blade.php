@extends('layouts.app')

@section('title', 'Help & FAQs – UP Law Center - National Administrative Register')

@section('content')
    <!-- Hero Search Section -->
    <section class="relative bg-white dark:bg-card-dark border-b border-border-light dark:border-border-dark w-full">
        <div class="flex flex-col gap-6 bg-cover bg-center bg-no-repeat py-20 px-4 items-center justify-center relative w-full" data-alt="Abstract blue legal background pattern" style='background-image: linear-gradient(rgba(128, 0, 32, 0.85), rgba(16, 22, 34, 0.9)), url("{{ asset('images/bg.jpg') }}");'>
            <div class="flex flex-col gap-3 text-center z-10 max-w-2xl">
                <h1 class="text-white text-4xl md:text-5xl font-black leading-tight tracking-[-0.033em]">
                    How can we help you?
                </h1>
                <p class="text-blue-100 text-base md:text-lg font-normal leading-normal">
                    Find answers to your questions about legal bulletins, issuances, and research tools.
                </p>
            </div>
            <!-- <div class="w-full max-w-2xl z-10 mt-4">
                <form action="{{ route('search') }}" method="GET" class="flex w-full items-stretch rounded-lg h-14 bg-white shadow-lg overflow-hidden focus-within:ring-2 focus-within:ring-primary/50 transition-shadow">
                    <div class="flex items-center justify-center pl-4 pr-2 text-text-sec-light">
                        <span class="material-symbols-outlined">search</span>
                    </div>
                    <input name="q" class="w-full border-none bg-transparent text-text-main-light dark:text-text-main-dark placeholder:text-text-sec-light focus:ring-0 text-base h-full" placeholder="Search for keywords like 'bulletins', 'download', or 'citation'..." value="{{ request('q') }}"/>
                    <div class="p-2">
                        <button type="submit" class="h-full px-6 bg-primary hover:opacity-90 text-white font-bold rounded flex items-center justify-center transition-colors">
                            Search
                        </button>
                    </div>
                </form>
            </div> -->
        </div>
    </section>

    <!-- Main Body -->
    <main class="flex-1 w-full max-w-[1200px] mx-auto px-4 md:px-10 py-10">
        <!-- Quick Links Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
            <a class="group flex gap-4 rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark p-6 items-center hover:shadow-md transition-shadow" href="{{ route('search') }}">
                <div class="flex items-center justify-center size-12 rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">menu_book</span>
                </div>
                <div>
                    <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-tight group-hover:text-primary transition-colors">Browse Issuances</h3>
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-1">Explore all legal issuances</p>
                </div>
            </a>

            <a class="group flex gap-4 rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark p-6 items-center hover:shadow-md transition-shadow" href="{{ route('bulletins') }}">
                <div class="flex items-center justify-center size-12 rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">newspaper</span>
                </div>
                <div>
                    <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-tight group-hover:text-primary transition-colors">Latest Bulletins</h3>
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-1">View recent releases</p>
                </div>
            </a>

            <a class="group flex gap-4 rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark p-6 items-center hover:shadow-md transition-shadow" href="{{ route('about') }}">
                <div class="flex items-center justify-center size-12 rounded-full bg-primary/10 text-primary">
                    <span class="material-symbols-outlined">info</span>
                </div>
                <div>
                    <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-tight group-hover:text-primary transition-colors">About ONAR</h3>
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-1">Learn more about us</p>
                </div>
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar Navigation (Desktop) / Tabs (Mobile) -->
            <aside class="w-full lg:w-64 shrink-0">
                <div class="sticky top-24">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-text-sec-light dark:text-text-sec-dark mb-4 px-2">Categories</h3>
                    <nav class="flex flex-row lg:flex-col overflow-x-auto lg:overflow-visible gap-2 pb-2 lg:pb-0">
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-background-light dark:hover:bg-card-dark/70 text-text-sec-light dark:text-text-sec-dark font-medium text-sm whitespace-nowrap transition-colors border-l-4 border-transparent" href="#getting-started">
                            <span class="material-symbols-outlined text-[20px]">rocket_launch</span>
                            Getting Started
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-background-light dark:hover:bg-card-dark/70 text-text-sec-light dark:text-text-sec-dark font-medium text-sm whitespace-nowrap transition-colors border-l-4 border-transparent" href="#searching">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                            Searching Issuances
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-background-light dark:hover:bg-card-dark/70 text-text-sec-light dark:text-text-sec-dark font-medium text-sm whitespace-nowrap transition-colors border-l-4 border-transparent" href="#browsing">
                            <span class="material-symbols-outlined text-[20px]">auto_stories</span>
                            Browsing Bulletins
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-background-light dark:hover:bg-card-dark/70 text-text-sec-light dark:text-text-sec-dark font-medium text-sm whitespace-nowrap transition-colors border-l-4 border-transparent" href="#citations">
                            <span class="material-symbols-outlined text-[20px]">format_quote</span>
                            Citations &amp; Exports
                        </a>
                        <a class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-background-light dark:hover:bg-card-dark/70 text-text-sec-light dark:text-text-sec-dark font-medium text-sm whitespace-nowrap transition-colors border-l-4 border-transparent" href="#legal">
                            <span class="material-symbols-outlined text-[20px]">gavel</span>
                            Legal Disclaimers
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- FAQs Content -->
            <div class="flex-1">
                <!-- Getting Started Section -->
                <div id="getting-started" class="mb-8 scroll-mt-24">
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Getting Started</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark">Basics of navigating the National Administrative Register and understanding the platform.</p>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <!-- FAQ Item 1 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden" open="">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">What is the National Administrative Register?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">The National Administrative Register (ONAR) is the official repository of administrative issuances filed with the University of the Philippines Law Center. It contains thousands of bulletins, circulars, department orders, and other legal documents from Philippine government agencies.</p>
                            <p>This platform provides a searchable digital index of these materials, making them accessible to researchers, lawyers, and the general public.</p>
                        </div>
                    </details>

                    <!-- FAQ Item 2 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">How do I search for specific issuances?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">You can search for issuances using the search bar on the homepage or the <a href="{{ route('search') }}" class="text-primary hover:underline">Issuances page</a>. Enter keywords related to the document you're looking for, such as:</p>
                            <ul class="list-disc list-inside mb-3 space-y-1">
                                <li>Document title or subject matter</li>
                                <li>Issuing agency name</li>
                                <li>Bulletin or issuance number</li>
                                <li>Year of issuance</li>
                            </ul>
                            <p>You can also filter results by year using the dropdown menu in the search interface.</p>
                        </div>
                    </details>

                    <!-- FAQ Item 3 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">What types of documents are available?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">The ONAR database includes various types of administrative issuances:</p>
                            <ul class="list-disc list-inside mb-3 space-y-1">
                                <li><strong>Department Orders</strong> and Administrative Orders</li>
                                <li><strong>Memorandum Circulars</strong></li>
                                <li><strong>Implementing Rules and Regulations (IRR)</strong></li>
                                <li><strong>Regulatory Issuances</strong> from various government agencies</li>
                            </ul>
                            <p>Documents are organized by volume and book, and can be browsed through the <a href="{{ route('bulletins') }}" class="text-primary hover:underline">Bulletins page</a>.</p>
                        </div>
                    </details>
                </div>

                <!-- Searching Section -->
                <div id="searching" class="mb-8 scroll-mt-24">
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Searching Issuances</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark">Tips and techniques for finding the documents you need.</p>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <!-- FAQ Item 4 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">How do I use boolean search operators?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p>You can use standard operators like <code class="bg-background-light dark:bg-background-dark px-1.5 py-0.5 rounded">AND</code>, <code class="bg-background-light dark:bg-background-dark px-1.5 py-0.5 rounded">OR</code>, and <code class="bg-background-light dark:bg-background-dark px-1.5 py-0.5 rounded">NOT</code> to refine your search results. For example, searching for "tax AND exemption" will only show documents containing both words. You can also use quotation marks for exact phrases.</p>
                        </div>
                    </details>

                    <!-- FAQ Item 5 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">Can I filter by agency or year?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">Yes! On the search page, you can filter results by:</p>
                            <ul class="list-disc list-inside space-y-1">
                                <li><strong>Year:</strong> Use the year dropdown to limit results to a specific year</li>
                                <li><strong>Agency:</strong> Browse issuances by specific government agencies</li>
                            </ul>
                            <p class="mt-3">These filters help narrow down your search to find exactly what you're looking for.</p>
                        </div>
                    </details>
                </div>

                <!-- Browsing Bulletins Section -->
                <div id="browsing" class="mb-8 scroll-mt-24">
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Browsing Bulletins</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark">How to navigate the bulletin collection organized by volumes and books.</p>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <!-- FAQ Item 6 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">How are bulletins organized?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">Bulletins are organized hierarchically:</p>
                            <ul class="list-disc list-inside mb-3 space-y-1">
                                <li><strong>Volumes:</strong> Collections of bulletins organized by time period or category</li>
                                <li><strong>Books:</strong> Subdivisions within volumes containing specific sets of issuances</li>
                                <li><strong>Sections:</strong> Individual bulletins or groups of related documents</li>
                            </ul>
                            <p>You can browse this structure on the <a href="{{ route('bulletins') }}" class="text-primary hover:underline">Bulletins page</a>.</p>
                        </div>
                    </details>
                </div>

                <!-- Citations Section -->
                <div id="citations" class="mb-8 scroll-mt-24">
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Citations &amp; Exports</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark">How to properly cite and reference documents from the ONAR.</p>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <!-- FAQ Item 7 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">How do I cite a document from ONAR?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">When citing documents from the National Administrative Register, include:</p>
                            <ul class="list-disc list-inside mb-3 space-y-1">
                                <li>The document title or subject</li>
                                <li>The issuing agency</li>
                                <li>The bulletin number and date</li>
                                <li>Reference to ONAR, UP Law Center</li>
                            </ul>
                            <p>For specific citation formats (APA, MLA, Chicago), refer to the document details page where citation information is typically provided.</p>
                        </div>
                    </details>

                    <!-- FAQ Item 8 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">Can I download documents?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p>Document availability depends on the specific issuance. Some documents may have downloadable PDF files, while others may require you to visit the UP Law Center in person to obtain certified copies. Check the individual document page for download options and availability.</p>
                        </div>
                    </details>
                </div>

                <!-- Legal Disclaimers Section -->
                <div id="legal" class="mb-8 scroll-mt-24">
                    <h2 class="text-2xl font-bold text-text-main-light dark:text-text-main-dark mb-2">Legal Disclaimers</h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark">Important information about the use and accuracy of ONAR data.</p>
                </div>

                <div class="flex flex-col gap-4 mb-12">
                    <!-- FAQ Item 9 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">Is the information on this platform legally binding?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <div class="bg-primary/10 dark:bg-primary/20 p-3 rounded-lg border-l-4 border-primary text-xs mb-3">
                                <strong>Important Disclaimer:</strong> This platform serves as a search aid and digital index. While we strive for accuracy, this platform is not a replacement for official certified copies obtained directly from the UP Law Center. For legal purposes, always refer to the official documents.
                            </div>
                            <p>The information displayed here is for research and reference purposes. For official legal matters, you should obtain certified copies from the UP Law Center.</p>
                        </div>
                    </details>

                    <!-- FAQ Item 10 -->
                    <details class="group flex flex-col rounded-xl border border-border-light dark:border-border-dark bg-white dark:bg-card-dark overflow-hidden">
                        <summary class="flex cursor-pointer items-center justify-between gap-6 p-5 hover:bg-background-light dark:hover:bg-card-dark/70 transition-colors">
                            <h3 class="text-text-main-light dark:text-text-main-dark text-base font-bold leading-normal">How do I get certified copies of documents?</h3>
                            <div class="text-text-sec-light dark:text-text-sec-dark transition-transform group-open:rotate-180">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </summary>
                        <div class="px-5 pb-5 pt-0 text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                            <p class="mb-3">To obtain certified copies of documents, you need to visit the UP Law Center in person:</p>
                            <ul class="list-disc list-inside mb-3 space-y-1">
                                <li><strong>Location:</strong> UP Law Center, Bocobo Hall, University of the Philippines Diliman, Quezon City</li>
                                <li><strong>Contact:</strong> onar_upd.law@up.edu.ph</li>
                                <li>Bring identification and the specific document reference information</li>
                            </ul>
                            <p>For more information, visit our <a href="{{ route('about') }}" class="text-primary hover:underline">About page</a>.</p>
                        </div>
                    </details>
                </div>

                <!-- Contact Support CTA -->
                <div class="mt-12 rounded-xl bg-primary dark:bg-primary/90 overflow-hidden relative">
                    <!-- Background decoration -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-black/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10 flex flex-col md:flex-row items-center p-8 gap-6 text-center md:text-left">
                        <div class="p-3 bg-white/20 rounded-full text-white">
                            <span class="material-symbols-outlined text-3xl">support_agent</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-white text-xl font-bold mb-1">Still can't find what you're looking for?</h3>
                            <p class="text-white/80 text-sm">Our support team is here to help you with specific inquiries regarding the ONAR database.</p>
                        </div>
                        <a href="{{ route('about') }}" class="bg-white text-primary hover:bg-background-light px-6 py-3 rounded-lg font-bold text-sm whitespace-nowrap transition-colors shadow-sm">
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('aside nav a');
        
        function setActiveLink() {
            const hash = window.location.hash || '#getting-started';
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === hash) {
                    link.classList.remove('hover:bg-background-light', 'dark:hover:bg-card-dark/70', 'text-text-sec-light', 'dark:text-text-sec-dark', 'font-medium', 'border-transparent');
                    link.classList.add('bg-primary/10', 'text-primary', 'font-bold', 'border-primary');
                } else {
                    link.classList.remove('bg-primary/10', 'text-primary', 'font-bold', 'border-primary');
                    link.classList.add('hover:bg-background-light', 'dark:hover:bg-card-dark/70', 'text-text-sec-light', 'dark:text-text-sec-dark', 'font-medium', 'border-transparent');
                }
            });
        }
        
        setActiveLink();
        
        window.addEventListener('hashchange', setActiveLink);
        
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(setActiveLink, 10);
            });
        });
    });
</script>
@endpush
@endsection
