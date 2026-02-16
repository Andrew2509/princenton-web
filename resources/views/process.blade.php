<!DOCTYPE html>
<html class="lang-{{ LaravelLocalization::getCurrentLocale() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ \App\Models\SiteSetting::t('site_title') ?? 'Metodologi Kami | Proses STAR' }}</title>

    <!-- Performance Optimizations -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/css/process.css', 'resources/js/app.js'])
    <script defer src="/_vercel/speed-insights/script.js"></script>
    <script>
        window.va = window.va || function () { (window.vaq = window.vaq || []).push(arguments); };
    </script>
    <script defer src="/_vercel/insights/script.js"></script>
</head>
<body class="page-container bg-white dark:bg-background-dark min-h-screen">
    @include('components.navbar')

    <section class="hero-section text-center relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="hero-bg-overlay">
            <div class="hero-gradient"></div>
            <div class="hero-pattern"></div>
        </div>
        <div class="section-container relative z-10">
            <div class="hero-badge mx-auto">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-xs font-bold tracking-wider uppercase text-primary/60 dark:text-gray-400">
                    <span class="lang-id">Alur Kerja Saya</span>
                    <span class="lang-en">My Workflow</span>
                </span>
            </div>
            <h1 class="hero-heading text-center text-primary dark:text-primary mb-6">
                <span class="lang-id">Metodologi <span class="hero-heading-accent">Kami</span></span>
                <span class="lang-en">Our <span class="hero-heading-accent">Methodology</span></span>
            </h1>
            <p class="hero-description mx-auto">
                <span class="lang-id">Saya mengikuti kerangka kerja STAR—pendekatan terstruktur yang memastikan setiap keputusan desain didukung oleh data, logika, dan jalur yang jelas menuju hasil yang terukur.</span>
                <span class="lang-en">I follow the STAR framework—a structured approach that ensures every design decision is backed by data, logic, and a clear path to measurable results.</span>
            </p>
        </div>
    </section>

