<?php 
	class findhouse_Opalestate {
		
		public function __construct () {
			add_action( 'template_redirect', array($this,'init'), 999 );

		}

		public function init() {
			$this->set_breadcrumb();
		}
		public function set_breadcrumb (){ 
			if( is_single_property() || is_single_agent() || is_post_type_archive( 'opalestate_agent' ) || is_post_type_archive( 'opalestate_agency' ) ) {
				remove_action( 'findhouse_before_site_content' , 'findhouse_breadcrumb' );
				/*$template = opalestate_single_the_property_layout(); 

				if(  $template == 'v3' || $template == 'v5' ){
					remove_action( 'findhouse_before_site_content' , 'findhouse_breadcrumb' );
					remove_action( 'findhouse_before_site_content' , 'findhouse_breadcrumbs_simple' ); 
				} else {
					remove_action( 'findhouse_before_site_content' , 'findhouse_breadcrumb' );
					add_action( 'findhouse_before_site_content' 	, 'findhouse_breadcrumbs_simple' );
				}*/
			}
			if( is_single_agent() ) {
				// add_action( 'findhouse_before_site_content', 'findhouse_breadcrumb' );
			}
		}
	}
	new findhouse_Opalestate();
?>