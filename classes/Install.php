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

			$table1 = $wpdb->prefix . parent::KVCOMPANYTABLE;
			$table2 = $wpdb->prefix . parent::KVREVIEWSTABLE;
			$table3 = $wpdb->prefix . parent::KVCONTENTTABLE;
			
			$sql = "CREATE TABLE IF NOT EXISTS $table1(
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `averagerating` int(11) NOT NULL,
					  `numberreviews` bigint(8) NOT NULL,					  				  
					  `last12monthaveragerating` int(11) NOT NULL,
					  `last12monthnumberreviews` int(11) NOT NULL,
					  `percentagerecommendation` int(11) NOT NULL,
					  `locationid` varchar(255) NOT NULL,
					  `locationname` varchar(255) NOT NULL,						  
					  `xmlsource` varchar(255) NOT NULL,
					  `added` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',	
					  PRIMARY KEY (`id`)
					);";

			dbDelta($sql); 

			$sql = "CREATE TABLE IF NOT EXISTS $table2(
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `locationid` varchar(255) NOT NULL,
					  `reviewid` varchar(255) NOT NULL,
					  `reviewauthor` varchar(255) NOT NULL,					  				  
					  `city` varchar(255) NOT NULL,
					  `rating` varchar(255) NOT NULL,					  
					  `datesince` varchar(255) NOT NULL,
					  `updatedsince` varchar(255) NOT NULL,
					  PRIMARY KEY (`id`)
					);";

			dbDelta($sql);
			
			$sql = "CREATE TABLE IF NOT EXISTS $table3(
					  `id` int(11) NOT NULL AUTO_INCREMENT,					  
					  `reviewid` varchar(255) NOT NULL,
					  `questiongroup` varchar(255) NOT NULL,					  				  
					  `questiontype` varchar(255) NOT NULL,
					  `rating` int(11) NOT NULL,	
					  `order` int(11) NOT NULL,					  
					  `questiontranslation` varchar(255) NOT NULL,
					  `notapplicable` varchar(255) NULL,
					  PRIMARY KEY (`id`)
					);";

			dbDelta($sql); 

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
		* @since : 1.0.0
		*/
		public static function install()
		{
			self::databaseTables();
			self::databaseVersion();
		}

	}

}