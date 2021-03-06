<?php
/**
 * The template for simple keyword search
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( isset( $nobutton ) && $nobutton ) {
	$grid = [
		0 => 6,
		1 => 3,
		2 => 3,
		3 => 3,
	];
} else {
	$grid = [
		0 => 6,
		1 => 2,
		2 => 2,
		3 => 2,
	];
}

$display_more_options = isset( $display_more_options ) ? $display_more_options : false;

$form_classes = [
	'opalestate-search-form',
	'opalestate-search-form--simple-keyword',
	isset( $hidden_labels ) && $hidden_labels ? 'hidden-labels' : '',
];

?>

<form class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $form_classes ) ) ); ?>" action="<?php echo esc_url( opalestate_get_search_link() ); ?>" method="GET">
    <div class="opal-row">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			<?php echo opalestate_load_template_path( 'search-box/fields/search-text' ); ?>
        </div>

		<?php if ( ! isset( $nobutton ) || ! $nobutton ) : ?>
            <div class="col-lg-<?php echo esc_attr( $grid[3] ); ?> col-md-<?php echo esc_attr( $grid[3] ); ?> col-sm-<?php echo esc_attr( $grid[3] ); ?> col-xs-12">
				<?php echo opalestate_load_template_path( 'search-box/fields/submit-button' ); ?>
            </div>
		<?php endif; ?>
    </div>

	<?php
	if ( $display_more_options ) {
		echo opalestate_load_template_path( 'search-box/fields/more-options' );
	}
	?>

	<?php do_action( 'opalestate_after_search_properties_form' ); ?>
</form>
