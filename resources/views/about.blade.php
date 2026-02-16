<!DOCTYPE html>
<html class="lang-{{ LaravelLocalization::getCurrentLocale() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $about->name ?? 'About Me' }} | {{ \App\Models\SiteSetting::t('site_title') ?? 'The Human Behind the Code' }}</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Performance Optimizations -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/css/about.css', 'resources/js/app.js'])
    <script defer src="/_vercel/speed-insights/script.js"></script>
    <script>
        window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/insights/script.js"></script>
</head>
<body class="bg-white dark:bg-background-dark font-display text-primary transition-colors duration-300">
    @include('components.navbar')

    <section class="pt-32 pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl bg-white dark:bg-primary/20 p-2">
                        <img alt="Casual portrait of {{ $about->name }}"
                             class="w-full aspect-[4/5] object-cover rounded-lg"
                             src="{{ $about->profile_image_url }}"
                             fetchpriority="high"
                             loading="eager"/>
                    </div>
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-primary/10 rounded-full blur-3xl"></div>
                    <div class="absolute top-1/2 -right-4 transform -translate-y-1/2 hidden xl:block">
                        <div class="bg-white dark:bg-background-dark p-6 rounded-xl shadow-xl border border-primary/5 rotate-3">
                            <span class="material-symbols-outlined text-primary text-4xl mb-2">coffee</span>
                            <p class="text-sm font-bold dark:text-white">
                                <span class="lang-en">Coffee, Code, &<br/>Curiosity.</span>
                                <span class="lang-id">Kopi, Kode, &<br/>Rasa Ingin Tahu.</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="space-y-8">
                    <div>
                        <span class="text-primary/60 dark:text-gray-400 font-bold tracking-widest uppercase text-sm mb-4 block">
                            <span class="lang-en">The Human Behind the Code</span>
                            <span class="lang-id">Manusia di Balik Kode</span>
                        </span>
                        <h1 class="text-5xl lg:text-6xl font-bold dark:text-white leading-tight">
                            {!! nl2br(e($about->t('hero_heading') ?? 'I build digital products with a human-centered soul.')) !!}
                        </h1>
                    </div>
                    <p class="text-xl text-primary/70 dark:text-gray-400 leading-relaxed">
                        {{ $about->t('bio') ?? 'I am a UI/UX Designer and Web Developer.' }}
                    </p>
                    <div class="flex gap-4">
                        <div class="px-5 py-3 bg-primary/5 dark:bg-white/5 border border-primary/10 rounded-full flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary dark:text-blue-400">location_on</span>
                            <span class="text-sm font-bold dark:text-white">
                                <span class="lang-en">Based in {{ $about->t('location') }}</span>
                                <span class="lang-id">Berbasis di {{ $about->t('location') }}</span>
                            </span>
                        </div>
                        <div class="px-5 py-3 bg-primary/5 dark:bg-white/5 border border-primary/10 rounded-full flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary dark:text-blue-400">language</span>
                            <span class="text-sm font-bold dark:text-white">
                                <span class="lang-en">Remote Enthusiast</span>
                                <span class="lang-id">Antusias Remote</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white dark:bg-background-dark/30 border-y border-primary/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
                <div class="lg:col-span-7 space-y-10">
                    <div>
                        <h2 class="text-3xl font-bold mb-6 dark:text-white">
                            <span class="lang-en">The Story</span>
                            <span class="lang-id">Cerita Saya</span>
                        </h2>
                        <div class="prose prose-lg dark:prose-invert text-primary/80 dark:text-gray-400 space-y-6">
                            <p>
                                {!! nl2br(e($about->t('story_text'))) !!}
                            </p>
                        </div>
                    </div>
                    <div class="pt-10 border-t border-primary/10">
                        <h3 class="text-2xl font-bold mb-8 dark:text-white">
                            <span class="lang-en">Philosophy</span>
                            <span class="lang-id">Filosofi</span>
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @php $philosophies = $about->t('philosophies'); @endphp
                            @if(is_array($philosophies))
                                @foreach($philosophies as $philosophy)
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 mb-1">
                                        <span class="material-symbols-outlined text-primary dark:text-blue-400 text-xl">{{ $philosophy['icon'] ?? 'lightbulb' }}</span>
                                        <h4 class="font-bold dark:text-white text-primary">{{ $philosophy['title'] ?? '' }}</h4>
                                    </div>
                                    <p class="text-sm dark:text-gray-400 leading-relaxed">{{ $philosophy['description'] ?? '' }}</p>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <h2 class="text-3xl font-bold mb-10 dark:text-white">
                        <span class="lang-en">Experience</span>
                        <span class="lang-id">Pengalaman</span>
                    </h2>
                    <div class="space-y-12">
                        @php $experiences = $about->t('experiences'); @endphp
                        @if(is_array($experiences))
                            @foreach($experiences as $exp)
                            <div class="relative pl-8 border-l border-primary/10">
                                <div class="absolute -left-[5px] top-0 w-[10px] h-[10px] rounded-full {{ ($exp['is_current'] ?? false) ? 'bg-emerald-500' : 'bg-primary/30 dark:bg-white/20' }}"></div>
                                <span class="text-xs font-bold uppercase tracking-widest text-primary/40 dark:text-gray-500">{{ $exp['period'] ?? '' }}</span>
                                <h4 class="text-lg font-bold dark:text-white mt-1">{{ $exp['title'] ?? '' }}</h4>
                                <p class="text-sm font-medium text-primary/60 dark:text-gray-400 mb-3">{{ $exp['company'] ?? '' }}</p>
                                <p class="text-sm text-primary/70 dark:text-gray-400 leading-relaxed">
                                    {{ $exp['description'] ?? '' }}
                                </p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <h2 class="text-3xl font-bold mt-20 mb-10 dark:text-white">
                        <span class="lang-en">Education</span>
                        <span class="lang-id">Pendidikan</span>
                    </h2>
                    <div class="space-y-8">
                        @php $educations = $about->t('educations'); @endphp
                        @if(is_array($educations))
                            @foreach($educations as $edu)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-primary/5 dark:bg-white/5 flex-none flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary/50 dark:text-gray-400">{{ $edu['icon'] ?? 'school' }}</span>
                                </div>
                                <div>
                                    <h4 class="font-bold dark:text-white">{{ $edu['degree'] ?? '' }}</h4>
                                    <p class="text-sm text-primary/60 dark:text-gray-400">{{ $edu['institution'] ?? '' }}</p>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-primary/5 dark:bg-white/2">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold dark:text-white mb-4">
                    <span class="lang-en">Tools I Love</span>
                    <span class="lang-id">Alat Favorit</span>
                </h2>
                <p class="text-primary/60 dark:text-gray-400 max-w-xl mx-auto">
                    <span class="lang-en">The stack that helps me move fast and break nothing.</span>
                    <span class="lang-id">Stack yang membantu saya bergerak cepat dan tidak merusak apapun.</span>
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($skills as $skill)
                <div class="bg-white dark:bg-background-dark p-6 rounded-xl border border-primary/5 text-center group hover:border-primary/20 transition-all">
                    <img alt="{{ $skill->name }}" class="h-10 w-auto mx-auto mb-4 grayscale group-hover:grayscale-0 transition-all" src="{{ $skill->icon_url }}" loading="lazy"/>
                    <p class="text-sm font-bold dark:text-white">{{ $skill->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="py-24 bg-white dark:bg-background-dark" id="contact">
        <div class="max-w-7xl mx-auto px-6">
            <div class="bg-primary rounded-xl p-12 md:p-24 text-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute -left-20 -top-20 w-80 h-80 rounded-full border-[40px] border-white"></div>
                    <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full border-[40px] border-white"></div>
                </div>
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-5xl md:text-6xl font-bold text-white mb-8">
                        <span class="lang-en">Ready to start a new chapter together?</span>
                        <span class="lang-id">Siap memulai babak baru bersama?</span>
                    </h2>
                    <p class="text-xl text-white/70 mb-12 leading-relaxed">
                        <span class="lang-en">Whether you have a specific project in mind or just want to chat about the intersection of design and tech, my inbox is always open.</span>
                        <span class="lang-id">Baik Anda memiliki proyek spesifik atau hanya ingin mengobrol tentang persimpangan desain dan teknologi, kotak masuk saya selalu terbuka.</span>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a class="bg-white text-primary px-12 py-5 rounded-full font-bold text-xl hover:shadow-2xl hover:scale-105 transition-all inline-flex items-center justify-center gap-3" href="{{ route('contact') }}">
                            <span class="lang-en">Let's Connect</span>
                            <span class="lang-id">Mari Terhubung</span>
                            <span class="material-icons">send</span>
                        </a>
                        @if($about->cv_url)
                        <a class="bg-primary border border-white/20 text-white px-12 py-5 rounded-full font-bold text-xl hover:bg-white/10 transition-all inline-flex items-center justify-center gap-3" href="{{ $about->cv_url }}" target="_blank">
                            <span class="lang-en">Download CV</span>
                            <span class="lang-id">Unduh CV</span>
                            <span class="material-icons">file_download</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-24 pt-10 border-t border-primary/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs">{{ \App\Models\SiteSetting::t('site_logo_text') ?? 'AP' }}</div>
                    <span class="font-bold text-primary dark:text-white">{{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}.dev</span>
                </div>
                <div class="flex gap-8">
                    @php $socialLinks = json_decode($site_settings['social_links'] ?? '[]', true); @endphp
                    @foreach($socialLinks as $link)
                    <a class="text-primary/60 hover:text-primary dark:text-gray-400 dark:hover:text-white transition-colors font-medium" href="{{ $link['url'] }}" target="_blank">{{ $link['name'] }}</a>
                    @endforeach
                </div>
                <p class="text-sm text-primary/40 dark:text-gray-500">© {{ date('Y') }} {{ $about->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Vercel Speed Insights -->
    <script>
        window.si = window.si || function () { (window.siq = window.siq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/speed-insights/script.js"></script>

    <!-- Vercel Web Analytics -->
    <script>
        window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/insights/script.js"></script>
</body>

</html>
