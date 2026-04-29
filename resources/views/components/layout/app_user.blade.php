@props(['title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sinau Bareng' }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
   <div {{ $attributes->merge(['class' => 'bg-[#E5E5E5]']) }}>
    <div class="flex min-h-screen">
        <div class="w-64"></div>

        <!-- Sidebar -->
        <x-layout.sidebar_user />

        <!-- Content -->
        <main class="flex-1 p-12">
            {{ $slot ?? '' }}
        </main>

    </div>
</div>

    @yield('content')

    @stack('scripts')
</body>
</html>