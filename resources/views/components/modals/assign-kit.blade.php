<div x-data="{ open: false, hover: false }" @mouseenter="hover = true" @mouseleave="hover = false">
    <button @click="open = true"
        class="inline-flex items-center bg-gray-600 hover:bg-gray-800 hover:delay-150 duration-300 hover:duration-300 text-white rounded-full cursor-pointer px-3 py-2 overflow-hidden">
        <x-heroicon-o-tag class="w-2 h-2" />
        <span class="ml-2 transition-all duration-300 ease-in-out text-xs">
            Assign
        </span>
    </button>

    <div x-show="open" class="fixed inset-0 bg-black/80 flex items-center justify-center z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl relative overflow-y-auto max-h-[90vh]">
            <h2 class="text-xl font-semibold mb-4">Assign Kit to User</h2>
            <form method="POST" action="#">
                <div class="space-y-4 text-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label>Kit Barcode</label>
                            <input type="text" name="barcode" class="w-full border p-2 rounded text-gray-500"
                                required value={{ $kit }} readonly />
                        </div>
                        <div>
                            <label>User ID</label>
                            <input type="text" name="user_id" class="w-full border p-2 rounded" required />
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded-full hover:bg-gray-100">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 text-white hover:bg-gray-700 rounded-full">Assign</button>
                </div>
            </form>

            <button @click="open = false"
                class="absolute top-2 right-4 text-xl text-gray-500 hover:text-black cursor-pointer rounded-full">
                &times;
            </button>
        </div>
    </div>
</div>
