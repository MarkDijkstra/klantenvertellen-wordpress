<?php

/**
* WP_Klantenvertellen_Database CLASS.
* 
* @since : 1.0.0*/

if(!class_exists('WP_Klantenvertellen_Database'))
{
	class WP_Klantenvertellen_Database
	{

		//move this to add better location like a settings class
		const KVDBVERSION     = '1.0.0';		
		const KVDBVERSIONNAME = 'klantenvertellen_db_version';
		const KVSETTINGSTABLE = 'klantenvertellen_settings';
		const KVREVIEWSTABLE  = 'klantenvertellen_reviews';

	}
	
}
