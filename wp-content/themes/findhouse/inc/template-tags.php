<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Render post meta data: show or hide author,date,categories,comment
 */
function findhouse_get_post_meta($atts = array())
{
    extract(shortcode_atts(array(
        'author' => 1,
        'avatar' => 0,
        'date' => 1,
        'cats' => 0,
        'tags' => 0,
        'limit_cats' => 0,
        'labels' => 0,
        'short' => false,
        'edit' => 1,
        'comments' => 1
    ), $atts));
    ?>
    <ul class="entry-meta-list">
        <?php if (get_post_type() === 'post'): ?>

            <?php // Is sticky ?>
            <li class="modified-date">
                <time class="updated"
                      datetime="<?php echo get_the_modified_date('c'); ?>"><?php echo get_the_modified_date(); ?></time>
            </li>
            <?php if (is_sticky()): ?>
                <li class="meta-featured-post"><?php esc_html_e('Featured', 'findhouse') ?></li>
            <?php endif; ?>
            <?php if ($author == 1): ?>
                <li class="meta-author">
                    <?php if ($labels == 1 && !$short): ?>
                        <span class="posted-by"><?php esc_html_e('Posted By', 'findhouse'); ?></span>
                    <?php elseif ($labels == 1 && $short): ?>
                        <span class="posted-by"><?php esc_html_e('By', 'findhouse'); ?></span>
                    <?php endif; ?>

                    <?php if ($avatar == 1): ?>
                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
                <span class="author author_name">
                  <span class="author-inner"><?php echo get_the_author(); ?></span>
                </span>
                    </a>
                </li>
            <?php endif ?>
            <?php if ($date == 1): ?>
                <li class="meta-date">
                    <?php esc_html_e('On', 'findhouse') . ' ' . get_the_date(); ?>
                </li>
            <?php endif ?>
            <?php if (get_the_category_list(', ') && $cats == 1): ?>
                <li class="meta-categories"><?php echo get_the_category_list(', '); ?></li>
            <?php endif; ?>
            <?php if (get_the_tag_list('', ', ') && $tags == 1): ?>
                <li class="meta-tags"><?php echo get_the_tag_list('', ', '); ?></li>
            <?php endif; ?>
            <?php if ($comments && comments_open()): ?>
                <li><span class="meta-reply">
              <?php
              $comment_link_template = '<span class="replies-count">%s</span> <span class="replies-count-label">%s</span>';
              ?>
              <?php comments_popup_link(
                  sprintf($comment_link_template, '0', esc_html__('comments', 'findhouse')),
                  sprintf($comment_link_template, '1', esc_html__('comment', 'findhouse')),
                  sprintf($comment_link_template, '%', esc_html__('comments', 'findhouse'))
              ); ?>
            </span></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
    <?php
}

if (!function_exists('findhouse_post_nav')) {
    /**
     * Prints HTML of next and previous in bottom single post style layout
     */
    function findhouse_post_nav()
    {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h3 class="screen-reader-text"><?php esc_html_e('Post navigation', 'findhouse'); ?></h3>
            <div class="nav-links clearfix">
                <?php

                if (is_attachment()) :
                    previous_post_link('%link', '<div class="col-lg-6"><span class="meta-nav">' . esc_html__('Published In', 'findhouse') . '</span>%title</div>');
                else : ?>
                <?php
                    if( $prev_post = get_previous_post() ):
                        $url = get_the_post_thumbnail_url($prev_post->ID, 'metro');
                    ?>
                    
                        <div class="nav-links-inner prev">
                            <div class="nav-img-bg" style="background-image:url('<?php echo esc_url($url); ?>');"></div>
                            <?php previous_post_link('%link', ' <i class="fa fa-long-arrow-left"></i> <div class="nav-content"> <div class="meta-nav">' . esc_html__('Назад', 'findhouse') . '</div><div class="nav-title">%title</div> </div>'); ?>
                        </div>
                   
                    <?php endif; ?>
                    <?php                        
                        if( $next_post = get_next_post() ):
                        $url = get_the_post_thumbnail_url($next_post->ID, 'metro');
                    ?>
                    
                   
                        <div class="nav-links-inner next text-right">
                            <div class="nav-img-bg" style="background-image:url('<?php echo esc_url($url); ?>');"></div>
                            <?php next_post_link('%link',  ' <div class="nav-content"> <div class="meta-nav">' . esc_html__('Далее', 'findhouse') . '</div><div class="nav-title">%title</div> </div> <i class="fa fa-long-arrow-right"></i>'); ?>
                        </div>
                  
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </nav><!-- .navigation -->
        <?php
    }
}
add_action('findhouse_content_single_after', 'findhouse_post_nav', 2);

