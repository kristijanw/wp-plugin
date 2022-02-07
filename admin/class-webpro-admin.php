<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       webpro.com
 * @since      1.0.0
 *
 * @package    Webpro
 * @subpackage Webpro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Webpro
 * @subpackage Webpro/admin
 * @author     Kristijan <freelance.kristijan@gmail.com>
 */
class Webpro_Admin {

	private $plugin_name;
	private $version;
	private $valid_hooks;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->version 		= $version;

		$this->valid_hooks = [
			'toplevel_page_webp_options',
			WEBPRO_ADMIN_PAGE_PREFIX . 'options_erp'
		];
		
	}

	public function enqueue_styles($hook_suffix) {

		if(!in_array($hook_suffix, $this->valid_hooks)) {
			return false;
		}

		// Bootstrap
		wp_enqueue_style( 'webp-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' );
		wp_enqueue_style( 'webp-fa5', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/webpro-admin.css', array(), $this->version, 'all' );

	}
	
	public function enqueue_scripts($hook_suffix) {

		if(!in_array($hook_suffix, $this->valid_hooks)) {
			return false;
		}

		// jQuery
		wp_enqueue_script('webp-jquery', 'https://code.jquery.com/jquery-3.6.0.js', array(), false, true);
		// Bootstrap JS
		wp_enqueue_script('webp-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array(), false, true);
		// Validator
		wp_enqueue_script( 'webp-validator', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js', array('jquery'), false, true);

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/webpro-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script(
			'webpro',
			'webproAjax',
			array(
				'ajaxurl'   => admin_url( 'admin-ajax.php' ),
				'ajaxnonce' => wp_create_nonce( 'ajaxnonce' ),
			)
		);
		wp_enqueue_script( 'webpro' );
	}

}
