<?php global $agency;
$address = $agency->get_meta( 'address' ); ?>
<div class="agency-box">

			<?php
			if ( ! isset( $id ) ) {
				$id = get_the_ID();
			}
			$picture = '';
			?>
            <div class="property-agency-contact">
				<?php $is_sticky = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'sticky', true ); ?>
                <div class="agency-top-meta">
 
                        <h5 class="outbox-title">Контакты</h5>
						<?php // the_title( '<h5 class="entry-title">', '</h5>' ); ?>
						<?php
						// $slogan = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'slogan', true );
						?>
                      <!--  <p class="agency-slogan"><?php //echo esc_html( $slogan ); ?></p> -->
          
					<?php
					$facebook  = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'facebook', true );
					$twitter   = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'twitter', true );
					$pinterest = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'pinterest', true );
					$google    = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'google', true );
					$instagram = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'instagram', true );
					$linkedIn  = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'linkedin', true );
					$vk        = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'vk', true );
					$youtube   = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'youtube', true );
					$ok  = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'ok', true );
					?>
                </div>


                <div class="agency-box-meta">

					<?php $email = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'email', true ); ?>
					<?php if ( ! empty( $email ) ) : ?>
                        <div class="agency-box-email">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>">
                                <span><?php echo esc_attr( $email ); ?></span>
                            </a>
                        </div><!-- /.agency-box-email -->
					<?php endif; ?>


					<?php $phone = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'phone', true ); ?>
					<?php if ( ! empty( $phone ) ) : ?>
                        <div class="agency-box-phone">
                            <i class="fa fa-phone"></i><span><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_attr( $phone ); ?></a></span>
                        </div><!-- /.agency-box-phone -->
					<?php endif; ?>

					<?php $mobile = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'mobile', true ); ?>
					<?php if ( ! empty( $mobile ) ) : ?>
                        <div class="agency-box-mobile">
                            <i class="fa fa-mobile"></i><span><a href="tel:<?php echo esc_attr( $mobile ); ?>"><?php echo esc_html( $mobile ); ?></a></span>
                        </div><!-- /.agency-box-phone -->
					<?php endif; ?>

					<?php $fax = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'fax', true ); ?>
					<?php if ( ! empty( $fax ) ) : ?>
                        <div class="agency-box-fax">
                            <i class="fa fa-fax"></i><span><?php echo esc_attr( $fax ); ?></span>
                        </div><!-- /.agency-box-phone -->
					<?php endif; ?>

					<?php $web = get_post_meta( $id, OPALESTATE_AGENCY_PREFIX . 'web', true ); ?>
					<?php if ( ! empty( $web ) ) : ?>
                        <div class="agency-box-web">
                            <i class="fa fa-globe"></i>
                            <a href="<?php echo esc_attr( $web ); ?>" rel="nofollow" target="_blank">
                                <span><?php echo esc_attr( $web ); ?></span>
                            </a>
                        </div><!-- /.agency-box-web -->
					<?php endif; ?>

                </div><!-- /.agency-box-meta -->


            </div>

            <div class="opalestate-social-icons">
				<?php  if ( $vk && $vk != "#" && ! empty( $vk ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $vk ); ?>"><i class="fab fa-vk"></i></a>
				<?php  } ?>
				
				<?php  if ( $ok && $ok != "#" && ! empty( $ok ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $ok ); ?>"><i class="fab fa-odnoklassniki"></i></a>
				<?php  } ?>
				
				<?php if ( $facebook && $facebook != "#" && ! empty( $facebook ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $facebook ); ?>"> <i class="fab fa-facebook"></i> </a>
				<?php } ?>
				
				<?php if ( $twitter && $twitter != "#" && ! empty( $twitter ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter"></i></a>
				<?php } ?>
				<?php if ( $instagram && $instagram != "#" && ! empty( $instagram ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $instagram ); ?>"> <i class="fab fa-instagram"></i></a>
				<?php } ?>
				<?php  if ( $youtube && $youtube != "#" && ! empty( $youtube) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $youtube ); ?>"><i class="fab fa-youtube"></i></a>
				<?php  } ?>
				
				<?php if ( $pinterest && $pinterest != "#" && ! empty( $pinterest ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $pinterest ); ?>"><i class="fab fa-pinterest"></i> </a>
				<?php } ?>

				<?php if ( $linkedIn && $linkedIn != "#" && ! empty( $linkedIn ) ) { ?>
                    <a target="_blank" class="opalestate-social-white radius-x" rel="nofollow" href="<?php echo esc_url( $linkedIn ); ?>"> <i class="fab fa-linkedin"></i></a>
				<?php } ?>


            </div>
</div>


