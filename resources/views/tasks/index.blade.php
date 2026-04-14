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

        <!-- TASK LIST -->
        @foreach($tasks as $task)
            <div style="background:white; padding:15px; margin-bottom:15px; border-radius:10px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">

                <!-- TITLE -->
                <h2 style="font-size:18px; font-weight:bold; color:black;">
                    {{ $task->title }}
                </h2>

                <!-- DESCRIPTION -->
                <p style="color:#444; margin-bottom:8px;">
                    {{ $task->description }}
                </p>

                <!-- BADGES -->
                <div style="margin-bottom:10px;">

                    <!-- PRIORITY -->
                    @if($task->priority == 'high')
                        <span style="background:red; color:white; padding:4px 8px; border-radius:6px;">HIGH</span>
                    @elseif($task->priority == 'medium')
                        <span style="background:orange; color:black; padding:4px 8px; border-radius:6px;">MEDIUM</span>
                    @elseif($task->priority == 'low')
                        <span style="background:green; color:white; padding:4px 8px; border-radius:6px;">LOW</span>
                    @endif

                    <!-- STATUS -->
                    <span style="margin-left:10px; color:black;">
                        {{ $task->status }}
                    </span>

                </div>

                <!-- ACTIONS -->
                <div style="display:flex; gap:10px;">

                    <!-- EDIT -->
                    <a href="/tasks/{{ $task->id }}/edit"
                       style="background:#f59e0b; color:black; padding:6px 12px; border-radius:6px; font-weight:bold;">
                        Edit
                    </a>

                    <!-- DELETE -->
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

    </div>
</x-app-layout>