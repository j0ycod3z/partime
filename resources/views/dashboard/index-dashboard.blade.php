{{-- resources/views/index-dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 px-4">
        <div class="p-6 items-center">
            <h1 class="text-6xl text-white" style="font-family: 'Yaro-Black'">aeternum</h1>
            <p class="text-center pt-4 text-gray-200">
                Get Your DNA Biological Age Test
            </p>
        </div>
        <!-- Search form -->
        <form id="search-form" action="{{ route('kit.search') }}" method="GET" class="w-full max-w-xl">
            <div
                class="flex items-center bg-white border border-gray-300 rounded-full shadow focus-within:border-gray-500 focus-within:shadow-md transition px-4 py-2">
                <x-heroicon-o-beaker class="h-5 text-gray-500" />
                <div class="h-5 border-r border-gray-300 mx-2"></div>
                <input type="text" name="q" placeholder="Enter your ID or Email"
                    class="flex-grow px-2 py-2 focus:outline-none placeholder-gray-500 text-gray-800" autocomplete="off" />
            </div>
        </form>

        <!-- Action buttons -->
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <button type="submit" form="search-form"
                class="px-6 py-3 text-white text-sm font-medium rounded-full
               bg-[#010132]
               shadow-sm shadow-gray-500
               hover:bg-[#001438] hover:scale-105 hover:shadow-md
               transition-all duration-300 ease-in-out cursor-pointer">
                Know your Biological Age Now
            </button>
        </div>

    </div>
@endsection
