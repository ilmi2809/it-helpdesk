<div class="w-full lg:w-1/4 bg-white p-6 rounded shadow self-start">
    <h2 class="text-lg font-bold mb-4">Create Category</h2>

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">New Category</label>
            <input type="text" name="name" placeholder="Type Category" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Description</label>
            <textarea name="description" placeholder="Type Description" class="w-full border px-4 py-2 rounded" required></textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded">
                Submit
            </button>
        </div>
    </form>
</div>
