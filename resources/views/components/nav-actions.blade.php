<div class="lang-switcher">
    @php
        $currentLocale = LaravelLocalization::getCurrentLocale();
        $supportedLocales = LaravelLocalization::getSupportedLocales();
        $flagMap = [
            'id' => 'https://flagcdn.com/w20/id.png',
            'en' => 'https://flagcdn.com/w20/us.png'
        ];
    @endphp
    <button class="lang-btn" id="lang-btn">
        <img alt="{{ $currentLocale }}" class="flag-icon" src="{{ $flagMap[$currentLocale] ?? $flagMap['en'] }}"/>
        <span>{{ strtoupper($currentLocale) }}</span>
        <span class="material-icons text-sm">expand_more</span>
    </button>
    <div class="lang-dropdown">
        @foreach($supportedLocales as $localeCode => $properties)
            <a class="lang-option {{ $currentLocale == $localeCode ? 'active' : '' }}"
               rel="alternate" hreflang="{{ $localeCode }}"
               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                <img alt="{{ $properties['name'] }}" class="flag-icon" src="{{ $flagMap[$localeCode] ?? $flagMap['en'] }}"/>
                <span>{{ $properties['native'] }}</span>
            </a>
        @endforeach
    </div>
</div>

<button aria-label="Toggle dark mode" class="theme-toggle theme-toggle-btn" title="Toggle Theme">
    <span class="material-icons theme-icon">dark_mode</span>
</button>

<a class="nav-cta" href="{{ route('contact') }}">
    <span class="lang-id">Diskusikan Proyek Anda</span>
    <span class="lang-en">Let's Discuss Your Project</span>
</a>
