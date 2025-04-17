<x-app-layout>


    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ __('messages.create_thesis_task') }}</h2>
            <x-language-switcher />
        </div>


        <form method="POST" action="{{ route('thesis-tasks.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-bold mb-2">{{ __('messages.title_en') }}</label>
                <input name="title_en" class="w-full p-2 border rounded" value="{{ old('title_en') }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">{{ __('messages.title_hr') }}</label>
                <input name="title_hr" class="w-full p-2 border rounded" value="{{ old('title_hr') }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">{{ __('messages.task') }}</label>
                <textarea name="task" class="w-full p-2 border rounded" rows="4" value="{{ old('task') }}" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2">{{ __('messages.study_type') }}</label>
                <select name="study_type" class="w-full p-2 border rounded">
                    <option value="professional">{{ __('messages.professional') }}</option>
                    <option value="undergraduate">{{ __('messages.undergraduate') }}</option>
                    <option value="graduate">{{ __('messages.graduate') }}</option>
                </select>
                @error('study_type')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500  px-4 py-2 rounded">
                {{ __('messages.submit') }}
            </button>

            <a href="{{route('thesis-tasks.index')}}" class="bg-blue-500">Cancel</a>
        </form>



</x-app-layout>