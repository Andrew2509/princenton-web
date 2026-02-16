/**
 * Auto-translation utility for Admin Panel (v3 MEGA-DEBUG)
 */

(function() {
    // ULTIMATE TEST: This should pop up immediately on page load
    console.log('[AutoTranslate] MEGA-DEBUG script loaded!');

    // Check if we are in admin area
    if (!window.location.pathname.includes('/admin')) {
        console.log('[AutoTranslate] Not in admin area, skipping.');
        return;
    }

    function initializeSystem() {
        if (window.atV3Initialized) return;
        window.atV3Initialized = true;

        console.log('[AutoTranslate] Initializing System v3...');

        let translationTimeout = null;
        const contactEmail = window.siteConfig?.contactEmail || 'admin@example.com';

        async function doTranslation(source, text) {
            const targetId = source.getAttribute('data-translate-target');
            if (!targetId || !text || text.trim().length === 0) return;

            const cleanText = text.trim();

            // SAFETY CHECK: Prevent 414 Request-URI Too Large
            // 1. Skip if text is too long (over 1000 chars is unlikely for a simple headline/label)
            if (cleanText.length > 2000) {
                console.warn(`[AutoTranslate] Skipping field #${targetId}: Text too long (${cleanText.length} chars).`);
                return;
            }

            // 2. Skip if it looks like Base64/Data URI
            if (cleanText.startsWith('data:') || cleanText.includes(';base64,')) {
                console.warn(`[AutoTranslate] Skipping field #${targetId}: Detected binary/Base64 data.`);
                return;
            }

            const target = document.getElementById(targetId);
            if (!target) {
                console.error(`[AutoTranslate] Target #${targetId} not found.`);
                return;
            }

            if (source.getAttribute('data-last-translated') === cleanText) return;

            console.log(`[AutoTranslate] Fetching: "${cleanText.substring(0, 50)}..." -> ${targetId}`);

            // UI Feedback
            target.classList.add('at-translating');
            const originalPlaceholder = target.placeholder;
            target.placeholder = 'Translating...';

            try {
                const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(cleanText)}&langpair=en|id&de=${encodeURIComponent(contactEmail)}`;
                const res = await fetch(url);
                if (!res.ok) throw new Error(`Status ${res.status}`);
                const data = await res.json();

                if (data.responseData?.translatedText) {
                    target.value = data.responseData.translatedText;
                    target.dispatchEvent(new Event('input', { bubbles: true }));
                    source.setAttribute('data-last-translated', cleanText);
                    console.log(`[AutoTranslate] Success: ${data.responseData.translatedText}`);
                } else {
                    console.warn('[AutoTranslate] Bad API response:', data);
                }
            } catch (err) {
                console.error('[AutoTranslate] API Error:', err);
                target.placeholder = 'Translation failed...';
            } finally {
                setTimeout(() => {
                    target.classList.remove('at-translating');
                    target.placeholder = originalPlaceholder;
                }, 500);
            }
        }

        function forceInjectButtons() {
            const fields = document.querySelectorAll('[data-translate-target]:not(.at-btn-injected)');
            if (fields.length > 0) {
                console.log(`[AutoTranslate] Injecting ${fields.length} buttons.`);
            }

            fields.forEach(field => {
                field.classList.add('at-btn-injected');

                const wrapper = document.createElement('div');
                wrapper.className = 'at-btn-wrapper';
                wrapper.innerHTML = `
                    <button type="button" class="at-manual-btn">
                        <span class="material-symbols-outlined" style="font-size:12px;">translate</span>
                        Translate
                    </button>
                `;

                const btn = wrapper.querySelector('button');
                btn.onclick = (e) => {
                    e.preventDefault();
                    console.log('[AutoTranslate] Manual button clicked.');
                    doTranslation(field, field.value);
                };

                // Position it relative to the field
                field.parentNode.style.position = 'relative';
                field.parentNode.appendChild(wrapper);
            });
        }

        // Run once
        forceInjectButtons();

        // Run on any DOM change
        const observer = new MutationObserver(() => forceInjectButtons());
        observer.observe(document.body, { childList: true, subtree: true });

        // Input listeners
        document.addEventListener('input', (e) => {
            if (e.target.hasAttribute?.('data-translate-target')) {
                if (translationTimeout) clearTimeout(translationTimeout);
                translationTimeout = setTimeout(() => doTranslation(e.target, e.target.value), 1500);
            }
        });

        // Styles
        if (!document.getElementById('at-v3-styles')) {
            const style = document.createElement('style');
            style.id = 'at-v3-styles';
            style.textContent = `
                .at-btn-wrapper {
                    position: absolute;
                    margin-top: -32px;
                    right: 12px;
                    z-index: 9999;
                }
                .at-manual-btn {
                    background: #3b82f6 !important;
                    color: white !important;
                    font-size: 10px !important;
                    font-weight: bold !important;
                    padding: 2px 8px !important;
                    border-radius: 4px !important;
                    border: none !important;
                    display: flex !important;
                    align-items: center !important;
                    gap: 4px !important;
                    cursor: pointer !important;
                    box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1) !important;
                    transition: all 0.2s !important;
                }
                .at-manual-btn:hover { background: #2563eb !important; transform: translateY(-1px) !important; }
                .at-translating { border: 2px dashed #3b82f6 !important; background: #eff6ff !important; }
            `;
            document.head.appendChild(style);
        }

        console.log('[AutoTranslate] V3 System Ready.');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeSystem);
    } else {
        initializeSystem();
    }
})();
