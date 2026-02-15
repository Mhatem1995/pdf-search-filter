jQuery(document).ready(function ($) {
    var $wrap    = $('.pdf-search-mobile-wrapper');
    if (!$wrap.length) return; // not on mobile page – bail out

    var $input   = $wrap.find('#pdf-mobile-search-input');
    var $results = $wrap.find('#pdf-mobile-search-results');
    var $loading = $wrap.find('#pdf-mobile-search-loading');
    var $count   = $wrap.find('#pdf-mobile-search-count');
    var $clear   = $wrap.find('.pdf-mobile-clear-btn');
    var isSuggestionClick = false;

    // ---- Clear button visibility ----
    $input.on('input', function () {
        $clear.toggle($input.val().length > 0);
    });

    $clear.on('click', function () {
        $input.val('').trigger('input').focus();
    });

    // ---- Suggestion clicks ----
    $wrap.on('click', '.pdf-mobile-suggestion', function () {
        var term = $(this).data('term');
        isSuggestionClick = true;
        $input.val(term).trigger('input');
    });

    // ---- Core search ----
    $input.on('input', function () {
        var searchTerm = $input.val().trim();

        if (searchTerm.length < 2) {
            $results.empty();
            $loading.hide();
            $count.text('');
            return;
        }

        $loading.show();
        $results.empty();
        $count.text('');

        $.ajax({
            url: pdfSearch.ajax_url,
            type: 'POST',
            data: {
                action: 'pdf_search',
                nonce: pdfSearch.nonce,
                term: searchTerm,
                from_suggestion: isSuggestionClick ? 1 : 0
            },
            success: function (response) {
                isSuggestionClick = false;
                $loading.hide();

                if (!response || response.length === 0) {
                    $results.html('<div class="pdf-mobile-no-result">لا توجد نتائج مطابقة</div>');
                    $count.text('تم العثور على 0 نتيجة');
                    return;
                }

                var html = '';
                response.forEach(function (item) {
                    html += '<div class="pdf-mobile-result-card">' +
                                '<a href="' + item.link + '" target="_blank">' + item.title + '</a>' +
                            '</div>';
                });
                $results.html(html);
                $count.text('تم العثور على ' + response.length + ' نتيجة');
            }
        });
    });
});
