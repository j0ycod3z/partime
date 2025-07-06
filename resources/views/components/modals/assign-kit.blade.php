<div x-data="{ open: false, hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
    <button @click="open = true"
        class="inline-flex items-center bg-gray-600 hover:bg-gray-800 hover:shadow-lg hover:delay-150 duration-300 hover:duration-300 text-white rounded-full cursor-pointer px-3 py-2 overflow-hidden">
        <x-heroicon-o-tag class="w-2 h-2" />
        <span class="ml-2 transition-all duration-300 ease-in-out text-xs">
            Assign
        </span>
    </button>

    <div x-show="open" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl relative overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold mb-4">Assign Kit to User</h2>
            <form method="POST" action="#">
                <div class="space-y-6 text-sm">

                    <!-- Kit Barcode (read-only and styled as static) -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Kit Barcode</label>
                        <input type="text" name="barcode"
                            class="w-full border border-gray-300 bg-gray-100 p-2 rounded cursor-not-allowed text-gray-500"
                            value="{{ $kit }}" readonly />
                    </div>

                    <!-- User ID -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">User ID</label>
                        <input type="text" name="user_id" class="w-full border p-2 rounded" required />
                    </div>
                    <!-- Height & Weight -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Height (Feet + Inches) -->
                        <div class="flex gap-2">
                            <div class="w-1/2">
                                <label class="block text-gray-700 font-medium mb-1">Height (feet)</label>
                                <input type="number" step="any" name="height_feet"
                                    class="w-full border p-2 rounded appearance-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700 font-medium mb-1">Height (inches)</label>
                                <input type="number" step="any" name="height_inches"
                                    class="w-full border p-2 rounded appearance-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                            </div>
                        </div>

                        <!-- Weight (Full width of Column 2) -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Weight (kg)</label>
                            <input type="number" step="any" name="weight"
                                class="w-full border p-2 rounded appearance-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" />
                        </div>
                    </div>

                    <!-- Overall & Mental Health -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Overall Health</label>
                            <div class="flex gap-4">
                                @foreach (['Excellent', 'Good', 'Fair', 'Poor'] as $option)
                                    <label class="flex items-center gap-1 text-gray-600">
                                        <input type="radio" name="overall_health" value="{{ $option }}"
                                            class="text-blue-600" />
                                        {{ $option }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Mental Health</label>
                            <div class="flex gap-4">
                                @foreach (['Excellent', 'Good', 'Fair', 'Poor'] as $option)
                                    <label class="flex items-center gap-1 text-gray-600">
                                        <input type="radio" name="mental_health" value="{{ $option }}"
                                            class="text-blue-600" />
                                        {{ $option }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Lifestyle Questions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $lifestyle = [
                                'social_life' => ['Yes', 'No', "I'd rather not say"],
                                'stress' => [
                                    'A little stressed',
                                    'Somewhat stressed',
                                    'Really stressed',
                                    'Not at all',
                                    'Extremely stressed',
                                ],
                                'has_cancer' => ['Yes', 'No', "I'd rather not say"],
                                'has_diabetes' => ['Yes', 'No', "I'd rather not say"],
                                'medicine_consumption' => ['Yes', 'No'],
                                'coffee_consumption' => ['Yes', 'No'],
                                'tobacco_consumption' => ['Yes', 'No'],
                                'waking_up_condition' => ['Yes', 'No'],
                                'trouble_sleeping' => ['Yes', 'No'],
                            ];
                        @endphp

                        @foreach ($lifestyle as $field => $options)
                            <div>
                                <label
                                    class="block text-gray-700 font-medium mb-1 capitalize">{{ str_replace('_', ' ', $field) }}</label>
                                <div class="flex flex-wrap gap-4">
                                    @foreach ($options as $option)
                                        <label class="flex items-center gap-1 text-gray-600">
                                            <input type="radio" name="{{ $field }}" value="{{ $option }}"
                                                class="text-blue-600" />
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Alcohol, Sleep, Physical Activity -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Alcohol Consumption</label>
                            <select name="alcohol_consumption" class="w-full border p-2 rounded">
                                @foreach (['0', '1-2', '3-5', '6-9', '+10'] as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Sleep Hours</label>
                            <select name="sleep_hours" class="w-full border p-2 rounded">
                                @foreach (['<5', '6', '7', '8', '9', '>10'] as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Physical Activity (days/week)</label>
                            <select name="physical_activity_days" class="w-full border p-2 rounded">
                                @foreach (['0', '1', '2', '3', '4', '5', '+6'] as $option)
                                    <option>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Supplements -->
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Supplement Consumption</label>
                        <input type="text" name="supplement_consumption" placeholder="e.g. Vitamin D"
                            class="w-full border p-2 rounded" />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded-full hover:bg-gray-100 cursor-pointer">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 text-white hover:bg-gray-700 rounded-full cursor-pointer">Assign</button>
                </div>
            </form>


            <button @click="open = false"
                class="absolute top-2 right-4 text-xl text-gray-500 hover:text-black cursor-pointer rounded-full">
                &times;
            </button>
        </div>
    </div>
</div>
