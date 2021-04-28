<?php
/**
 * findhouse functions and definitions
 *
 * @package findhouse
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/// admin /// 
if (is_admin()) {
    require get_template_directory() . '/inc/admin/class-menu.php';
    /**
     * Load include plugins using for this project
     */
    require get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';
    require get_template_directory() . '/inc/tgm.php';
}

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/classes/class-wp-bootstrap-navwalker.php';

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/classes/class-offcanvas.php';


/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/functions.php';

/**
 * Initialize theme default settings
 */
require get_template_directory() . '/inc/markup.php';


/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom pagination for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom hooks.
 */
require get_template_directory() . '/inc/template-hooks.php';


/**
 * Custom hooks.
 */
require get_template_directory() . '/inc/post-format-functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

if( class_exists("OpalEstate") ) {
	require get_template_directory() . '/inc/vendor/opalestate.php';
}
require get_template_directory() . '/inc/vendor/elementor-functions.php';
require get_template_directory() . '/inc/vendor/elementor-others.php';



/**
 * Удаляет лишние пункты в меню админ. панели
 */
add_action( 'admin_init', 'wpse_136058_remove_menu_pages' );

function wpse_136058_remove_menu_pages() {

 // remove_menu_page( 'edit.php?post_type=header' );
//  remove_menu_page( 'edit.php?post_type=footer' );
//  remove_menu_page( 'edit.php?post_type=elementor_library' ); //Шаблоны
    remove_menu_page( 'wpopal_dashboard' ); 
    remove_menu_page( 'opalmembership' );
    remove_menu_page( 'revslider' );
    remove_menu_page( 'mailchimp-for-wp' );
  // remove_menu_page( 'elementor' );
}

/**
 * Для дебага пунктов меню
 */

//add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );
//
//function wpse_136058_debug_admin_menu() {
//
//    echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
//}



/**
 * Добавляет рекламные блоки (CMB2)
 */
//add_action( 'cmb2_admin_init', 'dcwd_pr_services_options' );
//function dcwd_pr_services_options() {
//	$cmb_options = new_cmb2_box( array(
//		'id'           => 'pr-services',
//		'title'        => 'Рекламные блоки',
//		'object_types' => array( 'options-page' ),
//
//		// The following parameters are specific to the options-page box.
//		'option_key'      => 'pr_services', // The option key and admin menu page slug.
//		'icon_url'        => 'dashicons-images-alt', // Menu icon.
//		'capability'      => 'edit_posts', // Capability required to view this options page.
//		'position'        => 53, // Menu position.
//		'save_button'     => 'Сохранить',
//	) );
//	
//	$cmb_options->add_field( array(
//		'desc' => "Добавляем рекламные блоки на сайт",
//		'type' => 'title',
//		'id'   => 'options_title'
//	) );
//
//	// Options fields IDs only need to be unique within this box. Prefix is not needed.
//	$pr_services_items_group_id = $cmb_options->add_field( array(
//		'id' => 'pr_service',
//		'type' => 'group',
//		'repeatable'  => true,
//		'options'     => array(
//			'group_title'   => 'Рекламный блок {#}',
//			'add_button'    => 'Добавить блок',
//			'remove_button' => 'Удалить этот блок',
//			'closed'        => true,  // Repeater fields closed by default as page would otherwise be very long.
//			'sortable'      => true,
//		),
//	) );
//	$cmb_options->add_group_field( $pr_services_items_group_id, array(
//		'name' => 'Заголовок',
//		'id'   => 'service_name',
//		'type' => 'text',
//		'attributes' => array(
//			//'required' => 'required',
//		),
//	) );
//	$cmb_options->add_group_field( $pr_services_items_group_id, array(
//		'name' => 'Описание',
//		'desc' => 'Количество символом - 180 символов',
//		'id'   => 'service_description',
//		'type' => 'text',
//		'attributes' => array(
//			//'required' => 'required',
//		),
//	) );
//  
//  	$cmb_options->add_group_field( $pr_services_items_group_id, array(
//		'name' => 'Допольнительная информация',
//		'desc' => 'Например, номер телефона. Поле необязательно',
//		'id'   => 'service_optional',
//		'type' => 'text',
//		'attributes' => array(
//			
//		),
//	) );
//  
//  
//  
//	$cmb_options->add_group_field( $pr_services_items_group_id, array(
//		'name' => 'Картинка',
//		'desc' => 'Размер изображения 234px на 120px',
//		'id'   => 'service_image',
//		'type' => 'file',
//		'options' => array(
//			'url' => false, // Hide the text input for the url
//		),
//		'attributes' => array(
//			//'required' => 'required',
//		),
//		'preview_size' => 'medium',
//	) );
//}
//
//
//add_shortcode( 'pr-services-grid', 'dcwd_cmb2_services_grid_shortcode' );
//function dcwd_cmb2_services_grid_shortcode($atts, $content, $code) {
//	$services = get_option( 'pr_services' );
//	//return '<pre>' . var_export( $services, true ) . '</pre>';
//
//	$grid_html = '';
//	if ( $services && array_key_exists( 'pr_service', $services ) ) {
//		$services_per_row = 2;
//		$i = 0;
//
//		// Fallback if image not set in repeater field.
//		$placeholder_image = 'https://dummyimage.com/234x120/ed008a/dbdbdb.png&text=Реклама';
//
//		foreach ( $services[ 'pr_service' ] as $service ) {
//			// Opening div at the start of each row.
//            if ( $i % $services_per_row == 0 ) {
//                $grid_html .= '<div class="grid">';
//            }
//
//            // Use a placeholder image if none specified.
//            $service_image = $service[ 'service_image' ]; 
//            if ( empty( $service_image ) ) {
//                $service_image = $placeholder_image;
//            }
//          
//          
//          
//          
//          
//			$grid_html .= sprintf( '<figure class="effect-julia"><img src="%s" alt="%s" />
//<figcaption>
//<h2>%s</h2>
//<div><p>%s</p></div>
//<div><p>%s</p></div>
//</figcaption></figure>%s', $service_image, $service[ 'service_name' ], $service[ 'service_name' ], implode( ' ', $service_name_words ), $service[ 'service_description' ], $service[ 'service_optional' ], "\n" );
//
//			$i++;
//             // Two images/services per row.
//             if ( $i % $services_per_row == 0 ) {
//                 $grid_html .= '</div>'."\n";
//             }
//		}
//	}
//	else {
//		return '<p>No services.</p>';
//	}
//
//	return $grid_html;    
//}
//



