<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-100">
    <div id="app">
        <div class="flex">
            @include('layouts.sidebar')
            <div class="flex-1 flex flex-col">
                @include('layouts.topbar')
                <main class="p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
