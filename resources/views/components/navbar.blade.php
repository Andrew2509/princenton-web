<style>
    html.lang-id .lang-en { display: none !important; }
    html.lang-en .lang-id { display: none !important; }
    html:not(.lang-id):not(.lang-en) .lang-en { display: none !important; }
</style>
<nav class="nav-bar">
    <div class="nav-inner">
        <div class="nav-logo-container">
            <div class="nav-logo" @if(!empty($site_settings['favicon_url'])) style="background:none; width:auto; height:auto;" @endif>
                @if(!empty($site_settings['favicon_url']))
                    <img src="{{ $site_settings['favicon_url'] }}" alt="Logo" class="w-15 h-15 object-contain"/>
                @else
                    <span class="font-bold text-xl">{{ \App\Models\SiteSetting::t('site_logo_text') ?? 'AP' }}</span>
                @endif
            </div>
            <a href="{{ route('home') }}" class="nav-brand">{{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}</a>
        </div>
        <div class="nav-links">
            <a class="nav-link" href="{{ route('home') }}">
                <span class="lang-id">Beranda</span>
                <span class="lang-en">Home</span>
            </a>
            <a class="nav-link" href="{{ route('projects') }}">
                <span class="lang-id">Proyek</span>
                <span class="lang-en">Work</span>
            </a>
            <a class="nav-link" href="{{ route('process') }}">
                <span class="lang-id">Proses</span>
                <span class="lang-en">Process</span>
            </a>
            <a class="nav-link" href="{{ route('about') }}">
                <span class="lang-id">Tentang</span>
                <span class="lang-en">About</span>
            </a>
            <div class="hidden md:flex items-center gap-6">
                <div class="lang-switcher">
                    @php
                        $currentLocale = LaravelLocalization::getCurrentLocale();
                        $supportedLocales = LaravelLocalization::getSupportedLocales();
                        $currentLocaleData = $supportedLocales[$currentLocale];
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

                <button aria-label="Toggle dark mode" class="theme-toggle" id="theme-toggle" title="Toggle Theme">
                    <span class="material-icons" id="theme-icon">dark_mode</span>
                </button>
                <a class="nav-cta" href="{{ route('contact') }}">
                    <span class="lang-id">Diskusikan Proyek Anda</span>
                    <span class="lang-en">Let's Discuss Your Project</span>
                </a>
            </div>
        </div>
        <button class="md:hidden text-primary dark:text-white">
            <span class="material-icons">menu</span>
        </button>
    </div>
</nav>
