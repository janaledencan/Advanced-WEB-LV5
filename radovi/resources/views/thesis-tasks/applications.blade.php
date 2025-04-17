<x-app-layout>

    @foreach($myThesisTasks as $task)
    <div class="bg-white p-6 rounded shadow-md mb-6">
        <h3 class="text-xl font-bold mb-4">{{ $task->getTranslation('title', app()->getLocale()) }}</h3>
        @php
        $hasApproved = $task->applicants->contains(function ($applicant) {
        return $applicant->pivot->approved;
        });
        @endphp

        @if($task->applicants->count() > 0)
        <h4 class="font-semibold text-lg mb-2">{{ __('messages.applicants') }}:</h4>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">{{ __('messages.name') }}</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.email') }}</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.status') }}</th>
                        <th class="px-4 py-2 text-left">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($task->applicants as $applicant)
                    <tr class="border-t">
                        <td class="px-4 py-3 ">{{ $applicant->name }}</td>
                        <td class="px-4 py-3 ">{{ $applicant->email }}</td>
                        <td class="px-4 py-3 ">
                            @if($applicant->pivot->approved)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded">
                                {{ __('messages.approved') }}
                            </span>
                            @else
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">
                                {{ __('messages.pending') }}
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if(!$applicant->pivot->approved && !$hasApproved)
                            <form method="POST" action="{{ route('thesis-tasks.approve', [$task, $applicant]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="bg-green-500 px-3 py-1 rounded">
                                    {{ __('messages.approve') }}
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>{{ __('messages.no_applicants') }}</p>
        @endif
    </div>
    @endforeach
</x-app-layout>