<x-app-layout>

    <div class="container">
        <h2>{{ __('messages.edit_thesis_task') }}</h2>

        <form method="POST" action="{{ route('thesis-tasks.update', $thesisTask) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>{{ __('messages.thesis_title') }}</label>
                <input name="title[{{ app()->getLocale() }}]" class="form-control" value="{{ $thesisTask->getTranslation('title', app()->getLocale(), '') }}">
            </div>

            <div class="form-group">
                <label>{{ __('messages.thesis_task') }}</label>
                <textarea name="task[{{ app()->getLocale() }}]" class="form-control">{{ $thesisTask->getTranslation('task', app()->getLocale(), '') }}</textarea>
            </div>

            <div class="form-group">
                <label>{{ __('messages.study_type') }}</label>
                <select name="study_type" class="form-control">
                    <option value="professional" {{ $thesisTask->study_type == 'professional' ? 'selected' : '' }}>{{ __('messages.professional') }}</option>
                    <option value="undergraduate" {{ $thesisTask->study_type == 'undergraduate' ? 'selected' : '' }}>{{ __('messages.undergraduate') }}</option>
                    <option value="graduate" {{ $thesisTask->study_type == 'graduate' ? 'selected' : '' }}>{{ __('messages.graduate') }}</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
        </form>
    </div>

</x-app-layout>