<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package findhouse
 */

$the_theme = wp_get_theme();
$container = get_theme_mod('findhouse_container_type');
?>
<?php get_template_part('sidebar-templates/sidebar', 'footerfull'); ?>
<div class="wrapper" id="wrapper-footer">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
            <div class="wp-col-md-12">
                <footer class="site-footer" id="colophon">
                    <div class="site-info">
                        <?php printf(esc_html__('Copyright %s', 'findhouse'), date('Y')); ?>
                        <sep> -</sep>
                        <?php printf( // WPCS: XSS ok.
                        /* translators:*/
                            esc_html__('by %1$s.', 'findhouse'), '<a href="' . esc_url($the_theme->get('AuthorURI')) . '">' . $the_theme->get('Name') . '</a>'); ?>
                        <?php echo esc_html__('All rights reserved.', 'findhouse'); ?>
                        <?php echo esc_html__('Powered by', 'findhouse') ?>
                        <a href="<?php echo esc_url(esc_html__('http://wordpress.org/', 'findhouse')); ?>">WordPress</a>

                    </div><!-- .site-info -->

                </footer><!-- #colophon -->
            </div><!--col end -->
        </div><!-- row end -->
    </div><!-- container end -->
</div><!-- wrapper end -->