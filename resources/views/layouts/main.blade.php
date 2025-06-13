<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="h-full">
    <!--
        This example requires updating your template:

        ```
        <html class="h-full bg-gray-100">
        <body class="h-full">
        ```
    -->
    <div class="min-h-full">
        {{-- Using Old Include --}}
        @include('layouts.partials.navbar')

        {{-- Using Navbar Component --}}
        {{-- <x-navbar/> --}}

        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $title }}</h1>
            </div>
        </header>

        {{-- Using Header Component --}}
        {{-- <x-header :title="$title"/> --}}

        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>