if (!function_exists('findhouse_post_prev_next')) {
    /**
     * Prints HTML of next and previous in bottom single blog style layout
     */
    function findhouse_post_prev_next()
    {

        $post = get_next_post();
        $class = '';
        if ($post) {
            $class = 'fa fa-arrow-right';
            $text = esc_html__('Next', 'findhouse');
        } else {
            $post = get_previous_post();
            $class = 'fa fa-arrow-left';
            $text = esc_html__('Previous', 'findhouse');
        }

        ?>
        <div class="single-blog-nextprev">
            <div class="container  text-center">
                <a href="<?php echo get_post_permalink($post->ID); ?>" rel="<?php echo esc_attr($text); ?>">
                    <span class="blog-title"><?php echo esc_html($post->post_title); ?></span>
                    <span class="blog-navigation-text">
                      <?php echo esc_html($text); ?>
                  </span>
                    <span class="blog-navigation-icon">
                     <i class="<?php echo esc_attr($class); ?>"></i>
                  </span>
                </a>
            </div>
        </div>
        <?php
    }
}


if (!function_exists('findhouse_blog_posted_date')) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function findhouse_blog_posted_date()
    {

        // Get the author name; wrap it in a link.

        // Finally, let's write all of this to the page.
        echo '<div class="blog-posted-on">	<span class="post-date-day">' . get_the_time('d') . '</span> <span class="post-date-month"> ' . get_the_time('M') . '</span> </div>';
    }
}

if (!function_exists('findhouse_time_link')) {
    /**
     * Gets a nicely formatted string for the published date.
     */
    function findhouse_time_link()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            get_the_date(DATE_W3C),
            get_the_date(),
            get_the_modified_date(DATE_W3C),
            get_the_modified_date()
        );

        // Wrap the time string in a link, and preface it with 'Posted on'.
        return sprintf(
        /* translators: %s: post date */
            esc_html__('<span class="screen-reader-text">Posted on</span> %s', 'findhouse'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );
    }
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists('findhouse_posted_on')) {
    function findhouse_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }
        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );
        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'findhouse'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );
        $byline = sprintf(
            esc_html_x('By %s', 'post author', 'findhouse'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        ); ?>
        <div class="entry-meta-inner">
            <span class="posted-on"><?php echo trim( $posted_on ); ?></span>
            <?php 
            if(comments_open()) : ?>
            <span class="entry-comment"><i class="fa fa-commenting" aria-hidden="true"></i>
            <?php 
                $comment_link_template = '<span class="replies-count">%s</span>';
                comments_popup_link(
                    sprintf($comment_link_template, '0'),
                    sprintf($comment_link_template, '1'),
                    sprintf($comment_link_template, '%')
                ); ?>
            </span>
            <?php endif; ?>
<!--            <div class="byline"><?php echo trim( $byline ); ?></div>-->
        </div>
    <?php
    }
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if (!function_exists('findhouse_entry_footer')) {
    function findhouse_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__('', 'findhouse'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('%1$s', 'findhouse') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }
        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(esc_html__('Leave a comment', 'findhouse'), esc_html__('1 Comment', 'findhouse'), esc_html__('% Comments', 'findhouse'));
            echo '</span>';
        }
        
    }
}


/**
 * Call back to re-mark html and show comment in good look
 */
if (!function_exists('findhouse_theme_comment')) {
    function findhouse_theme_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $add_below = '';
        $comment_type = $comment->comment_type;
        ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="the-comment">
            <footer class="comment-meta">
                <?php if (!$comment_type) : ?>
                    <div class="wrap-avatar">
                        <?php echo get_avatar($comment, 54); ?>
                    </div>
                <?php endif; ?>
                <div class="comment-box">
                    <div class="comment-header">
                        <h6><?php echo get_comment_author_link() ?></h6>
                    </div>
                    <div class="comment-metadata">
                        <?php printf(esc_html__('%1$s at %2$s', 'findhouse'), get_comment_date(), get_comment_time()) ?></a>
                        <?php edit_comment_link(esc_html__('Edit', 'findhouse'), '  ', '') ?>
                        <?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'findhouse'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0') : ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.', 'findhouse') ?></em>
                            <br/>
                        <?php endif; ?>
                        <?php comment_text() ?>
                    </div>
                </div>
            </footer>
        </div>

    <?php }
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if (!function_exists('findhouse_categorized_blog')) {
    function findhouse_categorized_blog()
    {
        if (false === ($all_the_cool_cats = get_transient('findhouse_categories'))) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories(array(
                'fields' => 'ids',
                'hide_empty' => 1,
                // We only need to know if there is more than one category.
                'number' => 2,
            ));
            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count($all_the_cool_cats);
            set_transient('findhouse_categories', $all_the_cool_cats);
        }
        if ($all_the_cool_cats > 1) {
            // This blog has more than 1 category so components_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so components_categorized_blog should return false.
            return false;
        }
    }
}


/**
 * Flush out the transients used in findhouse_categorized_blog.
 */
add_action('edit_category', 'findhouse_category_transient_flusher');
add_action('save_post', 'findhouse_category_transient_flusher');

if (!function_exists('findhouse_category_transient_flusher')) {
    function findhouse_category_transient_flusher()
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Like, beat it. Dig?
        delete_transient('findhouse_categories');
    }
}


if (!function_exists('findhouse_get_svg_icon')) {
    function findhouse_get_svg_icon($name)
    {

    }
}


