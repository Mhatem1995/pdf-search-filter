<div class="pdf-search-mobile-wrapper">
    <div class="pdf-mobile-header">
        <div class="pdf-mobile-icon-circle">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
        </div>
        <h2 class="pdf-mobile-title">البحث في القوانين</h2>
        <p class="pdf-mobile-subtitle">ابحث في جميع القوانين والتشريعات</p>
    </div>

    <div class="pdf-mobile-input-wrap">
        <svg class="pdf-mobile-input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
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
