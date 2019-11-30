<?php
/*
Plugin Name: Klantenvertellen Wordpress 
Plugin URI: http://www.wordpress.com
Description: Klantenvertellen plugin.
Author: Mark Dijkstra
Version: 1.0.0
Author URI: 
*/


//include_once(dirname( __FILE__ ).'/classes/Settings.php');
include_once(dirname( __FILE__ ).'/classes/Core.php');
include_once(dirname( __FILE__ ).'/classes/Database.php');	
include_once(dirname( __FILE__ ).'/classes/Install.php');
//include_once(dirname( __FILE__ ).'/classes/uninstall.php');
include_once(dirname( __FILE__ ).'/classes/Core.php');

/*
*  leave empty for now
*/
function deactivateKlantenvertellen(){ }


function uninstallKlantenvertellen(){
    
    global $wpdb, $dbSettingsName, $dbStatsName, $dbName, $dbVersionName, $dbVersion;
    ///global $wpdb, $dbSettingsName, $dbStatsName,$dbName, $dbVersionName, $dbVersion;

    if(!defined( 'WP_UNINSTALL_PLUGIN')){
        exit();	
    }

    if(!is_multisite()){
        // remove the db version number from the wp options table   
        delete_option($dbVersionName);
    }else{

        // remove the db version number from the wp options table   
        delete_site_option($dbVersionName);

    }

}


register_activation_hook(__FILE__, array('WP_Klantenvertellen_Install', 'install'));


$klantenvertellen = new WP_Klantenvertellen_Core();