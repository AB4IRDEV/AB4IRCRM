@props(['item', 'type', 'types']) <!-- Accept item (role/permission) and type -->

<div x-data="{ open: false }">
    <!-- Edit Button -->
    <button @click="open = true" class="px-3 btn btn-warning mx-2  py-2 bg-yellow-500 hover:bg-red-700 text-white text-xs font-medium rounded">
        {{ __('Edit') }}
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed  inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/2">
            <a href="{{url('stakeholders')}}" class="btn btn-dark float-end">back</a>
            <h2 class="text-lg font-semibold mb-4">{{ __('Edit ' . ucfirst($type)) }}</h2>

          
            <form method="POST" action="{{ route('stakeholders.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div>
                <x-input-label for="Organisation" :value="__('Organisation')" />
                <x-text-input id="organisation" value="{{ $item->organisation }}" name="organisation" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('organisation')" />
                </div>

                <div class="flex w-full gap-4">
                    <div class="w-full">
                    <x-input-label for="Type" :value="__('Type')" />
                    <select name="type" id="type" class="border-gray-300 mt-1 dark:border-gray-700 w-full dark:bg-black dark:text-gray-300 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="w-full">
                        <x-input-label for="Organisation Address" :value="__('Organisation Address')" />
                        <x-text-input id="address" value="{{ $item->address}}" name="address" type="text" class="mt-1 block w-full"  autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>
                </div>


                
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="Phone Number" :value="__('Phone Number')" />
                        <x-text-input id="phone" name="phone" value="{{ $item->phone}}" type="text" class="mt-1 block w-full" maxlength="13" required />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" value="{{ $item->email}}" name="email" type="email" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                </div>

                <div class="flex items-center gap-4 mt-4">
                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                    @if (session('status') === 'stakeholder-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400"
                    >{{ __('Saved.') }}</p>
                @endif
                
                </div>
                </form>
        </div>
    </div>
</div>
