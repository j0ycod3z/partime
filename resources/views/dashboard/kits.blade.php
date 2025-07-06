@extends('layouts.app')

@section('content')
    <div class="flex h-screen overflow-hidden p-4">
        {{-- Registered Kits Div --}}
        <div class="w-full h-full flex flex-col p-4">
            <div class="flex items-center justify-between flex-shrink-0 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Registered Kits</h2>
            </div>
            <div class="flex-1 overflow-y-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                    <thead class="bg-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold bg-gray-100">Barcode</th>
                            <th class="px-6 py-3 text-left font-semibold bg-gray-100">Assigned User</th>
                            <th class="px-6 py-3 text-left font-semibold bg-gray-100">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($registeredKits as $kit)
                            <tr>
                                <td class="px-6 py-4">{{ $kit['barcode'] }}</td>
                                <td class="px-6 py-4">{{ $kit['user'] }}</td>
                                <td class="px-6 py-4 space-x-2 flex flex-row items-center">
                                    @include('components.modals.user-results', [
                                        'results' => $results,
                                    ])
                                    @include('components.modals.edit-kit', ['kit' => $kit])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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

    </div>
@endsection
