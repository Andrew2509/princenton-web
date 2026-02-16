<!DOCTYPE html>
<html class="lang-{{ LaravelLocalization::getCurrentLocale() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ \App\Models\SiteSetting::t('site_title') ?? 'Galeri Proyek | Desainer UI/UX & Pengembang Web' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="page-container">
@include('components.navbar')

<header class="pt-16 pb-12">
    <div class="section-container">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
            <div class="max-w-2xl">
                <span class="text-primary/60 dark:text-gray-400 font-bold tracking-widest uppercase text-sm mb-4 block">
                    <span class="lang-id">Portofolio</span>
                    <span class="lang-en">Portfolio</span>
                </span>
                <h1 class="hero-heading text-center text-primary dark:text-primary">
            <span class="lang-id">Galeri <span class="hero-heading-accent">Proyek</span></span>
            <span class="lang-en">Work <span class="hero-heading-accent">Gallery</span></span>
        </h1>
                <p class="text-lg text-primary/70 dark:text-gray-400 mt-4">
                    <span class="lang-id">Koleksi pengalaman digital yang dibangun dengan fokus pada psikologi pengguna, tujuan bisnis, dan keunggulan teknis.</span>
                    <span class="lang-en">A collection of digital experiences built with a focus on user psychology, business goals, and technical excellence.</span>
                </p>
            </div>
            <div class="flex flex-wrap gap-2 bg-primary/5 dark:bg-white/5 p-1.5 rounded-full border border-primary/10" id="project-filters">
                <button class="filter-btn active px-6 py-2.5 bg-primary text-white rounded-full text-sm font-bold shadow-md transition-all" onclick="filterProjectsPage('all', this)">
                    <span class="lang-id">Semua</span>
                    <span class="lang-en">All</span>
                </button>
                <button class="filter-btn px-6 py-2.5 text-primary/60 dark:text-gray-400 hover:text-primary dark:hover:text-white text-sm font-bold transition-all rounded-full" onclick="filterProjectsPage('ui-ux', this)">UI/UX</button>
                <button class="filter-btn px-6 py-2.5 text-primary/60 dark:text-gray-400 hover:text-primary dark:hover:text-white text-sm font-bold transition-all rounded-full" onclick="filterProjectsPage('development', this)">
                    <span class="lang-id">Pengembangan</span>
                    <span class="lang-en">Development</span>
                </button>
                <button class="filter-btn px-6 py-2.5 text-primary/60 dark:text-gray-400 hover:text-primary dark:hover:text-white text-sm font-bold transition-all rounded-full" onclick="filterProjectsPage('saas', this)">SaaS</button>
            </div>
        </div>
    </div>
</header>

