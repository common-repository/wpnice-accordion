<?php
/*
Plugin Name: WPNice Accordion
Plugin URI:https://accordion.reactheme.com
Description: Fully Responsive and Mobile Friendly Faq/Accordion/QA Showcase plugin.
Version: 1.0.2
Author: ReacThemes
Author URI:https://reactheme.com
License: GPLv2 or later
Text Domain: wpnice-accordion
Domain Path: /languages/
*/

if ( ! function_exists( 'wa_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wa_fs() {
        global $wa_fs;

        if ( ! isset( $wa_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $wa_fs = fs_dynamic_init( array(
                'id'                  => '10952',
                'slug'                => 'wpnice-accordion',
                'type'                => 'plugin',
                'public_key'          => 'pk_255f87804a788d1821d47cdcaa15c',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'slug'           => 'edit.php?post_type=wpnice-accordion',
                    'account'        => false,
                ),
            ) );
        }

        return $wa_fs;
    }

    // Init Freemius.
    wa_fs();
    // Signal that SDK was initiated.
    do_action( 'wa_fs_loaded' );
}
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Pro version check.
 *
 * @return boolean
 */
function is_wpnice_accordion_pro() {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! ( is_plugin_active( 'wpnice-accordion-pro/wpnice-accordion-pro.php' ) || is_plugin_active_for_network( 'wpnice-accordion-pro/wpnice-accordion-pro.php' ) ) ) {
		return true;
	}
}

define( 'WPNICE_ACCORDION_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPNICE_ACCORDION_URL', plugin_dir_url( __FILE__ ) );
define( 'WPNICE_ACCORDION_INCLUDES', WPNICE_ACCORDION_PATH . 'includes' );		
define( 'WPNICE_ACCORDION_PLUGIN_NAME', 'wpnice-accordion' );

class WPNICE_ACCORDION_INITIAL{
	function __construct(){
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'add_plugin_action_links' ));
		require_once('includes/init.php');				
	}

	//load text-domain
	function load_textdomain() {
		load_plugin_textdomain( 'wpnice-accordion', false, plugin_dir_url( __FILE__ ) . "/languages" );
	}	
	//add pluign links
	function add_plugin_action_links ( $links ) {
		$mylinks = array(
			'<a href="https://accordion.reactheme.com/" target="_blank">Demo</a>',
			'<a href="https://accordion.reactheme.com/docs/nice-accordion/" target="_blank">Documentation</a>',
		);
		return array_merge( $links, $mylinks );
	}	
}

if ( is_wpnice_accordion_pro() ) {
	new WPNICE_ACCORDION_INITIAL();
}