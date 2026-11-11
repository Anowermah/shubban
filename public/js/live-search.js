/**
 * Global Instant Live Search for Shubban Website
 * Works on Desktop Header Search, Mobile Search Modal, and Drawer
 */
(function () {
    'use strict';

    function initLiveSearch() {
        const searchInputs = document.querySelectorAll('form[action*="/search"] input[name="q"], .search-box input[name="q"], .mobile-search-modal input[name="q"], .drawer-search-box input[name="q"]');

        if (!searchInputs.length) return;

        searchInputs.forEach(input => {
            const form = input.closest('form');
            if (!form) return;

            // Make sure form container has relative positioning
            form.style.position = 'relative';

            // Create dropdown container
            let dropdown = form.querySelector('.global-live-search-dropdown');
            if (!dropdown) {
                dropdown = document.createElement('div');
                dropdown.className = 'global-live-search-dropdown shadow-lg rounded-4 bg-white border';
                dropdown.style.display = 'none';
                form.appendChild(dropdown);
            }

            let debounceTimer = null;
            let currentAbortController = null;

            function hideDropdown() {
                dropdown.style.display = 'none';
                dropdown.innerHTML = '';
            }

            function showLoading() {
                dropdown.style.display = 'block';
                dropdown.innerHTML = `
                    <div class="p-3 text-center text-muted small">
                        <div class="spinner-border spinner-border-sm text-success me-2" role="status"></div>
                        অনুসন্ধান করা হচ্ছে...
                    </div>
                `;
            }

            async function performLiveSearch(term) {
                term = term.trim();
                if (term.length < 1) {
                    hideDropdown();
                    return;
                }

                if (currentAbortController) {
                    currentAbortController.abort();
                }
                currentAbortController = new AbortController();

                showLoading();

                try {
                    const searchUrl = `/search/live?q=${encodeURIComponent(term)}`;
                    const response = await fetch(searchUrl, {
                        signal: currentAbortController.signal,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) throw new Error('Search request failed');

                    const data = await response.json();
                    renderResults(data, term, form);
                } catch (err) {
                    if (err.name !== 'AbortError') {
                        dropdown.innerHTML = `
                            <div class="p-3 text-center text-muted small">
                                <i class="fas fa-exclamation-circle text-warning me-1"></i> সংযোগে ত্রুটি হয়েছে
                            </div>
                        `;
                    }
                }
            }

            function renderResults(data, term, targetForm) {
                if (!data || !data.results || data.results.length === 0) {
                    dropdown.innerHTML = `
                        <div class="p-3 text-center text-muted small">
                            <i class="fas fa-search-minus text-muted me-1"></i> "${term}"-এর সাথে কোনো ফলাফল মেলেনি
                        </div>
                    `;
                    dropdown.style.display = 'block';
                    return;
                }

                let html = '<div class="live-search-results-list py-2">';

                data.results.forEach(item => {
                    const badgeClass = item.category_badge || 'bg-success';
                    const iconClass = item.icon || 'fas fa-search';
                    const subtitle = item.subtitle ? `<div class="live-search-sub text-muted small text-truncate">${item.subtitle}</div>` : '';
                    
                    let thumbHtml = `<div class="live-search-icon-wrap rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"><i class="${iconClass}"></i></div>`;
                    if (item.image) {
                        thumbHtml = `<div class="live-search-thumb-wrap rounded-2 overflow-hidden flex-shrink-0"><img src="${item.image}" alt="" class="w-100 h-100 object-fit-cover" onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\\'live-search-icon-wrap rounded-circle d-flex align-items-center justify-content-center\\'><i class=\\'${iconClass}\\'></i></div>';"></div>`;
                    }

                    html += `
                        <a href="${item.url}" class="live-search-item d-flex align-items-center gap-3 px-3 py-2 text-decoration-none border-bottom">
                            ${thumbHtml}
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge ${badgeClass} rounded-pill font-xs px-2 py-0">${item.category}</span>
                                </div>
                                <div class="live-search-title fw-bold text-dark text-truncate">${item.title}</div>
                                ${subtitle}
                            </div>
                            <i class="fas fa-chevron-right text-muted font-xs"></i>
                        </a>
                    `;
                });

                html += '</div>';

                // Bottom link to full search
                html += `
                    <div class="live-search-footer p-2 text-center bg-light border-top rounded-bottom-4">
                        <button type="submit" class="btn btn-sm btn-link text-success text-decoration-none fw-bold p-0 font-sm">
                            সকল ফলাফল দেখুন (${data.total} টি পাওয়া গেছে) <i class="fas fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                `;

                dropdown.innerHTML = html;
                dropdown.style.display = 'block';

                // Allow clicking footer button to submit form
                const footerBtn = dropdown.querySelector('.live-search-footer button');
                if (footerBtn) {
                    footerBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        targetForm.submit();
                    });
                }
            }

            // Input Event Listener with Debounce
            input.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                const term = this.value;
                if (!term || term.trim().length === 0) {
                    hideDropdown();
                    return;
                }
                debounceTimer = setTimeout(() => {
                    performLiveSearch(term);
                }, 200);
            });

            // Focus shows results if query exists
            input.addEventListener('focus', function () {
                if (this.value.trim().length > 0) {
                    performLiveSearch(this.value);
                }
            });

            // Close when clicking outside
            document.addEventListener('click', function (e) {
                if (!form.contains(e.target)) {
                    hideDropdown();
                }
            });

            // Close on Escape key
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    hideDropdown();
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLiveSearch);
    } else {
        initLiveSearch();
    }
})();
