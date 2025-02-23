<x-app-layout>
    <div class="flex flex-wrap">
        <div class="w-full md:w-full">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <x-card title="Edit Stakeholder" buttonText="back" buttonLink="stakeholders">
                <form method="post" action="{{ route('stakeholders.update', $stakeholder->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
            
                    <div>
                    <x-input-label for="Organisation" :value="__('Organisation')" />
                    <x-text-input id="organisation" name="organisation" type="text" class="mt-1 block w-full" :value="old('organisation', $stakeholder->organisation)"  required autofocus autocomplete="name" />
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
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $stakeholder->address)" autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>
         
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="Phone Number" :value="__('Phone Number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" maxlength="13" :value="old('phone', $stakeholder->phone)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $stakeholder->email)" required />
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
                <br>
                
                   
                
            </x-card>
            
            
        </div>
    </div>   

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const idInput = document.getElementById("id_number");
            const dobInput = document.getElementById("dob");
            const ageInput = document.getElementById("age");
    
            // Store initial values (to check if ID number changes)
            let oldID = idInput.value.trim();
    
            idInput.addEventListener("input", function () {
                const newID = idInput.value.trim();
    
                // Only update if ID is 13 digits and has changed
                if (newID.length === 13 && newID !== oldID) {
                    oldID = newID; // Update stored ID
    
                    let year = newID.substring(0, 2);
                    const month = newID.substring(2, 4);
                    const day = newID.substring(4, 6);
    
                    const currentYear = new Date().getFullYear();
                    const fullYear = (year <= (currentYear % 100)) ? `20${year}` : `19${year}`;
    
                    // Update DOB & Age
                    dobInput.value = `${fullYear}-${month}-${day}`;
                    ageInput.value = calculateAge(fullYear, month, day);
                }
            });
    
            function calculateAge(year, month, day) {
                const birthDate = new Date(year, month - 1, day);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
    
                if (
                    today.getMonth() < birthDate.getMonth() || 
                    (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())
                ) {
                    age--;
                }
                return age;
            }
        });
    </script>
    
</x-app-layout>