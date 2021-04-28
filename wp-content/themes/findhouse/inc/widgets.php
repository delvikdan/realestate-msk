<?php
/**
 * Declaring widgets
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('widgets_init', 'findhouse_widgets_init');

if (!function_exists('findhouse_widgets_init')) {
    /**
     * Initializes themes widgets.
     */
    function findhouse_widgets_init() {
        register_sidebar(array(
            'name' => esc_html__('Right Sidebar', 'findhouse'),
            'id' => 'right-sidebar',
            'description' => esc_html__('Right sidebar widget area', 'findhouse'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Left Sidebar', 'findhouse'),
            'id' => 'left-sidebar',
            'description' => esc_html__('Left sidebar widget area', 'findhouse'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));


        register_sidebar(array(
            'name' => esc_html__('User Sidebar', 'findhouse'),
            'id' => 'user-sidebar',
            'description' => esc_html__('User dashboard sidebar widget area', 'findhouse'),
            'before_widget' => '<aside id="%1$s" class="widget-no-border">',
            'after_widget' => '</aside>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
    }
} // endif function_exists( 'findhouse_widgets_init' ).
