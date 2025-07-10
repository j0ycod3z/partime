@php
    $modalId = 'editKitModal_' . $kit['barcode'];
@endphp

<div x-data="{ open: false }" class="inline-block">
    <button @click="open = true"
        class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full hover:bg-yellow-200 transition cursor-pointer">
        <x-heroicon-o-pencil class="w-4 h-4 mr-1" />
        Edit
    </button>

    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black/40 z-50" x-cloak>
        <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative">
            <h2 class="text-xl font-bold mb-4">Edit Kit</h2>

            <form method="POST" action="#">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label class="block text-sm">Barcode</label>
                    <input type="text" value="{{ $kit['barcode'] }}" readonly
                        class="w-full p-2 border rounded bg-gray-100" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm">Assigned User</label>
                    <input type="text" name="user" value="{{ $kit['user'] }}"
                        class="w-full p-2 border rounded" />
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded-3xl hover:bg-gray-100">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 text-white rounded-3xl hover:bg-gray-700">Update</button>
                </div>
            </form>

            <!-- Close icon -->
            <button @click="open = false"
                class="absolute top-2 right-4 text-gray-500 hover:text-black text-xl cursor-pointer">&times;</button>
        </div>
    </div>
</div>
