<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'UP Law Center - National Administrative Register')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main-light dark:text-text-main-dark min-h-screen flex flex-col transition-colors duration-200">
    <!-- Navigation -->
    <header class="bg-white dark:bg-card-dark border-b border-border-light dark:border-border-dark sticky top-0 z-50">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/nar-logo.png') }}" alt="UP Law Center Logo" class="h-10 w-auto"/>
                    </a>
                </div>
                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8">
                    <nav class="flex gap-6">
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('search') }}">Issuances</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('bulletins') }}">Bulletins</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('about') }}">About Us</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('help') }}">Help &amp; FAQs</a>
                    </nav>
                    <div class="h-6 w-px bg-border-light dark:bg-border-dark"></div>
                    @auth
                        <a href="{{ url('/admin') }}" class="bg-primary hover:opacity-90 text-white text-sm font-bold py-2 px-5 rounded-lg transition-colors shadow-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="#" class="bg-primary hover:opacity-90 text-white text-sm font-bold py-2 px-5 rounded-lg transition-colors shadow-sm">
                            Login / Register
                        </a>
                    @endauth
                </div>
                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-text-sec-light dark:text-text-sec-dark">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-card-dark border-t border-border-light dark:border-border-dark py-12">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="size-6 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-xl">balance</span>
                        </div>
                        <span class="text-sm font-bold text-text-main-light dark:text-text-main-dark">UP Law Center</span>
                    </div>
                    <p class="text-sm text-text-sec-light dark:text-text-sec-dark">
                        Bocobo Hall, University of the Philippines Diliman, Quezon City, 1101 Metro Manila
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-text-main-light dark:text-text-main-dark mb-4 text-sm uppercase tracking-wide">Resources</h4>
                    <ul class="space-y-2 text-sm text-text-sec-light dark:text-text-sec-dark">
                        <li><a class="hover:text-primary" href="#">Search Register</a></li>
                        <li><a class="hover:text-primary" href="#">Agency Directory</a></li>
                        <li><a class="hover:text-primary" href="#">Help &amp; FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-text-main-light dark:text-text-main-dark mb-4 text-sm uppercase tracking-wide">Legal</h4>
                    <ul class="space-y-2 text-sm text-text-sec-light dark:text-text-sec-dark">
                        <li><a class="hover:text-primary" href="#">Terms of Use</a></li>
                        <li><a class="hover:text-primary" href="#">Privacy Policy</a></li>
                        <li><a class="hover:text-primary" href="#">Accessibility</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-text-main-light dark:text-text-main-dark mb-4 text-sm uppercase tracking-wide">Connect</h4>
                    <div class="flex gap-4">
                        <a class="w-8 h-8 rounded-full bg-background-light dark:bg-background-dark flex items-center justify-center text-text-sec-light dark:text-text-sec-dark hover:bg-primary hover:text-white transition-colors" href="#">
                            <!-- Social Icon Placeholder -->
                            <span class="text-xs font-bold">f</span>
                        </a>
                        <a class="w-8 h-8 rounded-full bg-background-light dark:bg-background-dark flex items-center justify-center text-text-sec-light dark:text-text-sec-dark hover:bg-primary hover:text-white transition-colors" href="#">
                            <!-- Social Icon Placeholder -->
                            <span class="text-xs font-bold">t</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-border-light dark:border-border-dark pt-8 text-center md:text-left">
                <p class="text-xs text-text-sec-light dark:text-text-sec-dark">
                    © 2024 University of the Philippines Law Center. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>

