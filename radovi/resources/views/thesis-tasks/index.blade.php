<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ __('messages.my_thesis_tasks') }}</h2>
            <div class="flex space-x-4">
                <x-language-switcher />
                <a href="{{ route('thesis-tasks.create') }}" class="bg-blue-500 px-4 py-2 rounded">
                    {{ __('messages.add_new') }}
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if(($thesisTasks ?? collect())->count() > 0)
        <div class="bg-white rounded shadow-md overflow-hidden">
            <table class="w-full text-center">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">{{ __('messages.thesis_title') }} (EN)</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.thesis_title') }} (HR)</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.study_type') }}</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.applicants') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($thesisTasks as $task)
                    <tr class="border-t">
                        <td class="px-4 py-3 text-center align-middle">
                            {{ $task->title_en ?? ($task->title['en'] ?? '') }}
                        </td>
                        <td class="px-4 py-3 text-center align-middle">
                            {{ $task->title_hr ?? ($task->title['hr'] ?? '') }}
                        </td>
                        <td class="px-4 py-3 text-center align-middle">
                            {{ __('messages.' . $task->study_type) }}
                        </td>
                        <td class="px-4 py-3 text-center align-middle">
                            {{ method_exists($task, 'applications') && $task->applications ? $task->applications->count() : 0 }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="bg-white p-6 rounded shadow-md text-center">
            <p>{{ __('messages.no_thesis_tasks') }}</p>
            <a href="{{ route('thesis-tasks.create') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                {{ __('messages.add_new') }}
            </a>
        </div>
        @endif
    </div>
</x-app-layout>