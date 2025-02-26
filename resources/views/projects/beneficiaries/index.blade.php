<x-app-layout>
    <div class=" mx-auto px-4">
        
        <div class="flex flex-wrap">
            <div class="w-full md:w-full translate-x-10">
                <x-card-table title="All Beneficiaries" buttonText="Add Beneficiary" buttonLink="beneficiaries/create">
                    <x-slot name="headers">
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Surname</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Gender</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">ID Number</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">email</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">phone</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Program</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-200">Province</th>
                        <th class="px-4 py-2 text-center text-gray-600 dark:text-gray-200">Action</th>
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
            @foreach($beneficiaries as $beneficiary)
            <tr class="border-b border-gray-200 dark:border-gray-700 text-black">
                <td class="px-4 py-2">{{ $beneficiary->id }}</td>
                <td class="px-4 py-2"><a class="text-decoration-none" href="{{ url('beneficiaries/'.$beneficiary->id) }}">{{ $beneficiary->name }}</a></td>
                <td class="px-4 py-2">{{ $beneficiary->surname }}</td>
                <td class="px-4 py-2">{{ $beneficiary->gender }}</td>
                <td class="px-4 py-2">{{ $beneficiary->id_number }}</td>
                <td class="px-4 py-2">{{ $beneficiary->email }}</td>
                <td class="px-4 py-2">{{ $beneficiary->phone }}</td> 
                <td class="px-4 py-2">
                @foreach ($beneficiary->program as $program)
                <span>{{ $program->title }}</span>
                @endforeach
                </td>
                <td class="px-4 py-2">
                @foreach ($beneficiary->province as $province)
                <span>{{ $province->name }}</span>
                @endforeach
                </td>
                <td class="pr-4 py-2 flex float-end">
                    <a href="{{ url('beneficiaries/'.$beneficiary->id) }}" 
                        class="inline-block btn btn-warning px-3 py-2 mr-2 text-xs font-medium text-white bg-yellow-600 rounded hover:bg-gray-700">
                         View Beneficiary
                     </a>
                     
                    <a href="{{ url('beneficiaries/'.$beneficiary->id.'/edit') }}" 
                        class="inline-block btn btn-dark px-3 py-2 mx-4 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                         Edit Beneficiary
                     </a>
                    
                    <x-confirm-delete :route="route('beneficiaries.destroy', $beneficiary->id)" message="Are you sure you want to remove this user?" />
                </td>
            </tr>
        @endforeach
            
                </x-card-table>
            </div>
        </div>

        
</x-app-layout>
