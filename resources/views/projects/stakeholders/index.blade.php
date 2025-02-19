<x-app-layout>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                <x-card-table title="All Stakeholders" buttonText="" buttonLink="">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Organisation</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Type</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Contact Person</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Phone</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Action</th>
                    </x-slot>
            @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition 
                x-init="setTimeout(() => show = false, 3000)" 
                class="alert alert-success"
            >
                {{ session('status') }}
            </div>
        @endif
            @foreach($stakeholders as $stakeholder)
            <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                <td class="px-4 py-2">{{ $stakeholder->id }}</td>
                <td class="px-4 py-2">{{ $stakeholder->organisation}}</td>
                <td class="px-4 py-2">{{ $stakeholder->type}}</td>
                <td class="px-4 py-2">{{ $stakeholder->contact_person}}</td>
                <td class="px-4 py-2">{{ $stakeholder->phone}}</td>
                <td class="px-4 py-2">{{ $stakeholder->email}}</td>
                <td class="px-4 py-2 flex">
                    <x-edit-stakeholder-modal :item="$stakeholder" type="stakeholders" :types="$types" />
                    <x-confirm-delete :route="route('stakeholder.delete', $stakeholder->id)" message="Are you sure you want to remove this stakeholder?" />

                </td>
            </tr>
        @endforeach
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Add Stakeholder" buttonText="" buttonLink="stakeholders/create">
                <form method="post" action="{{ url('stakeholders') }}" class="mt-6 space-y-6">
                @csrf
        
                <div>
                <x-input-label for="Organisation" :value="__('Organisation')" />
                <x-text-input id="organisation" name="organisation" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
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
                        <x-input-label for="Contact Person" :value="__('Contact Person')" />
                        <x-text-input id="contact_person" name="contact_person" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('contact_person')" />
                    </div>
                </div>
     
                <div class="flex w-full gap-4">
                    <div class="w-full">
                        <x-input-label for="Phone Number" :value="__('Phone Number')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" maxlength="13" required />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>
                    <div class="w-full">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    @if (session('status') === 'permission-saved')
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
                </x-card>
            </div>
        </div>

    </div>

  
</x-app-layout>
