@extends('layouts.app')

@section('title', 'About Us – UP Law Center - National Administrative Register')

@section('content')
    <div class="w-full flex justify-center">
        <div class="flex flex-col w-full max-w-[960px] px-4 md:px-10 py-8 md:py-10 gap-8">
            <!-- Hero Section -->
            <div class="@container">
                <div class="flex flex-col gap-6 py-6 md:py-10 @[864px]:flex-row items-center">
                    <div
                        class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-xl shadow-sm @[864px]:w-1/2"
                        style='background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuCOMQru4sC9vUcGv2XbBqsz3Ok8KMu2RsnM5z_Hk3K647RAv0HEaO3JNB1qBgE1uMumfqY5pFe0PE-6-W05dkK7RwCquZVc7rln1GNbFF52k2YNmV2JvKAHxSzFgCU7Xm9U2SMTmuObZBH3JmO9KZpoIGArgerG-lypq7ped8kE9oHRSPCPBnIe9pSA6R8N7aGjoN3dsjVeDt1aHVx3ggwQ6UJuB49fgzBzOdIWbFscuRlpXbpQI9_R9ZmOtWOF48ay1gwTfczSwEh3");'
                    >
                    </div>
                    <div class="flex flex-col gap-6 @[864px]:w-1/2 @[864px]:pl-8 justify-center">
                        <div class="flex flex-col gap-3 text-left">
                            <h1
                                class="text-text-main-light dark:text-text-main-dark text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-[-0.033em]"
                            >
                                Navigating the National Administrative Register with Ease
                            </h1>
                            <p class="text-text-sec-light dark:text-text-sec-dark text-base leading-relaxed">
                                We are democratizing access to administrative law. This platform serves as a comprehensive
                                digital index and intelligent search engine for legal materials filed in the UP Law Center
                                ONAR.
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            <a
                                href="{{ route('search') }}"
                                class="flex items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-primary text-white text-base font-bold tracking-[0.015em] shadow-sm"
                            >
                                <span class="truncate">View Issuances</span>
                            </a>
                            <a
                                href="#mission"
                                class="flex items-center justify-center overflow-hidden rounded-lg h-12 px-6 bg-transparent border border-border-light dark:border-border-dark text-text-main-light dark:text-text-main-dark text-base font-bold tracking-[0.015em] hover:bg-background-light/60 dark:hover:bg-card-dark/70 transition-colors"
                            >
                                <span class="truncate">Learn More</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats / Scope Section -->
            <section aria-labelledby="scope-heading" class="flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-2xl">auto_stories</span>
                    <h2
                        id="scope-heading"
                        class="text-text-main-light dark:text-text-main-dark text-xl md:text-2xl font-bold leading-tight"
                    >
                        Scope of Data
                    </h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm"
                    >
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">calendar_month</span>
                            <p
                                class="text-text-main-light dark:text-text-main-dark text-base font-medium leading-normal"
                            >
                                Coverage Years
                            </p>
                        </div>
                        <p
                            class="text-text-main-light dark:text-text-main-dark tracking-tight text-3xl font-bold leading-tight"
                        >
                            1990 - Present
                        </p>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark">Continuous updates</p>
                    </div>

                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm"
                    >
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">library_books</span>
                            <p
                                class="text-text-main-light dark:text-text-main-dark text-base font-medium leading-normal"
                            >
                                Issuances Indexed
                            </p>
                        </div>
                        <p
                            class="text-text-main-light dark:text-text-main-dark tracking-tight text-3xl font-bold leading-tight"
                        >
                            15,000+
                        </p>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark">Searchable documents</p>
                    </div>

                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 border border-border-light dark:border-border-dark bg-card-light dark:bg-card-dark shadow-sm"
                    >
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">account_balance</span>
                            <p
                                class="text-text-main-light dark:text-text-main-dark text-base font-medium leading-normal"
                            >
                                Partner Agencies
                            </p>
                        </div>
                        <p
                            class="text-text-main-light dark:text-text-main-dark tracking-tight text-3xl font-bold leading-tight"
                        >
                            100+
                        </p>
                        <p class="text-sm text-text-sec-light dark:text-text-sec-dark">Gov. departments</p>
                    </div>
                </div>
            </section>

            <!-- Mission Section -->
            <section
                id="mission"
                class="flex flex-col gap-8 py-8 md:flex-row md:items-start md:justify-between border-t border-b border-border-light dark:border-border-dark"
            >
                <div class="flex flex-col gap-4 md:w-1/2">
                    <h2 class="text-text-main-light dark:text-text-main-dark text-3xl font-bold leading-tight">
                        Our Mission
                    </h2>
                    <p class="text-text-main-light dark:text-text-main-dark text-lg leading-relaxed">
                        To provide researchers, lawyers, and the general public with efficient, reliable, and transparent
                        access to the rules and regulations filed with the UP Law Center.
                    </p>
                    <p class="text-text-sec-light dark:text-text-sec-dark text-base leading-relaxed">
                        We believe that administrative law should be accessible to everyone, not just those with physical
                        access to the archives. By digitizing and indexing these records, we bridge the gap between
                        government actions and public knowledge.
                    </p>
                </div>
                <div class="flex flex-col gap-4 md:w-5/12">
                    <h3 class="text-text-main-light dark:text-text-main-dark text-lg font-bold">What We Index</h3>
                    <ul class="flex flex-col gap-3">
                        <li class="flex items-center gap-3 text-text-main-light dark:text-text-main-dark">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span>Department Orders &amp; Administrative Orders</span>
                        </li>
                        <li class="flex items-center gap-3 text-text-main-light dark:text-text-main-dark">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span>Memorandum Circulars</span>
                        </li>
                        <li class="flex items-center gap-3 text-text-main-light dark:text-text-main-dark">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span>Implementing Rules and Regulations (IRR)</span>
                        </li>
                        <li class="flex items-center gap-3 text-text-main-light dark:text-text-main-dark">
                            <span class="material-symbols-outlined text-primary text-xl">check_circle</span>
                            <span>Regulatory Issuances</span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Affiliation Card -->
            <section
                class="rounded-2xl bg-background-light dark:bg-card-dark border border-border-light dark:border-border-dark p-6 md:p-8 shadow-sm"
            >
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex flex-col gap-4 md:w-1/2">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="material-symbols-outlined text-primary text-3xl">verified</span>
                                <h3
                                    class="text-text-main-light dark:text-text-main-dark text-xl font-bold leading-tight"
                                >
                                    Official Source &amp; Affiliation
                                </h3>
                            </div>
                            <p class="text-text-main-light dark:text-text-main-dark text-base font-medium">
                                University of the Philippines Law Center
                            </p>
                            <p class="text-text-sec-light dark:text-text-sec-dark text-sm leading-relaxed">
                                Data on this platform is sourced directly from the Office of the National Administrative
                                Register (ONAR). While we strive for accuracy, this platform serves as a search aid and is
                                not a replacement for official certified copies obtained directly from the UP Law Center.
                            </p>
                        </div>
                        <a
                            class="flex items-center gap-2 text-primary font-bold text-sm hover:underline mt-2"
                            href="https://law.upd.edu.ph/onar/"
                            target="_blank"
                        >
                            <span>Visit Official ONAR Site</span>
                            <span class="material-symbols-outlined text-sm">open_in_new</span>
                        </a>
                    </div>
                    <div
                        class="w-full md:w-1/2 bg-center bg-no-repeat aspect-video bg-cover rounded-2xl shadow-sm"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDkSXT9eutsi5VydZTQa-JgD2Y4zLSVNzELj_FT-n2VEAe7dz1urQ3WlqpF6YIA3DnR0gvDvPkObuZ1_03BfLggDdE9lCoLoYDg3SqO-elPCtDOaXLFVz_vXy-VCbotw3-z7EoXiidfkBNsieOW9kr155mxruwdv-f7NUAiw6vvLNpIJfAJ6Ddy40_vigpqjqsJY0GKOTb_mnl0quWOxorVzJGHyVvNxCOrhOvX-LQuTACiUEeAwkDf7p8mpDE3vKFnNTCovO6TpOIi");'
                    >
                    </div>
                </div>
            </section>

            <!-- Team / Contact Section -->
            <section class="flex flex-col gap-6 py-8">
                <div class="flex flex-col gap-2 text-center max-w-[720px] mx-auto">
                    <h2 class="text-text-main-light dark:text-text-main-dark text-2xl font-bold">
                        Contact the Research Team
                    </h2>
                    <p class="text-text-sec-light dark:text-text-sec-dark text-base">
                        Have questions about a specific issuance or need help navigating the portal? Reach out to our
                        support team.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div
                        class="flex items-start gap-4 p-5 rounded-xl border border-border-light dark:border-border-dark hover:border-primary/40 transition-colors cursor-pointer bg-card-light dark:bg-card-dark shadow-sm"
                    >
                        <div class="p-3 bg-primary/10 rounded-full text-primary">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-text-main-light dark:text-text-main-dark font-bold text-base">
                                Email Support
                            </span>
                            <span class="text-text-sec-light dark:text-text-sec-dark text-sm">
                                onar_upd.law@up.edu.ph
                            </span>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-4 p-5 rounded-xl border border-border-light dark:border-border-dark hover:border-primary/40 transition-colors cursor-pointer bg-card-light dark:bg-card-dark shadow-sm"
                    >
                        <div class="p-3 bg-primary/10 rounded-full text-primary">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-text-main-light dark:text-text-main-dark font-bold text-base">
                                Visit the Library
                            </span>
                            <span class="text-text-sec-light dark:text-text-sec-dark text-sm">
                                UP Law Center, Diliman, Quezon City
                            </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection


