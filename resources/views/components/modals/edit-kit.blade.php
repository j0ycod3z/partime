@php
    $modalId = 'editKitModal_' . $kit['barcode'];
    $placeholder = fn($value) => $value ?? '—';
@endphp

<div x-data="{ open: false }" class="inline-block">
    <button @click="open = true"
        class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full hover:bg-yellow-200 transition cursor-pointer">
        <x-heroicon-o-beaker class="w-4 h-4 mr-1" />
        Edit
    </button>

    <div x-show="open" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl relative overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold mb-4">View Kit Information</h2>

            <div class="space-y-6 text-sm">
                <!-- Barcode -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Kit Barcode</label>
                    <p class="border bg-gray-100 p-2 rounded text-gray-700">{{ $placeholder($kit['barcode'] ?? null) }}
                    </p>
                </div>

                <!-- User ID -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">User ID</label>
                    <p class="border bg-gray-100 p-2 rounded text-gray-700">{{ $placeholder($kit['user_id'] ?? null) }}
                    </p>
                </div>

                <!-- Height & Weight -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Height</label>
                        <p class="border bg-gray-100 p-2 rounded text-gray-700">
                            {{ $placeholder($kit['height_feet'] ?? null) }} ft
                            {{ $placeholder($kit['height_inches'] ?? null) }} in
                        </p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Weight (kg)</label>
                        <p class="border bg-gray-100 p-2 rounded text-gray-700">
                            {{ $placeholder($kit['weight'] ?? null) }}</p>
                    </div>
                </div>

                <!-- Overall & Mental Health -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach (['overall_health', 'mental_health'] as $field)
                        <div>
                            <label
                                class="block text-gray-700 font-medium mb-1">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                            <p class="border bg-gray-100 p-2 rounded text-gray-700">
                                {{ $placeholder($kit[$field] ?? null) }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Lifestyle -->
                @php
                    $lifestyle = [
                        'social_life' => 'Social Life',
                        'stress' => 'Stress Level',
                        'has_cancer' => 'Cancer History',
                        'has_diabetes' => 'Diabetes History',
                        'medicine_consumption' => 'Takes Medicine',
                        'coffee_consumption' => 'Drinks Coffee',
                        'tobacco_consumption' => 'Uses Tobacco',
                        'waking_up_condition' => 'Wakes Up Rested',
                        'trouble_sleeping' => 'Trouble Sleeping',
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($lifestyle as $field => $label)
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">{{ $label }}</label>
                            <p class="border bg-gray-100 p-2 rounded text-gray-700">
                                {{ $placeholder($kit[$field] ?? null) }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Additional Metrics -->
                @php
                    $metrics = [
                        'alcohol_consumption' => 'Alcohol Consumption',
                        'sleep_hours' => 'Sleep Hours',
                        'physical_activity_days' => 'Physical Activity (days/week)',
                        'supplement_consumption' => 'Supplement Consumption',
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($metrics as $field => $label)
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">{{ $label }}</label>
                            <p class="border bg-gray-100 p-2 rounded text-gray-700">
                                {{ $placeholder($kit[$field] ?? null) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button @click="open = false"
                    class="px-4 py-2 border rounded-full hover:bg-gray-100 cursor-pointer">Close</button>
            </div>

            <button @click="open = false"
                class="absolute top-2 right-4 text-xl text-gray-500 hover:text-black cursor-pointer rounded-full">
                &times;
            </button>
        </div>
    </div>
</div>
