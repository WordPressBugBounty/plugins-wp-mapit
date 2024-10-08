<?php
/**
 * Gutenberg block.
 *
 * @package wp-mapit
 */

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access Denied' );
}

if ( ! class_exists( 'Wp_Mapit_Gutenberg_Block' ) ) {

	/**
	 * Class to manage the gutenberg block for WP MAPIT
	 */
	class Wp_Mapit_Gutenberg_Block {
		/**
		 * Add hooks and filters for the gutenberg block
		 *
		 * @since 1.0
		 * @static
		 * @access public
		 */
		public static function init() {
			add_action( 'init', __CLASS__ . '::init_block' );
		}

		/**
		 * Hook to handle the init action to initialize the block
		 *
		 * @since 1.0
		 * @static
		 * @access public
		 */
		public static function init_block() {

			if ( ! function_exists( 'register_block_type' ) ) {
				/* Guternberg is not active */
				return;
			}

			wp_register_script( 'wp-mapit-gutenberg-js', WP_MAPIT_URL . 'js/wp_mapit_gutenberg.js', array(), filemtime( WP_MAPIT_DIR . 'js/wp_mapit_gutenberg.js' ), true );

			wp_localize_script(
				'wp-mapit-gutenberg-js',
				'wp_mapit_gutenberg',
				array(
					'logo' => WP_MAPIT_URL . 'images/logo.jpg',
				)
			);

			register_block_type(
				'wp-mapit/wp-mapit-gutenberg-map-block',
				array(
					'editor_script' => 'wp-mapit-gutenberg-js',
				)
			);
		}
	}

	/**
	 * Calling init function to activate hooks and filters.
	 */
	Wp_Mapit_Gutenberg_Block::init();
}
