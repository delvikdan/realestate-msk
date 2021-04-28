
<?php 
$args = array(
    'posts_per_page' => 3, // we need only the latest post, so get that post only
    'cat' => '55', // Use the category id, can also replace with category_name which uses category slug
    //'category_name' => 'SLUG OF FOO CATEGORY,
);
$q = new WP_Query( $args);

if ( $q->have_posts() ): ?>

  <div class="offers-slider-area">
  <div class="offers-container-swapper"> 
  <div class="swiper-wrapper">
  
  
  
<?php while ( $q->have_posts() ) : ?>
<?php $q->the_post();   ?>

<?php if (has_post_thumbnail( $post->ID )) : ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); endif; ?>
<div class="offers-slider-item swiper-slide" style="background-image: url('<?php echo $image[0]; ?>')">
  <div class="offers-slider-overlay"></div>
  <div class="offers-inner">
  <?php the_title( '<h3 class="offers-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

    <?php the_excerpt(); ?>



  </div>
</div>

<?php endwhile; ?>
    </div>
     <div class="offers-button-next"><i class="eicon-chevron-right" aria-hidden="true"></i></div>
     <div class="offers-button-prev"><i class="eicon-chevron-left" aria-hidden="true"></i></div>

  </div>
</div>


<?php wp_reset_postdata(); 
endif;  ?>

