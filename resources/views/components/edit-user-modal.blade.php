@props(['item', 'type', 'iroles']) <!-- Accept item (role/permission) and type -->

<div x-data="{ open: false }">
    <!-- Edit Button -->
    <button @click="open = true" class="px-3 py-1 bg-yellow-500 hover:bg-red-700 text-white text-xs font-medium rounded">
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
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ $item->email }}" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" value=""  autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>

                <div class="my-4">
                    <x-input-label for="permission" :value="__('Permissions')" />
                    <div class="grid grid-cols-3 md:grid-cols-4 gap-4 my-4">
                    @foreach ($iroles as $irole)
                        <div class="w-full md:w-full flex items-center space-x-2">
                            <input id="roles"
                                   name="roles[]"
                                   value="{{$irole}}"
                                   type="checkbox"
                                   class="mt-1 mx-2"
                                />
                                
                                {{$irole}}
                                    
                            
                        </div>
                    @endforeach
                        <br>

                    </div>
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
