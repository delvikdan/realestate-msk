<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php do_action('findhouse_content_bottom'); ?>
</div>

<?php do_action('findhouse_after_site_content'); ?>
<?php
/**
 * findhouse_before_footer hook.
 *
 * @since 0.1
 */
do_action('findhouse_before_footer');
?>

<div <?php findhouse_footer_class(); ?>>
    <?php
    /**
     * findhouse_before_footer_content hook.
     *
     * @since 0.1
     */
    do_action('findhouse_before_footer_content');

    /**
     * findhouse_footer hook.
     *
     * @since 1.3.42
     *
     * @hooked findhouse_construct_footer_widgets - 5
     * @hooked findhouse_construct_footer - 10
     */
    do_action('findhouse_footer');

    /**
     * findhouse_after_footer_content hook.
     *
     * @since 0.1
     */
    do_action('findhouse_after_footer_content');
    ?>
</div><!-- .site-footer -->


<?php if( is_page_template( 'page-templates/t-brand-page.php' ) ) :?>
  <script type="text/javascript">
    jQuery(document).ready(function(){
      jQuery('.fnslider').slick({
  arrows: true,
  dots: true,});
    });
  </script>
<?php endif;  ?>

</div></section>

<?php
/**
 * findhouse_after_footer hook.
 *
 * @since 2.1
 */
do_action('findhouse_after_footer');

wp_footer();

?>


</body>

</html>

