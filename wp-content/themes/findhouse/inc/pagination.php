<?php
/**
 * Pagination layout.
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!function_exists('findhouse_pagination')) {

    function findhouse_pagination($args = array(), $class = 'pagination')
    {
        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;
        $args = wp_parse_args($args, array(
            'mid_size' => 2,
            'prev_next' => true,
            'prev_text' => esc_html__('&laquo;', 'findhouse'),
            'next_text' => esc_html__('&raquo;', 'findhouse'),
            'screen_reader_text' => esc_html__('Posts navigation', 'findhouse'),
            'type' => 'array',
            'current' => max(1, get_query_var('paged')),
        ));
        $links = paginate_links($args);

        ?>
        <nav aria-label="<?php echo esc_html($args['screen_reader_text']); ?>">
            <ul class="pagination">
                <?php
                foreach ($links as $key => $link) { ?>
                    <li class="page-item <?php echo strpos($link, 'current') ? 'active' : '' ?>">
                        <?php echo str_replace('page-numbers', 'page-link', $link); ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <?php
    }
}

?>
