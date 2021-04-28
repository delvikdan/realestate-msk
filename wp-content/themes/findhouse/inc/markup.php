<?php
/**
 * Adds HTML markup.
 *
 * @package GeneratePress
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('findhouse_body_schema')) {
    /**
     * Figure out which schema tags to apply to the <body> element.
     *
     * @since 1.3.15
     */
    function findhouse_body_schema()
    {
        // Set up blog variable
        $blog = (is_home() || is_archive() || is_attachment() || is_tax() || is_single()) ? true : false;

        // Set up default itemtype
        $itemtype = 'WebPage';

        // Get itemtype for the blog
        $itemtype = ($blog) ? 'Blog' : $itemtype;

        // Get itemtype for search results
        $itemtype = (is_search()) ? 'SearchResultsPage' : $itemtype;

        // Get the result
        $result = esc_html(apply_filters('findhouse_body_itemtype', $itemtype));

        // Return our HTML
        echo "itemtype='https://schema.org/$result' itemscope='itemscope'"; // WPCS: XSS ok, sanitization ok.
    }
}

if (!function_exists('findhouse_article_schema')) {
    /**
     * Figure out which schema tags to apply to the <article> element
     * The function determines the itemtype: findhouse_article_schema( 'BlogPosting' )
     * @since 1.3.15
     */
    function findhouse_article_schema($type = 'CreativeWork')
    {
        // Get the itemtype
        $itemtype = esc_html(apply_filters('findhouse_article_itemtype', $type));

        // Print the results
        echo "itemtype='https://schema.org/$itemtype' itemscope='itemscope'"; // WPCS: XSS ok, sanitization ok.
    }
}

if (!function_exists('findhouse_footer_class')) {
    /**
     * Display the classes for the footer.
     *
     * @since 0.1
     * @param string|array $class One or more classes to add to the class list.
     */
    function findhouse_footer_class($class = '')
    {
        if ($class) {
            // Separates classes with a single space, collates classes for post DIV
            echo 'class="' . join(' ', findhouse_footer_classes($class)) . '"'; // WPCS: XSS ok, sanitization ok.
        }
    }
}

if (!function_exists('findhouse_footer_classes')) {
    add_filter('findhouse_footer_class', 'findhouse_footer_classes');
    /**
     * Adds custom classes to the footer.
     *
     * @since 0.1
     */
    function findhouse_footer_classes($classes)
    {
        $classes[] = 'site-footer';

        return $classes;
    }
}
