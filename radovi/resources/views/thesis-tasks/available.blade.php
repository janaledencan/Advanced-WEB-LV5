<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ __('messages.available_thesis_tasks') }}</h2>
            <x-language-switcher />
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        @if(($thesisTasks ?? collect())->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($thesisTasks as $task)
            <div class="bg-white p-6 rounded shadow-md">
                <h3 class="text-xl font-bold mb-2">
                    {{ $task->title['en'] ?? '' }}<br>
                    <span class="text-gray-500">{{ $task->title['hr'] ?? '' }}</span>
                </h3>
                <p class="text-gray-600 mb-4">
                    {{ __('messages.by') }}: {{ $task->teacher->name }}
                </p>

                <div class="mb-4">
                    <p class="text-gray-700">
                        {{ \Illuminate\Support\Str::limit($task->task, 150) }}
                    </p>
                </div>

                <div class="flex justify-between items-center">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                        {{ __('messages.' . $task->study_type) }}
                    </span>

                    @php
                    $applied = $task->applicants->contains(auth()->id());
                    $application = $task->applicants->where('id', auth()->id())->first();
                    @endphp

                    @if($applied)
                    @if($application && $application->pivot->approved)
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded">
                        {{ __('messages.approved') }}
                    </span>
                    @else
                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded">
                        {{ __('messages.pending_approval') }}
                    </span>
                    @endif
                    @else
                    <form method="POST" action="{{ route('thesis-tasks.apply', $task) }}">
                        @csrf
                        <button type="submit" class="bg-blue-500  px-3 py-1 rounded">
                            {{ __('messages.apply') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white p-6 rounded shadow-md text-center">
            <p>{{ __('messages.no_available_thesis_tasks') }}</p>
        </div>
        @endif
    </div>
</x-app-layout>