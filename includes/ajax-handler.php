<?php
add_action('wp_ajax_pdf_search', 'handle_pdf_search_ajax');
add_action('wp_ajax_nopriv_pdf_search', 'handle_pdf_search_ajax');

function handle_pdf_search_ajax() {
    check_ajax_referer('pdf_search_nonce', 'nonce');

    $search_term = isset($_POST['term']) ? sanitize_text_field($_POST['term']) : '';
    $from_suggestion = isset($_POST['from_suggestion']) && intval($_POST['from_suggestion']) === 1;

    if (empty($search_term)) {
        wp_send_json([]);
    }

    $args = [
        'post_type' => ['post', 'page'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ];

    $query = new WP_Query($args);
    $results = [];

    if ($query->have_posts()) {
        foreach ($query->posts as $post) {
            $pdf_blocks = get_post_meta($post->ID, '_cpp_pdf_files', true);

            if (!empty($pdf_blocks) && is_array($pdf_blocks)) {
                foreach ($pdf_blocks as $block) {
                    if (!isset($block['title'])) continue;

                    $title = trim($block['title']);
                    $title_lc = mb_strtolower($title);
                    $search_lc = mb_strtolower($search_term);

                    if (strpos($title_lc, $search_lc) !== false) {
                        $results[] = [
                            'title' => esc_html($title),
                            'link'  => get_permalink($post->ID),
                        ];

                        // 💡 Stop adding more if limit reached and it's from suggestion
                        if ($from_suggestion && count($results) >= 10) {
                            wp_send_json($results);
                        }
                    }
                }
            }
        }
    }

    wp_send_json($results);
}
