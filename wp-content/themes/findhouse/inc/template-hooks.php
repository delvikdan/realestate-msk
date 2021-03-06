<?php
/**
 * Custom hooks.
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function findhouse_add_layout_style_option_body_class($classes)
{
    if (get_theme_mod('findhouse_layout_style') == 'boxed') {
        $classes[] = 'layout-boxed';
    }
    return $classes;
}

add_filter('body_class', 'findhouse_add_layout_style_option_body_class');


function findhouse_render_offcanvas()
{

}

add_action('wp_footer', "findhouse_render_offcanvas", 99);


if (function_exists("wpopal_social_share_post")) {
    add_action("findhouse_single_entry_footer_after", "wpopal_social_share_post");
}

/**
 * Display related posts in single post page
 */
add_action('findhouse_content_single_after', 'findhouse_post_related', 2);

function findhouse_post_related()
{
    if (get_theme_mod('findhouse_post_related')) {
        echo findhouse_post_related_html(6, 'post', 'category');
    }
}


/**
 * Display custom color CSS in customizer and on frontend.
 */
function findhouse_colors_css_wrap()
{

    // Only include custom colors in customizer or frontend.
    if ((!is_customize_preview() && 'default' === get_theme_mod('primary_color', 'default')) || is_admin()) {
        return;
    }
    require_once get_parent_theme_file_path('/inc/color-patterns.php');

    $primary_color = "";
    if ('default' !== get_theme_mod('primary_color', 'default')) {
        $primary_color = get_theme_mod('primary_color_hue', "");
    }
    $secondary_color = get_theme_mod('secondary_color_hue', "");


    ?>

    <style type="text/css"
           id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . esc_attr($primary_color) . '" data-secondary="' . $secondary_color . '"' : ''; ?>>
        <?php echo findhouse_custom_colors_css(); ?>
    </style>
    <?php
}

add_action('wp_head', 'findhouse_colors_css_wrap', 9999);


// Comments form.
add_filter('comment_form_default_fields', 'findhouse_bootstrap_comment_form_fields');

/**
 * Creates the comments form.
 *
 * @param string $fields Form fields.
 *
 * @return array
 */
if (!function_exists('findhouse_bootstrap_comment_form_fields')) {

    function findhouse_bootstrap_comment_form_fields($fields)
    {
        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = current_theme_supports('html5', 'comment-form') ? 1 : 0;
        $consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
        $fields = array(
            'author' => '<div class="form-group comment-form-author"><label for="author">' . esc_html__('Name',
                    'findhouse') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input class="form-control" id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'findhouse') . '" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . '></div>',
            'email' => '<div class="form-group comment-form-email"><label for="email">' . esc_html__('Email',
                    'findhouse') . ($req ? ' <span class="required">*</span>' : '') . '</label> ' .
                '<input class="form-control" id="email" name="email" placeholder="' . esc_attr__( 'Email', 'findhouse') . ' " ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . '></div>',
            'url' => '<div class="form-group comment-form-url"><label for="url">' . esc_html__('Website',
                    'findhouse') . '</label> ' .
                '<input class="form-control" id="url" name="url" placeholder="' . esc_attr__( 'Website', 'findhouse') . '" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" size="30"></div>',
            'cookies' => '<div class="form-group form-check comment-form-cookies-consent"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' /> ' .
                '<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment', 'findhouse') . '</label></div>',
        );

        return $fields;
    }
} // endif function_exists( 'findhouse_bootstrap_comment_form_fields' )

add_filter('comment_form_defaults', 'findhouse_bootstrap_comment_form');

/**
 * Builds the form.
 *
 * @param string $args Arguments for form's fields.
 *
 * @return mixed
 */

