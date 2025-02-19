<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Beneficiary Header -->
        <div class="bg-white shadow-md rounded-lg p-6 flex items-center">
            <!-- Profile Image (Placeholder for now) -->
            <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 text-lg">
                <span>IMG</span>
            </div>
            <div class="ml-6">
                <h1 class="text-2xl font-semibold text-gray-800">{{ $beneficiary->name }} {{ $beneficiary->surname }}</h1>
                <p class="text-sm text-gray-500">Beneficiary Profile</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Beneficiary Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">Beneficiary Details</h2>
                <div class="mt-4 space-y-2 text-gray-600">
                    <p><strong>ID:</strong> {{ $beneficiary->id }}</p>
                    <p><strong>Gender:</strong> {{ $beneficiary->gender }}</p>
                    <p><strong>Age:</strong> {{ $beneficiary->age }}</p>
                    <p><strong>Date of Birth:</strong> {{ $beneficiary->dob->format('Y-m-d') }}</p>
                    <p><strong>ID Number:</strong> {{ $beneficiary->id_number }}</p>
                    <p><strong>Email:</strong> {{ $beneficiary->email }}</p>
                    <p><strong>Phone:</strong> {{ $beneficiary->phone }}</p>
                    <p><strong>Province:</strong> {{ $beneficiary->location }}</p>
                    <p><strong>Qualifications:</strong> {{ $beneficiary->highest_qualification }}</p>
                    <br>
                    <p><strong>Updated by:</strong> {{ $updateuser ? $updateuser->name : 'Unknown' }}</p>
                    <p><strong>Created by:</strong> {{ $createuser ? $createuser->name : 'Unknown' }}</p>
                </div>
            </div>

            <!-- Next of Kin Details -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700">Next of Kin Details</h2>
                @if($nextOfKin)
                    <div class="mt-4 space-y-2 text-gray-600">
                        <p><strong>Name:</strong> {{ $nextOfKin->first_name }}</p>
                        <p><strong>Surname:</strong> {{ $nextOfKin->last_name }}</p>
                        <p><strong>Phone:</strong> {{ $nextOfKin->phone }}</p>
                        <p><strong>Relation:</strong> {{ $nextOfKin->email }}</p>
                        <p><strong>Relation:</strong> {{ $nextOfKin->relationship }}</p>
                    </div>
                @else
                    <p class="text-gray-500 mt-4">No next of kin information available.</p>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('beneficiaries.index') }}" 
            class=" btn btn-primary ml-1 mr-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded">
            Back to List
            </a>
            <a href="{{ route('beneficiaries.edit', $beneficiary->id) }}" 
                class=" btn btn-warning px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 text-sm">
                Edit Beneficiary
            </a>
           
            <x-confirm-delete :route="route('beneficiaries.destroy', $beneficiary->id)" message="Are you sure you want to remove this user?" />
        </div>
    </div>
</x-app-layout>
