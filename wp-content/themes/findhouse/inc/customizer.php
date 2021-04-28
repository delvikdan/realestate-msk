<?php
/**
 * findhouse Theme Customizer
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function findhouse_customize_preview_js()
{
    wp_enqueue_script('findhouse-customize-preview', get_theme_file_uri('/assets/js/customize-preview.js'), array('customize-preview'), '20181108', true);
}

add_action('customize_preview_init', 'findhouse_customize_preview_js', 99);


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('findhouse_customize_register')) {
    /**
     * Register basic customizer support.
     *
     * @param object $wp_customize Customizer reference.
     */
    function findhouse_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';


        $wp_customize->remove_section('fl-presets');  //Modify this line as needed


        /**
         * Primary color.
         */
        $wp_customize->add_setting(
            'primary_color',
            array(
                'default' => 'default',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'primary_color',
            array(
                'type' => 'radio',
                'label' => esc_html__('Primary Color', 'findhouse'),
                'choices' => array(
                    'default' => esc_html_x('Default', 'primary color', 'findhouse'),
                    'custom' => esc_html_x('Custom', 'primary color', 'findhouse'),
                ),
                'section' => 'color_style_theme',
                'priority' => 5,
            )
        );


        // Add primary color hue setting and control.
        $wp_customize->add_setting(
            'primary_color_hue',
            array(
                'default' => "",
                'transport' => 'postMessage',
                'sanitize_callback' => 'maybe_hash_hex_color',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'primary_color_hue',
                array(
                    'label' => esc_html__('Primary Color', 'findhouse'),
                    'description' => esc_html__('Apply a custom color for buttons, links, featured images, etc.', 'findhouse'),
                    'section' => 'color_style_theme',

                )
            )
        );

        // Add primary color hue setting and control.
        $wp_customize->add_setting(
            'secondary_color_hue',
            array(
                'default' => "",
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'secondary_color_hue',
                array(
                    'label' => esc_html__('Secondary Color', 'findhouse'),
                    'description' => esc_html__('Apply a custom color for buttons, links, featured images, etc.', 'findhouse'),
                    'section' => 'color_style_theme',

                )
            )
        );

        // Add primary color hue setting and control.
        $wp_customize->add_setting(
            'body_color_hue',
            array(
                'default' => "",
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );

        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'body_color_hue',
                array(
                    'label' => esc_html__('Body Color', 'findhouse'),
                    'section' => 'color_style_theme',
                )
            )
        );

        /**
         * Button Style.
         */
        $wp_customize->add_setting(
            'button_style',
            array(
                'default' => 'gradient',
                'transport' => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'button_style',
            array(
                'type' => 'select',
                'label' => esc_html__('Button Style', 'findhouse'),
                'choices' => array(
                    'default' => esc_html__('Default', 'findhouse'),
                    'gradient' => esc_html__('gradient', 'findhouse'),
                ),
                'section' => 'color_style_theme',
            )
        );


        $wp_customize->add_setting('gradient_color_left', array(
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        // enable product category
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'gradient_color_left', array(
                    'label' => esc_html__('Button Gradient Color', 'findhouse'),
                    'section' => 'color_style_theme',
                )
            )
        );

        $wp_customize->add_setting('gradient_color_right', array(
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        ));

        // enable product category
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'gradient_color_right', array(
                    'label' => '',
                    'section' => 'color_style_theme',
                )
            )
        );
    }
}
add_action('customize_register', 'findhouse_customize_register');

/**
 * Select sanitization function
 *
 * @param string $input Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function findhouse_theme_slug_sanitize_select($input, $setting)
{

    // Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
    $input = sanitize_key($input);

    // Get the list of possible select options.
    $choices = $setting->manager->get_control($setting->id)->choices;

    // If the input is a valid key, return it; otherwise, return the default.
    return (array_key_exists($input, $choices) ? $input : $setting->default);

}

/**
 * Register individual settings through customizer's API.
 *
 * @param WP_Customize_Manager $wp_customize Customizer reference.
 */
