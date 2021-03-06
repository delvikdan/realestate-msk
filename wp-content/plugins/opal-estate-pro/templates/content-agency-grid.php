<?php
$agency = new OpalEstate_Agency();

$agency_id = get_the_ID();
$address   = get_post_meta( get_the_ID(), OPALESTATE_AGENCY_PREFIX . 'address', true );
?>
 
  <article <?php post_class( 'agency-grid-style' ); ?> <?php if ( 'on' === $agency->is_featured() ): ?>style="background-color: #ebedf7; border-radius:8px;border: 1px solid #3f51b6;"<?php endif; ?>>
    <div class="agency-inner">
      <header class="team-header agency-header">
        <?php // opalestate_get_loop_agent_thumbnail(); ?>


      </header>

      <div class="agency-body-content clearfix">
        <div class="agency-info">
          <div class="agency-logo">
            <?php $data = OpalEstate_Agency::get_link( $agency_id ); ?>
            <a href="<?php echo esc_url( $data['link'] ); ?>">
                        <img src="<?php echo esc_url( $data['avatar'] ); ?>">
                    </a>
          </div>
          <div class="agency-content">
            <h6 class="agency-box-title text-uppercase">
              <a href="<?php the_permalink(); ?>">
                <?php the_title() ?>
              </a>
            </h6>
            <!-- /.agency-box-title -->

            <?php if ( 'on' === $agency->get_trusted() ): ?>
            <span class="trusted-label hint--top" aria-label="<?php esc_attr_e( 'Trusted Member', 'opalestate-pro' ); ?>" title="<?php esc_attr_e( 'Trusted Member', 'opalestate-pro' ); ?>">
                        <i class="fas fa-check-circle"></i>
                    </span>
            <?php endif; ?>

            <h3 class="agency-name hide">
              <?php the_title(); ?>
            </h3>
            <p class="agency-address">
              <?php echo esc_html( $address ); ?>
            </p>
          </div>
        </div>

        <div class="agency-box-meta">
          <div class="agency-box-column-1">
            <?php $phone = get_post_meta( get_the_ID(), OPALESTATE_AGENCY_PREFIX . 'phone', true ); ?>
            <?php if ( ! empty( $phone ) ) : ?>
            <div class="agency-box-phone">
              <i class="fa fa-phone"></i>
              <a href="tel:<?php echo sanitize_title( $phone ); ?>">
                            <span><?php echo esc_html( $phone ); ?></span>
                        </a>
            </div>
            <!-- /.agency-box-phone -->
            <?php endif; ?>
            <?php $email = get_post_meta( get_the_ID(), OPALESTATE_AGENCY_PREFIX . 'email', true ); ?>
            <?php if ( ! empty( $email ) ) : ?>
            <div class="agency-box-email ">
              <i class="fa fa-envelope"></i>
              <a href="mailto:<?php echo esc_attr( $email ); ?>">
                            <span><?php echo esc_html( $email ); ?></span>
                        </a>
            </div>
            <!-- /.agency-box-email -->
            <?php endif; ?>
           <?php $web = get_post_meta( get_the_ID(), OPALESTATE_AGENCY_PREFIX . 'web', true ); ?>
            <?php if ( ! empty( $web ) ) : ?>
            <div class="agency-box-web">
              <i class="fa fa-globe"></i>
              <a href="<?php echo esc_attr( $web ); ?>" rel="nofollow" target="_blank">
                                      <span><?php echo esc_attr( $web ); ?></span>
                                  </a>
            </div>
            <!-- /.agency-box-web -->
            <?php endif; ?>
            
            
          </div>
          <div class="agency-box-column-2">
          
            <div class="agency-box-featured">
              <?php if ( 'on' === $agency->is_featured() ): ?>
              <div class="agency-label">
                <span class="label label-featured" aria-label="<?php esc_attr_e( 'Featured Agency', 'opalestate-pro' ); ?>" title="<?php esc_attr_e( 'Featured Agency', 'opalestate-pro' ); ?>">
                            <?php esc_html_e( 'Featured', 'opalestate-pro' ); ?>
                        </span>
              </div>
              <?php endif; ?>
            </div>
          </div>

        </div>
        <!-- /.agency-box-meta -->
        
        <div class="agency-rating-grid ar-list">
         
          <?php $average_rating = get_post_meta( get_the_ID(), OPALESTATE_AGENCY_PREFIX . 'average_rating', true ); ?>
          <div class="ar-point-number"><?php echo esc_attr( $average_rating ); ?></div>

          <div class="ar-stars">
          <h3>?????????????? ????????????</h3>
          <?php
				if ( $average_rating ) {
				  echo opalestate_get_rating_html( $average_rating ); // WPCS: XSS ok.
				}
				?>
          </div>
          
        </div>
        
        
      </div>
    </div>
  </article>