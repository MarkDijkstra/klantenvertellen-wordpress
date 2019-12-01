<?php

/**
* WP_Klantenvertellen_Process CLASS.
* 
* @since : 1.0.0*/

if(!class_exists('WP_Klantenvertellen_Process'))
{
	class WP_Klantenvertellen_Process extends WP_Klantenvertellen_Database
	{
		
		
		public static function processReviews($url)
		{
			
		}
		
		public static function processCompany($url)
		{
			
			
			$xml = simplexml_load_file($url);
			
			
			if ($xml) {

				
				// for now we are goingin to delete instead of updating the row
				WP_Powertour_Uninstall::emptyTable('company');

				global $wpdb;
				
				$table = $wpdb->prefix . parent::KVCOMPANYTABLE;

				$wpdb->insert($table,
						array(
							'averagerating'            => $xml->averageRating,
							'numberreviews'            => $xml->numberReviews, 
							'last12monthaveragerating' => $xml->last12MonthAverageRating, 
							'last12monthnumberreviews' => $xml->last12MonthNumberReviews, 
							'percentagerecommendation' => $xml->percentageRecommendation, 
							'locationid'               => $xml->locationId,
							'locationname'             => $xml->locationName,
							'xmlsource'                => $url, 
							'added'                    => current_time('mysql'),
							'updated'                  => current_time('mysql'),

						),
						array(
							'%s',
							'%d',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s'

						)
							  
				);
				
				
			}
			
		}
		
		public static function processUrl($url = false)
		{
			
			if ($url !== false) {
				self::processCompany($url);
				//self::processReviews($url);
				
			}
			
		}
		

	}
	
}
