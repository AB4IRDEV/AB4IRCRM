<x-app-layout>
    <div class="container mx-auto px-4">



        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full">
                @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="mt-6 translate-x-2">
                    <!-- project Details --> 
                    
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-700"></h2>
                        
                        <h1 class="text-center text-2xl font-bold text-gray-800">{{ $project->title }}</h1>
                        <hr class="my-4">
                    
                        <div class="grid grid-cols-2 gap-4 text-gray-600">
                            <!-- Left Side -->
                            <div class="space-y-2">
                                <p><strong>Program:</strong> {{ $project->programs->pluck('name')->implode(', ') }}</p>
                                <p><strong>Description:</strong> {{ $project->description }}</p>
                                <p><strong>Funder:</strong> {{ $project->stakeholders->pluck('organisation')->implode(', ') }}</p>
                                <p><strong>Year:</strong> {{ $project->year }}</p>
                                <p><strong>Accredited:</strong> 
                                    @if ($project->accredited)
                                        Yes
                                    @else
                                        <span class="text-red-500 font-semibold">Project is not accredited</span>
                                    @endif
                                </p>
                                
                                <p><strong>NQF Level:</strong> 
                                    @if ($project->nqf_level)
                                        {{ $project->nqf_level }}
                                    @else
                                        <span class="text-red-500 font-semibold">Not NQF Aligned</span>
                                    @endif
                                </p>
                                
                                <p><strong>Budget:</strong> {{ $project->budget}}</p>
                                <p><strong>Status:</strong> 
                                    <span class="px-2 py-1 text-xs font-semibold text-white rounded 
                                        @if ($project->status == 'active') bg-green-500
                                        @elseif ($project->status == 'pending') bg-yellow-500
                                        @elseif ($project->status == 'completed') bg-blue-500
                                        @elseif ($project->status == 'cancelled') bg-red-500
                                        @else bg-gray-500
                                        @endif">
                                        {{ $project->status }}
                                    </span>
                                </p>
                                <br>
                                <p><strong>Project Manager :</strong> {{ $managers ? $managers->name : 'Unknown' }}</p>

                            </div>
                    
                            <!-- Right Side -->
                            <div class="space-y-2 text-right">
                                <p><strong>Start date:</strong> {{ $project->start_date }}</p>
                                <p><strong>End date:</strong> {{ $project->end_date }}</p>
                                <p><strong>intendet Beneficiaries:</strong> {{ $project->intended_beneficiaries }}</p>
                                <p><strong>Locations:</strong></p>
                                <ul>
                                    @foreach ($project->provinces as $province)
                                        <li>{{ $province->name }}</li>
                                    @endforeach
                                </ul>
                                
                            </div>
                        </div>
                    
                        <br>
                    
                        <div class="flex justify-between text-gray-600 mt-4">
                            <p><strong>Updated by:</strong> {{ $updateuser ? $updateuser->name : 'Unknown' }}</p>
                            <p><strong>Created by:</strong> {{ $createuser ? $createuser->name : 'Unknown' }}</p>
                        </div>
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

             
        
            </div>
        </div>

        <div class="flex flex-wrap">
            <div class="w-full md:w-full">

                 <x-card title=" Edit project" buttonText="" buttonLink="">
                    <form method="POST" action="{{ route('projects.update',$project->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <div>
                                <x-input-label for="program_id" :value="__('Program')" />   
                                <select id="program_id" name="program_id" class="mt-1 block w-full text-dark">
                                    @foreach ($programs as $program)
                                        <option class="text-dark" value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>                                
                                <x-input-error class="mt-2" :messages="$errors->get('program_id')" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="Project Template" :value="__('Project Template')" />   
                            <select id="project_template_id" name="project_template_id" class="mt-1 block w-full text-dark">
                                @foreach ($projectTemplates as $programtemp)
                                    <option class="text-dark" value="{{ $programtemp->id }}">{{ $programtemp->title }}</option>
                                @endforeach
                            </select>                                
                            <x-input-error class="mt-2" :messages="$errors->get('project_template_id')" />
                        </div>
                        
                        <!-- Program Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" 
                                            value="{{ old('title', $project->title ?? '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                    
                        <!-- Program Description -->
                        <div>
                            <x-input-label for="description" :value="__('Project Description')" />
                            <x-textarea-input id="description" type='text' name="description" class="mt-1 block w-full" required 
                            value="{{ old('description', $project->description ?? '') }}" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    
                        <!-- Accredited Checkbox -->
                        <div class="flex items-center gap-4">
                            <x-input-label for="accredited" :value="__('Accredited')" />
                            <input id="accredited" name="accredited" type="checkbox" value="1"
                            {{ old('accredited', $project->accredited ?? false) ? 'checked' : '' }} class="mr-2">
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
                                <x-text-input 
                                    id="start_date" 
                                    name="start_date" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('start_date', $project->start_date ?? '') }}" 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>
                            
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input 
                                    id="end_date" 
                                    name="end_date" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('end_date', $project->end_date ?? '') }}" 
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>
                        
                    
                        <!-- Year and Budget -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="year" :value="__('Year')" />
                                <x-text-input 
                                    id="year" 
                                    name="year" 
                                    type="number" class="mt-1 block w-full" 
                                    placeholder="2023"
                                     value="{{ old('year', $project->year ?? '') }}" 
                                    />
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>
                            <div>
                                <x-input-label for="budget" :value="__('Budget')" />
                                <x-text-input 
                                    id="budget" 
                                    name="budget" 
                                    type="number" step="0.01" 
                                    class="mt-1 block w-full" 
                                    placeholder="10000.00" 
                                    value="{{ old('budget', $project->budget ?? '') }}"/>
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
                                <x-text-input 
                                    id="intended_beneficiaries" 
                                    name="intended_beneficiaries" 
                                    type="text" class="mt-1 block w-full" 
                                    placeholder="0" 
                                    value="{{ old('intended_beneficiaries', $project->intended_beneficiaries ?? '') }}"/>
                                <x-input-error class="mt-2" :messages="$errors->get('intended_beneficiaries')" />
                            </div>
                          
                        </div>
                        <div class="form-group ">
                            <label class="text-dark">Select Provinces:</label><br>
                            @foreach($locations as $province)
                            <div class="form-check form-check-inline mt-2">
                                <input class="my-2 text-dark" type="checkbox" name="location_id[]" value="{{ $province->id }}" 
                                    id="province_{{ $province->id }}" 
                                    {{ in_array($province->id, old('location_id', $project->provinces->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                <label class="my-2 text-dark" for="province_{{ $province->id }}">{{ $province->name }}</label><br>
                            </div>
                            @endforeach
                        </div>

                             
                        <div>
                            <x-input-label for="program_manager_id" :value="__('Stakeholder')" />   
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
                                        <option class="text-dark" value="{{ $user->id }}" 
                                            {{ old('program_manager_id', $project->program_manager_id ?? '') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
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

<script>
    $(document).ready(function () {
        $('#program_id').on('change', function () {
            var programId = $(this).val();
            $('#projectTemp').html('<option value="">Loading...</option>');

            if (programId) {
                $.ajax({
                    url: "{{ route('getProjectTemplates') }}",
                    type: "GET",
                    data: { program_id: programId },
                    success: function (response) {
                        $('#projectTemp').html('<option value="">Select a Project Template</option>');
                        $.each(response, function (key, template) {
                            $('#projectTemp').append('<option value="' + template.id + '">' + template.title + '</option>');
                        });
                    }
                });
            } else {
                $('#projectTemp').html('<option value="">Select a Project Template</option>');
            }
        });
    });
</script>

  
</x-app-layout>