// Добавлляет опцию "Рекламные блоки" (ACF)
 if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
		'page_title' 	=> 'Реклама',
		'menu_title'	=> 'Реклама',
		'menu_slug' 	=> 'adbox',
		'capability'	=> 'edit_posts',
        'position'      => 53, 
        'icon_url'      => 'dashicons-images-alt', 
		'redirect'		=> false
	));
	
}



//Создает шорткод из из файла
add_shortcode( 'ads', 'shortcode_ads' );

function shortcode_ads() {
	ob_start();

	get_template_part( 'partials/ads-in-body' );

	return ob_get_clean();
}



//Шорткоды рекламных баннеров
add_shortcode( 'transparent-1', 'shortcode_transparent_1' );

function shortcode_transparent_1() {
	ob_start();

	get_template_part( 'partials/transparent-1' );

	return ob_get_clean();
}



add_shortcode( 'transparent-2', 'shortcode_transparent_2' );

function shortcode_transparent_2() {
	ob_start();

	get_template_part( 'partials/transparent-2' );

	return ob_get_clean();
}




add_shortcode( 'transparent-3', 'shortcode_transparent_3' );

function shortcode_transparent_3() {
	ob_start();

	get_template_part( 'partials/transparent-3' );

	return ob_get_clean();
}



//Шорткод популярных запросов
add_shortcode( 'popular-requests', 'shortcode_popular_requests' );

function shortcode_popular_requests() {
	ob_start();

	get_template_part( 'partials/popular-requests' );

	return ob_get_clean();
}

//Шорткод для слайдера спецпредложений
add_shortcode( 'offers-slider', 'shortcode_offers_slider' );

function shortcode_offers_slider() {
	ob_start();

	get_template_part( 'partials/offers-slider' );

	return ob_get_clean();
}


//Исключаем спецпредложения из блоговой странцы
function exclude_category($query) {
if ( $query->is_home() ) {
$query->set('cat', '-55');
}
return $query;
}
add_filter('pre_get_posts', 'exclude_category');


//Длина отрывка
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );




//Разбить архивы по 12 результатов
function wpsites_query( $query ) {
if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
        $query->set( 'posts_per_page', 12 );
    }
}
add_action( 'pre_get_posts', 'wpsites_query' );





add_action( 'pre_get_posts', function ( $query ) {
    if ( is_post_type_archive('opalestate_agency') && $query->is_main_query() )  {
        $query->set( 'orderby', 'meta_value date' );
        $query->set( 'order', 'DESC' ); //ASC or DESC
        $query->set( 'meta_key', 'opalestate_ofe_featured' );
    }
} );




//для слайдера на странице бренда
add_shortcode( 'fnslider', 'shortcode_fnslider' );

function shortcode_fnslider() {
	ob_start();

	get_template_part( 'partials/fnslider' );

	return ob_get_clean();
}


//для вывода проектов на странице бренда
add_shortcode( 'fnproperties', 'shortcode_fnproperties' );

function shortcode_fnproperties() {
	ob_start();

	get_template_part( 'partials/fnproperties' );

	return ob_get_clean();
}