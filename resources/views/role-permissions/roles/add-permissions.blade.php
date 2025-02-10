<x-app-layout>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                <x-card-table title="Role:{{$roles->name}}" buttonText="back" buttonLink="{{url('roles')}}">
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
          
            <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                <td class="px-4 py-2">{{ $roles->id }}</td>
                <td class="px-4 py-2">{{ $roles->name }}</td>
                <td class="px-4 py-2 flex">
                    <x-edit-modal :item="$roles" type="role" />
                    <x-confirm-delete :route="route('roles.destroy', $roles->id)" message="Are you sure you want to remove this role?" />
                </td>
            </tr>
       
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Add roles" buttonText="" buttonLink="permissions/create">
                <form method="post" action="{{ url('roles/'.$roles->id.'/give-permissions') }}" class="mt-6 space-y-6">
                @csrf
                @method('PUT')
        
                <div>
                <x-input-label for="name" :value="__('Permissions')" />
                <div class="grid grid-cols-3 md:grid-cols-4 gap-4 my-2">
                    @foreach ($permissions as $permission)
                        <div class="w-full md:w-full flex items-center space-x-2">
                            <input id="permission-{{ $permission->id }}"
                                   name="permission[]"
                                   value="{{ $permission->name }}"
                                   type="checkbox"
                                   class="mt-1 mx-2"
                                   @checked(in_array($permission->id, $rolePermissions)) />
                    
                            <label class="text-red-600" for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
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

      
  
</x-app-layout>
