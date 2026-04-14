<x-app-layout>
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
            Dashboard
        </h1>

        <!-- STATS -->
        <div style="display:flex; gap:20px; flex-wrap:wrap;">

            <div style="background:white; padding:20px; border-radius:10px; width:200px;">
                <h3>Total Tasks</h3>
                <h1 style="font-size:30px;">{{ $totalTasks }}</h1>
            </div>

            <div style="background:orange; padding:20px; border-radius:10px; width:200px;">
                <h3>In Progress</h3>
                <h1 style="font-size:30px;">{{ $inProgressTasks }}</h1>
            </div>

            <div style="background:green; padding:20px; border-radius:10px; width:200px;">
                <h3>Done</h3>
                <h1 style="font-size:30px;">{{ $doneTasks }}</h1>
            </div>

            <div style="background:gray; padding:20px; border-radius:10px; width:200px;">
                <h3>To Do</h3>
                <h1 style="font-size:30px;">{{ $todoTasks }}</h1>
            </div>

        </div>

        <!-- CLOCK STATUS -->
        <div style="margin-top:30px;">
            @if($isClockedIn)
                <div style="background:green; color:white; padding:15px; border-radius:8px;">
                    ✅ You are CLOCKED IN
                </div>
            @else
                <div style="background:red; color:white; padding:15px; border-radius:8px;">
                    ❌ You are NOT clocked in
                </div>
            @endif
        </div>

    </div>
</x-app-layout>