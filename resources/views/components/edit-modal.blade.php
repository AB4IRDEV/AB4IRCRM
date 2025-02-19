@props(['item', 'type']) <!-- Accept item (role/permission) and type -->

<div x-data="{ open: false }">
    <!-- Edit Button -->
    <button @click="open = true" class="px-4 btn btn-warning py-2 mx-2 bg-yellow-500 hover:bg-red-700 text-white text-xs font-medium rounded">
        {{ __('Edit') }}
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-lg font-semibold mb-4">{{ __('Edit ' . ucfirst($type)) }}</h2>

            <form method="POST" action="{{ url($type . 's/' . $item->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $item->name }}" required autofocus />
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
