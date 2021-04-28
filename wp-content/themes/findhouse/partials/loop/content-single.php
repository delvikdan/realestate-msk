<?php
/**
 * Single post partial template.
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<?php do_action('findhouse_content_single_before'); ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post-thumbnail">
            <?php do_action('findhouse_single_post_preview'); ?>
        </div>
        <div class="entry-meta">
            <?php findhouse_posted_on(); ?>
        </div><!-- .entry-meta -->

        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'findhouse'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php findhouse_entry_footer(); ?>
            <?php do_action('findhouse_single_entry_footer_after'); ?>
        </footer><!-- .entry-footer -->

    </article><!-- #post-## -->

<?php do_action('findhouse_content_single_after'); ?>