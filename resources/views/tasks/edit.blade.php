<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl mb-4">Edit Task</h1>

        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            <!-- TITLE -->
            <input type="text" name="title" value="{{ $task->title }}" class="border p-2 w-full mb-3">

            <!-- DESCRIPTION -->
            <textarea name="description" class="border p-2 w-full mb-3">{{ $task->description }}</textarea>

            <!-- PRIORITY -->
            <label class="block mb-1">Priority:</label>
            <select name="priority" class="border p-2 w-full mb-3">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>

            <!-- STATUS -->
            <label class="block mb-1">Status:</label>
            <select name="status" class="border p-2 w-full mb-3">
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>

            <!-- DUE DATE -->
            <label class="block mb-1">Due Date:</label>
            <input type="date" name="due_date" value="{{ $task->due_date }}" class="border p-2 w-full mb-3">

            <!-- HOURS -->
            <label class="block mb-1">Estimated Hours:</label>
            <input type="number" step="0.1" name="estimated_hours" value="{{ $task->estimated_hours }}" class="border p-2 w-full mb-3">

            <!-- ASSIGN USER -->
            <label class="block mb-1">Assign User:</label>
            <select name="user_id" class="border p-2 w-full mb-4">
                <option value="">-- Select User --</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}"
                        {{ $task->users->contains($user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>