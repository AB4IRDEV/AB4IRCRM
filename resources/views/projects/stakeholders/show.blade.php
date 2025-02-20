<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
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
        <!-- Stakeholder Header -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center">
            <!-- Profile Image (Placeholder for now) -->
            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 text-lg">
                <span>IMG</span>
            </div>
            <div class="ml-6">
                <h1 class="text-2xl font-semibold text-gray-800">{{ $stakeholder->name }} {{ $stakeholder->surname }}</h1>
                <p class="text-sm text-gray-500">Stakeholder Profile</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Stakeholder Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">Stakeholder Details</h2>
                <div class="mt-4 space-y-2 text-gray-600">
                    <p><strong>ID:</strong> {{ $stakeholder->id}}</p>
                    <p><strong>Name:</strong> {{ $stakeholder->organisation }}</p>
                    <p><strong>Type:</strong> {{ $stakeholder->type }}</p>                    
                    <p><strong>Email:</strong> {{ $stakeholder->email }}</p>
                    <p><strong>Phone:</strong> {{ $stakeholder->phone }}</p>
                    <p><strong>Address:</strong> {{ $stakeholder->address }}</p>
                    <br>
                    <p><strong>Updated by:</strong> {{ $updateuser ? $updateuser->name : 'Unknown' }}</p>
                    <p><strong>Created by:</strong> {{ $createuser ? $createuser->name : 'Unknown' }}</p>
                </div>
            </div>

            <!-- Next of Kin Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">Stakeholder Contacts</h2>
                @if(!empty($contactData) && $contactData->isNotEmpty())
                @foreach($contactData as $contact)
                    <div class="mt-4 space-y-2 text-gray-600">
                        <p><strong>Name:</strong> {{ $contact->name }}</p>
                        <p><strong>Surname:</strong> {{ $contact->last_name }}</p>
                        <p><strong>Phone:</strong> {{ $contact->phone}}</p>
                        <p><strong>Email:</strong> {{ $contact->email}}</p>
                        <p><strong>Department:</strong> {{ $contact->department}}</p>
                        <p><strong>Position:</strong> {{ $contact->position}}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 mt-4">No contact information available.</p>
            @endif
            
            </div>
        </div>


        <div class="bg-white shadow-md rounded-lg p-6 mt-5">
            <h2 class="text-xl font-semibold text-gray-700">Add Contacts</h2>
            <p>add additional contacts assorciated with this stakeholder organisation </p>
            <div class="">

                <form method="POST" action="{{ route('contacts.store', $stakeholder->id) }}">
                    @csrf

                    <input type="hidden" name="stakeholder_id" value="{{ $stakeholder->id }}">
                    <div>
                        <x-input-label for="full_name" :value="__('Full Name')" />
                        <x-text-input id="name" class="my-2 block w-full" name="name" type="text" required />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="my-2 block w-full" name="email" type="email" maxlength="255" />
                        <x-input-error :messages="$errors->get('email')" />
                        <span id="error-email" class="text-red-500 text-sm"></span>
                    </div>
                
                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="my-2 block w-full" name="phone" maxlength="10" type="text" />
                        <x-input-error :messages="$errors->get('phone')" />
                        <span id="error-phone" class="text-red-500 text-sm"></span>    
                    </div>
                
                    <div>
                        <x-input-label for="department" :value="__('Department')" />
                        <x-text-input id="department" class="my-2 block w-full" name="department" type="text" maxlength="255" />
                        <x-input-error :messages="$errors->get('position')" />
                        
                    </div>
                
                    <div>
                        <x-input-label for="position" :value="__('Position')" />
                        <x-text-input id="position" class="my-2 block w-full" name="position" type="text" maxlength="255" />
                        <x-input-error :messages="$errors->get('position')" />
                    </div>
                
                    <x-primary-button>{{ __('Add Contact') }}</x-primary-button>
                </form>
                
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-center my-2">
            <div class="my-2 flex space-x-4">
                <a href="{{ route('stakeholders.index') }}" 
                class=" btn btn-primary ml-1 mr-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
                Back to List
                </a>
                <a href="{{ route('stakeholders.edit', $stakeholder->id) }}" 
                    class=" btn btn-warning px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 text-sm">
                    Edit Stakeholder
                </a>
            
                <x-confirm-delete :route="route('stakeholders.destroy', $stakeholder->id)" message="Are you sure you want to remove this user?" />
            </div>
        </div>

       
    </div>
</x-app-layout>
