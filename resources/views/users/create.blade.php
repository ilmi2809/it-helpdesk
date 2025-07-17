<div class="w-full lg:w-1/4 bg-white p-6 rounded shadow self-start">
    <h2 class="text-lg font-bold mb-4">Create User</h2>
    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name" placeholder="Masukan Nama" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">User Email</label>
            <input type="email" name="email" placeholder="Type Email" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" placeholder="Type Password" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Role</label>
            <select name="role" class="w-full border px-4 py-2 rounded" required>
                <option disabled selected>Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="it_support">IT Support</option>
                <option value="helpdesk_agent">Helpdesk Agent</option>
            </select>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded">
                Submit
            </button>
        </div>
    </form>
</div>
