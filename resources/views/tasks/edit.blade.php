<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Task</h1>

        <form method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            
            <input type="text" name="title" value="{{ $task->title }}"
                   class="border p-2 w-full mb-3 rounded">

            
            <textarea name="description"
                      class="border p-2 w-full mb-3 rounded">{{ $task->description }}</textarea>

            
            <label class="block mb-1 font-semibold">Priority:</label>
            <select name="priority" class="border p-2 w-full mb-3 rounded">
                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                <option value="urgent" {{ $task->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
            </select>

            
            <label class="block mb-1 font-semibold">Status:</label>
            <select name="status" class="border p-2 w-full mb-3 rounded">
                <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="in_review" {{ $task->status == 'in_review' ? 'selected' : '' }}>In Review</option>
                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
            </select>

            
            <label class="block mb-1 font-semibold">Due Date:</label>
            <input type="date" name="due_date"
                   value="{{ $task->due_date }}"
                   class="border p-2 w-full mb-3 rounded">

            
            <label class="block mb-1 font-semibold">Estimated Hours:</label>
            <input type="number" step="0.1" name="estimated_hours"
                   value="{{ $task->estimated_hours }}"
                   class="border p-2 w-full mb-3 rounded">

            
            <label class="block mb-1 font-semibold">Assign User:</label>
            <select name="user_id" class="border p-2 w-full mb-4 rounded">
                <option value="">-- Select User --</option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}"
                        {{ $task->users->contains($user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            
            <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded font-bold">
                Update Task
            </button>

        </form>
    </div>
</x-app-layout>