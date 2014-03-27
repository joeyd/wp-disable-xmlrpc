<?php /**
 * Plugin Name: WP Disable XMLRPC
 * Plugin URI: https://github.com/joeyd/WP-Conversions
 * Description: Fix for the DDOS attack on the WP file xmlrpc.php.
 * Version: 1.0
 * Author: Joey Durham
 * Author URI: http://www.ultraweaver.com/
 * License: GPL2
 */

add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   return $methods;
});

?>