if (!function_exists('findhouse_theme_layout_customizer')) {

    function findhouse_theme_layout_customizer($wp_customize)
    {

        $wp_customize->add_panel('layout', array(
            'title' => esc_html__('Layout', 'findhouse'),
            'capability' => 'edit_theme_options',
            'priority' => 1,
        ));

        // Theme layout settings.
        $wp_customize->add_section('layout_theme', array(
            'title' => esc_html__('Theme', 'findhouse'),
            'capability' => 'edit_theme_options',
            'description' => esc_html__('Set layout global theme layout style', 'findhouse'),
            'priority' => 3,
            'panel' => 'layout'
        ));

        ///

        $wp_customize->add_setting('findhouse_layout_style', array(
            'default' => 'default',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_layout_style', array(
                    'label' => esc_html__('Global Layout Style', 'findhouse'),
                    'description' => esc_html__('Set global layout style boxed or fullwidth having custom background image, custom width.',
                        'findhouse'),
                    'section' => 'layout_theme',
                    'settings' => 'findhouse_layout_style',
                    'type' => 'select',
                    'choices' => array(
                        'default' => esc_html__('Default', 'findhouse'),
                        'boxed' => esc_html__('Boxed', 'findhouse'),

                    ),
                    'priority' => '2',
                )
            ));

    }
}
add_action('customize_register', 'findhouse_theme_layout_customizer');

/**
 * Register individual settings through customizer's API.
 *
 * @param WP_Customize_Manager $wp_customize Customizer reference.
 */
