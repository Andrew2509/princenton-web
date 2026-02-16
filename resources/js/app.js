import './bootstrap';
import { inject } from '@vercel/analytics';
import { injectSpeedInsights } from '@vercel/speed-insights';

// Initialize Vercel Analytics
inject();

// Initialize Vercel Speed Insights
injectSpeedInsights();

// Theme Toggle Logic
document.addEventListener('DOMContentLoaded', () => {
    // --- Theme Toggle Logic ---
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');
    const htmlElement = document.documentElement;

    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        htmlElement.classList.add('dark');
        if (themeIcon) themeIcon.textContent = 'light_mode';
    }

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const isDark = htmlElement.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            if (themeIcon) themeIcon.textContent = isDark ? 'light_mode' : 'dark_mode';

            themeToggle.style.transform = 'scale(0.9)';
            setTimeout(() => themeToggle.style.transform = '', 100);
        });
    }

    // --- Language Switcher Logic ---
    const langBtn = document.getElementById('lang-btn');
    const langSwitcher = document.querySelector('.lang-switcher');

    if (langBtn && langSwitcher) {
        langBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            langSwitcher.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!langSwitcher.contains(e.target)) {
                langSwitcher.classList.remove('active');
            }
        });
    }

    // Ensure the root class matches the server-side locale (safety fallback)
    const currentLang = htmlElement.getAttribute('lang') || 'en';
    console.log('Antigravity Locale Sync:', currentLang);
    if (!htmlElement.classList.contains(`lang-${currentLang}`)) {
        htmlElement.classList.add(`lang-${currentLang}`);
    }
});
