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
            <x-card title="Add Beneficiary" buttonText="back" buttonLink="beneficiaries">
                <form method="post" action="{{ route('beneficiaries.update', $beneficiary->id) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                 
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $beneficiary->name)"  required autofocus autocomplete="given-name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="Surname" :value="__('Surname')" />
                            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" :value="old('surname', $beneficiary->surname)"  required autocomplete="family-name" />
                            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $beneficiary->dob)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="age" :value="__('Age')" />
                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $beneficiary->age)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="id_number" :value="__('ID Number')" />
                            <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" maxlength="13" :value="old('id_number', $beneficiary->id_number)" required oninput="updateDobAndAge()" />
                            <x-input-error class="mt-2" :messages="$errors->get('id_number')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $beneficiary->email)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $beneficiary->phone)" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="mt-1 block w-full dark:bg-black" :value="old('gender', $beneficiary->gender)" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="province" :value="__('location')" />   
                            <select id="province_id" name="province_id" class="mt-1 block w-full text-dark">
                                @foreach ($locations as $location)
                                    <option class="text-dark" value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>                                
                            <x-input-error class="mt-2" :messages="$errors->get('location_id')" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="Select program" :value="__('Select Program ')" />   
                            <select id="program_id" name="program_id" class="mt-1 block w-full text-dark">
                                @foreach ($programs as $program)
                                    <option class="text-dark" value="{{ $program->id }}">{{ $program->title}}</option>
                                @endforeach
                            </select>                                 
                            <x-input-error class="mt-2" :messages="$errors->get('program_id')" />
                        </div>
                    </div>
            
                    <div class="flex items-center gap-4">
                        <div class="w-full">
                            <x-input-label for="highest_qualification" :value="__('Highest Qualification')" />
                            <x-text-input id="highest_qualification" name="highest_qualification" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.highest_qualification', '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('highest_qualification')" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="Photo" :value="__('Beneficiary Photo')" />
                            <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>
                             
                    </div>
            
                  

{{-- Next of Kin Information --}}
<h3 class="text-lg font-semibold text-gray-700 mt-6">Next of Kin Information</h3>
        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="next_of_kin_name" :value="__('Full Name')" />
                <x-text-input id="next_of_kin_name" name="next_of_kin_name" type="text" class="mt-1 block w-full" :value="old('next_of_kin_name', $nextOfKin?->first_name)"   required />
                <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_name')" />
            </div>
            <div class="w-full">
                <x-input-label for="next_of_kin_last_name" :value="__('last Name')" />
                <x-text-input id="next_of_kin_last_name" name="next_of_kin_last_name" type="text" class="mt-1 block w-full" :value="old('next_of_kin_last_name', $nextOfKin?->last_name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_last_name')" />
            </div>
            <div class="w-full">
                <x-input-label for="relationship" :value="__('Relationship')" />
                <select id="relationship" name="relationship" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Relationship</option>
                    <option value="Parent" {{ old('relationship', $nextOfKin->relationship) == 'Parent' ? 'selected' : '' }}>Parent</option>
                    <option value="Sibling" {{ old('relationship', $nextOfKin->relationship) == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                    <option value="Spouse" {{ old('relationship', $nextOfKin->relationship) == 'Spouse' ? 'selected' : '' }}>Spouse</option>
                    <option value="Guardian" {{ old('relationship', $nextOfKin->relationship) == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                    <option value="Relative" {{ old('relationship', $nextOfKin->relationship) == 'Relative' ? 'selected' : '' }}>Relative</option>
                    <option value="Friend" {{ old('relationship', $nextOfKin->relationship) == 'Friend' ? 'selected' : '' }}>Friend</option>
                    <option value="Other" {{ old('relationship', $nextOfKin->relationship) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                
                <x-input-error class="mt-2" :messages="$errors->get('relationship')" />
            </div>
        </div>

        <div class="flex w-full gap-4">
            <div class="w-full">
                <x-input-label for="next_of_kin_phone" :value="__('Phone')" />
                <x-text-input 
    id="next_of_kin_phone" 
    name="next_of_kin_phone" 
    type="text" 
    class="mt-1 block w-full" 
    :value="old('next_of_kin_phone', $nextOfKin?->phone)" 
    required 
/><x-input-error class="mt-2" :messages="$errors->get('next_of_kin_phone')" />
            </div>
            <div class="w-full">
                <x-input-label for="next_of_kin_email" :value="__('Email (Optional)')" />
                <x-text-input id="next_of_kin_email" name="next_of_kin_email" type="email" class="mt-1 block w-full" :value="old('email', $nextOfKin->email)" />
                <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_email')" />
            </div>
        </div>

        <x-primary-button>{{ __('Submit') }}</x-primary-button>
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