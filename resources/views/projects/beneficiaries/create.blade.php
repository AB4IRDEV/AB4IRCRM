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
                <form method="post" action="{{ url('beneficiaries') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.name', '') }}" required autofocus autocomplete="given-name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="surname" :value="__('Surname')" />
                            <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.surname', '') }}" required autocomplete="family-name" />
                            <x-input-error class="mt-2" :messages="$errors->get('surname')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" value="{{ session('beneficiary_data.dob', '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="age" :value="__('Age')" />
                            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('age')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="id_number" :value="__('ID Number')" />
                            <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" maxlength="13" value="{{ session('beneficiary_data.id_number', '') }}" required oninput="updateDobAndAge()" />
                            <x-input-error class="mt-2" :messages="$errors->get('id_number')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ session('beneficiary_data.email', '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>
            
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.phone', '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="mt-1 block w-full dark:bg-black" required>
                                <option value="male" {{ session('beneficiary_data.gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ session('beneficiary_data.gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>
                    </div>

                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="province" :value="__('location')" />   
                            <select id="location_id" name="location_id" class="mt-1 block w-full text-dark">
                                @foreach ($locations as $location)
                                    <option class="text-dark" value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>                                
                            <x-input-error class="mt-2" :messages="$errors->get('location_id')" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="Select project" :value="__('Select Project')" />   
                            <select id="project_id" name="project_id" class="mt-1 block w-full text-dark">
                                @foreach ($projects as $project)
                                    <option class="text-dark" value="{{ $project->id }}">{{ $project->title}}</option>
                                @endforeach
                            </select>                                 
                            <x-input-error class="mt-2" :messages="$errors->get('project_id')" />
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-full">
                            <x-input-label for="highest_qualification" :value="__('Highest Qualification')" />
                            <x-text-input id="highest_qualification" name="highest_qualification" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.highest_qualification', '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('highest_qualification')" />
                        </div>

                        <div class="w-full">
                            <x-input-label for="Image" :value="__('Beneficiary Photo')" />
                            <x-text-input id="photo" name="photo" type="file" class="mt-1 block w-full" />
                            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
                        </div>
                             
                    </div>
            
                    {{-- Next of Kin Information --}}
                    <h3 class="text-lg font-semibold text-gray-700 mt-6">Next of Kin Information</h3>
                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="next_of_kin_name" :value="__('Full Name')" />
                            <x-text-input id="next_of_kin_name" name="next_of_kin_name" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.next_of_kin_name', '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_name')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="next_of_kin_last_name" :value="__('Last Name')" />
                            <x-text-input id="next_of_kin_last_name" name="next_of_kin_last_name" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.next_of_kin_last_name', '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_last_name')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="relationship" :value="__('Relationship')" />
                            <select id="relationship" name="relationship" class="mt-1 block w-full" required>
                                <option value="">Select Relationship</option>
                                <option value="Parent" {{ session('beneficiary_data.relationship') == 'Parent' ? 'selected' : '' }}>Parent</option>
                                <option value="Sibling" {{ session('beneficiary_data.relationship') == 'Sibling' ? 'selected' : '' }}>Sibling</option>
                                <option value="Spouse" {{ session('beneficiary_data.relationship') == 'Spouse' ? 'selected' : '' }}>Spouse</option>
                                <option value="Guardian" {{ session('beneficiary_data.relationship') == 'Guardian' ? 'selected' : '' }}>Guardian</option>
                                <option value="Relative" {{ session('beneficiary_data.relationship') == 'Relative' ? 'selected' : '' }}>Relative</option>
                                <option value="Friend" {{ session('beneficiary_data.relationship') == 'Friend' ? 'selected' : '' }}>Friend</option>
                                <option value="Other" {{ session('beneficiary_data.relationship') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('relationship')" />
                        </div>
                    </div>

                    <div class="flex w-full gap-4">
                        <div class="w-full">
                            <x-input-label for="next_of_kin_phone" :value="__('Phone')" />
                            <x-text-input id="next_of_kin_phone" name="next_of_kin_phone" type="text" class="mt-1 block w-full" value="{{ session('beneficiary_data.next_of_kin_phone', '') }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_phone')" />
                        </div>
                        <div class="w-full">
                            <x-input-label for="next_of_kin_email" :value="__('Email (Optional)')" />
                            <x-text-input id="next_of_kin_email" name="next_of_kin_email" type="email" class="mt-1 block w-full" value="{{ session('beneficiary_data.next_of_kin_email', '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('next_of_kin_email')" />
                        </div>
                    </div>

                    {{-- Save Button --}}
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                        @if (session('status') === 'beneficiary-saved')
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
                <form method="post" action="{{ url('beneficiary/finalize') }}">
                    @csrf
                    <x-primary-button>{{ __('Submit') }}</x-primary-button>
                </form>
            </x-card>
            
        </div>
    </div>

    <script>
        function updateDobAndAge() {
            const idNumber = document.getElementById('id_number').value;
            console.log("ID Number Entered:", idNumber);
        
            if (idNumber.length === 13) {
                let year = idNumber.substring(0, 2);
                const month = idNumber.substring(2, 4);
                const day = idNumber.substring(4, 6);
        
                const currentYear = new Date().getFullYear();
                const fullYear = (year <= (currentYear % 100)) ? `20${year}` : `19${year}`;
                
                const dob = `${fullYear}-${month}-${day}`;
                console.log("DOB Set:", dob); // Check if DOB is being generated
        
                document.getElementById('dob').value = dob;
                document.getElementById('age').value = calculateAge(fullYear, month, day);
            }
        }
        
        function calculateAge(year, month, day) {
            const birthDate = new Date(year, month - 1, day);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
        
            if (today.getMonth() < birthDate.getMonth() || 
                (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            console.log("Calculated Age:", age); // Debugging output
            return age;
        }
        
        </script>
</x-app-layout>

