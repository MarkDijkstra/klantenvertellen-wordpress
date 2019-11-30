<?php

/**
* WP_Klantenvertellen_Install CLASS.
* 
* @since : 1.0.0
*/
if(!class_exists('WP_Klantenvertellen_Install'))
{
	
	class WP_Klantenvertellen_Install extends WP_Klantenvertellen_Database
	{

		
		/**
		* INSTALL DATABASE TABLES.
		* 
		* @since : 1.0.0
		*/
		public static function databaseTables()
		{
			
			global $wpdb;
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			

			$table1 = $wpdb->prefix . parent::KVSETTINGSTABLE;
			$table2 = $wpdb->prefix . parent::KVREVIEWSTABLE;
			     
			
			//build


			}
			
			
			/**
			* ADD DATABASE VERSION.
			* 
			* This will save the plugin database version to the 'wp_options' table.
			*
			* @since : 1.0.0
			*/
			public static function databaseVersion()
			{
				add_option(parent::KVDBVERSIONNAME , parent::KVDBVERSION);
			}
			
			/**
			* COMBINED INSTALL OBJECTS.
			* 
			* Make it all happen at once's.
			*
			* @since : 1.0.0
			*/
			public static function install()
			{
				//self::databaseTables();
				self::databaseVersion();
			}
	
		}

	}