<x-app-layout>
    <div class="container mx-auto px-4">
        
      

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Edit - {{$user->name}}" buttonText="back" buttonLink="user">
                <form method="post" action="{{ url('user/'.$user->id) }}" class="mt-6 space-y-6">
                @csrf
                @method('PUT')
        
                <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" value="{{$user->name}}" name="name" type="text" class="mt-1 block w-full"  required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                <x-input-label for="email" :value="__('email')" />
                <x-text-input id="email" value="{{$user->email}}" name="email" type="email" class="mt-1 block w-full"   autofocus autocomplete="email" />
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
                            {{ in_array($irole, $userRoles) ? 'checked' : '' }} 
                     /> {{$irole}}
                     
                            
                        </div>
                    @endforeach
                        <br>

                    </div>
                </div>
                <div class="">
                <x-input-label for="password" :value="__('password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"  nullable autofocus autocomplete="password" />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" nullable autocomplete="new-password" />
        
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
