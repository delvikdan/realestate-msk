<?php
/**
 * The template for displaying search forms in Underscores.me
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
    <label class="sr-only"><?php esc_html_e('Поиск', 'findhouse'); ?></label>
    <div class="input-group">
        <input class="field form-control" name="s" type="text"
               placeholder="<?php esc_attr_e('Поиск &hellip;', 'findhouse'); ?>"
               value="<?php the_search_query(); ?>">
        <span class="input-group-append">
            <button class="btn searchsubmit" name="submit"> <i class="fa fa-search"> </i></button>
	</span>
    </div>
</form>
