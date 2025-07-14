@props(['results'])

<div x-data="{ open: true }">
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl relative overflow-y-auto max-h-[90vh]">
            @if ($results)
                <h2 class="text-xl font-semibold mb-4">Your Results</h2>

                {{-- Biological Age Results --}}
                @if (!empty($results['bio_age_results']))
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Biological Age Results</h3>
                        <div class="overflow-hidden rounded-lg border border-gray-300">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="text-left p-2 border-b">Kit Barcode</th>
                                        <th class="text-left p-2 border-b">Chronological Age</th>
                                        <th class="text-left p-2 border-b">Biological Age</th>
                                        <th class="text-left p-2 border-b">Peer Score</th>
                                        <th class="text-left p-2 border-b">Collection Date</th>
                                        <th class="text-left p-2 border-b">Share Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results['bio_age_results'] as $bio)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="p-2 border-t">{{ $bio['kit_barcode'] }}</td>
                                            <td class="p-2 border-t">{{ $bio['chronological_age'] }}</td>
                                            <td class="p-2 border-t">{{ $bio['biological_age'] }}</td>
                                            <td class="p-2 border-t">{{ $bio['peer_biological_age_score'] }}%</td>
                                            <td class="p-2 border-t">
                                                {{ \Carbon\Carbon::parse($bio['collection_date'])->format('Y-m-d') }}
                                            </td>
                                            <td class="p-2 border-t">
                                                <a href="{{ $bio['share_link'] }}" class="text-blue-500 underline"
                                                    target="_blank">Link</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif

                {{-- Genetic Results --}}
                @if (!empty($results['genetic_results']))
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Genetic Results</h3>
                        @foreach ($results['genetic_results'] as $kit)
                            <h4 class="text-gray-700 font-medium mb-1">Kit: {{ $kit['kit_barcode'] }}</h4>
                            <div class="overflow-hidden rounded-lg border border-gray-300 mb-4">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="text-left p-2 border-b">Marker</th>
                                            <th class="text-left p-2 border-b">Risk</th>
                                            <th class="text-left p-2 border-b">Gene</th>
                                            <th class="text-left p-2 border-b">Position</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kit['markers'] as $marker)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="p-2 border-t">{{ $marker['marker'] }}</td>
                                                <td class="p-2 border-t">{{ $marker['risk'] }}</td>
                                                <td class="p-2 border-t">{{ $marker['gene'] }}</td>
                                                <td class="p-2 border-t">{{ $marker['position'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if (empty($results['bio_age_results']) && empty($results['genetic_results']))
                    <p class="text-gray-600">No results available.</p>
                @endif
            @else
                <h2 class="text-xl font-semibold mb-4">No Kit Found</h2>
                <p class="text-gray-600">There is no kit registered to that ID or Email.</p>
            @endif

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('index-dashboard') }}"
                    class="px-4 py-2 border border-gray-300 rounded-3xl hover:bg-gray-100 cursor-pointer">Close</a>
            </div>
        </div>
    </div>
</div>
