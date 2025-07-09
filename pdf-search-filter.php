<?php
/**
 * Plugin Name: PDF Search Filter
 * Description: AJAX search plugin for PDF meta box titles.  Contact: mhatem1995@yahoo.com
 * Version: 1.8
 * Author: Marwan Hatem
 * Author URI: linkedin.com/in/marwan-hatem-713269211/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Enqueue JS and CSS
function pdf_search_filter_enqueue_assets() {
    wp_enqueue_script(
        'pdf-search-script',
        plugin_dir_url( __FILE__ ) . 'assets/js/search.js',
        ['jquery'],
        '1.0.0',
        true
    );

    wp_localize_script('pdf-search-script', 'pdfSearch', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('pdf_search_nonce')
    ]);

    wp_enqueue_style(
        'pdf-search-style',
        plugin_dir_url( __FILE__ ) . 'assets/css/search.css',
        [],
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'pdf_search_filter_enqueue_assets');

// Shortcode to render search form
function pdf_search_filter_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'includes/render-search-form.php';
    return ob_get_clean();
}
add_shortcode('pdf_search_form', 'pdf_search_filter_shortcode');

// Include AJAX handler
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
