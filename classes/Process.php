<?php

/**
* WP_Klantenvertellen_Process CLASS.
* 
* @since : 1.0.0*/

if(!class_exists('WP_Klantenvertellen_Process'))
{
	class WP_Klantenvertellen_Process extends WP_Klantenvertellen_Database
	{
		

		public static function processSource($url)
		{
			
			
			$xml = simplexml_load_file($url);
			
			
			if ($xml) {

				
				// for now we are goingin to delete instead of updating the row
				WP_Powertour_Uninstall::emptyTable('all');

				global $wpdb;
				
				$table1 = $wpdb->prefix . parent::KVCOMPANYTABLE;
				$table2 = $wpdb->prefix . parent::KVREVIEWSTABLE;
				$table3 = $wpdb->prefix . parent::KVCONTENTTABLE;

				$wpdb->insert($table1,
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
				
				
				// id for reviews $xml->locationId
				foreach($xml->reviews->reviews as $review){
				
					$wpdb->insert($table2,
							array(
								'locationid'   => $xml->locationId,//fix value
								'reviewid'     => $review->reviewId, 
								'reviewauthor' => $review->reviewAuthor, 
								'city'         => $review->city, 
								'rating'       => $review->rating, 
								'datesince'    => $review->dateSince,
								'updatedsince' => $review->updatedSince,
							),
							array(
								'%s',
								'%s',
								'%s',
								'%s',
								'%d',
								'%s',
								'%s',
							)

					);
					
					foreach($review->reviewContent->reviewContent as $content){
						
						$wpdb->insert($table3,
								array(
									'reviewid'           => $review->reviewId,//fix value 
									'questiongroup'      => $content->questionGroup,
									'questiontype'       => $content->questionType, 
									'rating'             => $content->rating, 
									'order'              => $content->order, 
									'questiontranslation'=> $content->questionTranslation, 
									'notapplicable'      => isset($content->notApplicable) ? $content->notApplicable : NULL ,
								),
								array(
									'%s',
									'%s',
									'%s',
									'%s',
									'%d',
									'%s',
									'%s',
								)

						);
						
					}

				}
				
			}
			
		}

	}
	
}
