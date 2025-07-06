@props(['results'])

<div x-data="{ open: false }">
    <button @click="open = true"
        class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition cursor-pointer">
        <x-heroicon-o-document-text class="w-4 h-4 mr-1" />
        View Results
    </button>


    <div x-show="open" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl relative overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold mb-4">User Results</h2>

            {{-- Biological Age Results --}}
            @if (!empty($results['bio_age_results']))
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Biological Age Results</h3>
                    <table class="w-full text-sm border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-left p-2 border">Kit Barcode</th>
                                <th class="text-left p-2 border">Chronological Age</th>
                                <th class="text-left p-2 border">Biological Age</th>
                                <th class="text-left p-2 border">Peer Score</th>
                                <th class="text-left p-2 border">Collection Date</th>
                                <th class="text-left p-2 border">Share Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results['bio_age_results'] as $bio)
                                <tr>
                                    <td class="p-2 border">{{ $bio['kit_barcode'] }}</td>
                                    <td class="p-2 border">{{ $bio['chronological_age'] }}</td>
                                    <td class="p-2 border">{{ $bio['biological_age'] }}</td>
                                    <td class="p-2 border">{{ $bio['peer_biological_age_score'] }}%</td>
                                    <td class="p-2 border">
                                        {{ \Carbon\Carbon::parse($bio['collection_date'])->format('Y-m-d') }}</td>
                                    <td class="p-2 border">
                                        <a href="{{ $bio['share_link'] }}" class="text-blue-500 underline"
                                            target="_blank">Link</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- Genetic Results --}}
            @if (!empty($results['genetic_results']))
                <div>
                    <h3 class="text-lg font-semibold mb-2">Genetic Results</h3>
                    @foreach ($results['genetic_results'] as $kit)
                        <h4 class="text-gray-700 font-medium mb-1">Kit: {{ $kit['kit_barcode'] }}</h4>
                        <table class="w-full text-sm border mb-4">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="text-left p-2 border">Marker</th>
                                    <th class="text-left p-2 border">Risk</th>
                                    <th class="text-left p-2 border">Gene</th>
                                    <th class="text-left p-2 border">Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kit['markers'] as $marker)
                                    <tr>
                                        <td class="p-2 border">{{ $marker['marker'] }}</td>
                                        <td class="p-2 border">{{ $marker['risk'] }}</td>
                                        <td class="p-2 border">{{ $marker['gene'] }}</td>
                                        <td class="p-2 border">{{ $marker['position'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            @endif

            @if (empty($results['bio_age_results']) && empty($results['genetic_results']))
                <p class="text-gray-600">No results available.</p>
            @endif

            <div class="mt-6 flex justify-end gap-2">
                <button @click="open = false"
                    class="px-4 py-2 border rounded-3xl hover:bg-gray-100 cursor-pointer">Close</button>
            </div>

            <button @click="open = false"
                class="absolute top-2 right-4 text-xl text-gray-500 hover:text-black cursor-pointer">
                &times;
            </button>
        </div>
    </div>
</div>
