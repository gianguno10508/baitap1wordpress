<?php

/**
 * Plugin Name: Block Widgets Monster
 * Plugin URI: http://demo.rgblab.net/block-widgets-monster/
 * Description: Quick and easy testing of multiple WordPress and/or WooCommerce block/legacy widgets. Not intended for production use.
 * Version: 1.0.1
 * Author: RGB Lab
 * Author URI: http://rgblab.net/
 * Text Domain: bwm
 * Domain Path: /languages/
 * Requires at least: 5.8
 * Requires PHP: 5.6
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Block_Widgets_Monster' ) ) {
	/**
	 * class Block_Widgets_Monster
	 */
	class Block_Widgets_Monster {
		// instance var
		private static $instance;

		/**
		 * get instance
		 *
		 * get single instance of Block_Widgets_Monster class
		 *
		 * @return object Block_Widgets_Monster
		 */
		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Block_Widgets_Monster constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'init_plugin' ), 100 );
		}

		/**
		 * init function
		 *
		 * hooked on 'plugins_loaded' action
		 *
		 * @since 1.0.0
		 */
		public function init_plugin() {
			// include constants
			require_once dirname( __FILE__ ) . '/define.php';

			// include helper
			require_once BWM_ABS_PATH . '/lib/helper.php';

			// include widget
			require_once BWM_ABS_PATH . '/class-bwm-widget.php';

			if ( is_admin() ) {
				// show additional links in dashboard on 'plugin_row_meta' hook
				add_filter( 'plugin_row_meta', array( $this, 'dashboard_links' ), 10, 2 );

				// include backend assets on 'admin_enqueue_scripts' hook
				// priority 5 to ensure loading before gutenberg
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_assets' ), 5 );
			}

			// textdomain
			load_plugin_textdomain( 'bwm', false, BWM_REL_PATH . '/languages' );
		}

		/**
		 * set dashboard links
		 *
		 * @param array  $links - plugin links from plugin meta
		 * @param string $file  - name of main plugin file
		 *
		 * hooked on 'plugin_row_meta' filter
		 *
		 * @return array
		 * @since 1.0.0
		 */
		public function dashboard_links( $links, $file ) {
			if ( plugin_basename( dirname( __FILE__ ) . '/block-widgets-monster.php' ) === $file ) {
				$links[] = '<a href="http://demo.rgblab.net/block-widgets-monster" target="_blank">' . esc_html__( 'Docs & Demo', 'bwm' ) . '</a>';
				$links[] = '<a href="https://wordpress.org/support/plugin/block-widgets-monster/reviews/#new-post" target="_blank">' . esc_html__( 'Please rate with ★★★★★', 'bwm' ) . '</a>';
				$links[] = '<a href="https://www.paypal.me/rgblab" target="_blank">' . esc_html__( 'Donate', 'bwm' ) . '</a>';
			}

			return $links;
		}

		/**
		 * enqueue backend assets
		 *
		 * @param string $hook
		 *
		 * hooked on 'admin_enqueue_scripts' action
		 *
		 * @since 1.0.0
		 */
		public function enqueue_backend_assets( $hook ) {

			if ( 'widgets.php' === $hook ) {
				$backend_labels = array(
					'widgetTitle' => esc_html__( 'Block Widgets Monster', 'bwm' ),
				);

				wp_register_script( 'bwm-backend', BWM_URL_PATH . 'assets/js/backend.min.js', array( 'jquery' ), false, true );
				wp_localize_script( 'bwm-backend', 'backendLabels', $backend_labels );
				wp_enqueue_script( 'bwm-backend' );
			}
		}
	}

	Block_Widgets_Monster::get_instance();
}
