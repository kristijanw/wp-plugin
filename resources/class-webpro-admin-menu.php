<?php

/**
 * Fired during plugin activation
 *
 * @link       http://webpro.com
 * @since      1.0.0
 *
 * @package    WebPro
 * @subpackage WebPro/resources/menus
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WebPro
 * @subpackage WebPro/resources/menus
 * @author     WebPro IT <devs@webpro.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class WebPro_Admin_Menu {

    protected $args = [];
    public $webp_helper;
    
    public function __construct($args = []) {
        $this->args = $args;
        $this->webp_helper = new WebProHelper();
        
        add_action( 'admin_menu', [$this,  'webpro_menu_item_options']);
    }


    public function webpro_menu_item_options() {

        //Generate Admin Menu 
        add_menu_page(
            'WebPro',
            'WebPro',
            'manage_options',
            WEBPRO_ADMIN_PREFIX. 'options',
            [$this, WEBPRO_ADMIN_PREFIX. 'options_home'],
            'dashicons-book-alt',
            40
        );

        add_submenu_page(
            WEBPRO_ADMIN_PREFIX . 'options',
            'ERP API',
            'ERP API',
            'manage_options',
            WEBPRO_ADMIN_PREFIX . 'options_erp',
            [$this, WEBPRO_ADMIN_PREFIX . 'options_erp']
        );

    }

    /**
     * List of methods for creating menu and menu item design in template folder
    */
    public function webp_options_home() {
        $page_values = $this->webp_helper->admin_menu_item_data($_GET['page']);

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'resources/templates/pages/webp-home.php';
    }
    
    public function webp_options_erp() {
        $page_values = $this->webp_helper->admin_menu_item_data($_GET['page']);

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'resources/templates/pages/webp-erp.php';
    }

}

$webp_admin_menus = new WebPro_Admin_Menu();