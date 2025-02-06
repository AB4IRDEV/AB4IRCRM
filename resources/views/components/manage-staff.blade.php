<div class="container mx-auto p-6">
    <!-- Staff Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Staff Card (Repeat for each staff) -->
        <div class="bg-white shadow-lg rounded-lg p-4 cursor-pointer hover:shadow-xl transition"
             onclick="openEditModal('John Doe', 'john@example.com', '123-456-7890', 'Developer', 'Active')">
            <h3 class="text-lg font-semibold">John Doe</h3>
            <p class="text-gray-500">Developer</p>
            <p class="text-sm text-gray-400">john@example.com</p>
            <p class="text-sm text-gray-400">123-456-7890</p>
            <span class="text-green-600 text-sm">Active</span>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4 cursor-pointer hover:shadow-xl transition"
             onclick="openEditModal('John Doe', 'john@example.com', '123-456-7890', 'Developer', 'Active')">
            <h3 class="text-lg font-semibold">John Doe</h3>
            <p class="text-gray-500">Developer</p>
            <p class="text-sm text-gray-400">john@example.com</p>
            <p class="text-sm text-gray-400">123-456-7890</p>
            <span class="text-green-600 text-sm">Active</span>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4 cursor-pointer hover:shadow-xl transition"
             onclick="openEditModal('John Doe', 'john@example.com', '123-456-7890', 'Developer', 'Active')">
            <h3 class="text-lg font-semibold">John Doe</h3>
            <p class="text-gray-500">Developer</p>
            <p class="text-sm text-gray-400">john@example.com</p>
            <p class="text-sm text-gray-400">123-456-7890</p>
            <span class="text-green-600 text-sm">Active</span>
        </div>
        <div class="bg-white shadow-lg rounded-lg p-4 cursor-pointer hover:shadow-xl transition"
             onclick="openEditModal('John Doe', 'john@example.com', '123-456-7890', 'Developer', 'Active')">
            <h3 class="text-lg font-semibold">John Doe</h3>
            <p class="text-gray-500">Developer</p>
            <p class="text-sm text-gray-400">john@example.com</p>
            <p class="text-sm text-gray-400">123-456-7890</p>
            <span class="text-green-600 text-sm">Active</span>
        </div>
    </div>

    <!-- Floating Add Button -->
    <button class="fixed bottom-6 right-6 bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-700 transition"
            onclick="openAddModal()">
        + Add Staff
    </button>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Edit Staff</h2>
            <input type="text" id="editName" class="w-full border p-2 mb-2 rounded" placeholder="Name">
            <input type="email" id="editEmail" class="w-full border p-2 mb-2 rounded" placeholder="Email">
            <input type="text" id="editPhone" class="w-full border p-2 mb-2 rounded" placeholder="Phone">
            <input type="text" id="editRole" class="w-full border p-2 mb-2 rounded" placeholder="Role">
            <select id="editStatus" class="w-full border p-2 mb-4 rounded">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <div class="flex justify-between">
                <button class="bg-gray-300 px-4 py-2 rounded" onclick="closeEditModal()">Cancel</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-semibold mb-4">Add Staff</h2>
            <input type="text" id="addName" class="w-full border p-2 mb-2 rounded" placeholder="Name">
            <input type="email" id="addEmail" class="w-full border p-2 mb-2 rounded" placeholder="Email">
            <input type="text" id="addPhone" class="w-full border p-2 mb-2 rounded" placeholder="Phone">
            <input type="text" id="addRole" class="w-full border p-2 mb-2 rounded" placeholder="Role">
            <select id="addStatus" class="w-full border p-2 mb-4 rounded">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <div class="flex justify-between">
                <button class="bg-gray-300 px-4 py-2 rounded" onclick="closeAddModal()">Cancel</button>
                <button class="bg-green-600 text-white px-4 py-2 rounded">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openEditModal(name, email, phone, role, status) {
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editPhone').value = phone;
        document.getElementById('editRole').value = role;
        document.getElementById('editStatus').value = status;
        document.getElementById('editModal').classList.remove('hidden');
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
    }
    
    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
    }
</script>
