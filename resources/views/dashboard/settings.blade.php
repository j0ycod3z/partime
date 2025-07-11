@extends('layouts.app')

@section('content')
    <div class="p-8 space-y-8">
        <div>
            <h1 class="text-2xl font-bold mb-2">Settings</h1>
            <p class="text-gray-600"></p>
        </div>

        <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Test Kit Tools (For staging nnly)</h2>
            <p class="text-sm text-gray-500 mb-6">
                Use this to generate or mock a test kit on staging. Ensure API and keys are configured.
            </p>

            <form method="POST" action="{{ route('settings.generate-kit') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barcode</label>
                        <input type="text" name="barcode" class="w-full border p-2 rounded" placeholder="e.g. ABC-12345"
                            required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Test Type</label>
                        <select name="test_type" class="w-full border p-2 rounded" required>
                            <option value="1">Folate</option>
                            <option value="2">Age</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-gray-600 text-white px-4 py-2 hover:bg-gray-700 transition rounded-full cursor-pointer">
                        Generate Test Kit
                    </button>
                </div>
            </form>

            <hr class="my-6">

            <!-- Mock Kit Result Form -->
            <form method="POST" action="{{ route('settings.mock-kit') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Barcode</label>
                    <input type="text" name="barcode" class="w-full border p-2 rounded" placeholder="e.g. ABC-12345"
                        required>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-gray-600 text-white px-4 py-2 hover:bg-gray-700 transition rounded-full">
                        Mock Kit Result
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
