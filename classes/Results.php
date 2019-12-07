<?php
/**
* WP_Klantenvertellen_Results CLASS.
*
* This class provides the fetching of the data from the DB.
* 
* @since : 1.0.0
*/
if(!class_exists('WP_Klantenvertellen_Results'))
{
    class WP_Klantenvertellen_Results extends WP_Klantenvertellen_Database
    {
        

        public static function getCompany($id = false)
        {

            if (is_numeric($id)) {
                //fixed for now
                //$id    = 1;
                $limit = 1;
                $offset= 0;

                global $wpdb;

                $table = $wpdb->prefix . parent::KVCOMPANYTABLE;	

                $results = $wpdb->get_results(
                    $wpdb->prepare("SELECT * FROM $table WHERE id = %d LIMIT %d OFFSET %d", $id, $limit, $offset)
                , ARRAY_A);

                return $results;
                
            }
            
        }
        
        public static function getCompanyLocationId($id = false)
        {

            if (is_numeric($id)) {
                
                global $wpdb;

                $table = $wpdb->prefix . parent::KVCOMPANYTABLE;	
                
                $results = $wpdb->get_var(
                    $wpdb->prepare("SELECT locationid FROM $table WHERE id = %s", $id)
                );

                return $results;
                
            }
            
        }
        

        public static function getReviews($id = false)
        {
            
            if (is_numeric($id)) {
                
                global $wpdb;

                $locId = self::getCompanyLocationId($id);                
                $table = $wpdb->prefix . parent::KVREVIEWSTABLE;
                
                //fixed for now
                $limit  = 100000;
                $offset = 0;

                $results = $wpdb->get_results(
                    $wpdb->prepare("SELECT * FROM $table WHERE locationid = %d LIMIT %d OFFSET %d", $locId, $limit, $offset)
                , ARRAY_A);

                return $results;
                
            }
            
        }

        public static function getContentByReviewId($revId = false)
        {
            
            if ($revId !== false ) {
                
                global $wpdb;
               
                $table = $wpdb->prefix . parent::KVCONTENTTABLE;	
                

                $results = $wpdb->get_results(
                    $wpdb->prepare("SELECT * FROM $table WHERE reviewid = %s", $revId)
                , ARRAY_A);

                return $results;
                
            }
           
        }

        public static function getAll()
        {
            
            self::getCompany();
            self::getReviews();
            self::getContent();

        }
        
  
    }
    
}
			