jQuery(document).ready(function ($) {
    const $input = $('#pdf-search-input');
    const $results = $('#pdf-search-results');
    let isSuggestionClick = false; // Track suggestion clicks

    // Append suggestions
    const suggestions = ['قانون', 'مرور', 'وزارة'];

    if (!$('.pdf-search-suggestions').length) {
        const $suggestionsContainer = $('<div class="pdf-search-suggestions"></div>');
        suggestions.forEach(term => {
            $suggestionsContainer.append(`<span class="pdf-search-suggestion">${term}</span>`);
        });
        $input.before($suggestionsContainer);
    }

    // Handle suggestion clicks
    $(document).on('click', '.pdf-search-suggestion', function () {
        const term = $(this).text();
        isSuggestionClick = true; // Set flag
        $input.val(term).trigger('input');
    });

    // Append spinner if not already there
    if (!$results.find('.loading-spinner').length) {
        $results.append('<div class="loading-spinner"></div>');
    }

    // Append result count container if not already there
    if (!$results.next('#pdf-search-count').length) {
        $results.after('<div id="pdf-search-count"></div>');
    }

    // Core search logic (unchanged)
    $input.on('input', function () {
        const searchTerm = $(this).val().trim();
        const $spinner = $('.loading-spinner');
        const $count = $('#pdf-search-count');

        if (searchTerm.length < 2) {
            $results.find('.pdf-result-card, .no-result').remove();
            $spinner.hide();
            $count.text('');
            return;
        }

        $spinner.show();
        $count.text('');

        $.ajax({
            url: pdfSearch.ajax_url,
            type: 'POST',
            data: {
                action: 'pdf_search',
                nonce: pdfSearch.nonce,
                term: searchTerm,
                from_suggestion: isSuggestionClick ? 1 : 0 // only added this line
            },
            success: function (response) {
                isSuggestionClick = false; // reset after request
                $results.find('.pdf-result-card, .no-result').remove();
                $spinner.hide();

                if (response.length === 0) {
                    $results.append('<div class="pdf-result-item no-result">No matches found.</div>');
                    $count.text('تم العثور على 0 نتيجة');
                    return;
                }

                response.forEach(function (item) {
                    $results.append(`
                        <div class="pdf-result-card">
                            <a href="${item.link}" target="_blank">${item.title}</a>
                        </div>
                    `);
                });

                $count.text(`تم العثور على ${response.length} نتيجة`);
            }
        });
    });
});