if (!function_exists('findhouse_bootstrap_comment_form')) {

    function findhouse_bootstrap_comment_form($args)
    {
        $args['comment_field'] = '<div class="form-group comment-form-comment">
      <label for="comment">' . esc_html_x('??????????????????????', 'noun', 'findhouse') . (' <span class="required">*</span>') . '</label>
      <textarea class="form-control" id="comment" name="comment" aria-required="true" cols="45" rows="8" placeholder="' . esc_attr__( '??????????????????????', 'findhouse') . '" ></textarea>
      </div>';
        $args['submit_button']='<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>';
        $args['class_submit'] = 'btn btn-primary button-lg btn-arrow-right btn-full'; // since WP 4.1.
        $args['label_submit'] = '??????????????????';
        return $args;
    }
} // endif function_exists( 'findhouse_bootstrap_comment_form' )

function findhouse_blog_columns_class($colclss)
{

    $col = get_theme_mod('findhouse_blog_columns');

    if ($col) {
        $col = floor(12 / $col);

        return "wp-col-md-" . $col . ' wp-col-sm-6 ';
    }

    return $colclss;
}

add_filter('findhouse_blog_columns_class', 'findhouse_blog_columns_class');


/**
 * Add Preloader Page animation
 */

add_action('findhouse_before_header', 'findhouse_page_preloader');
function findhouse_page_preloader()
{
    if ( ! get_theme_mod('findhouse_preload_enable') ) {
        return;
    }

    $bg = get_theme_mod('findhouse_preload_bg');
    $svg = get_theme_mod('findhouse_preload_svg');
    $color = get_theme_mod('findhouse_preload_svgcolor');
    $img = get_theme_mod('findhouse_preload_logo');
    $style = array();
    $classes = array();

    if ($bg) {
        $style[] = 'background-color:' . $bg;
    }
    $classes[] = 'page-loading clearfix';

    if (is_customize_preview()) {
        $classes[] = 'is-preview';
    }
    $svg = $svg ? 'loaders/' . $svg : 'loaders/' . 'audio';
    $color = $color ? $color : '#000';
    ?>
    <div id="page-preloader" <?php if ($style): ?> style="<?php echo implode(" ;", $style); ?>" <?php endif; ?>
         class="<?php echo implode(" ", $classes); ?>">
        <div class="page-load-inner">

            <div class="preloader-content">
                <?php if ($img): ?>
                    <div class="preloader-img"><img alt="<?php echo esc_attr('Preloader images', 'findhouse'); ?>"
                                                    src="<?php echo esc_attr($img); ?>"></div>
                <?php endif; ?>
                <div class="preloader-icon"><img alt="<?php echo esc_attr('Preloader icon', 'findhouse'); ?>"
                                                 src="<?php echo findhouse_get_svg($svg, $color); ?>"></div>
            </div>
        </div>
    </div>
<?php }

/**
 * Display header block layout
 */
add_action('findhouse_header', 'findhouse_header');
function findhouse_header()
{
    get_template_part('partials/header/default');
}

/**
 * Display footer block layout
 */
add_action('findhouse_footer', 'findhouse_footer');
function findhouse_footer()
{
    get_template_part('partials/footer/default');
}

/// back to top
add_action('wp_footer', 'findhouse_back_to_top');
function findhouse_back_to_top()
{
    echo '<a href="#" id="back-to-top"><i class="fa fa-angle-up"></i>' . esc_html__('', 'findhouse') . '</a>';
}


function findhouse_breadcrumbs_simple(){ 
  if ( function_exists('bcn_display') ) {
        ?>
        <div class="breadcrumbs breadcrumb-simple-style" typeof="BreadcrumbList" vocab="http://schema.org/">
            <div class="container">
                <?php bcn_display(); ?>
            </div>
        </div>
        <?php
    } else { ?>
      <div class="breadcrumbs breadcrumb-simple-style" typeof="BreadcrumbList" vocab="http://schema.org/">
            <div class="container">
                <?php  get_template_part('partials/common/breadcrumb');  ?>
<!--
                <div class="breadcrumbs_title">
                    <?php //  findhouse_breadcrumb_title(); ?>
                </div>
-->
            </div>
      </div>
    <?php }
}

/**
 * Breadcrumb NavXT Compatibility.
 */