if (!function_exists('findhouse_post_layout_customize_register')) {

    function findhouse_post_layout_customize_register($wp_customize)
    {


        // Theme layout settings.
        $wp_customize->add_section('findhouse_blog_options', array(
            'title' => esc_html__('Post Settings', 'findhouse'),
            'capability' => 'edit_theme_options',
            'description' => esc_html__('Set blog layout display in varials style and design', 'findhouse'),
            'priority' => 3,
        ));


        $wp_customize->add_setting('findhouse_sidebar_position', array(
            'default' => 'right',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_sidebar_position', array(
                    'label' => esc_html__('Archive Sidebar Positioning', 'findhouse'),
                    'description' => esc_html__('Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
                        'findhouse'),
                    'section' => 'findhouse_blog_options',
                    'settings' => 'findhouse_sidebar_position',
                    'type' => 'select',
                    'sanitize_callback' => 'findhouse_theme_slug_sanitize_select',
                    'choices' => array(
                        'right' => esc_html__('Right sidebar', 'findhouse'),
                        'left' => esc_html__('Left sidebar', 'findhouse'),
                        'both' => esc_html__('Left & Right sidebars', 'findhouse'),
                        'none' => esc_html__('No sidebar', 'findhouse'),
                    ),
                    'priority' => '2',
                )
            ));

        // single blog post

        /// //
        $wp_customize->add_setting('findhouse_blog_archive_layout', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_blog_archive_layout', array(
                    'label' => esc_html__('Blog Archive layout', 'findhouse'),
                    'description' => esc_html__('Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
                        'findhouse'),
                    'section' => 'findhouse_blog_options',
                    'settings' => 'findhouse_blog_archive_layout',
                    'type' => 'select',
                    'sanitize_callback' => 'findhouse_theme_slug_sanitize_select',
                    'choices' => findhouse_get_blog_item_layouts(),
                    'priority' => '3',
                )
            ));
        /////// ///

        $wp_customize->add_setting('findhouse_sidebar_single_position', array(
            'default' => 'right',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_sidebar_single_position', array(
                    'label' => esc_html__('Single Sidebar Position', 'findhouse'),
                    'description' => esc_html__('Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
                        'findhouse'),
                    'section' => 'findhouse_blog_options',
                    'settings' => 'findhouse_sidebar_single_position',
                    'type' => 'select',
                    'sanitize_callback' => 'findhouse_theme_slug_sanitize_select',
                    'choices' => array(
                        'right' => esc_html__('Right sidebar', 'findhouse'),
                        'left' => esc_html__('Left sidebar', 'findhouse'),
                        'both' => esc_html__('Left & Right sidebars', 'findhouse'),
                        'none' => esc_html__('No sidebar', 'findhouse'),
                    ),
                    'priority' => '20',
                )
            ));
        // sidebar
        $wp_customize->add_setting('findhouse_blog_single_layout', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_blog_single_layout', array(
                    'label' => esc_html__('Single Layout', 'findhouse'),
                    'description' => esc_html__('Set single layout in view single post.',
                        'findhouse'),
                    'section' => 'findhouse_blog_options',
                    'settings' => 'findhouse_blog_single_layout',
                    'type' => 'select',
                    'sanitize_callback' => '',
                    'choices' => array(
                        '' => esc_html__('Basic Style', 'findhouse'),
                        'blog' => esc_html__('Style 1', 'findhouse'),
                        'blog-v2' => esc_html__('Style 2', 'findhouse'),
                        'blog-v3' => esc_html__('Style 3', 'findhouse')
                    ),
                    'priority' => '22',
                )
            ));

        // enable product category
        $wp_customize->add_setting(
            'findhouse_post_related', array(
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            )
        );

        $wp_customize->add_control(
            'findhouse_post_related', array(
                'type' => 'checkbox',
                'section' => 'findhouse_blog_options',
                'label' => esc_html__('Enable Post Related', 'findhouse'),
                'description' => esc_html__('Show post related by category.', 'findhouse'),
                'priority' => 2,
            )
        );

        /// / / /
        $wp_customize->add_setting(
            'findhouse_blog_columns',
            array(
                'default' => 1,
                'type' => 'theme_mod',
                'sanitize_callback' => 'absint',
                'sanitize_js_callback' => 'absint',
            )
        );

        $wp_customize->add_control(
            'findhouse_blog_columns',
            array(
                'label' => esc_html__('Blog per row', 'findhouse'),
                'description' => esc_html__('How many products should be shown per row?', 'findhouse'),
                'section' => 'findhouse_blog_options',
                'settings' => 'findhouse_blog_columns',
                'type' => 'number',
                'input_attrs' => array(
                    'min' => 1,
                    'max' => 5,
                    'step' => 1,
                ),
            )
        );

        /// enable or disable preloader
    }
}
add_action('customize_register', 'findhouse_post_layout_customize_register');

/**
 * Add customizer configuration for page preloader
 */
