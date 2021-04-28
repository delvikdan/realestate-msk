<?php global $post, $agency;
$agency = opalesetate_agency( get_the_ID() );

$maps    = $agency->get_meta( 'map' );
$address = $agency->get_meta( 'address' );
$rowcls  = apply_filters( 'opalestate_row_container_class', 'opal-row' );
$id      = time();
?>





<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/RealEstateAgency" <?php post_class( 'opalestate_single_agency' ); ?>>
    <div class="<?php echo esc_attr( $rowcls ); ?>">
       
        <div class="col-lg-3 col-md-4 col-sm-12 opalestate-sticky-column agency-left-column">
           
            <div class="opalestate-sidebar-box">
              <?php $data = OpalEstate_Agency::get_link( get_the_ID() ); ?>
              
               
              
              <div class="agency-logo" style="background-image:url(<?php echo esc_url( $data['avatar'] ); ?>)">

                  
                  
                  <?php if ( 'on' === $agency->get_trusted() ): ?>
                      <span class="trusted-label hint--top" aria-label="<?php esc_html_e( 'Trusted Member', 'opalestate-pro' ); ?>" title="<?php esc_html_e( 'Trusted Member', 'opalestate-pro' ); ?>">

                          <i class="fas fa-check-circle"></i>

                      </span>
                  <?php endif; ?>
              </div>
            </div>
           
           <?php if ( 'on' === $agency->is_featured() ): ?>
              <div class="agency-label">
                  <span class="label label-featured" aria-label="<?php esc_html_e( 'Featured Agency', 'opalestate-pro' ); ?>"
                        title="<?php esc_html_e( 'Featured Agency', 'opalestate-pro' ); ?>">
                      <?php echo esc_html_e( 'Featured', 'opalestate-pro' ); ?>
                  </span>
              </div>
            <?php endif; ?>
           
           
            <div class="agency-contact-form">
				<?php
				$email = $agency->get_meta( 'email' );
				$args  = [
					'post_id' => get_the_ID(),
					'id'      => get_the_ID(),
					'email'   => $email,
					'heading' => esc_html__( 'Contact Us', 'opalestate-pro' ),
					'message' => sprintf( esc_html__( 'Hi %s. I saw your profile and wanted to see if you could help me.', 'opalestate-pro' ), get_the_title() ),
					'type'    => 'agency',
				];
				echo apply_filters( 'opalestate_render_contact_form', opalestate_load_template_path( 'messages/contact-form', $args ), $args );
				?>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 agency-right-column">
        <div class="agency-top-info">

         <?php if( get_field('agency_transparent_radio') == '0' ) : ?>
         <?php else : ?>
         <?php echo do_shortcode(get_field('agency_transparent_radio')); ?>
         <?php endif; ?>
        </div>

    
    
			<?php
			$team       = opalestate_load_template_path( 'single-agency/team' );
			$properties = opalestate_load_template_path( 'single-agency/properties' );

			$tabs = [
				'description' => [ 'enable' => 1, 'name' => esc_html__( 'Description', 'opalestate-pro' ) ],
				//'address'     => [ 'enable' => 1, 'name' => esc_html__( 'Address', 'opalestate-pro' ) ],
				

				'properties' => [ 'enable' => ! empty( $properties ), 'name' => esc_html__( 'Listing', 'opalestate-pro' ) ],
				'team'       => [ 'enable' => ! empty( $team ), 'name' => esc_html__( 'Team', 'opalestate-pro' ) ],
              
              'reviews'     => [ 'enable' => 1, 'name' => esc_html__( 'Reviews', 'opalestate-pro' ) ],
              
			];
			?>
            <div class="agency-nav-tabs">
                <div class="opalestate-tab">
                    <div class="nav opalestate-tab-head" role="tablist">
						<?php foreach ( $tabs as $key => $tab ): ?>
							<?php if ( $tab['enable'] ): ?>
                                <a aria-expanded="true" href="#tab-content-<?php echo esc_attr( $key ); ?>" role="tab" class="tab-item">
                                    <span><?php echo esc_html( $tab['name'] ); ?></span>
                                </a>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                    <div class="opalestate-tabs-content">
                        <div class="opalestate-tab-content" id="tab-content-description">
                            <div class="opalestate-box-content">
                                <div class="opalestate-box">
                                    <div class="entry-content">
                                        <?php the_title( '<h1 class="outbox-title">', '</h1>' ); ?>
                                                                                
										<?php
										/* translators: %s: Name of current post */
										the_content( sprintf(
											__( 'Continue reading %s', 'opalestate-pro' ),
											the_title( '<span class="screen-reader-text">', '</span>', false )
										) );

										$end = 4;
										?>
                                    </div><!-- .entry-content -->

                                  
                                      <?php echo opalestate_load_template_path( 'single-agency/author-box' ); ?>
                                      
                                      
                                      <?php if ( isset( $maps ) ): ?>
                                    <div class="agency-box">
                                    <h5 class="outbox-title"><?php esc_html_e( 'На карте', 'opalestate-pro' ); ?></h5>
                                    <div class="agency-address-map">
                                        <div class="agency-google-map-content">
											<?php if ( $address ): ?>
                                                <p>
                                                    <i class="fas fa-map-marker-alt"></i> <span><?php esc_html_e( 'Head Agency:', 'opalestate-pro' ); ?></span> <?php echo wp_kses_post( $address ); ?>.
													<?php
													$terms = wp_get_post_terms( get_the_ID(), 'opalestate_agency_location' );
													if ( $terms && ! is_wp_error( $terms ) ) {

														echo '<strong>' . esc_html__( 'Location:', 'opalestate-pro' ) . '</strong>';

														$output = '<span class="property-locations">';
														foreach ( $terms as $term ) {
															$output .= $term->name;
														}
														$output .= '</span>';
														echo wp_kses_post( $output );
													}
													?>
                                                </p>
											<?php endif; ?>
                                            <div id="property-map<?php echo esc_attr( $id ); ?>" class="property-preview-map" style="height:500px"
                                                 data-latitude="<?php echo( isset( $maps['latitude'] ) ? $maps['latitude'] : '' ); ?>"
                                                 data-longitude="<?php echo( isset( $maps['longitude'] ) ? $maps['longitude'] : '' ); ?>"
                                                 data-icon="<?php echo esc_url( OPALESTATE_CLUSTER_ICON_URL ); ?>"></div>
                                        </div>
                                    </div>
                               </div>
							<?php endif ?>
                                      
  
                                 <div class="agency-box">     
                             <?php echo opalestate_load_template_path( 'single-agency/gallery' ); ?> 
                                      
                                  </div>    
                                                           
                                </div>
                            </div>
                        </div>
                        <div class="opalestate-tab-content" id="tab-content-address">
							
                        </div>
                        
                        <div class="opalestate-tab-content" id="tab-content-reviews">
                          <?php
                           if ( opalestate_agency_reviews_enabled() ) {
                              comments_template();
                           }
                          ?>
                        </div>
                        

						<?php if ( $team ): ?>
                            <div class="opalestate-tab-content" id="tab-content-team">
                                <div class="opalestate-box-content">
                                    <h5 class="outbox-title"><?php esc_html_e( 'Team', 'opalestate-pro' ); ?></h5>
									<?php echo $team; ?>
                                </div>
                            </div>
						<?php endif; ?>

						<?php if ( $properties ): ?>
                            <div class="opalestate-tab-content" id="tab-content-properties">
                                <div class="opalestate-box-content">
                                    <h5 class="outbox-title"><?php esc_html_e( 'Properties', 'opalestate-pro' ); ?></h5>
                                    <div class="opalestate-box">
                                   
										<?php echo opalestate_load_template_path( 'single-agency/properties' ); ?>
                                    </div>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>



<!--
            <div class="content-bottom">
				<?php do_action( 'opalestate_single_agency_content_bottom' ); ?>
            </div>
-->
			<?php // echo opalestate_load_template_path( 'single-agency/tabs' ); ?>
            <meta itemprop="url" content="<?php the_permalink(); ?>"/>
        </div>


    </div>
</article><!-- #post-## -->
<?php do_action( 'opalestate_single_content_agency_after' ); ?>
