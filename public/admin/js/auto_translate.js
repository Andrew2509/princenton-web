/**
 * Auto-translation utility for Admin Panel
 * Uses MyMemory API (en -> id)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Listen for paste events on elements with data-translate-target
    document.addEventListener('paste', async (e) => {
        const source = e.target;
        const targetId = source.getAttribute('data-translate-target');

        if (!targetId) return;

        const target = document.getElementById(targetId);
        if (!target) {
            console.warn(`Translation target with ID "${targetId}" not found.`);
            return;
        }

        // Capture original placeholder if not already captured (for dynamic elements)
        if (!target.hasAttribute('data-original-placeholder')) {
            target.setAttribute('data-original-placeholder', target.placeholder || '');
        }

        // Get pasted text
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        if (!pastedText) return;

        // Visual feedback: Start translating
        target.classList.add('translating');
        target.placeholder = 'Translating...';
        const originalOpacity = target.style.opacity;
        target.style.opacity = '0.5';

        try {
            const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(pastedText)}&langpair=en|id`;
            const response = await fetch(url);
            const data = await response.json();

            if (data.responseData && data.responseData.translatedText) {
                target.value = data.responseData.translatedText;
                // Dispatch input event to trigger any listeners (like char counters)
                target.dispatchEvent(new Event('input', { bubbles: true }));
            }
        } catch (error) {
            console.error('Translation error:', error);
        } finally {
            // Visual feedback: Stop translating
            target.classList.remove('translating');
            target.style.opacity = originalOpacity || '1';
            target.placeholder = target.getAttribute('data-original-placeholder') || '';
        }
    });
});

// CSS for translating state (can be added to global CSS or inline)
const style = document.createElement('style');
style.textContent = `
    .translating {
        border-style: dashed !important;
        border-color: #3b82f6 !important;
        transition: all 0.3s ease;
    }
`;
document.head.appendChild(style);
