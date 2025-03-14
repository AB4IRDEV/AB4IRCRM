<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Add Subcategory to Program</h1>

        <!-- Form to Add a New Subcategory (Project Template) -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <form method="POST" action="{{ route('programs_templates.save') }}">
                @csrf

                <!-- Program (Category) Selection -->
                <div class="mb-4">
                    <label for="program_id" class="block text-sm font-medium text-gray-700">Select Program</label>
                    <select id="program_id" name="program_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Select Program --</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                        @endforeach
                    </select>
                    @error('program_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subcategory Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Subcategory Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter subcategory title" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subcategory Description (Optional) -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                    <textarea id="description" name="description" rows="3" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter description">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Add Subcategory
                    </button>
                </div>
            </form>
        </div>

        <!-- List Existing Subcategories -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Existing Subcategories</h2>
            @if($projectTemplates->isNotEmpty())
                <div class="space-y-4">
                    @foreach($projectTemplates as $template)
                        <div class="p-4 border rounded-lg">
                            <p><strong>Program:</strong> {{ $template->program->name }}</p>
                            <p><strong>Title:</strong> {{ $template->title }}</p>
                            @if($template->description)
                                <p><strong>Description:</strong> {{ $template->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No subcategories added yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
