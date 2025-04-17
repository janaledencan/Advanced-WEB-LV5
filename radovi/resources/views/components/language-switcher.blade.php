    <div class="language-switcher flex space-x-2">
        <a href="{{ route('language.switch', 'en') }}" class="px-2 py-1 rounded {{ app()->getLocale() == 'en' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            English
        </a>
        <a href="{{ route('language.switch', 'hr') }}" class="px-2 py-1 rounded {{ app()->getLocale() == 'hr' ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
            Hrvatski
        </a>
    </div>