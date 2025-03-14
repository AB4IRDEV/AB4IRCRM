<x-app-layout>
    <div class=" mx-auto px-4 py-3">
        <div class=" container flex flex-wrap">
            <div class="w-full md:w-full translate-x-10 bg-white">
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
           </div>  
        </div>
        <div class="flex flex-wrap">
            <div class="w-full md:w-full translate-x-10 bg-white">
                <x-card-table title="Project Beneficiaries" buttonText="Add Beneficiary" :buttonLink="route('beneficiaries.create')">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Surname</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Gender</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID Number</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Email</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Phone</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Enrolled Date</th>
                        <th class="px-4 py-2 text-center text-gray-600 dark:text-gray-200">Action</th>
                    </x-slot>
                
                    @foreach($project->beneficiaries as $beneficiary)
                    <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                        <td class="px-4 py-2">{{ $beneficiary->id }}</td>
                        <td class="px-4 py-2"><a class="text-decoration-none" href="{{ route('beneficiaries.show', $beneficiary->id) }}">{{ $beneficiary->name }}</a></td>
                        <td class="px-4 py-2">{{ $beneficiary->surname }}</td>
                        <td class="px-4 py-2">{{ $beneficiary->gender }}</td>
                        <td class="px-4 py-2">{{ $beneficiary->id_number }}</td>
                        <td class="px-4 py-2">{{ $beneficiary->email }}</td>
                        <td class="px-4 py-2">{{ $beneficiary->phone }}</td>
                        <td class="px-4 py-2">{{ $beneficiary->pivot->enrolment_date }}</td>
                        <td class="pr-4 py-2 flex float-end">
                            <a href="{{ route('beneficiaries.show', $beneficiary->id) }}" 
                                class="inline-block btn btn-warning px-3 py-2 mr-2 text-xs font-medium text-white bg-yellow-600 rounded hover:bg-gray-700">
                                 View
                             </a>
                             
                            <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" 
                                class="inline-block btn btn-dark px-3 py-2 mx-4 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                                 Edit
                             </a>
                            
                            <x-confirm-delete :route="route('beneficiaries.destroy', $beneficiary->id)" message="Are you sure you want to remove this beneficiary?" />
                        </td>
                    </tr>
                    @endforeach
                </x-card-table>
                
           </div>  
        </div>
    </div>
</x-app-layout>