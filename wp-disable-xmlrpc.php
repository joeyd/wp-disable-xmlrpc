<?php /**
 * Plugin Name: WP Disable XMLRPC
 * Plugin URI: https://github.com/joeyd/wp-disable-xmlrpc
 * Description: Disable pingbacks from being used as a DDOS attack.
 * Version: 1.1
 * Author: Joey Durham
 * Author URI: http://www.ultraweaver.com/
 * License: GPL2
 */

if ( is_admin() ) {
  function nolo_disable_xmlrpc_plugin_get_version() {
    if ( ! function_exists( 'get_plugins' ) )
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $nolojd_plugin_data = get_plugin_data( __FILE__ );
    return $nolojd_plugin_data['Version'];
  }

  add_action('init', 'nolo_disable_xmlrpc_activate_auto_update');
  function nolo_disable_xmlrpc_activate_auto_update()
  {
      require_once ('includes/nolo-class-auto-update.php');
      $nolojd_plugin_current_version = nolo_disable_xmlrpc_plugin_get_version();
      $nolojd_plugin_remote_path = 'http://www.nologyinteractive.com/nolo-repo/?p='.basename(__FILE__, '.php');
      $nolojd_plugin_slug = plugin_basename(__FILE__);
      new nolo_disable_xmlrpc_auto_update ($nolojd_plugin_current_version, $nolojd_plugin_remote_path, $nolojd_plugin_slug);
  }
}

add_filter( 'xmlrpc_methods', function( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
});?>
