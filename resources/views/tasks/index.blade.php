<x-app-layout>
    <div class="p-6 bg-gray-100 min-h-screen">

        <!-- HEADER -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h1 style="font-size:22px; font-weight:bold; color:black;">Tasks</h1>

            <a href="/tasks/create"
               style="background:#2563eb; color:white; padding:10px 16px; border-radius:8px; font-weight:bold;">
                + New Task
            </a>
        </div>

        <!-- SEARCH + FILTER -->
        <form method="GET" action="/tasks"
              style="margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap;">

            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search tasks..."
                   style="padding:8px; border-radius:6px; border:1px solid #ccc;">

            <select name="status" style="padding:8px; border-radius:6px;">
                <option value="">All Status</option>
                <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
            </select>

            <select name="priority" style="padding:8px; border-radius:6px;">
                <option value="">All Priority</option>
                <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>

            <button style="background:black; color:white; padding:8px 12px; border-radius:6px;">
                Search / Filter
            </button>

        </form>

        <!-- EMPTY STATE -->
        @if($tasks->isEmpty())
            <div style="background:white; padding:20px; border-radius:10px;">
                No tasks found.
            </div>
        @endif

        <!-- TASK LIST -->
        @foreach($tasks as $task)
            <div style="background:white; padding:15px; margin-bottom:15px; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">

                <h2 style="font-size:18px; font-weight:bold; color:black;">
                    {{ $task->title }}
                </h2>

                <p style="color:#444; margin-bottom:8px;">
                    {{ $task->description }}
                </p>

                <div style="margin-bottom:10px;">

                    <!-- PRIORITY -->
                    @if($task->priority->value == 'high')
                        <span style="background:red; color:white; padding:4px 8px; border-radius:6px;">HIGH</span>
                    @elseif($task->priority->value == 'medium')
                        <span style="background:orange; color:black; padding:4px 8px; border-radius:6px;">MEDIUM</span>
                    @elseif($task->priority->value == 'low')
                        <span style="background:green; color:white; padding:4px 8px; border-radius:6px;">LOW</span>
                    @endif

                    <!-- STATUS -->
                    @if($task->status->value == 'todo')
                        <span style="background:gray; color:white; padding:4px 8px; border-radius:6px; margin-left:10px;">TODO</span>
                    @elseif($task->status->value == 'in_progress')
                        <span style="background:blue; color:white; padding:4px 8px; border-radius:6px; margin-left:10px;">IN PROGRESS</span>
                    @elseif($task->status->value == 'done')
                        <span style="background:green; color:white; padding:4px 8px; border-radius:6px; margin-left:10px;">DONE</span>
                    @endif

                </div>

                <div style="display:flex; gap:10px;">

                    <a href="/tasks/{{ $task->id }}/edit"
                       style="background:#f59e0b; color:white; padding:6px 12px; border-radius:6px; font-weight:bold;">
                        Edit
                    </a>

                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')

                        <button style="background:#ef4444; color:white; padding:6px 12px; border-radius:6px; font-weight:bold;">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @endforeach

        <!-- PAGINATION -->
        <div style="margin-top:20px;">
            {{ $tasks->links() }}
        </div>

    </div>
</x-app-layout>