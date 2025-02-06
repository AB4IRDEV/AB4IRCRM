<div x-data="{ open: false }">
    <!-- Edit Button -->
    <button @click="open = true" class=" mx-3 px-3 py-1 bg-yellow-500 hover:bg-red-700
     text-white text-xs font-medium rounded">
        {{ __('Edit/Assign Role') }}
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">{{ __('Edit Permission') }}</h2>

            <form method="POST" action="{{ url('roles/'. $roles->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <input id="name" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <button @click="open = false" type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                        {{ __('Cancel') }}
                    </button>
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