<section class="py-12 bg-white dark:bg-white/[0.02] border-y border-primary/5 overflow-hidden">
    <div class="marquee-container !bg-transparent !py-0 !border-none relative">
        <div class="absolute top-0 bottom-0 left-0 w-32 z-10 pointer-events-none bg-gradient-to-r from-white dark:from-[#15181d] to-transparent"></div>
        <div class="absolute top-0 bottom-0 right-0 w-32 z-10 pointer-events-none bg-gradient-to-l from-white dark:from-[#15181d] to-transparent"></div>
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
                <img alt="{{ $skill->name }}" class="tech-logo" src="{{ $skill->icon_url }}" loading="lazy"/>
                <span class="tech-name">{{ $skill->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24 !bg-white dark:bg-background-dark text-primary dark:text-gray-400" id="process">
    <div class="max-w-5xl mx-auto px-6 relative">
        <div class="absolute left-1/2 top-0 bottom-0 w-0.5 timeline-line hidden lg:block -translate-x-1/2"></div>
        <div class="space-y-24">
            @foreach($steps as $index => $step)
            <div class="relative grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center gap-12">
                @if($index % 2 == 0)
                <div class="lg:text-right order-2 lg:order-1">
                    <span class="text-blue-500 font-bold uppercase tracking-widest text-xs mb-2 block">
                        <span class="lang-id">Phase {{ str_pad($step->phase_number, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="lang-en">Phase {{ str_pad($step->phase_number, 2, '0', STR_PAD_LEFT) }}</span>
                    </span>
                    <h3 class="text-3xl font-bold mt-2 mb-4 dark:text-white">{{ $step->t('title') }}</h3>
                    <p class="text-primary/70 dark:text-gray-400 leading-relaxed text-sm">
                        {{ $step->t('description') }}
                    </p>
                    <div class="mt-4 flex flex-wrap lg:justify-end gap-2">
                        @if(is_array($step->tags))
                            @foreach($step->tags as $tag)
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded bg-gray-100 dark:bg-white/5 text-primary/60 dark:text-gray-400">{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="relative z-10 w-16 h-16 bg-[#293754] dark:bg-[#293754] rounded-full flex items-center justify-center shadow-xl order-1 lg:order-2 justify-self-center border-4 border-white dark:border-background-dark outline outline-4 outline-primary/5 dark:outline-white/5">
                    <span class="material-icons text-white text-3xl">{{ $step->icon }}</span>
                </div>
                <div class="order-3">
                    <div class="p-4 bg-background-light dark:bg-white/5 rounded-3xl border border-primary/5">
                        <img alt="{{ $step->t('title') }}" class="w-full rounded-2xl shadow-sm" src="{{ $step->image_url }}"/>
                    </div>
                </div>
                @else
                <div class="order-3 lg:order-1">
                    <div class="p-4 bg-background-light dark:bg-white/5 rounded-3xl border border-primary/5">
                        <img alt="{{ $step->t('title') }}" class="w-full rounded-2xl shadow-sm" src="{{ $step->image_url }}"/>
                    </div>
                </div>
                <div class="relative z-10 w-16 h-16 bg-[#293754] dark:bg-[#293754] rounded-full flex items-center justify-center shadow-xl order-1 lg:order-2 justify-self-center border-4 border-white dark:border-background-dark outline outline-4 outline-primary/5 dark:outline-white/5">
                    <span class="material-icons text-white text-3xl">{{ $step->icon }}</span>
                </div>
                <div class="order-2">
                    <span class="text-blue-500 font-bold uppercase tracking-widest text-xs mb-2 block">
                        <span class="lang-id">Phase {{ str_pad($step->phase_number, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="lang-en">Phase {{ str_pad($step->phase_number, 2, '0', STR_PAD_LEFT) }}</span>
                    </span>
                    <h3 class="text-3xl font-bold mt-2 mb-4 dark:text-white">{{ $step->t('title') }}</h3>
                    <p class="text-primary/70 dark:text-gray-400 leading-relaxed text-sm">
                        {{ $step->t('description') }}
                    </p>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if(is_array($step->tags))
                            @foreach($step->tags as $tag)
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded bg-gray-100 dark:bg-white/5 text-primary/60 dark:text-gray-400">{{ $tag }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24 bg-[#293754] text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(37,99,235,0.1),transparent)]"></div>
    <div class="section-container relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-8 leading-tight">
                    <span class="lang-id">Why I use the <span class="text-blue-400">STAR Method</span></span>
                    <span class="lang-en">Why I use the <span class="text-blue-400">STAR Method</span></span>
                </h2>
                <p class="text-lg text-white/70 leading-relaxed mb-10 max-w-xl">
                    <span class="lang-id">Most designers focus purely on aesthetics. While beauty is important, it's the logic behind the design that drives business results.</span>
                    <span class="lang-en">Most designers focus purely on aesthetics. While beauty is important, it's the logic behind the design that drives business results.</span>
                </p>
                <div class="space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <span class="material-icons text-blue-400">verified</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">
                                <span class="lang-id">Hasil yang Dapat Diprediksi</span>
                                <span class="lang-en">Predictable Outcomes</span>
                            </h4>
                            <p class="text-white/60 text-sm">
                                <span class="lang-id">Menghilangkan tebakan dengan menggunakan proses berulang yang berdasarkan bukti.</span>
                                <span class="lang-en">Eliminates guesswork by using a repeatable, evidence-based process.</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <span class="material-icons text-blue-400">handshake</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">
                                <span class="lang-id">Kepercayaan Pemangku Kepentingan</span>
                                <span class="lang-en">Stakeholder Trust</span>
                            </h4>
                            <p class="text-white/60 text-sm">
                                <span class="lang-id">Memberikan transparansi di setiap tahap sehingga Anda selalu tahu "Mengapa" di balik "Apa".</span>
                                <span class="lang-en">Provides transparency at every stage so you always know the "Why" behind the "What".</span>
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-4 items-start">
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center shrink-0">
                            <span class="material-icons text-blue-400">speed</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">
                                <span class="lang-id">Iterasi Lebih Cepat</span>
                                <span class="lang-en">Faster Iteration</span>
                            </h4>
                            <p class="text-white/60 text-sm">
                                <span class="lang-id">Alur yang terstruktur mencegah pelebaran ruang lingkup dan mempercepat siklus pengiriman.</span>
                                <span class="lang-en">A structured flow prevents scope creep and speeds up the delivery cycle.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-white/5 border border-white/10 p-10 rounded-[2.5rem] backdrop-blur-xl relative z-10 shadow-2xl">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-blue-500/20 flex items-center justify-center">
                            <span class="material-icons text-blue-400">format_quote</span>
                        </div>
                        <p class="font-bold text-white/90 italic">
                            <span class="lang-id">A Client's Perspective</span>
                            <span class="lang-en">A Client's Perspective</span>
                        </p>
                    </div>
                    <p class="text-lg text-white/80 leading-relaxed mb-10 italic">
                        <span class="lang-id">"Working with John was eye-opening. Instead of just showing us pretty screens, he walked us through the 'Situation' and 'Task' so clearly that the 'Result' felt inevitable. Our conversion rates are up 30% because of this methodology."</span>
                        <span class="lang-en">"Working with John was eye-opening. Instead of just showing us pretty screens, he walked us through the 'Situation' and 'Task' so clearly that the 'Result' felt inevitable. Our conversion rates are up 30% because of this methodology."</span>
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-400 rounded-full overflow-hidden border-2 border-white/10">
                            <img alt="Client" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKPqlS8jeVLQPyq3QIFwzEN0CB-GRjw0q1d6lSn1_T87XoyPUN_JkU1HhWqtAj3Os6xEVHN7H39WqBv6nwL3GIpyTPdGlwN-osMbhuqmeIVpmrnchEw0j9z_GyGgAqvogntfGogKjLPKzEfd3SrWnKV14SOqyJOTOhmsnNcNby7Wwf7LBXfpUBcH5HmaX3CLJ-OqXAeuv41qrnQbWFfslOkOUDzMNrKp5y2SQNnr6kbK7Hy9bGrQex82GNFLLT8ol_EQRa9qdSDp9o"/>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-white">Sarah Jenkins</p>
                            <p class="text-white/40 text-xs">Product Manager, FinTech Global</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px]"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-primary/20 rounded-full blur-[100px]"></div>
            </div>
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
                    <span class="lang-id">Alami prosesnya secara langsung.</span>
                    <span class="lang-en">Experience the process firsthand.</span>
                </h2>
                <p class="text-xl text-white/70 mb-10 max-w-2xl mx-auto">
                    <span class="lang-id">Saya siap menerapkan kerangka kerja STAR untuk tantangan besar Anda berikutnya. Mari kita bangun sesuatu yang luar biasa bersama.</span>
                    <span class="lang-en">I'm ready to apply the STAR framework to your next big challenge. Let's build something exceptional together.</span>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a class="footer-btn-primary" href="{{ route('contact') }}">
                        <span class="lang-id">Diskusikan Proyek Anda</span>
                        <span class="lang-en">Let's Discuss Your Project</span>
                    </a>
                    <a class="footer-btn-secondary" href="/projects">
                        <span class="lang-id">Lihat Studi Kasus</span>
                        <span class="lang-en">View Case Studies</span>
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
