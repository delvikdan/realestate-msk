<?php
/**
 * Partial template for content in page.php
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


    <div class="entry-content">

        <?php the_content(); ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'findhouse'),
            'after' => '</div>',
        ));
        ?>

    </div><!-- .entry-content -->


</article><!-- #post-## -->
