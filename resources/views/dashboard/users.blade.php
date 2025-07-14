@extends('layouts.app')

@section('content')
    <div class="p-8 h-screen flex flex-col overflow-hidden">
        <div class="flex justify-center items-center gap-4 mb-8">
            <form method="GET" action="{{ route('users.show') }}" class="flex-grow">
                <div class="relative">
                    <input type="text" name="query" placeholder="Search by ID or Email"
                        class="w-full px-5 py-3 rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-300"
                        value="{{ request('query') }}">
                    <button type="submit"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M15.5 10.5A5 5 0 1110.5 5a5 5 0 015 5z" />
                        </svg>
                    </button>
                </div>
            </form>
            @if ($globalRole === 'admin')
                <div class="flex-shrink-0">
                    @include('components.modals.create-user')
                </div>
            @endif
        </div>


        <!-- Results -->
        @if (request()->has('query') && request()->filled('query'))
            <div class="flex flex-col gap-4 w-full mx-auto overflow-y-auto">
                @forelse ($users as $user)
                    <div
                        class="relative group bg-white border border-gray-200 hover:shadow-lg hover:border-gray-400 rounded-lg px-6 py-4 transition duration-200 hover:bg-gray-50">
                        <!-- Dropdown -->
                        {{-- <div class="absolute top-4 right-4">
                            <div class="relative">
                                <button
                                    onclick="document.getElementById('menu-{{ $user->id }}').classList.toggle('hidden')"
                                    class="text-gray-400 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 14a1.5 1.5 0 110 3 1.5 1.5 0 010-3z" />
                                    </svg>
                                </button>
                                <div id="menu-{{ $user->id }}"
                                    class="hidden absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-lg z-20">
                                    <button
                                        onclick="document.getElementById('edit-modal-{{ $user->id }}').classList.remove('hidden')"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">Edit</button>
                                </div>
                            </div>
                        </div> --}}

                        <!-- User Details -->
                        <span class="cursor-default"> 
                            <div class="font-bold text-lg text-gray-800 group-hover:text-black">{{ $user->email }}</div>
                            <div class="font-semibold text-sm text-gray-600 group-hover:text-gray-700">ID:
                                {{ $user->id }}</div>
                            <div class="text-sm text-gray-500">{{ $user->first_name }} {{ $user->last_name }} -
                                {{ $user->country }} - {{ $user->gender }}</div>
                            </span>

                            <div class="flex flex-row mt-4 gap-4">
  <!-- View Modal -->
                                @include('components.modals.view-user', ['user' => $user])

                                <!-- Edit Modal -->
                                @if ($globalRole === 'admin')
                                    @include('components.modals.edit-user', ['user' => $user])
                                @endif
                            </div>

                    </div>
                @empty
                    <div class="text-center text-gray-400">No results found.</div>
                @endforelse
            </div>
        @else
            <div class="text-center text-gray-400 text-sm mt-8">Start typing above to search users by ID or email.</div>
        @endif

    </div>
@endsection
