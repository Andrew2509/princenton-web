<style>
    html.lang-id .lang-en { display: none !important; }
    html.lang-en .lang-id { display: none !important; }
    html:not(.lang-id):not(.lang-en) .lang-en { display: none !important; }

    /* Mobile Menu Styles */
    .mobile-menu-overlay {
        position: fixed;
        inset: 0;
        background: rgba(41, 55, 84, 0.95);
        backdrop-filter: blur(10px);
        z-index: 100;
        display: flex;
        flex-direction: column;
        padding: 2rem;
        transform: translateY(-100%);
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dark .mobile-menu-overlay {
        background: rgba(15, 17, 21, 0.98);
    }
    .mobile-menu-overlay.active {
        transform: translateY(0);
    }
    .mobile-menu-close {
        align-self: flex-end;
        color: white;
        margin-bottom: 2rem;
    }
    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    .mobile-nav-link {
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        text-decoration: none;
        opacity: 0.8;
        transition: opacity 0.2s;
    }
    .mobile-nav-link:hover {
        opacity: 1;
    }
</style>

<nav class="nav-bar">
    <div class="nav-inner">
        <div class="nav-logo-container">
            <div class="nav-logo" @if(!empty($site_settings['favicon_url'])) style="background:none; width:auto; height:auto;" @endif>
                @if(!empty($site_settings['favicon_url']))
                    <img src="{{ $site_settings['favicon_url'] }}" alt="Logo" class="w-10 h-10 object-contain"/>
                @else
                    <span class="font-bold text-xl">{{ \App\Models\SiteSetting::t('site_logo_text') ?? 'AP' }}</span>
                @endif
            </div>
            <a href="{{ route('home') }}" class="nav-brand">{{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}</a>
        </div>

        {{-- Desktop Links --}}
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
                @include('components.nav-actions')
            </div>
        </div>

        {{-- Mobile Hamburger --}}
        <div class="md:hidden flex items-center gap-4">
            <button aria-label="Toggle dark mode" class="theme-toggle" id="theme-toggle-mobile" title="Toggle Theme">
                <span class="material-icons">dark_mode</span>
            </button>
            <button class="text-primary dark:text-white" id="mobile-menu-open">
                <span class="material-icons text-3xl">menu</span>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu Overlay --}}
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <button class="mobile-menu-close" id="mobile-menu-close">
        <span class="material-icons text-4xl">close</span>
    </button>

    <div class="mobile-nav-links">
        <a class="mobile-nav-link" href="{{ route('home') }}">
            <span class="lang-id">Beranda</span>
            <span class="lang-en">Home</span>
        </a>
        <a class="mobile-nav-link" href="{{ route('projects') }}">
            <span class="lang-id">Proyek</span>
            <span class="lang-en">Work</span>
        </a>
        <a class="mobile-nav-link" href="{{ route('process') }}">
            <span class="lang-id">Proses</span>
            <span class="lang-en">Process</span>
        </a>
        <a class="mobile-nav-link" href="{{ route('about') }}">
            <span class="lang-id">Tentang</span>
            <span class="lang-en">About</span>
        </a>
        <a class="mobile-nav-link text-blue-400" href="{{ route('contact') }}">
            <span class="lang-id">Kontak</span>
            <span class="lang-en">Contact</span>
        </a>

        <div class="mt-8 pt-8 border-t border-white/10 flex flex-col gap-6">
            <div class="flex items-center justify-between">
                <span class="text-white/60 text-sm font-bold uppercase tracking-widest">Language</span>
                <div class="flex gap-4">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                           class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center overflow-hidden border {{ LaravelLocalization::getCurrentLocale() == $localeCode ? 'border-blue-500' : 'border-transparent' }}">
                           @php
                               $flagMap = ['id' => 'https://flagcdn.com/w40/id.png', 'en' => 'https://flagcdn.com/w40/us.png'];
                           @endphp
                           <img src="{{ $flagMap[$localeCode] }}" class="w-full h-full object-cover">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('mobile-menu-overlay');
        const openBtn = document.getElementById('mobile-menu-open');
        const closeBtn = document.getElementById('mobile-menu-close');

        if (openBtn && overlay) {
            openBtn.addEventListener('click', () => {
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        if (closeBtn && overlay) {
            closeBtn.addEventListener('click', () => {
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        }
    });
</script>