add_action('findhouse_before_site_content', 'findhouse_breadcrumb');
function findhouse_breadcrumb($post_id = null)
{

    $cssBreadcrumbs = '';
    $breadcrumbs_bg_color = ($breadcrumbs_bg_color = get_post_meta(get_the_ID(), 'osf_breadcrumb_bg_color', 1)) ? $breadcrumbs_bg_color : get_theme_mod('layout_bcn_bgc');
    $breadcrumbs_bg_image = ($breadcrumbs_bg_image = get_post_meta(get_the_ID(), 'osf_breadcrumb_bg_image', 1)) ? $breadcrumbs_bg_image : get_theme_mod('layout_bcn_bg');
    $breadcrumb_padding_top = ($breadcrumb_padding_top = get_post_meta(get_the_ID(), 'layout_options_bcn_pt', 1)) ? $breadcrumb_padding_top : get_theme_mod('layout_options_bcn_pt');
    $breadcrumb_padding_bottom = ($breadcrumb_padding_bottom = get_post_meta(get_the_ID(), 'layout_options_bcn_pb', 1)) ? $breadcrumb_padding_bottom : get_theme_mod('layout_options_bcn_pb');

    if (!empty($breadcrumbs_bg_color)) {
        $cssBreadcrumbs .= "background-color: {$breadcrumbs_bg_color};";
    }

    if (!empty($breadcrumbs_bg_image)) {
        $cssBreadcrumbs .= "background-image: url({$breadcrumbs_bg_image});";
    }

    if (!empty($breadcrumb_padding_top)) {
        $cssBreadcrumbs .= "padding-top: {$breadcrumb_padding_top}px;";
    }

    if (!empty($breadcrumb_padding_bottom)) {
        $cssBreadcrumbs .= "padding-bottom: {$breadcrumb_padding_bottom}px;";
    }
    if (!$post_id) {
        if (is_page()) {
            $post_id = get_the_ID();
        }
    }
    if ($post_id) {
        $hb = get_post_meta($post_id, 'osf_hide_breadcrumb', true);

        if ($hb != "" && $hb == 0) {
            return;
        }

        $slug = get_post_field('post_name', $post_id);

        if (preg_match("#home#", $slug)) {
            return true;
        }
    }
    else if (is_404()) {
        return true;
    }

    if (function_exists('bcn_display')) { ?>
        <div style="<?php echo esc_html($cssBreadcrumbs); ?>" class="breadcrumbs" typeof="BreadcrumbList"
             vocab="http://schema.org/">
            <div class="container">
<!--
                <div class="breadcrumbs_title">
                    <?php // findhouse_breadcrumb_title(); ?>
                </div>
-->
                <?php bcn_display(); ?>
            </div>
        </div>
        <?php
    } else { ?>
        <div style="<?php echo esc_html($cssBreadcrumbs); ?>" class="breadcrumbs" typeof="BreadcrumbList"
             vocab="http://schema.org/">
            <div class="container">
<!--
                <div class="breadcrumbs_title">
                    <?php // findhouse_breadcrumb_title(); ?>
                </div>
-->
                <?php get_template_part('partials/common/breadcrumb'); ?>
            </div>
        </div>

    <?php }

}

