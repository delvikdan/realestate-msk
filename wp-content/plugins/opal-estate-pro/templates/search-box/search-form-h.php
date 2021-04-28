<?php
/**
 * The template for advanced v1 search
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$display_country      = isset( $display_country ) ? $display_country : true;
$display_state        = isset( $display_state ) ? $display_state : false;
$display_city         = isset( $display_city ) ? $display_city : false;
$display_more_options = isset( $display_more_options ) ? $display_more_options : true;

$form_classes = [
	'opalestate-search-form',
	'opalestate-search-form--advanced-1',
	isset( $hidden_labels ) && $hidden_labels ? 'hidden-labels' : '',
];

?>
<form class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $form_classes ) ) ); ?>" action="<?php echo esc_url( opalestate_get_search_link() ); ?>" method="GET">
<!--
    <div class="searchbox-top">
		<?php echo opalestate_load_template_path( 'search-box/fields/status-bar', [ 'style' => 2 ] ); ?>
    </div>
-->

    <div class="opal-row">
    
        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
			<?php echo opalestate_load_template_path( 'search-box/fields/search-text' ); ?>
        </div>
         <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
          <button class="btn btn-secondary btn-search btn-search-map" type="submit" formaction="/split-search-2/"><i class="far fa-map"></i> На карте</button>
         </div>
		<?php // if ( $display_state ) : ?>
            <div class="col-lg-4 col-md-4 col-sm-12">
				<?php echo opalestate_load_template_path( 'search-box/fields/state-select' ); ?>
            </div>
		<?php // endif; ?>

		<?php if ( $display_city ) : ?>
            <div class="col-lg-4 col-md-4 col-sm-12">
				<?php echo opalestate_load_template_path( 'search-box/fields/city-select' ); ?>
            </div>
		<?php endif; ?>

<!--
        <div class="col-lg-3 col-md-3 col-sm-12">
			<?php echo opalestate_load_template_path( 'search-box/fields/types' ); ?>
        </div>
-->

		<?php if ( opalestate_is_enable_price_field() ) : ?>
            <div class="col-lg-4 col-md-4 col-sm-12">
				<?php echo opalestate_load_template_path( 'search-box/fields/price' ); ?>
            </div>
		<?php endif; ?>

		<?php if ( opalestate_is_enable_areasize_field() ) : ?>
            <div class="col-lg-4 col-md-4 col-sm-12">
				<?php echo opalestate_load_template_path( 'search-box/fields/areasize' ); ?>
            </div>
		<?php endif; ?>


  
    
    
 
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="opal-row">
				<?php  echo opalestate_load_template_path( 'search-box/fields/group-info' ); ?>
            </div>
        </div>
        
       <?php if ( ! isset( $nobutton ) || ! $nobutton ) : ?>

		<?php endif; ?>
        
  </div>
    
    
    
	<?php
	if ( $display_more_options ) {
		echo opalestate_load_template_path( 'search-box/fields/more-options' );
	}
	?>

 <div class="opal-row">  
  <div class="col-lg-6 col-md-4 col-sm-12 "></div>
  <div class="col-lg-6 col-md-8 col-sm-12 ">
      <div class="col-lg-6 col-md-6 col-sm-6 "><a class="reset-button" href="/search-map-properties-page/"><i class="fas fa-sync-alt"></i> Сбросить фильтры</a></div>
      <div class="col-lg-6 col-md-6 col-sm-6 "><?php echo opalestate_load_template_path( 'search-box/fields/submit-button' ); ?></div>
  </div>
</div>
    
  
	<?php do_action( 'opalestate_after_search_properties_form' ); ?>
	

</form>

