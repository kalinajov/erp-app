<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900">

                    <p class="mb-4 text-lg font-semibold">
                        You're logged in!
                    </p>

                    <!-- CLOCK IN -->
                    <form method="POST" action="/clock-in" class="mb-3">
                        @csrf
                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Clock In
                        </button>
                    </form>

                    <!-- CLOCK OUT -->
                    <form method="POST" action="/clock-out">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Clock Out
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>