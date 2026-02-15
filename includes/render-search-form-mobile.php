<div class="pdf-search-mobile-wrapper">
    <div class="pdf-mobile-header">
        <svg class="pdf-mobile-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <h2 class="pdf-mobile-title">البحث في القوانين</h2>
    </div>

    <div class="pdf-mobile-input-wrap">
        <input
            type="text"
            id="pdf-mobile-search-input"
            placeholder="ابحث باسم القانون أو رقمه..."
            autocomplete="off"
        />
        <span class="pdf-mobile-clear-btn" style="display:none;">&times;</span>
    </div>

    <div class="pdf-mobile-suggestions">
        <span class="pdf-mobile-suggestion" data-term="قانون">قانون</span>
        <span class="pdf-mobile-suggestion" data-term="مرور">مرور</span>
        <span class="pdf-mobile-suggestion" data-term="وزارة">وزارة</span>
    </div>

    <div id="pdf-mobile-search-count"></div>
    <div id="pdf-mobile-search-loading" style="display:none;">
        <div class="pdf-mobile-spinner"></div>
    </div>
    <div id="pdf-mobile-search-results"></div>
</div>