if (!function_exists('findhouse_customize_preloader')) {
    function findhouse_customize_preloader($wp_customize)
    {

        // Theme layout settings.
        $wp_customize->add_panel('layout_options', array(
            'title' => esc_html__('Preloader', 'findhouse'),
            'capability' => 'edit_theme_options',
            'description' => esc_html__('Set blog layout display in varials style and design', 'findhouse'),
            'priority' => 2
        ));


        // Theme layout settings.
        $wp_customize->add_section('container_options', array(
            'title' => esc_html__('Page Container', 'findhouse'),
            'capability' => 'edit_theme_options',
            'description' => esc_html__('Set blog layout display in varials style and design', 'findhouse'),
            'priority' => 2,
            'panel' => 'layout_options'
        ));

        $wp_customize->add_setting('findhouse_container_type', array(
            'default' => 'container',
            'type' => 'theme_mod',
            'sanitize_callback' => 'findhouse_theme_slug_sanitize_select',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_container_type', array(
                    'label' => esc_html__('Container Width', 'findhouse'),
                    'description' => esc_html__('Choose between Bootstrap\'s container and container-fluid', 'findhouse'),
                    'section' => 'container_options',
                    'settings' => 'findhouse_container_type',
                    'type' => 'select',
                    'choices' => array(
                        'container' => esc_html__('Fixed width container', 'findhouse'),
                        'container-fluid' => esc_html__('Full width container', 'findhouse'),
                    ),
                    'priority' => '1',
                )
            ));

        // Theme layout settings.
        $wp_customize->add_section('preload_layout_options', array(
            'title' => esc_html__('Page Preloader', 'findhouse'),
            'capability' => 'edit_theme_options',
            'description' => esc_html__('Set Page Preloader settings', 'findhouse'),
            'priority' => 2,
            'panel' => 'layout_options'
        ));

        $wp_customize->add_setting(
            'findhouse_preload_enable', array(
                'default' => false,
                'sanitize_callback' => 'wp_validate_boolean',
            )
        );

        $wp_customize->add_control(
            'findhouse_preload_enable', array(
                'type' => 'checkbox',
                'section' => 'preload_layout_options',
                'label' => esc_html__('Enable Page Preloader', 'findhouse'),
                'description' => esc_html__('Enable Page Preloader while loading pages.', 'findhouse'),
                'priority' => 2,
            )
        );

        $wp_customize->add_setting('findhouse_preload_logo', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'findhouse_preload_logo',
                array(
                    'label' => esc_html__('Upload a logo', 'findhouse'),
                    'section' => 'preload_layout_options',
                    'settings' => 'findhouse_preload_logo'
                )
            )
        );

        ///
        $wp_customize->add_setting('findhouse_preload_svg', array(
            'default' => '',
            'type' => 'theme_mod',
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'findhouse_preload_svg', array(
                    'label' => esc_html__('Svg Icon', 'findhouse'),
                    'description' => esc_html__('Select preloading icon showing on center of the panel',
                        'findhouse'),
                    'section' => 'preload_layout_options',
                    'settings' => 'findhouse_preload_svg',
                    'type' => 'select',
                    'sanitize_callback' => 'findhouse_theme_slug_sanitize_select',
                    'choices' => findhouse_svg_in_folders('loaders'),
                    'priority' => '3',
                )
            ));

        // Add page background color setting and control.
        $wp_customize->add_setting('findhouse_preload_bg', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport' => 'postMessage',
        ));

        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'findhouse_preload_bg', array(
            'label' => esc_html__('Page Background Color', 'findhouse'),
            'section' => 'preload_layout_options',
        )));
        //


        // Add page background color setting and control.
        // $wp_customize->add_setting('findhouse_preload_svgcolor', array(
        //     'default' => '',
        //     'sanitize_callback' => 'sanitize_hex_color',
        //     'transport' => 'postMessage',
        // ));
		//
        // $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'findhouse_preload_svgcolor', array(
        //     'label' => esc_html__('Svg Icon Color', 'findhouse'),
        //     'section' => 'preload_layout_options',
        // )));
    }
}
add_action('customize_register', 'findhouse_customize_preloader');

/**
 * Automatic set default values for postion and style, containner width after active the theme.
 */
if (!function_exists('findhouse_setup_theme_default_settings')) {
    function findhouse_setup_theme_default_settings()
    {

        // check if settings are set, if not set defaults.
        // Caution: DO NOT check existence using === always check with == .
        // Latest blog posts style.
        $findhouse_posts_index_style = get_theme_mod('findhouse_posts_index_style');
        if ('' == $findhouse_posts_index_style) {
            set_theme_mod('findhouse_posts_index_style', 'default');
        }

        // Sidebar position.
        $findhouse_sidebar_position = get_theme_mod('findhouse_sidebar_position');
        if ('' == $findhouse_sidebar_position) {
            set_theme_mod('findhouse_sidebar_position', 'right');
        }

        // Sidebar position.
        $findhouse_sidebar_single_position = get_theme_mod('findhouse_sidebar_single_position');
        if ('' == $findhouse_sidebar_single_position) {
            set_theme_mod('findhouse_sidebar_single_position', 'right');
        }

        // Container width.
        $findhouse_container_type = get_theme_mod('findhouse_container_type');
        if ('' == $findhouse_container_type) {
            set_theme_mod('findhouse_container_type', 'container');
        }


    }
}
?>