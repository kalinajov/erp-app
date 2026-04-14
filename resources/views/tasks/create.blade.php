<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl mb-4">Create Task</h1>

        <form method="POST" action="/tasks">
            @csrf

            <input type="text" name="title" placeholder="Title" class="border p-2 w-full mb-3">

            <textarea name="description" placeholder="Description" class="border p-2 w-full mb-3"></textarea>

            
            <label class="block mb-1">Priority:</label>
            <select name="priority" class="border p-2 w-full mb-3">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
            </select>

            
            <label class="block mb-1">Due Date:</label>
            <input type="date" name="due_date" class="border p-2 w-full mb-3">

            
            <label class="block mb-1">Estimated Hours:</label>
            <input type="number" name="estimated_hours" class="border p-2 w-full mb-3">

            
            <label class="block mb-1">Assign User:</label>
            <select name="user_id" class="border p-2 w-full mb-4">
                <option value="">-- Select User --</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Create 
            </button>
        </form>
    </div>
</x-app-layout>