<?php

/**
* WP_Klantenvertellen_Uninstall CLASS.
* 
* @since 1.0.0
*/
if(!class_exists('WP_Powertour_Uninstall'))
{
	
	class WP_Powertour_Uninstall extends WP_Klantenvertellen_Database
	{

		public static function emptyTable($table)
		{
			
			global $wpdb;

			if ($table == 'company') {
				$turnTable = $wpdb->prefix . parent::KVCOMPANYTABLE;
			} elseif ($table == 'reviews') {
				$turnTable = $wpdb->prefix . parent::KVREVIEWSTABLE;
			}else{
				$turnTable = '';
			}

			$wpdb->query("TRUNCATE TABLE $turnTable");

		}

		/**
		* UNINSTALL DATABASE.
		*
		* Uninstall the plugin custom database.
		* 
		* @todo  : add the possibility to save backup the data? 
		* @since : 1.0.0
		*/
		public static function uninstallDatabase()
		{
			
			global $wpdb;
			
			$table1 = $wpdb->prefix.parent::KVCOMPANYTABLE;
			$table2 = $wpdb->prefix.parent::KVREVIEWSTABLE;
		
            $wpdb->query("DROP TABLE $table1");// update
			
		}

		/**
		* INSTALL DATABASE VERSION.
		* 
		* This will delete the plugin database version from the 'wp_options' table.
		*
		* @since : 1.0.0
		*/
		public static function removeDatabaseVersion()
		{
			delete_option(parent::KVDBVERSIONNAME);	
		}

		/**
		* COMBINED UNINSTALL OBJECTS.
		*
		* @since : 1.0.0
		*/
		public static function uninstall()
		{
			self::uninstallDatabase();
			self::removeDatabaseVersion();
		}
		
	}
	
}