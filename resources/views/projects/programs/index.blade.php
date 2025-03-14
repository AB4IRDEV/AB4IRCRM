<x-app-layout>
    <div class="mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full translate-x-10">
                <x-card-table title="All Stakeholders" buttonText="" buttonLink="">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Title</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Description</th>
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
            @foreach($programs as $program)
            <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                <td class="px-4 py-2">{{ $program->id }}</td>
                <td class="px-4 py-2"><a href="{{route('programs.show', $program->id)}}">{{ $program->name}}</a></td>
                <td class="px-4 py-2">{{ $program->description}}</td>

                <td class="px-4 py-2 flex">
                    <a href="{{ url('programs/'.$program->id) }}" 
                        class="inline-block btn btn-warning px-3 py-2 mr-2 text-xs font-medium text-white bg-yellow-600 rounded hover:bg-gray-700">
                         View Program
                     </a>
                     
                    <a href="{{ url('programs/'.$program->id.'/edit') }}" 
                        class="inline-block btn btn-dark px-3 py-2 mx-4 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                         Edit Program
                     </a>
                    <x-confirm-delete :route="route('programs.destroy', $program->id)" message="Are you sure you want to remove this stakeholder?" />

                </td>
            </tr>
        @endforeach
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Create program" buttonText="" buttonLink="programs">
                <form method="post" action="{{ url('programs') }}" class="mt-6 space-y-6" >
                @csrf
        
                <div>
                <x-input-label for="Title" :value="__('Title')" />
                <x-text-input id="title" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

               
               
                    <div>
                        <x-input-label for="description" :value="__('Program Description')" />
                        <x-textarea-input id="description" type='text' name="description" class="mt-1 block w-full" required />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
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
