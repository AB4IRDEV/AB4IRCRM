@props(['item', 'type','item2']) <!-- Accept item (role/permission) and type -->

<div x-data="{ open: false }">
    <!-- Edit Button -->
    <button @click="open = true" class=" mx-3 px-3 py-1 bg-yellow-500 hover:bg-red-700
     text-white text-xs font-medium rounded">
        {{ __('Edit') }}
    </button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/3">
            <a class="btn btn-dark float-end" href="{{route("stakeholders.show",$item2->id)}}">Back</a>
            <h2 class="text-lg font-semibold mb-4">{{ __('Edit Contact') }}</h2>

            <form method="POST" action="{{ route('contacts.update', ['stakeholder' => $item2->id, 'contact' => $item->id]) }}">

                @csrf
                @method('PUT')

                <input type="hidden" name="stakeholder_id" value="{{ $item2->id }}">
                <div>
                    <x-input-label for="full_name" :value="__('Full Name')" />
                    <x-text-input id="name" class="my-2 block w-full" name="name" type="text" value="{{ $item->name }}" required />
                    <x-input-error :messages="$errors->get('name')" />
                </div>
            
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="my-2 block w-full" name="email" type="email" value="{{ $item->email }}" maxlength="255" />
                    <x-input-error :messages="$errors->get('email')" />
                    <span id="error-email" class="text-red-500 text-sm"></span>
                </div>
            
                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="my-2 block w-full" name="phone" maxlength="10" value="{{ $item->phone }}" type="text" />
                    <x-input-error :messages="$errors->get('phone')" />
                    <span id="error-phone" class="text-red-500 text-sm"></span>    
                </div>
            
                <div>
                    <x-input-label for="department" :value="__('Department')" />
                    <x-text-input id="department" class="my-2 block w-full" name="department" type="text" value="{{ $item->department}}" maxlength="255" />
                    <x-input-error :messages="$errors->get('position')" />
                    
                </div>
            
                <div>
                    <x-input-label for="position" :value="__('Position')" />
                    <x-text-input id="position" class="my-2 block w-full" name="position" type="text" value="{{ $item->position}}" maxlength="255" />
                    <x-input-error :messages="$errors->get('position')" />
                </div>
            
                <x-primary-button>{{ __('update') }}</x-primary-button>
            </form>
        </div>
    </div>
</div>
