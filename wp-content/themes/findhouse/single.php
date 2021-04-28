<?php
/**
 * The template for displaying all single posts.
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();

$layout = apply_filters('findhouse_blog_single_layout', get_theme_mod('findhouse_blog_single_layout'));

?>
<div class="wrapper" id="single-wrapper">

    <?php get_template_part('partials/single-layout/single', $layout); ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>
