<?php if( have_rows('body_ads', 'option') ): 
  $numrows = count( get_field( 'body_ads', 'option' ) );
  ?>
    <div class="pr-body-area">
     <div class="prbox-container-swapper">
       <div class="swiper-wrapper">
        <?php while( have_rows('body_ads', 'option' ) ): the_row(); 

          $image = get_sub_field('body_ads_banner'); 
          $size = 'medium';
          $image_url = $image['sizes'][$size];
          $pr_excerpt = wp_trim_words( get_sub_field('body_ads_descr'), $num_words = 25, $more = '...' ); 
        ?>

        <div class="prbox-item swiper-slide">
          <div class="prbox-bg" style="background-image:url('<?php echo $image_url; ?>');"></div>
          <div class="prbox-label">Реклама</div>
          <div class="prbox-title"><a title="<?php the_sub_field('body_ads_title'); ?>" href="<?php the_sub_field('body_ads_link'); ?>"><?php the_sub_field('body_ads_title'); ?></a></div>
          <div class="prbox-descr"><?php echo $pr_excerpt; ?></div>
          <div class="prbox-opt"><?php the_sub_field('body_ads_opt'); ?></div>
          <div class="prbox-link"><a title="<?php the_sub_field('body_ads_title'); ?>" href="<?php the_sub_field('body_ads_link'); ?>">УЗНАТЬ ПОДРОБНЕЕ</a></div>
        </div>
        <?php 

         endwhile; ?>

        </div> 
        <?php // if ($numrows > 7) : ?>
        <div class="prbox-button-next"><i class="eicon-chevron-right" aria-hidden="true"></i></div>
        <div class="prbox-button-prev"><i class="eicon-chevron-left" aria-hidden="true"></i></div>
        <?php // endif; ?>
    </div> 
   </div>
<?php endif; ?>