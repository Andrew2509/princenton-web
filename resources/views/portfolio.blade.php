<!DOCTYPE html>
<html class="lang-{{ LaravelLocalization::getCurrentLocale() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ \App\Models\SiteSetting::t('site_title') ?? 'Process-Driven Portfolio | UI/UX & Dev' }}</title>

    <!-- Performance Optimizations -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="/_vercel/speed-insights/script.js"></script>
    <script>
        window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/insights/script.js"></script>
</head>
<body class="page-container">
@include('components.navbar')

<section class="hero-section">
    <div class="hero-bg-overlay">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
    </div>
    <div class="section-container">
        <div class="hero-grid">
            <div class="hero-text-container">
                <div class="hero-badge">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase text-primary/60 dark:text-gray-400">
                        {{ $about->t('secondary_badge') ?? 'Available for New Projects' }}
                    </span>
                </div>
                <h1 class="hero-heading">
                    {!! nl2br(e($about->t('hero_heading') ?? 'Programmer | Web Development')) !!} <br/>
                    <span class="hero-heading-accent">{!! nl2br(e($about->t('hero_subheading') ?? 'UI/UX Design | Fullstack Development')) !!}</span>
                </h1>
                <p class="hero-description">
                    {{ $about->t('tagline') ?? (\App\Models\SiteSetting::t('site_tagline') ?? 'I bridge the gap between complex problems and elegant digital solutions.') }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a class="hero-btn-primary" href="/projects">
                        <span class="lang-id">Lihat Studi Kasus</span>
                        <span class="lang-en">View Case Studies</span>
                        <span class="material-icons">arrow_forward</span>
                    </a>
                    <a class="hero-btn-secondary" href="/process">
                        <span class="lang-id">Metodologi Saya</span>
                        <span class="lang-en">My Methodology</span>
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-value">{{ $about->stats_projects ?? '50+' }}</span>
                        <span class="stat-label">
                            <span class="lang-id">Proyek Selesai</span>
                            <span class="lang-en">Projects Completed</span>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">{{ $about->stats_experience ?? '6thn' }}</span>
                        <span class="stat-label">
                            <span class="lang-id">Pengalaman</span>
                            <span class="lang-en">Years of Experience</span>
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">{{ $about->stats_satisfaction ?? '100%' }}</span>
                        <span class="stat-label">
                            <span class="lang-id">Kepuasan Klien</span>
                            <span class="lang-en">Client Satisfaction</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="hero-image-container">
                <div class="hero-frame-group">
                    <div class="hero-frame-bg-outer"></div>
                    <div class="hero-frame-bg-inner">
                        <img alt="Professional profile of {{ $about->name }}, {{ $about->title }}"
                             class="hero-image grayscale hover:grayscale-0 transition-all duration-700"
                             src="{{ $about->profile_image_url ?: 'https://via.placeholder.com/600' }}"
                             fetchpriority="high"
                             loading="eager"/>
                        <div class="hero-image-overlay"></div>
                    </div>

                    <div class="hero-verified-badge">
                        <div class="verified-icon-wrapper">
                            <span class="material-icons text-xl">verified</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-primary/40 uppercase tracking-tighter dark:text-gray-500">
                                <span class="lang-id">Spesialis Terverifikasi</span>
                                <span class="lang-en">Verified Specialist</span>
                            </p>
                            <p class="verified-name text-xs font-bold">
                                <span class="lang-id">{{ $about->name }}, {{ $about->title }}</span>
                                <span class="lang-en">{{ $about->name }}, {{ $about->title }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl -z-10"></div>
                <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-primary/10 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</section>

<section class="marquee-container">
    <div class="marquee-gradient-left"></div>
    <div class="marquee-gradient-right"></div>
    <div class="animate-marquee">
        <!-- Tech Set 1 -->
        @foreach($skills as $skill)
        <div class="tech-item">
            <img alt="{{ $skill->name }}" class="tech-logo" src="{{ $skill->icon_url }}" loading="lazy"/>
            <span class="tech-name">{{ $skill->name }}</span>
        </div>
        @endforeach

        <!-- Tech Set 2 (Duplicate for seamless scroll) -->
        @foreach($skills as $skill)
        <div class="tech-item">
            <img alt="{{ $skill->name }}" class="tech-logo" src="{{ $skill->icon_url }}"/>
            <span class="tech-name">{{ $skill->name }}</span>
        </div>
        @endforeach
    </div>
</section>

<section class="section-work" id="work">
    <div class="section-container">
        <div class="work-header">
            <div>
                <span class="work-label">
                    <span class="lang-id">Proyek Pilihan</span>
                    <span class="lang-en">Selected Work</span>
                </span>
                <h2 class="work-title text-primary dark:text-primary">
                    <span class="lang-id">Dari Sketsa ke Produk Nyata</span>
                    <span class="lang-en">From Sketch to Production</span>
                </h2>
            </div>
        </div>
        {{-- Category Filter Buttons --}}
        @if($categories->count() > 0)
        <div class="flex flex-wrap gap-2 mb-10 bg-primary/5 dark:bg-white/5 p-1.5 rounded-full border border-primary/10 w-fit" id="home-project-filters">
            <button class="filter-item-active" data-cat="all" onclick="filterProjects('all', this)">
                <span class="lang-id">Semua</span>
                <span class="lang-en">All</span>
            </button>
            @foreach($categories as $cat)
            <button class="filter-item" data-cat="{{ $cat }}" onclick="filterProjects('{{ $cat }}', this)">
                {{ str_replace('-', '/', ucfirst($cat)) }}
            </button>
            @endforeach
        </div>
        @endif
        <div class="project-section-grid" id="project-grid">
            @foreach($featuredProjects as $project)
            <div class="project-card" data-category="{{ $project->category }}">
                <div class="project-image-container">
                    <div class="project-image-wrapper">
                        @php
                            $isSafeUrl = $project->image_url &&
                                       (Str::startsWith($project->image_url, ['http://', 'https://', '/', 'data:']) &&
                                       !Str::startsWith($project->image_url, 'file:'));
                        @endphp
                        @if($isSafeUrl)
                        <img alt="{{ $project->title }}" class="w-full aspect-video object-cover" src="{{ $project->image_url }}" loading="lazy"/>
                        @else
                        <div class="w-full aspect-video bg-primary/5 flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary/20 text-4xl">image</span>
                        </div>
                        @endif
                        <div class="project-image-overlay">
                            <span class="project-view-btn">
                                <span class="lang-id">Lihat Studi Kasus</span>
                                <span class="lang-en">View Case Study</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="project-content-container">
                    <div class="flex items-center gap-3">
                        @php $primaryCat = explode(' ', trim($project->category))[0]; @endphp
                        <span class="project-type-badge cursor-pointer hover:opacity-80 transition-opacity" onclick="filterByCategory('{{ $primaryCat }}')" title="Filter by {{ $primaryCat }}">
                            {{ $project->category }}
                        </span>
                        <span class="project-status-badge">
                            <span class="material-icons text-sm">{{ $project->status === 'completed' ? 'check_circle' : 'pending' }}</span>
                            <span class="lang-id">{{ strtoupper($project->status) }} {{ $project->year }}</span>
                            <span class="lang-en">{{ strtoupper($project->status) }} {{ $project->year }}</span>
                        </span>
                    </div>
                    <h3 class="text-3xl font-bold dark:text-white">{{ $project->t('title') }}</h3>
                    <div class="grid grid-cols-2 gap-4 py-4 border-y border-primary/10">
                        <div>
                            <p class="hero-stat-label">
                                <span class="lang-id">Peran Anda</span>
                                <span class="lang-en">Your Role</span>
                            </p>
                            <p class="text-sm font-semibold dark:text-gray-300">
                                {{ $project->t('role') }}
                            </p>
                        </div>
                        <div>
                            <p class="hero-stat-label">
                                <span class="lang-id">Alat yang Digunakan</span>
                                <span class="lang-en">Tools Used</span>
                            </p>
                            <p class="text-sm font-semibold dark:text-gray-300">{{ $project->tools }}</p>
                        </div>
                    </div>
                    <div class="project-star-container">
                        @if($project->situation_text)
                        <div class="project-star-item">
                            <div class="project-star-badge">S</div>
                            <p class="project-star-text">
                                <span class="lang-id"><strong>Situasi:</strong> {{ $project->t('situation_text') }}</span>
                                <span class="lang-en"><strong>Situation:</strong> {{ $project->t('situation_text') }}</span>
                            </p>
                        </div>
                        @endif
                        @if($project->task_text)
                        <div class="project-star-item">
                            <div class="project-star-badge">T</div>
                            <p class="project-star-text">
                                <span class="lang-id"><strong>Tugas:</strong> {{ $project->t('task_text') }}</span>
                                <span class="lang-en"><strong>Task:</strong> {{ $project->t('task_text') }}</span>
                            </p>
                        </div>
                        @endif
                        @if($project->action_text)
                        <div class="project-star-item">
                            <div class="project-star-badge">A</div>
                            <p class="project-star-text">
                                <span class="lang-id"><strong>Tindakan:</strong> {{ $project->t('action_text') }}</span>
                                <span class="lang-en"><strong>Action:</strong> {{ $project->t('action_text') }}</span>
                            </p>
                        </div>
                        @endif
                        @if($project->result_text)
                        <div class="project-star-item">
                            <div class="project-star-badge">R</div>
                            <p class="project-star-text">
                                <span class="lang-id"><strong>Hasil:</strong> {{ $project->t('result_text') }}</span>
                                <span class="lang-en"><strong>Result:</strong> {{ $project->t('result_text') }}</span>
                            </p>
                        </div>
                        @endif
                    </div>
                    <a class="project-link" href="/projects">
                        <span class="lang-id">Lihat Studi Kasus</span>
                        <span class="lang-en">View Case Study</span>
                        <span class="material-icons">arrow_forward</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center md:justify-end">
            <a class="project-link group" href="/projects">
                <span class="lang-id italic">Lihat Semua Proyek Pilihan</span>
                <span class="lang-en italic">View All Selected Projects</span>
                <span class="material-icons group-hover:translate-x-1 transition-transform">east</span>
            </a>
        </div>
    </div>
</section>

<section class="section-process" id="process">
    <div class="section-container">
        <div class="max-w-3xl mb-16">
            <span class="text-primary/60 dark:text-white/60 font-bold tracking-widest uppercase text-sm">
                <span class="lang-id">Kerangka Kerja Saya</span>
                <span class="lang-en">My Framework</span>
            </span>
            <h2 class="text-4xl font-bold mt-2 text-primary dark:text-white">
                <span class="lang-id">Metode STAR dalam Praktik</span>
                <span class="lang-en">The STAR Method in Practice</span>
            </h2>
            <p class="text-lg text-primary/70 dark:text-white/70 mt-4">
                <span class="lang-id">Setiap proyek yang saya kerjakan mengikuti metodologi yang ketat untuk memastikan produk akhir tidak hanya indah, tetapi juga memecahkan masalah bisnis yang nyata.</span>
                <span class="lang-en">Every project I undertake follows a rigorous methodology to ensure the final product isn't just beautiful, but solves real business problems.</span>
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="process-card">
                <div class="process-number">01</div>
                <h4 class="text-xl font-bold mb-2 text-primary dark:text-white">
                    <span class="lang-id">Situasi</span>
                    <span class="lang-en">Situation</span>
                </h4>
                <p class="text-sm text-primary/60 dark:text-white/60">
                    <span class="lang-id">Mengidentifikasi masalah utama, kendala pengguna, dan posisi pasar saat ini.</span>
                    <span class="lang-en">Identifying the core problem, user pain points, and current market positioning.</span>
                </p>
            </div>
            <div class="process-card">
                <div class="process-number">02</div>
                <h4 class="text-xl font-bold mb-2 text-primary dark:text-white">
                    <span class="lang-id">Tugas</span>
                    <span class="lang-en">Task</span>
                </h4>
                <p class="text-sm text-primary/60 dark:text-white/60">
                    <span class="lang-id">Menetapkan metrik keberhasilan, ruang lingkup proyek, dan batasan teknologi.</span>
                    <span class="lang-en">Defining success metrics, project scope, and technological constraints.</span>
                </p>
            </div>
            <div class="process-card">
                <div class="process-number">03</div>
                <h4 class="text-xl font-bold mb-2 text-primary dark:text-white">
                    <span class="lang-id">Tindakan</span>
                    <span class="lang-en">Action</span>
                </h4>
                <p class="text-sm text-primary/60 dark:text-white/60">
                    <span class="lang-id">Desain iteratif, pembuatan prototipe cepat, dan penerapan kode yang bersih serta terukur.</span>
                    <span class="lang-en">Iterative design, rapid prototyping, and clean, scalable code implementation.</span>
                </p>
            </div>
            <div class="process-card">
                <div class="process-number">04</div>
                <h4 class="text-xl font-bold mb-2 text-primary dark:text-white">
                    <span class="lang-id">Hasil</span>
                    <span class="lang-en">Result</span>
                </h4>
                <p class="text-sm text-primary/60 dark:text-white/60">
                    <span class="lang-id">Peluncuran, validasi pengujian pengguna, dan analisis kinerja berbasis data.</span>
                    <span class="lang-en">Deployment, user testing validation, and data-driven performance analysis.</span>
                </p>
            </div>
        </div>
        <div class="process-header text-center mt-16">
            <span class="process-label">
                <span class="lang-id">Metodologi Saya</span>
                <span class="lang-en">My Methodology</span>
            </span>
            <h2 class="process-title text-5xl font-bold tracking-tight mb-4">
                <span class="lang-id">Proses Berbasis Logika</span>
                <span class="lang-en">Rigorous Process, Logical Results</span>
            </h2>
            <p class="process-subtitle text-xl opacity-60 max-w-2xl mx-auto">
                <span class="lang-id">Saya menggunakan metode STAR yang telah terbukti untuk memastikan setiap keputusan desain didukung oleh data dan tujuan bisnis yang jelas.</span>
                <span class="lang-en">I use the proven STAR method to ensure every design decision is backed by data and clear business objectives.</span>
            </p>
        </div>
    </div>
</section>

<footer class="footer" id="contact">
    <div class="section-container">
        <div class="footer-cta-card">
            <div class="footer-circle footer-circle-left"></div>
            <div class="footer-circle footer-circle-right"></div>
            <div class="relative z-10">
                <h2 class="footer-cta-title">
                    <span class="lang-id">Siap membangun sesuatu yang berdampak?</span>
                    <span class="lang-en">Ready to build something impactful?</span>
                </h2>
                <p class="text-xl text-white/70 mb-10 max-w-2xl mx-auto">
                    <span class="lang-id">Saya saat ini menerima proyek baru dan penugasan konsultasi. Mari bicarakan tujuan Anda.</span>
                    <span class="lang-en">I'm currently accepting new projects and consulting engagements. Let's talk about your goals.</span>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a class="footer-btn-primary" href="{{ route('contact') }}">
                        <span class="lang-id">Diskusikan Proyek Anda</span>
                        <span class="lang-en">Let's Discuss Your Project</span>
                    </a>
                    @if($about->cv_url)
                    <a class="footer-btn-secondary" href="{{ $about->cv_url }}" target="_blank">
                        <span class="lang-id">Unduh CV Saya</span>
                        <span class="lang-en">Download My CV</span>
                    </a>
                    @endif
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
    function filterProjects(category, btn) {
        // Update Buttons
        if (btn) {
            document.querySelectorAll('#home-project-filters button').forEach(el => {
                el.className = 'filter-item';
            });
            btn.className = 'filter-item-active';
        }

        // Show only the FIRST matching project with animation
        let shown = false;
        document.querySelectorAll('.project-card').forEach(card => {
            const categories = card.getAttribute('data-category');
            if (!shown && (category === 'all' || categories.includes(category))) {
                card.style.display = '';
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
                shown = true;
            } else {
                card.style.transition = 'opacity 0.3s ease';
                card.style.opacity = '0';
                setTimeout(() => { card.style.display = 'none'; }, 300);
            }
        });
    }

    // Helper: filter by clicking a category badge on a project card
    function filterByCategory(cat) {
        const btn = document.querySelector('#home-project-filters button[data-cat="' + cat + '"]');
        if (btn) {
            filterProjects(cat, btn);
        } else {
            filterProjects(cat, null);
        }
    }

    // On page load, only show the first project
    document.addEventListener('DOMContentLoaded', function() {
        filterProjects('all', document.querySelector('#home-project-filters button'));
    });
</script>

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
