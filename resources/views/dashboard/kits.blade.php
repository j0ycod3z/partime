@extends('layouts.app')

@section('content')
    <div class="flex h-screen overflow-hidden p-4">
        <div class="p-8 h-screen flex flex-col overflow-hidden w-2/3">

            <!-- Search bar (Google‑style) -->
            <div class="flex justify-center items-center gap-4 mb-8 w-full">
                <form method="GET" action="{{ route('kits') }}" class="flex-grow">
                    <div class="relative">
                        <input type="text" name="kit_query" placeholder="Search kits by barcode or user"
                            class="w-full px-5 py-3 rounded-full shadow
                           focus:outline-none focus:ring-2 focus:ring-blue-500
                           border border-gray-300"
                            value="{{ request('kit_query') }}">
                        <button type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                           text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M15.5 10.5A5 5 0 1110.5 5a5 5 0 015 5z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Registered‑kit search results (show only if a query exists) -->
            @if ($kitQuery)
                <div class="flex flex-col gap-4 w-full mx-auto overflow-y-auto min-w-0"> {{-- Add min-w-0 here --}}
                    @forelse ($registeredKits as $kit)
                        <div
                            class="relative group bg-white border border-gray-200
                    hover:shadow-lg hover:border-gray-400 rounded-lg
                    px-6 py-4 transition hover:bg-gray-50 min-w-0">

                            <!-- Kit summary (click opens results modal) -->
                            <span class="block w-full overflow-hidden min-w-0 cursor-default">
                                <div
                                    class="font-bold text-lg text-gray-800 group-hover:text-black truncate whitespace-nowrap overflow-hidden max-w-[20rem]">
                                    {{ $kit['barcode'] }}
                                </div>
                                <div class="font-semibold text-sm text-gray-600 group-hover:text-gray-700">
                                    Assigned&nbsp;to: {{ $kit['user'] }}
                                </div>
                                <div class="text-sm text-gray-500 break-all">
                                    {{ $kit['user_details']['email'] }} • {{ $kit['user_details']['country'] }}
                                </div>
                            </span>

                            <div class="flex flex-row gap-4 mt-6">
                                @include('components.modals.user-results', ['results' => $results])

                                @if ($globalRole === 'admin')
                                    @include('components.modals.edit-kit', ['kit' => $kit])
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-400">No kits found.</div>
                    @endforelse
                </div>
            @endif

        </div>

        @if ($globalRole === 'admin')
            <!-- Unregistered Kits Section -->
            <div class="w-1/3 h-full">
                <div class="w-full h-full flex flex-col p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Unregistered Kits</h2>
                    </div>
                    <div class="bg-white rounded-xl shadow p-4 space-y-2 h-full overflow-y-auto border border-gray-200">
                        @foreach ($unregisteredKits as $kit)
                            <div
                                class="px-4 py-2 bg-gray-50 border border-gray-300 rounded-xl flex justify-between items-center gap-4">
                                <span class="truncate max-w-[60%] text-gray-700">{{ $kit }}</span>
                                <div class="flex-shrink-0">
                                    @include('components.modals.assign-kit', ['kit' => $kit])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