<main class="pb-32">
    <div class="section-container">
        <div class="grid grid-cols-1 gap-16 lg:gap-24">
            @foreach($projects as $index => $project)
            <article class="project-article group bg-white dark:bg-white/5 rounded-3xl overflow-hidden border border-primary/5 shadow-sm hover:shadow-xl transition-all duration-500" data-category="{{ $project->category }}">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
                    <div class="lg:col-span-7 bg-primary/[0.03] dark:bg-primary/20 flex items-center justify-center p-8 lg:p-12 overflow-hidden {{ $index % 2 != 0 ? 'lg:order-last' : '' }}">
                        <div class="relative w-full max-w-2xl transition-transform duration-700 group-hover:scale-105">
                            <img alt="{{ $project->title }}" class="w-full h-auto drop-shadow-2xl rounded-xl" src="{{ $project->image_url }}"/>
                        </div>
                    </div>
                    <div class="lg:col-span-5 p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex flex-wrap gap-2 mb-6">
                            @if(is_array($project->tags))
                                @foreach($project->tags as $tag)
                                <span class="px-3 py-1 bg-primary/5 dark:bg-white/10 text-primary dark:text-white text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $tag }}</span>
                                @endforeach
                            @endif
                        </div>
                        <h2 class="text-3xl font-bold dark:text-white mb-6">{{ $project->t('title') }}</h2>
                        <div class="grid grid-cols-2 gap-6 mb-8 py-6 border-y border-primary/10">
                            <div>
                                <p class="text-[10px] font-bold text-primary/40 dark:text-gray-500 uppercase tracking-widest mb-1">
                                    <span class="lang-id">Peran</span>
                                    <span class="lang-en">Role</span>
                                </p>
                                <p class="text-sm font-semibold dark:text-gray-300">
                                    {{ $project->t('role') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-primary/40 dark:text-gray-500 uppercase tracking-widest mb-1">
                                    <span class="lang-id">Alat</span>
                                    <span class="lang-en">Tools</span>
                                </p>
                                <p class="text-sm font-semibold dark:text-gray-300">{{ $project->tools }}</p>
                            </div>
                        </div>
                        <div class="space-y-6 mb-8">
                            @if($project->problem_text)
                            <div class="flex gap-4">
                                <div class="flex-none w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">P</div>
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-tighter text-primary/40 dark:text-gray-500">
                                        <span class="lang-id">Masalah</span>
                                        <span class="lang-en">The Problem</span>
                                    </h4>
                                    <p class="text-sm text-primary/70 dark:text-gray-400 mt-1">
                                        {{ $project->t('problem_text') }}
                                    </p>
                                </div>
                            </div>
                            @endif
                            @if($project->solution_text)
                            <div class="flex gap-4">
                                <div class="flex-none w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">S</div>
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-tighter text-primary/40 dark:text-gray-500">
                                        <span class="lang-id">Solusi</span>
                                        <span class="lang-en">The Solution</span>
                                    </h4>
                                    <p class="text-sm text-primary/70 dark:text-gray-400 mt-1">
                                        {{ $project->t('solution_text') }}
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <a class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-full font-bold hover:gap-4 transition-all w-fit" href="{{ $project->live_link ?? '#' }}" target="_blank">
                            <span class="lang-id">Baca Studi Kasus STAR</span>
                            <span class="lang-en">Read STAR Case Study</span>
                            <span class="material-icons text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</main>

<footer class="footer" id="contact">
    <div class="section-container">
        <div class="footer-cta-card">
            <div class="footer-circle footer-circle-left"></div>
            <div class="footer-circle footer-circle-right"></div>
            <div class="relative z-10">
                <h2 class="footer-cta-title">
                    <span class="lang-id">Siap membangun kisah sukses Anda berikutnya?</span>
                    <span class="lang-en">Let's build your next success story</span>
                </h2>
                <p class="text-xl text-white/70 mb-10 max-w-2xl mx-auto">
                    <span class="lang-id">Saya saat ini menerima proyek baru dan penugasan konsultasi. Mari bicarakan tujuan Anda.</span>
                    <span class="lang-en">I'm currently accepting new projects and consulting engagements. Let's talk about your goals.</span>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a class="footer-btn-primary" href="{{ route('contact') }}">
                        <span class="lang-id">Mulai Percakapan</span>
                        <span class="lang-en">Start a Conversation</span>
                    </a>
                    <a class="footer-btn-secondary" href="/#process">
                        <span class="lang-id">Lihat Metodologi</span>
                        <span class="lang-en">View Methodology</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-logo-container">
                <div class="footer-logo-badge">{{ $site_settings['site_logo_text'] ?? 'AP' }}</div>
                <span class="footer-brand">{{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}.dev</span>
            </div>
            <div class="footer-social-links">
                @php $socialLinks = json_decode($site_settings['social_links'] ?? '[]', true); @endphp
                @foreach($socialLinks as $link)
                <a class="footer-social-link" href="{{ $link['url'] }}" target="_blank">{{ $link['name'] }}</a>
                @endforeach
            </div>
            <p class="footer-copyright">
                <span class="lang-id">© {{ date('Y') }} {{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}.dev — {{ \App\Models\SiteSetting::t('footer_text') ?? 'Dibuat dengan logika dan presisi.' }}</span>
                <span class="lang-en">© {{ date('Y') }} {{ \App\Models\SiteSetting::t('site_name') ?? 'AndrewPrince' }}.dev — {{ \App\Models\SiteSetting::t('footer_text') ?? 'Built with logic and precision.' }}</span>
            </p>
        </div>
    </div>
</footer>

<script>
    function filterProjectsPage(category, btn) {
        // Update button styles
        document.querySelectorAll('#project-filters .filter-btn').forEach(el => {
            el.classList.remove('active', 'bg-primary', 'text-white', 'shadow-md');
            el.classList.add('text-primary/60', 'dark:text-gray-400');
        });
        btn.classList.add('active', 'bg-primary', 'text-white', 'shadow-md');
        btn.classList.remove('text-primary/60', 'dark:text-gray-400');

        // Filter project articles
        document.querySelectorAll('.project-article').forEach(article => {
            const categories = article.getAttribute('data-category');
            if (category === 'all' || categories.includes(category)) {
                article.style.opacity = '0';
                article.style.transform = 'translateY(20px)';
                article.style.display = '';
                setTimeout(() => {
                    article.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    article.style.opacity = '1';
                    article.style.transform = 'translateY(0)';
                }, 50);
            } else {
                article.style.transition = 'opacity 0.3s ease';
                article.style.opacity = '0';
                setTimeout(() => { article.style.display = 'none'; }, 300);
            }
        });
    }
</script>

<!-- Vercel Speed Insights -->
<script>
    window.si = window.si || function () { (window.siq = window.siq || []).push(arguments); };
</script>
<script defer src="/_vercel/speed-insights/script.js"></script>

</body>
</html>
