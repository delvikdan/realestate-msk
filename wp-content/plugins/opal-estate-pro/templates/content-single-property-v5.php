<?php global $property, $post;

$property = opalesetate_property( get_the_ID() );
$header   = apply_filters( 'opalestate_single_show_heading', true );
?>
<div class="agency-nav-tabs">
<div class="opalestate-tab">




<div class="property-single-top ">
	<?php
	/**
	 * opalestate_before_single_property_summary hook
	 */
	do_action( 'opalestate_single_property_preview' );
	?>

  <?php if( have_rows('plan') ): ?>
  <div class="nav opalestate-tab-head" role="tablist" style="max-width:1200px;margin:0 auto;">

    <a aria-expanded="true" href="#tab-content-description" role="tab" class="tab-item"><span>ОПИСАНИЕ</span></a>
    <a aria-expanded="true" href="#tab-content-planirovki" role="tab" class="tab-item"><span>ПЛАНИРОВКИ</span></a>

  </div>

</div>
<div class="opalestate-tab-content" id="tab-content-description">

  <?php else: ?>
</div> 
 <div>
  <?php endif; ?>
    <div class="property-single-stick-bars keep-top-bars ">
        <div class="container">
            <ul class="list-inline opalestate-scroll-elements">
                <li><a href="#block-description"><?php esc_html_e( 'О проекте', 'opalestate-pro' ); ?></a></li>
                
				<?php if ( $property->get_block_setting( 'apartments' ) && $property->get_apartments() ) : ?>
                    <li><a href="#block-apartments"><?php esc_html_e( 'Квартиры', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>
				
				<?php if ( $property->get_block_setting( 'map' ) && apply_filters( 'opalestate_single_show_map', true ) ) : ?>
                    <li><a href="#block-map"><?php esc_html_e( 'Расположение', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>
				
				<?php if ( $property->get_block_setting( 'video' ) ) : ?>
                    <li><a href="#block-video"><?php esc_html_e( 'Video', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>

<!--
				<?php if ( $property->get_block_setting( 'walkscores' ) ) : ?>
                    <li><a href="#block-scores"><?php esc_html_e( 'Scores', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>
-->
				
				<?php if ( $property->get_block_setting( 'views_statistics' ) ) : ?>
                    <li><a href="#block-statistics"><?php esc_html_e( 'Статистика', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>

<!--
				<?php if ( $property->get_block_setting( 'floor_plans' ) && $property->get_floor_plans() ) : ?>
                    <li><a href="#block-floor-plans"><?php esc_html_e( 'Планировка', 'opalestate-pro' ); ?></a></li>
				<?php endif; ?>
-->
               
                <li><a href="#reviews"><?php esc_html_e( 'Отзывы', 'opalestate-pro' ); ?></a></li>
                <li class="single-property-buttons">
					<?php opalestate_property_request_viewing_button(); ?>
                </li>
            </ul>
        </div>
    </div>


<div class="container">
    <article id="property-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Property" <?php post_class( "opalestate-single-property opalestate-single-property--version-5" ); ?>>
        <meta itemprop="url" content="<?php the_permalink(); ?>"/>
        <div class="opal-row">
            <div class="col-lg-8 col-md-8 col-sm-12">
				<?php if ( $header ): ?>
                    <header class="property-single-header">
                       
                        <div class="property-meta-top">
                            <ul class="list-inline property-meta-top__list">
	                          
	                           
	                             <?php do_action( 'opalestate_before_property_meta_top_list' ); ?>

								<?php if ( $property->get_sku() ) : ?>
                                    <li class="list-inline__sku">
                                        <span><?php // esc_html_e( 'Property ID: ', 'opalestate-pro' ) ?></span>
                                        <span class="property-sku"><?php // echo esc_html( $property->get_sku() ); ?></span>
                                    </li>
								<?php endif; ?>
                                <li class="list-inline__print property-meta-top__button">
									<?php // opalestate_property_print_button( $property->get_id() ); ?>
                                </li>
                                <li class="list-inline__favorite property-meta-top__button">
									<?php // echo do_shortcode( '[opalestate_favorite_button property_id=' . get_the_ID() . ']' ); ?>
                                </li>

	                            <?php do_action( 'opalestate_after_property_meta_top_list' ); ?>
                            </ul>
                        </div>
                       
                       
                       
                       
                        <div id="block-description" class="property-single-info">
                            <div class="single-price-content"><?php opalestate_property_loop_price(); ?></div>
                            <div class="group-items">
	                            <?php // do_action( 'opalestate_before_single_property_title' ); ?>
                              
                               
                                <?php opalestate_property_label(); ?>
                                <?php opalestate_property_status(); ?>
                                
								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	                            
	                            

	                            <?php do_action( 'opalestate_after_single_property_title' ); ?>

                                <div class="property-meta">
                                    <div class="property-meta__list">
		                                <?php // opalestate_property_types_list(); ?>
		                                <?php // opalestate_property_categories_list(); ?>
                                    </div>

                                    <div class="property-address clearfix">
										<?php if ( $property->latitude && $property->longitude ) : ?>
                                            <a href="<?php echo esc_url( $property->get_google_map_link() ); ?>" rel="nofollow" target="_blank">
                                                <span class="property-address__view-map property-view-map"><i class="fas fa-map-marker-alt"></i></span>
                                            </a>
										<?php endif; ?>

										<?php if ( $property->get_address() ) : ?>
                                            <span class="property-address__text"><?php echo esc_html( $property->get_address() ); ?></span>
										<?php endif; ?>
                                    </div>
                                    <div class="property-date">
										<?php
										printf(
										/* translators: %s: property date */
											__( 'Posted: %s', 'opalestate-pro' ),
											// esc_html( $property->get_posted() )
										);
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
				<?php endif; ?>
               
 
                <div class="opalestate-box-content">

                    <div  class="summary entry-summary opalestate-rows">

						<?php
						/**
						 * opalestate_single_property_summary hook
						 */
						do_action( 'opalestate_single_property_summary' );
						?>
                        <div class="content-bottom">
							<?php do_action( 'opalestate_single_content_bottom' ); ?>
                        </div>
                    </div><!-- .summary -->
                </div>
                
                



                
              <div class="row two-input-form" style="background-image:url('/wp-content/uploads/2020/07/component.jpg);">
               <div class="if-overlay"></div>
                <div class="col-lg-6 col-md-12">
                  <h3>Получите персональное предложение</h3>
                  <p>подпишитесь на рассылку компании и получите уникальные предложения</p>
                </div>
                <div class="col-lg-6 col-md-12">
                  <?php echo do_shortcode( '[contact-form-7 id="32132" title="Запрос спецпредложения"]' ); ?>
                </div>
              </div>
                
                
                
                
                
				<?php
				/**
				 * opalestate_after_single_property_summary hook
				 */
				do_action( 'opalestate_after_single_property_summary' );
				?>
               
                <div class="clear clearfix"></div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-12  single-property-sidebar">
                <div class="inner">
					<?php do_action( 'opalestate_single_property_sidebar' ); ?>
                </div>
            </div>
        </div>
    </article><!-- #post-## -->
</div>		
</div>		<!-- #tab-content-description -->


<?php if( have_rows('plan') ): ?>
<div id="tab-content-planirovki" class="opalestate-tab-content">
  <div class="container">
    <div class="opal-row">
    <?php while ( have_rows('plan') ) : the_row(); ?>
     
     <div class="col-lg-4 col-md-4 col-sm-6">
        <div class="plan-box">
         <?php 
          $images = get_sub_field('plan_images'); 
           if( $images ): ?>
            <div class="opalestate-gallery plan-bg" style="background-image:url(<?php echo $images[0]['sizes']['medium']; ?>)">          
              <?php foreach( $images as $image ): ?>
              <a href="<?php echo $image['url']; ?>"></a>
              <?php endforeach; ?>

            <?php else: ?>
            <div class="opalestate-gallery plan-bg">
           <?php endif; ?>
      </div>
        <div class="plan-box-text">
        <h5><?php  the_sub_field('plan_heading'); ?></h5>
        <p><i class="fas fa-arrows-alt"></i> Площадь: <?php the_sub_field('plan_area'); ?></p>

        <p><i class="fas fa-door-open"></i> Количество комнат: <?php the_sub_field('plan_rooms'); ?></p>
        <p><i class="fas fa-bath"></i> Количество санузлов: <?php the_sub_field('plan_bathrooms'); ?></p>
        </div>
      <div class="plan-box-price"><?php the_sub_field('plan_price'); ?> <i class="fas fa-ruble-sign"></i></div>
      </div>
     </div>
     
    <?php   endwhile;  ?>
   </div>
  </div>
</div>
<?php endif; ?>

</div>	<!-- 	opalestate-tab  -->
</div> <!-- .agency-nav-tabs -->