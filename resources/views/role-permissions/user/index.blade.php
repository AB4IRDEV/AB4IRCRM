<x-app-layout>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                <x-card-table title="All Users" buttonText="Add Roles" buttonLink="">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Roles</th>
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
            @foreach($users as $user)
            <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                <td class="px-4 py-2">{{ $user->id }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">
                    @if (!@empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $rolename) 
                            <label class="badge bg-purple-700 mx-1">{{$rolename}} </label>
                        @endforeach
                    @endif
                </td>
                <td class="px-4 py-2 flex">
                    <a href="{{ url('user/'.$user->id.'/edit') }}" 
                        class="inline-block px-3 py-1 mx-4 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                         Edit User
                     </a>
                    <x-confirm-delete :route="route('user.destroy', $user->id)" message="Are you sure you want to remove this user?" />
                </td>
            </tr>
        @endforeach
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Add User" buttonText="" buttonLink="users/create">
                <form method="post" action="{{ url('user') }}" class="mt-6 space-y-6">
                @csrf
        
                <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                <x-input-label for="email" :value="__('email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"  required autofocus autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
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
                                />{{$irole}}
                    
                            
                        </div>
                    @endforeach
                        <br>

                    </div>
                </div>
                <div class="">
                <x-input-label for="password" :value="__('password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"  required autofocus autocomplete="password" />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <br>
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    @if (session('status') === 'user-saved')
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
