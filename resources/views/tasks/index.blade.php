<x-app-layout>
    <div class="p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tasks</h1>

            <!-- 🔴 STRONG BUTTON -->
            <a href="/tasks/create"
               class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg shadow-lg font-bold">
                + New Task
            </a>
        </div>

        <!-- TASK LIST -->
        @foreach($tasks as $task)
            <div class="bg-white shadow-md rounded p-4 mb-4">

                <!-- TITLE -->
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $task->title }}
                </h2>

                <!-- DESCRIPTION -->
                <p class="text-gray-600 mb-2">
                    {{ $task->description }}
                </p>

                <!-- EXTRA INFO -->
                <div class="text-sm text-gray-500 mb-3">
                    Priority: <span class="font-semibold">{{ $task->priority }}</span> |
                    Status: <span class="font-semibold">{{ $task->status }}</span>
                </div>

                <!-- ACTIONS -->
                <div class="flex gap-3">

                    <a href="/tasks/{{ $task->id }}/edit"
                       class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                        Edit
                    </a>

                    <form method="POST" action="/tasks/{{ $task->id }}">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @endforeach

    </div>
</x-app-layout>