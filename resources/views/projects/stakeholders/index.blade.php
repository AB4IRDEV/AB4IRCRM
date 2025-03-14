<x-app-layout>
    <div class="mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full translate-x-10 bg-white">
                
                <x-card-table title="All Stakeholders" buttonText="" buttonLink="">
                    
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Organisation</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Type</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Phone</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Address</th>
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
                <td class="px-4 py-2"><a href="{{route('stakeholders.show', $stakeholder->id)}}">{{ $stakeholder->organisation}}</a></td>
                <td class="px-4 py-2">{{ $stakeholder->type}}</td>
                <td class="px-4 py-2">{{ $stakeholder->phone}}</td>
                <td class="px-4 py-2">{{ $stakeholder->email}}</td>
                <td class="px-4 py-2">{{ $stakeholder->address}}</td>
                <td class="px-4 py-2 flex">
                    <a href="{{ url('stakeholders/'.$stakeholder->id) }}" 
                        class="inline-block btn btn-warning px-3 py-2 mr-2 text-xs font-medium text-white bg-yellow-600 rounded hover:bg-gray-700">
                         View Stakeholder
                     </a>
                     
                    <a href="{{ url('stakeholders/'.$stakeholder->id.'/edit') }}" 
                        class="inline-block btn btn-dark px-3 py-2 mx-4 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                         Edit Stakeholder
                     </a>
                    <x-confirm-delete :route="route('stakeholders.destroy', $stakeholder->id)" message="Are you sure you want to remove this stakeholder?" />

                </td>
            </tr>
        @endforeach
        <div class=" ">
            {{ $stakeholders->links() }} 
        </div>
                </x-card-table>

               
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Add Stakeholder" buttonText="" buttonLink="stakeholders/create">
                <form method="post" action="{{ url('stakeholders') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                        <x-input-label for="Address" :value="__('Organisation Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
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
                    <div class="w-full">
                        <x-input-label for="Image" :value="__('Image')" />
                        <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>
                </div>    
                <div class=" w-1/2 items-center gap-4">
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
