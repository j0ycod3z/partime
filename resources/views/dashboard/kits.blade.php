{{-- @extends('layouts.app')

@section('content')
    <div class="flex gap-6">
        <div class="w-2/3">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Registered Kits</h1>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Barcode</th>
                            <th class="px-6 py-3 text-left font-semibold">Assigned User</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($registeredKits as $kit)
                        <tr>
                            <td class="px-6 py-4">{{ $kit['barcode'] }}</td>
                            <td class="px-6 py-4">{{ $kit['user'] }}</td>
                            <td class="px-6 py-4 space-x-2 flex flex-row">
                                @include('components.modals.user-results', ['results' => $kitResults])
                                @include('components.modals.edit-kit', ['kit' => $kit])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-1/3">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Unregistered Kits</h2>
                @include('components.modals.assign-kit')
            </div>
            <div class="bg-white rounded-lg shadow p-4 space-y-2 h-[500px] overflow-y-auto">
                @foreach ($unregisteredKits as $kit)
                    <div class="px-4 py-2 bg-gray-50 border rounded">{{ $kit }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.app')

@section('content')
    <div class="flex gap-6">
        <!-- Registered Kits -->
        <div class="w-2/3">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Registered Kits</h1>
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-800">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Barcode</th>
                            <th class="px-6 py-3 text-left font-semibold">Assigned User</th>
                            <th class="px-6 py-3 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($registeredKits as $kit)
                            @php
                                $kitResults = [
                                    'bio_age_results' => collect($results['bio_age_results'] ?? [])
                                        ->filter(fn($r) => $r['kit_barcode'] === $kit['barcode'])
                                        ->values()
                                        ->all(),

                                    'genetic_results' => collect($results['genetic_results'] ?? [])
                                        ->filter(fn($r) => $r['kit_barcode'] === $kit['barcode'])
                                        ->values()
                                        ->all(),
                                ];
                            @endphp

                            <tr>
                                <td class="px-6 py-4">{{ $kit['barcode'] }}</td>
                                <td class="px-6 py-4">{{ $kit['user'] }}</td>
                                <td class="px-6 py-4 space-x-2 flex flex-row">
                                    @include('components.modals.user-results', ['results' => $kitResults])
                                    @include('components.modals.edit-kit', ['kit' => $kit])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Unregistered Kits -->
        <div class="w-1/3">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Unregistered Kits</h2>
                @include('components.modals.assign-kit')
            </div>
            <div class="bg-white rounded-lg shadow p-4 space-y-2 h-[500px] overflow-y-auto">
                @foreach ($unregisteredKits as $kit)
                    <div class="px-4 py-2 bg-gray-50 border rounded">{{ $kit }}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
