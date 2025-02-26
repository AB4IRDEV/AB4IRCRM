<x-app-layout>
    <div class="container mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                <x-card-table title="All Projects" buttonText="Add Project" buttonLink="">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">description</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">funder</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Locations</th>
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
                <td class="px-4 py-2">{{ $program->title }}</td>
                <td class="px-4 py-2">{{ $program->description }}</td>
                <td class="px-4 py-2">{{ $program->funder }}</td>
                <td class="px-4 py-2">{{ $program->locations }}</td>
                <td class="px-4 py-2 flex">
                    <x-edit-modal :item="$program" type="program" />
                    <x-confirm-delete :route="route('programs.destroy', $program->id)" message="Are you sure you want to remove this permission?" />

                </td>
            </tr>
        @endforeach
            
                </x-card-table>
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Create project" buttonText="" buttonLink="permissions/create">
                    <form method="POST" action="{{ route('projects.store') }}" class="mt-6 space-y-6">
                        @csrf
                    
                        <!-- Program Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                    
                        <!-- Program Description -->
                        <div>
                            <x-input-label for="description" :value="__('Program Description')" />
                            <x-textarea-input id="description" type='text' name="description" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    
                        <!-- Accredited Checkbox -->
                        <div class="flex items-center gap-4">
                            <x-input-label for="accredited" :value="__('Accredited')" />
                            <input id="accredited" name="accredited" type="checkbox" value="1" class="mr-2">
                            <x-input-error class="mt-2" :messages="$errors->get('accredited')" />
                        </div>
                    
                        <!-- NQF Level (displayed if accredited is checked) -->
                        <div>
                            <x-input-label for="nqf_level" :value="__('NQF Level')" />
                            <select id="nqf_level" name="nqf_level" class="mt-1 block w-full">
                                <option value="">Select NQF Level</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('nqf_level')" />
                        </div>
                    
                        <!-- Start Date and End Date -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>
                    
                        <!-- Year and Budget -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" placeholder="2023" />
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>
                            <div>
                                <x-input-label for="budget" :value="__('Budget')" />
                                <x-text-input id="budget" name="budget" type="number" step="0.01" class="mt-1 block w-full" placeholder="10000.00" />
                                <x-input-error class="mt-2" :messages="$errors->get('budget')" />
                            </div>
                        </div>
                    
                        <!-- Status -->
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full">
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>
                    
                        <!-- Intended Beneficiaries -->
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <x-input-label for="intended_beneficiaries" :value="__('Intended Beneficiaries')" />
                                <x-text-input id="intended_beneficiaries" name="intended_beneficiaries" type="text" class="mt-1 block w-full" placeholder="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('intended_beneficiaries')" />
                            </div>
                          
                        </div>
                        <div class="form-group ">
                            <label class="text-dark">Select Provinces:</label><br>
                            @foreach($locations as $province)
                            <div class="form-check form-check-inline mt-2">
                                <input class="my-2 text-dark" type="checkbox" name="provinces_id[]" value="{{ $province->id }}" id="province_{{ $province->id }}">
                                <label class="my-2 text-dark" for="province_{{ $province->id }}">{{ $province->name }}</label><br>
                            </div>
                                @endforeach
                        </div>

                             <!-- Program Manager ID -->
                             <div>
                                <x-input-label for="program_manager_id" :value="__('Funder')" />   
                                <select id="stakeholder_id" name="stakeholder_id" class="mt-1 block w-full text-dark">
                                    @foreach ($stakeholders as $stakeholder)
                                        <option class="text-dark" value="{{ $stakeholder->id }}">{{ $stakeholder->organisation }}</option>
                                    @endforeach
                                </select>                                
                                <x-input-error class="mt-2" :messages="$errors->get('funder')" />
                            </div>
                             <div>
                                <x-input-label for="program_manager_id" :value="__('Program Manager')" />   
                                <select id="program_manager_id" name="program_manager_id" class="mt-1 block w-full text-dark">
                                    @foreach ($users as $user)
                                        <option class="text-dark" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>                                
                                <x-input-error class="mt-2" :messages="$errors->get('program_manager_id')" />
                            </div>
                           
                        <!-- Submit Button & Status Message -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            @if (session('status'))
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    {{ session('status') }}
                                </p>
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
