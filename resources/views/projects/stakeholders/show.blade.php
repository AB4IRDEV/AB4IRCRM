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
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-center">
            <!-- Profile Image (Placeholder for now) -->
            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                <img src="{{ asset($stakeholder->logo) }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <div class="ml-6">
                <h1 class="text-2xl font-semibold text-gray-800">{{ $stakeholder->organisation}}</h1>
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

            <!-- Stakeholder Contacts  -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">Stakeholder Contacts</h2>
                @if(!empty($contactData) && $contactData->isNotEmpty())
                    @foreach($contactData as $contact)
                        <div class="mt-4 space-y-2 text-gray-600 border-b pb-4">
                            <p><strong>Name:</strong> {{ $contact->name }}</p>
                            <p><strong>Surname:</strong> {{ $contact->last_name }}</p>
                            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            <p><strong>Department:</strong> {{ $contact->department }}</p>
                            <p><strong>Position:</strong> {{ $contact->position }}</p>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2 mt-2">
                                <!-- Edit Button -->
                                <x-edit-contact-modal type="stakeholder" :item="$contact" :item2="$stakeholder" x-show="open" />
            
                                <!-- Delete Button (Triggers Modal) -->
                                <a href="#" 
                                    class="px-2 text-decoration-none pt-2 pb-1 text-xs font-medium text-white bg-red-500 rounded hover:bg-red-600"
                                    data-toggle="modal" 
                                    data-target="#deleteModal"
                                    data-url="{{ route('contacts.destroy', $contact->id) }}">
                                    Delete
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 mt-4">No contact information available.</p>
                @endif
            </div>
            
            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-semibold text-gray-700">Confirm Deletion</h2>
                    <p class="mt-2 text-gray-600">Are you sure you want to delete this contact?</p>
                    
                    <!-- Delete Form -->
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="mt-4 flex justify-end space-x-2">
                            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
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
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center justify-center mt-5">
            <div class="mt-6 flex space-x-4">
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

    <!-- JavaScript to Update Modal Form Action -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');

        document.querySelectorAll('[data-target="#deleteModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const deleteUrl = this.getAttribute('data-url');
                deleteForm.setAttribute('action', deleteUrl);
                deleteModal.classList.remove('hidden');
            });
        });
    });

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
</x-app-layout>
