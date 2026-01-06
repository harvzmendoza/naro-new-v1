@extends('layouts.app')

@section('title', 'UP Law Center - National Administrative Register')

@section('content')
    <!-- Hero Section -->
    <div class="w-full bg-card-dark relative overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img alt="Legal background" class="w-full h-full object-cover opacity-20" data-alt="Abstract image of law books and scales of justice representing legal research" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPJ6DxKayZDHRPLYRl3n5o5QVWHLqbwVLeAM1wba6Dwxb3c_SzCQkWr9K9K1HnBinsnuqILGd095mDXLXczrzVqSavt7OJzWdBVAj_sOPIxFAWsL5M0feRnyevzfsWjPbr9T6yjTOMvfhKEtzKYU321w1hRYm4zj45H1zJFLY3qkl3N1BLwGYtUvkYTbTASWu03MNcLF3oMRItOYpzGaYIpkDQlfpn9Qiop7poAAs2uiM0XHHJn1LNctS3tEfl8CPMbwNJXdJLAIxP"/>
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/80 to-background-dark/95"></div>
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
                <div class="flex flex-col md:flex-row bg-white dark:bg-card-dark rounded-xl p-2 gap-2 border border-white/10">
                    <div class="relative flex-grow group">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-text-sec-light">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input class="w-full h-12 pl-10 pr-4 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:bg-white dark:focus:bg-background-dark focus:ring-0 text-text-main-light dark:text-white placeholder:text-text-sec-light transition-all text-sm md:text-base" placeholder="Search by keyword, bulletin number, or title..." type="text"/>
                    </div>
                    <div class="flex gap-2">
                        <select class="h-12 pl-3 pr-8 rounded-lg bg-background-light dark:bg-background-dark/50 border-transparent focus:border-primary focus:ring-0 text-text-main-light dark:text-white text-sm cursor-pointer w-full md:w-auto">
                            <option>All Years</option>
                            <option>2024</option>
                            <option>2023</option>
                            <option>2022</option>
                        </select>
                        <button class="bg-primary hover:opacity-90 text-white h-12 px-6 rounded-lg font-bold text-sm md:text-base flex items-center justify-center gap-2 transition-colors min-w-[120px]">
                            Search
                        </button>
                    </div>
                </div>
                <div class="bg-black/20 backdrop-blur-sm px-4 py-2 text-left flex gap-4 text-xs text-white/70">
                    <span>Popular:</span>
                    <a class="hover:text-white underline decoration-white/30" href="#">Tax Reform</a>
                    <a class="hover:text-white underline decoration-white/30" href="#">Labor Guidelines</a>
                    <a class="hover:text-white underline decoration-white/30" href="#">Health Protocols</a>
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Agency Card 1 -->
            <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200" href="#">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">account_balance</span>
                    </div>
                    <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">BIR</span>
                </div>
                <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">Bureau of Internal Revenue</h3>
                <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">1,240 Issuances</p>
            </a>

            <!-- Agency Card 2 -->
            <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200" href="#">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-green-50 dark:bg-green-900/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-600 dark:text-green-400">query_stats</span>
                    </div>
                    <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">SEC</span>
                </div>
                <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">Securities and Exchange Commission</h3>
                <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">980 Issuances</p>
            </a>

            <!-- Agency Card 3 -->
            <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200" href="#">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">engineering</span>
                    </div>
                    <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">DOLE</span>
                </div>
                <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">Dept. of Labor and Employment</h3>
                <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">850 Issuances</p>
            </a>

            <!-- Agency Card 4 -->
            <a class="group flex flex-col p-5 bg-white dark:bg-card-dark rounded-xl border border-border-light dark:border-border-dark hover:border-primary/50 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200" href="#">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-red-50 dark:bg-red-900/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600 dark:text-red-400">medical_services</span>
                    </div>
                    <span class="bg-background-light dark:bg-background-dark text-text-sec-light dark:text-text-sec-dark text-xs font-semibold px-2 py-1 rounded">DOH</span>
                </div>
                <h3 class="text-lg font-bold text-text-main-light dark:text-text-main-dark group-hover:text-primary transition-colors mb-1">Department of Health</h3>
                <p class="text-sm text-text-sec-light dark:text-text-sec-dark mt-auto">600 Issuances</p>
            </a>
        </div>
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
                        <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">Oct 24, 2023</td>
                            <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">RMC-2023-98</td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="Clarification on the Taxation of Online Sellers">
                                    Clarification on the Taxation of Online Sellers and Digital Marketplaces
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-yellow-100 flex items-center justify-center text-[10px] font-bold text-yellow-800">B</div>
                                    <span class="text-text-main-light dark:text-text-main-dark">BIR</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-text-sec-light hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">Oct 23, 2023</td>
                            <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">DO-174-23</td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="Revised Rules on Contracting and Subcontracting Arrangements">
                                    Revised Rules on Contracting and Subcontracting Arrangements
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-800">D</div>
                                    <span class="text-text-main-light dark:text-text-main-dark">DOLE</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-text-sec-light hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">Oct 22, 2023</td>
                            <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">MC-2023-05</td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="Guidelines on the Submission of Annual Financial Statements">
                                    Guidelines on the Submission of Annual Financial Statements via OST
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-[10px] font-bold text-green-800">S</div>
                                    <span class="text-text-main-light dark:text-text-main-dark">SEC</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-text-sec-light hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">Oct 22, 2023</td>
                            <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">AO-2023-0012</td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="National Policy on the Prevention and Control of Non-Communicable Diseases">
                                    National Policy on the Prevention and Control of Non-Communicable Diseases
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center text-[10px] font-bold text-red-800">D</div>
                                    <span class="text-text-main-light dark:text-text-main-dark">DOH</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-text-sec-light hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-background-light/50 dark:hover:bg-background-dark/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-text-sec-light dark:text-text-sec-dark">Oct 21, 2023</td>
                            <td class="px-6 py-4 font-mono text-xs text-text-sec-light dark:text-text-sec-dark">LTFRB-MC-23</td>
                            <td class="px-6 py-4">
                                <a class="font-medium text-primary hover:underline line-clamp-2" href="#" title="Adjustments to Fare Rates for Public Utility Jeepneys">
                                    Adjustments to Fare Rates for Public Utility Jeepneys Nationwide
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-purple-100 flex items-center justify-center text-[10px] font-bold text-purple-800">L</div>
                                    <span class="text-text-main-light dark:text-text-main-dark">LTFRB</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-text-sec-light hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-xl">download</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-border-light dark:border-border-dark flex items-center justify-center bg-background-light/30 dark:bg-background-dark/30">
                <button class="text-primary font-bold text-sm hover:underline">View all recently filed issuances</button>
            </div>
        </div>
    </div>
@endsection
