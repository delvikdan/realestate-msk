<?php
global $post;

$agency_id = get_field('brand_id');
$limit     = get_field('brand_limit');
//$user_id   = get_post_meta( $agency_id, OPALESTATE_AGENCY_PREFIX . 'user_id', true );
$ppt_featured   = get_post_meta( $agency_id, 'opalestate_ppt_featured', false );


$query = Opalestate_Query::get_agency_property( $agency_id, $ppt_featured, $limit );


if ( $query->have_posts() ) :
	$id = rand();
	?>
    <div class="clearfix clear"></div>
    <div class="opalestate-box-inner property-agency-section">
        <h4 class="box-heading hide"><?php echo sprintf( esc_html__( 'My Properties', 'opalestate-pro' ), $query->found_posts ); ?></h4>

            <div class="opalestate-rows">
                <div class="fnslider" id="<?php echo esc_attr( $id ); ?>">
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
                      <div>
							<?php echo opalestate_load_template_path( 'content-property-featured-v1' ); ?>
                       </div>
					<?php endwhile; ?>
                </div>

            </div>
      
    </div>
<?php else : ?>
    <div class="opalestate-message">
		<?php esc_html_e( 'Объекты отсутствуют', 'opalestate-pro' ); ?>
    </div>
<?php endif; ?>



<?php  wp_reset_postdata(); ?>