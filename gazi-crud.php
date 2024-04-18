<?php
/*
 * Plugin Name:       Gazi Crud
 * Plugin URI:        https://gaziakter.com/plugins/gazi-crud/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Gazi Akter
 * Author URI:        https://gaziakter.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gazi-crud
 * Domain Path:       /languages
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Gazi_crud{
    function __construct(){
        add_action( 'init', [$this, 'gazi_init'] );
    }

    /** Init hook function */
    function gazi_init(){
        add_action('admin_menu', [$this, 'gazi_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'gazi_enqueue_file']);
    }

    /** Add Admin Menu */
    function gazi_admin_menu(){
        add_menu_page(
            'Gazi Crud',
            'Gazi Crud',
            'manage_options',
            'gazi-crud',
             [$this, 'main_content_section'],
             'dashicons-superhero',
             '25'
        );
    }

    /** Enqueue files */
    function gazi_enqueue_file($hook){
        if ($hook == 'toplevel_page_gazi-crud') {
            wp_enqueue_script('gazi-tailwind', '//cdn.tailwindcss.com', [], '1.0', [
                'in_footer' => true,
                'strategy' => 'defer'
            ]);
        }
    }

    /** Main content function */
    function main_content_section(){
        
    }
}
new Gazi_crud();