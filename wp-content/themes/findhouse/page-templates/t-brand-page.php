<?php
/*
Template Name: BRAND

*/
?>

<?php get_header(); ?>



<?php global $post, $agency;
//$idbrand = 533;
//$agency = opalesetate_agency( $idbrand );
//
//$maps    = $agency->get_meta( 'map' );
//$address = $agency->get_meta( 'address' );
//$rowcls  = apply_filters( 'opalestate_row_container_class', 'opal-row' );
//$id      = time();
?>



<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <div class="site-main wp-col-12" id="main">

                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('partials/loop/content', 'page'); ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; // end of the loop. ?>

            </div><!-- #main -->

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->



<script type='text/javascript' src='/wp-content/plugins/opal-widgets-for-elementor/assets/js/libs/slick.js?ver=1.8.1' id='jquery-slick-js'></script>

<?php get_footer(); ?> 