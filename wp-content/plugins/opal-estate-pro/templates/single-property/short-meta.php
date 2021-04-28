<?php
global $property;
$meta_content = apply_filters( 'opalestate_single_meta_info', '' );
if ( empty( $meta_content ) ) {
	$meta = $property->get_meta_shortinfo();
	?>

    <ul class="property-meta-list list-inline">
		<?php if ( $meta ) : ?>
			<?php foreach ( $meta as $key => $info ) : ?>
				<?php if ( trim( $info['value'] ) ) : ?>
                    <li class="property-label-<?php echo esc_attr( $key ); ?>">
 
                        <div class="info-meta">
                               
                               
                            <span class="hint--top" aria-label="<?php echo esc_attr( $info['label'] ); ?>" title="<?php echo esc_attr( $info['label'] ); ?>">
                                <i class="<?php echo opalestate_get_property_meta_icon( $key ); ?>"></i><?php echo apply_filters( 'opalestate-pro' . $key . '_unit_format', trim( $info['value'] ) ); ?>
                           
                            <?php  if  ($key ==  'areasize') : ?>
                             м²
                            
                            <?php endif; ?> 
                               
                            </span>
                               

                        </div>

                    </li>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
    </ul>

<?php } else {
	echo wp_kses_post( $meta_content );
}
