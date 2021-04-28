<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $property, $post;
$property = opalesetate_property( get_the_ID() );



?>
<article itemscope itemtype="http://schema.org/Property" <?php post_class( 'property-grid-v3' ); ?> <?php if ( $property->is_featured() ) : ?>style="background-color: #ebedf7"<?php endif; ?>>
   
   
    <div class="property-grid">
        <header>
            <div class="property-group-label">
				<?php opalestate_property_label(); ?>
            </div>

            <div class="property-group-status">
		        <?php opalestate_property_status(); ?>
            </div>

			<?php opalestate_get_loop_thumbnail( opalestate_get_option( 'loop_image_size', 'large' ) ); ?>
            <div class="property-meta-bottom">
				<?php opalestate_property_loop_price(); ?>
            </div>
        </header>
        <div class="entry-content">

			<?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
           
    
            
            <div class="entry-summary">
                <div class="property-address">
					<?php // if ( $property->latitude && $property->longitude ) : ?>

					<?php //endif; ?>

	                <?php if ( $property->get_address() ) : ?>
                        <span class="property-address__text"><i class="fa fa-map-marker"></i><?php echo esc_html( $property->get_address() ); ?></span>
	                <?php endif; ?>
                </div>

                <?php $metro = get_post_meta( get_the_ID(), OPALESTATE_PROPERTY_PREFIX . 'metro', true ); ?>
                <?php $timetometro = get_post_meta( get_the_ID(), OPALESTATE_PROPERTY_PREFIX . 'timetometro', true ); ?>

                <div class="metro">
                 <?php if ($metro) : ?>
                 <span class="hint--top" aria-label="Ближайшее метро" title="Ближайшее метро"><i class="icon-property-metro fas fa-train"></i><?php echo esc_attr( $metro ); ?></span>
                  <?php endif; ?>
                  <?php if ($timetometro) : ?>
                  <span class="hint--top" aria-label="Время до метро" title="Время до метро"><i class="icon-property-timetometro fas fa-walking"></i><?php echo esc_attr( $timetometro ); ?></span>
                  <?php endif; ?>
                </div>
                
                
                
            </div>
			<?php opalestate_get_loop_short_meta(); ?>
       
       
       
      
       
       
        </div><!-- .entry-content -->

        <div class="entry-content-bottom clearfix">
			<?php echo wp_kses_post( $property->render_author_link() ); ?>
			<?php echo do_shortcode( '[opalestate_favorite_button property_id=' . get_the_ID() . ']' ); ?>
        </div>

		<?php do_action( 'opalestate_after_property_loop_item' ); ?>
    </div>    <!-- .property-grid -->
    <meta itemprop="url" content="<?php the_permalink(); ?>"/>
</article><!-- #post-## -->
