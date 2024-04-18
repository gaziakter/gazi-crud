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

class Gazi_crud {
    private $table_name;

    function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'gazi_custom_data';
        register_activation_hook( __FILE__, array( $this, 'gazi_create_table' ) );
        
        add_action( 'init', [$this, 'gazi_init'] );
    }

    /** Init hook function */
    function gazi_init() {
        add_action('admin_menu', [$this, 'gazi_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'gazi_enqueue_file']);
        add_action('admin_post_gazi_add_new_data', [$this, 'handle_form_submission']);
    }

    /** Add Admin Menu */
    function gazi_admin_menu() {
        /** Add admin main menu function */
        add_menu_page(
            'Gazi Crud',
            'Gazi Crud',
            'manage_options',
            'gazi-crud',
             [$this, 'main_content_section'],
             'dashicons-superhero',
             '25'
        );

        /**add three submenu pages */
        add_submenu_page(
            'gazi-crud',
            'Add New Data',
            'Add New Data',
            'manage_options',
            'gazi-add-new-data',
            [$this, 'gazi_add_new_data']
        );
    }

    /** Create a custom data table */
    function gazi_create_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    /** Enqueue files */
    function gazi_enqueue_file($hook) {
        if ($hook == 'toplevel_page_gazi-crud' || 'toplevel_page_gazi-add-new-data') {
            wp_enqueue_script('gazi-tailwind', '//cdn.tailwindcss.com', [], '1.0', [
                'in_footer' => true,
                'strategy' => 'defer'
            ]);
        }
    }

    /** Main content function */
    function main_content_section() {
        // Your main content section code here
        include_once (plugin_dir_path(__FILE__) . 'pages/main.php');

    }

    /** Main gazi_add_new_data function */
    function gazi_add_new_data() {
        include_once (plugin_dir_path(__FILE__) . 'pages/add-new.php');

    }

    // Handle form submission
    function handle_form_submission() {
        if ( isset( $_POST['gazi_add_new_data_nonce'] ) && wp_verify_nonce( $_POST['gazi_add_new_data_nonce'], 'gazi_add_new_data' ) ) {
            global $wpdb;
            $name = sanitize_text_field( $_POST['name'] );
            $email = sanitize_email( $_POST['email'] );

            // Insert data into the database
            $wpdb->insert(
                $this->table_name,
                array(
                    'name' => $name,
                    'email' => $email,
                )
            );

            // Redirect after form submission
            wp_redirect( admin_url( 'admin.php?page=gazi-crud' ) );
            exit;
        }
    }
}

new Gazi_crud();
