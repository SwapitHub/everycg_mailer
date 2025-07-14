<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('theme') }}/images/favicon.png">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        button.inline-flex.items-center.px-4.py-2.bg-gray-800.border.border-transparent.rounded-md.font-semibold.text-xs.text-white.uppercase.tracking-widest.hover\:bg-gray-700.focus\:bg-gray-700.active\:bg-gray-900.focus\:outline-none.focus\:ring-2.focus\:ring-indigo-500.focus\:ring-offset-2.transition.ease-in-out.duration-150.ml-4 {
            background: #6571ff !important;
        }
        button.inline-flex.items-center.px-4.py-2.bg-gray-800.border.border-transparent.rounded-md.font-semibold.text-xs.text-white.uppercase.tracking-widest.hover\:bg-gray-700.focus\:bg-gray-700.active\:bg-gray-900.focus\:outline-none.focus\:ring-2.focus\:ring-indigo-500.focus\:ring-offset-2.transition.ease-in-out.duration-150 {
            background: #6571ff;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
