<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex">
    <aside class="w-64 bg-white h-screen shadow-md flex flex-col">
        <div class="p-6 text-xl text-gray-600" style="font-family: 'Yaro-Black'">
            <span class="">aeternum</span>
        </div>
        <div class="flex-1 flex flex-col justify-between">
            <nav class="space-y-2 px-4">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 py-2 pl-4 pr-6 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-300 text-gray-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
                    <span
                        class="p-2 rounded shadow-lg 
                {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-600' }}">
                        <x-heroicon-o-home class="w-5 h-5" />
                    </span>
                    Dashboard
                </a>

                <a href="{{ route('users') }}"
                    class="flex items-center gap-3 py-2 pl-4 pr-6 rounded-lg {{ request()->routeIs('users') ? 'bg-gray-300 text-gray-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
                    <span
                        class="p-2 rounded shadow-lg 
                {{ request()->routeIs('users') ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-600' }}">
                        <x-heroicon-o-user-group class="w-5 h-5" />
                    </span>
                    Users
                </a>

                <a href="{{ route('kits') }}"
                    class="flex items-center gap-3 py-2 pl-4 pr-6 rounded-lg {{ request()->routeIs('kits') ? 'bg-gray-300 text-gray-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
                    <span
                        class="p-2 rounded shadow-lg 
                {{ request()->routeIs('kits') ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-600' }}">
                        <x-heroicon-o-cube class="w-5 h-5" />
                    </span>
                    Kits
                </a>
            </nav>

            <div class="px-4 pb-4">
                <a href="{{ route('settings') }}"
                    class="flex items-center gap-3 py-2 pl-4 pr-6 rounded-lg {{ request()->routeIs('settings') ? 'bg-gray-300 text-gray-600 font-semibold' : 'text-gray-700 hover:bg-blue-50' }}">
                    <span
                        class="p-2 rounded shadow-lg 
                {{ request()->routeIs('settings') ? 'bg-gray-900 text-white' : 'bg-white border border-gray-300 text-gray-600' }}">
                        <x-heroicon-o-cog class="w-5 h-5" />
                    </span>
                    Settings
                </a>
            </div>
        </div>

    </aside>

    {{-- Main content --}}
    <main class="flex-1 h-screen">
        @yield('content')
    </main>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
