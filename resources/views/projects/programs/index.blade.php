<x-app-layout>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                <x-card-table title="All Programs" buttonText="Add Permission" buttonLink="">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
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
                <td class="px-4 py-2">{{ $programn->name }}</td>
                <td class="px-4 py-2 flex">
                    <x-edit-modal :item="$permission" type="permission" />
                    <x-confirm-delete :route="route('permissions.destroy', $permission->id)" message="Are you sure you want to remove this permission?" />

                </td>
            </tr>
        @endforeach
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Add program" buttonText="" buttonLink="permissions/create">
                <form method="post" action="{{ url('permissions') }}" class="mt-6 space-y-6">
                @csrf
        
                <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                <x-input-label for="Program Description" :value="__('Program Description')" />
                <x-textarea-input id="name" name="description" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
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

        <script>
            function confirmDelete(event) {
                event.preventDefault(); // Stop form submission
                if (confirm('Are you sure you want to delete this permission?')) {
                    event.target.submit(); // Submit the form if confirmed
                }
            }
        </script>

  
</x-app-layout>
