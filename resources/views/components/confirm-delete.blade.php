<div x-data="{ confirmDelete: false }">
    <!-- Delete Button -->
    <button type="button" 
        class="btn btn-danger px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded"
        @click="confirmDelete = true">
        Delete
    </button>

    <!-- Modal -->
    <div x-show="confirmDelete" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold text-gray-800">Are you sure?</h2>
            <p class="text-gray-600 mt-2">{{ $message }}</p>

            <div class="mt-4 flex justify-end space-x-3">
                <button @click="confirmDelete = false" 
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>

                <form action="{{ $route }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
