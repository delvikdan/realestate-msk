<?php
defined( 'ABSPATH' ) || exit();

/**
 * @Class Wpopal_Core_Admin_Menu
 *
 * Entry point class to setup load all files and init working on frontend and process something logic in admin
 */
class Wpopal_Core_Admin_Menu_Settings extends Wpopal_Core_Admin_Menu {
	/**
	 * Wpopal_Core_Admin_Menu_Settings constructor.
	 */
	public function __construct() {
		parent::__construct();
		add_action( 'admin_init', [ $this, 'save_settings' ] );
	}

	/**
	 * Retrieves the admin menu args
	 *
	 * @return array  Admin menu args
	 */
	public function get_admin_menu_args() {
		$menu_name = __( 'Settings', 'wpopal' );
		$menus     = add_filter( 'wpopal_admin_menu_navigator', [ $this, 'add_submenu' ] );

		return apply_filters( 'wpopal_admin_menu_settings_args', [
			'name'          => $menu_name,
			'title'         => __( 'Plugin', 'wpopal' ),
			'compatibility' => 'manage_options',
		] );
	}


	public function add_submenu( $menus ) {
		$menus['wpopal-settings'] = [
			'url'   => admin_url( "admin.php?page=wpopal-settings" ),
			'title' => __( 'Settings', 'wpopal' ),
		];

		return $menus;
	}

	public function save_settings() {
		if ( ! isset( $_GET['page'] ) || 'wpopal-settings' !== sanitize_text_field( $_GET['page'] ) ) {
			return;
		}

		$nonce = ! empty( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : '';

		if ( ! $nonce ) {
			return;
		}

		if ( ! wp_verify_nonce( $nonce, 'wpopal-settings-form' ) ) {
			wp_die( __( 'Permission denied.', 'wpopal' ) );
		}

		update_option( 'opal-settings', $_POST );
	}

	/**
	 * Retrieves the admin menu args
	 *
	 * @return array  Admin menu args
	 */
	public function the_content() {
		$options = get_option( 'opal-settings', [] );
		$api_key = isset( $options['api_key'] ) && $options['api_key'] ? $options['api_key'] : '';
		?>
        <form method="post" action="" novalidate="novalidate">
			<?php wp_nonce_field( 'wpopal-settings-form' ); ?>
            <table class="form-table" role="presentation">
                <tbody>
                <tr>
                    <th scope="row"><label for="blogname"><?php esc_html_e( 'Google API key', 'wpopal' ) ?></label></th>
                    <td><input name="api_key" type="text" id="api_key" value="<?php echo esc_attr( $api_key ); ?>" class="regular-text"></td>
                </tr>
                </tbody>
            </table>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'wpopal' ); ?>"></p></form>
		<?php
	}

	/**
	 * Register the admin menu
	 *
	 * @return void
	 */
	public function register_admin_menu() {
		$menu_args = $this->get_admin_menu_args();

		/*  Register welcome submenu
		/*---------------------------*/
		add_submenu_page( $this->page_slug,
			$menu_args['title'],
			$menu_args['name'],
			$menu_args['compatibility'],
			'wpopal-settings',
			[ $this, 'render' ]
		);
	}

}

new Wpopal_Core_Admin_Menu_Settings();