if (!function_exists('findhouse_breadcrumb_title')) {
    function findhouse_breadcrumb_title()
    {
        global $post;
        $shop_title = esc_html__('Shop', 'findhouse');
        $wbt_title = esc_html__('Blog', 'findhouse');
        $otf_args = '';
        if (function_exists('is_shop') && is_product()) {
            return true;
        }

        if (!is_front_page()) {
            if (function_exists('is_shop') && is_shop()) {
                $wbt_title = $shop_title;
            }
            if (is_home()) {

            } else {
                if (is_single()) {
                    $wbt_title = get_the_title();
                } else {
                    
                    if (is_archive() && is_tax() && !is_category() && !is_tag()) {
                        $tax_object = get_queried_object();
                        if (!empty($tax_object)) {
                            $wbt_title = esc_html($tax_object->name);
                        }
                    } else {
                        if( is_archive()  && get_post_type() == 'opalestate_property' ) {
                            $wbt_title = esc_html__('Properties', 'findhouse');
                        }
                        if (is_category()) {
                            $wbt_title = single_cat_title('', false);
                        } else {
                            if (is_page()) {
                                $wbt_title = get_the_title();
                            }
                            if (is_tag()) {

                                // Get tag information
                                $wbt_term_id = get_query_var('tag_id');
                                $wbt_taxonomy = 'post_tag';
                                $wbt_args = 'include=' . $wbt_term_id;
                                $wbt_terms = get_terms($wbt_taxonomy, $otf_args);

                                // Display the tag name
                                if (isset($wbt_terms[0]->name)) {
                                    $wbt_title = $wbt_terms[0]->name;
                                }
                            }
                            if (is_day()) {
                                $wbt_title = esc_html__('Day', 'findhouse');
                            } else {
                                if (is_month()) {
                                    $wbt_title = esc_html__('Month', 'findhouse');
                                } else {
                                    if (is_year()) {
                                        $wbt_title = esc_html__('Year', 'findhouse');
                                    } else {
                                        if (is_author()) {
                                            global $author;
                                            if (!empty($author->ID)) {
                                                $wbt_title = esc_html__('Author', 'findhouse');
                                            }
                                        } else {
                                            if (is_search()) {
                                                $wbt_title = esc_html__('Search', 'findhouse');
                                            } elseif (is_404()) {
                                                $wbt_title = esc_html__('Error 404', 'findhouse');
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                }
            } ?>
            <h1 class="title"><?php echo esc_html($wbt_title); ?></h1>
            <?php
        }
    }
}


if (!function_exists('findhouse_site_info')) {
    /**
     * Add site info hook to WP hook library.
     */
    function findhouse_site_info()
    {
        do_action('findhouse_site_info');
    }
}

if (!function_exists('findhouse_add_site_info')) {
    add_action('findhouse_site_info', 'findhouse_add_site_info');

    /**
     * Add site info content.
     */
    function findhouse_add_site_info()
    {
        $the_theme = wp_get_theme();

        $site_info = sprintf(
            '<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
            esc_url(esc_html__('http://wordpress.org/', 'findhouse')),
            sprintf(
            /* translators:*/
                esc_html__('Proudly powered by %s', 'findhouse'), 'WordPress'
            ),
            sprintf( // WPCS: XSS ok.
            /* translators:*/
                esc_html__('Theme: %1$s by %2$s.', 'findhouse'), $the_theme->get('Name'), '<a href="' . esc_url(esc_html__('http://wpopal.com', 'findhouse')) . '">wpopal.com</a>'
            ),
            sprintf( // WPCS: XSS ok.
            /* translators:*/
                esc_html__('Version: %1$s', 'findhouse'), $the_theme->get('Version')
            )
        );

        echo apply_filters('findhouse_site_info_content', $site_info); // WPCS: XSS ok.
    }
}


if (!function_exists("findhouse_blog_single_layout")) {
    function findhouse_blog_single_layout($value)
    {
        if (empty($value)) {
            return 'single';
        }
    }
}

/**
 * Set sidebar position
 */
function findhouse_sidebar_position($pos)
{
    if (is_single() && get_post_type() == 'post') {
        return get_theme_mod('findhouse_sidebar_single_position');
    }
    return $pos;
}

add_filter('findhouse_sidebar_position', 'findhouse_sidebar_position');
if (!function_exists('findhouse_service_loop_layouts')) {
    function findhouse_service_loop_layouts()
    {
        $array = array(
            'grid_v1' => esc_html__('Grid_V1 (Default)', 'findhouse'),
            'grid_v3' => esc_html__('Grid_V2', 'findhouse')
        );
        return $array;
    }
}
add_filter('service_loop_layouts', 'findhouse_service_loop_layouts');

if (!function_exists('findhouse_product_loop_layouts')) {
    function findhouse_product_loop_layouts()
    {
        $array = array('content' => esc_html__('Grid By Current Theme', 'findhouse'));
        return $array;
    }
}
add_filter('osf_elementor_product_loop_layouts', 'findhouse_product_loop_layouts');
add_filter('osf_elementor_product_loop_deal_layouts', 'findhouse_product_loop_layouts');