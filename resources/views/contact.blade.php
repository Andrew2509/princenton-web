<!DOCTYPE html>
<html class="lang-{{ LaravelLocalization::getCurrentLocale() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>
        <span class="lang-id">Hubungi Saya | AndrewPrince.dev</span>
        <span class="lang-en">Contact Me | AndrewPrince.dev</span>
    </title>

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
    <style>
        .contact-input {
            width: 100%;
            background-color: white;
            border: 1px solid rgba(41, 55, 84, 0.1);
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            color: var(--color-primary);
            outline: none;
            transition: all 0.3s;
        }
        .contact-input:focus {
            ring: 2px;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(41, 55, 84, 0.1);
        }
        .dark .contact-input {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .dark .contact-input:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.15);
        }
        .contact-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            color: rgba(41, 55, 84, 0.6);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        .dark .contact-label {
            color: #9ca3af;
        }
    </style>
</head>
<body class="page-container">
@include('components.navbar')

<main class="min-h-screen py-20 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <!-- Left Column: Info -->
            <div class="lg:col-span-5 space-y-12">
                <div>
                    <h1 class="text-5xl lg:text-6xl font-bold dark:text-white leading-tight mb-6">
                        <span class="lang-en">Let's build <span class="text-transparent bg-clip-text bg-linear-to-r from-primary to-blue-600 dark:from-blue-400 dark:to-indigo-400">something great</span> together.</span>
                        <span class="lang-id">Mari bangun <span class="text-transparent bg-clip-text bg-linear-to-r from-primary to-blue-600 dark:from-blue-400 dark:to-indigo-400">sesuatu yang hebat</span> bersama.</span>
                    </h1>
                    <p class="text-xl text-primary/70 dark:text-gray-400 leading-relaxed max-w-md">
                        <span class="lang-en">I'm currently available for new projects and collaborations. Drop me a line and let's start a conversation.</span>
                        <span class="lang-id">Saya saat ini tersedia untuk proyek dan kolaborasi baru. Kirim pesan dan mari mulai percakapan.</span>
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-primary/5 dark:bg-white/5 rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-primary/40 dark:text-gray-500 uppercase">
                                <span class="lang-en">Email Me</span>
                                <span class="lang-id">Email Saya</span>
                            </p>
                            <a class="text-lg font-bold dark:text-white hover:text-primary transition-colors" href="mailto:{{ $site_settings['contact_email'] ?? 'hello@example.com' }}">{{ $site_settings['contact_email'] ?? 'hello@example.com' }}</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 group">
                        <div class="w-12 h-12 bg-primary/5 dark:bg-white/5 rounded-full flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-300">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-primary/40 dark:text-gray-500 uppercase">
                                <span class="lang-en">Location</span>
                                <span class="lang-id">Lokasi</span>
                            </p>
                            <p class="text-lg font-bold dark:text-white">{{ $site_settings['contact_location'] ?? 'Jakarta, Indonesia (GMT+7)' }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-primary/10">
                    <p class="text-sm font-bold text-primary/60 dark:text-gray-400 uppercase mb-4 tracking-widest">
                        <span class="lang-en">Connect on Social</span>
                        <span class="lang-id">Terhubung di Sosial Media</span>
                    </p>
                    <div class="flex gap-4 flex-wrap">
                        @php $socialLinks = json_decode($site_settings['social_links'] ?? '[]', true) ?: []; @endphp
                        @forelse($socialLinks as $link)
                            @if(!empty($link['url']))
                            <a class="p-4 bg-white dark:bg-white/5 border border-primary/5 rounded-xl hover:border-primary transition-all" href="{{ $link['url'] }}" target="_blank">
                                <span class="text-sm font-bold dark:text-white">{{ $link['name'] }}</span>
                            </a>
                            @endif
                        @empty
                            <p class="text-sm text-primary/40 dark:text-gray-500 italic">No social links configured.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Map -->
                <div class="relative rounded-2xl overflow-hidden h-48 bg-primary/5 border border-primary/10 dark:bg-white/5">
                    @if(!empty($site_settings['contact_map_embed']))
                        <div class="absolute inset-0 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                            {!! $site_settings['contact_map_embed'] !!}
                        </div>
                    @else
                        <div class="absolute inset-0 grayscale opacity-40">
                            <img alt="Map background" class="w-full h-full object-cover blur-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmWtgKz3_0ADnhrbHCk4yL9cWmzAaVbQO8PRvo28ASHwNzUvr-rJAbDFW5VyPpXich7jNPOcjnEZWtXXpmbrcnvP61jgMu7sAI187l7d468Owo3qFTVVxT6BOCcqySTHdG1Ppt0K7R3-ScABka-DZ-69cQY5eDX_xV5AOoohAnkH1pmf3Jiqh2szogsThYIIMCvZUmsYsS5GjKZk5-0I9AG5h-wkW0tcuJQRbUi_KP3XQSQUcYAcPWtJ6wWOipAl4Ow-vlNzdDQTrz"/>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="relative">
                                <div class="w-4 h-4 bg-primary dark:bg-blue-400 rounded-full animate-ping absolute inset-0"></div>
                                <div class="w-4 h-4 bg-primary dark:bg-blue-400 rounded-full relative shadow-xl"></div>
                            </div>
                        </div>
                    @endif
                    <div class="absolute bottom-4 left-4 bg-white dark:bg-background-dark px-3 py-1.5 rounded-lg shadow-lg border border-primary/10">
                        <span class="text-xs font-bold dark:text-white">{{ $site_settings['contact_map_label'] ?? 'Jakarta, ID' }}</span>
                    </div>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-7" id="contact-form">
                @if(session('success'))
                <div class="mb-6 px-5 py-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-700 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 font-medium flex items-center gap-3">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-6 px-5 py-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl text-sm text-red-700 dark:text-red-300 font-medium">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-symbols-outlined text-lg">error</span>
                        <span>Terjadi kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside ml-6">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="bg-white dark:bg-white/3 p-8 lg:p-12 rounded-3xl border border-primary/5 shadow-2xl shadow-primary/5">
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-8" id="contactForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="contact-label" for="name">
                                    <span class="lang-en">Full Name</span>
                                    <span class="lang-id">Nama Lengkap</span>
                                </label>
                                <input class="contact-input" id="name" name="name" placeholder="Andrew Prince" required="" type="text"/>
                            </div>
                            <div>
                                <label class="contact-label" for="email">
                                    <span class="lang-en">Email Address</span>
                                    <span class="lang-id">Alamat Email</span>
                                </label>
                                <input class="contact-input" id="email" name="email" placeholder="andrew@company.com" required="" type="email"/>
                            </div>
                        </div>

                        <div>
                            <label class="contact-label" for="subject">
                                <span class="lang-en">Subject</span>
                                <span class="lang-id">Subjek</span>
                            </label>
                            <select class="contact-input" id="subject" name="subject">
                                <option value="new-project">
                                    New Project Inquiry / Proyek Baru
                                </option>
                                <option value="hi">
                                    Just Saying Hi / Sekedar Sapa
                                </option>
                                <option value="job">
                                    Job Opportunity / Peluang Kerja
                                </option>
                                <option value="other">
                                    Something Else / Lainnya
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="contact-label" for="message">
                                <span class="lang-en">Your Message</span>
                                <span class="lang-id">Pesan Anda</span>
                            </label>
                            <textarea class="contact-input" id="message" name="message" placeholder="Tell me about your vision... / Ceritakan visi Anda..." required="" rows="5" style="resize: none;"></textarea>
                        </div>

                        <button class="w-full bg-primary text-white py-5 rounded-xl font-bold text-lg flex items-center justify-center gap-3 hover:bg-primary/90 hover:scale-[1.01] transition-all shadow-xl shadow-primary/20 cursor-pointer" type="submit">
                            <span class="lang-en">Send Message</span>
                            <span class="lang-id">Kirim Pesan</span>
                            <span class="material-symbols-outlined">send</span>
                        </button>
                        @csrf
                        <p class="text-center text-sm text-primary/40 dark:text-gray-500">
                            <span class="lang-en">I usually respond within 24-48 hours.</span>
                            <span class="lang-id">Saya biasanya merespons dalam 24-48 jam.</span>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="py-12 border-t border-primary/10">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs">AP</div>
            <span class="font-bold text-primary dark:text-white">AndrewPrince.dev</span>
        </div>
        <p class="text-sm text-primary/40 dark:text-gray-500">
            <span class="lang-en">© 2024 AndrewPrince.dev — Built with logic and precision.</span>
            <span class="lang-id">© 2024 AndrewPrince.dev — Dibuat dengan logika dan presisi.</span>
        </p>
        <div class="flex gap-8">
            @php $footerSocials = json_decode($site_settings['social_links'] ?? '[]', true) ?: []; @endphp
            @foreach($footerSocials as $link)
                @if(!empty($link['url']))
                <a class="text-primary/60 hover:text-primary dark:text-gray-400 dark:hover:text-white transition-colors font-medium" href="{{ $link['url'] }}" target="_blank">{{ $link['name'] }}</a>
                @endif
            @endforeach
        </div>
    </div>
</footer>

</body>
</html>
