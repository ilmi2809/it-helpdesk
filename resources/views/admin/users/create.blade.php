<div class="w-full lg:w-1/3 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">Create User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" placeholder="Masukkan Nama"
                   class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-100 focus:border-red-400"
                   required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">User Email</label>
            <input type="email" name="email" placeholder="Masukkan Email"
                   class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-100 focus:border-red-400"
                   required>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" placeholder="Masukkan Password"
                   class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-100 focus:border-red-400"
                   required>
        </div>

        {{-- Role --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role-select"
                    class="mt-1 w-full border border-gray-300 px-4 py-2 rounded-md focus:ring focus:ring-red-100 focus:border-red-400"
                    required>
                <option disabled selected>Pilih Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="it_support">Technician</option>
                <option value="helpdesk_agent">Helpdesk Agent</option>
            </select>
        </div>

        {{-- Category: Tampil jika role = it_support --}}
        <div id="category-select-wrapper" class="hidden">
        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
        <div class="space-y-2 max-h-48 overflow-auto border border-gray-300 rounded-md p-3">
            @foreach($categories as $category)
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        name="categories[]" 
                        value="{{ $category->id }}" 
                        id="category-{{ $category->id }}"
                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                    >
                    <label for="category-{{ $category->id }}" class="ml-2 block text-gray-700 text-sm">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>
        <p class="text-xs text-gray-500 mt-1">* Khusus untuk Technician / IT Support, pilih kategori yang bisa ditangani.</p>
    </div>


        {{-- Submit --}}
        <div class="pt-4 text-right">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-md shadow">
                Submit
            </button>
        </div>
    </form>
</div>

{{-- Script untuk toggle category --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role-select');
        const categoryWrapper = document.getElementById('category-select-wrapper');

        const toggleCategory = () => {
            const role = roleSelect.value;
            if (role === 'it_support') {
                categoryWrapper.classList.remove('hidden');
            } else {
                categoryWrapper.classList.add('hidden');
            }
        };

        roleSelect.addEventListener('change', toggleCategory);
        toggleCategory(); // run saat page load
    });
</script>
