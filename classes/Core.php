<?php

/**
* WP_Klantenvertellen_Core CLASS.
* 
* @since : 1.0.0
*/
if(!class_exists('WP_Klantenvertellen_Core')) {
	
    class WP_Klantenvertellen_Core
	{
		     
		public $menuIcon;
		public $pluginDirName = 'klantenvertellen-wordpress';
		public $pluginName    = 'Klantenvertellen';
		public $pluginSlug    = 'klantenvertellen';  
		public $dashboardSlug = 'klantenvertellen-welcome';
		public $reviewsSlug   = 'klantenvertellen-reviews';
		public $docsSlug      = 'klantenvertellen-documentation';
		public $settingsSlug  = 'klantenvertellen-settings';
		public $oldIcon       = '';                            
		public $dashIcon      = 'dashicons-welcome-view-site';
		
		/**
		* CONSTRUCTOR
		* 
		* @since : 1.0.0
		*/
		public function __construct()
		{			
                       
			$this->pluginDirPath  = WP_PLUGIN_DIR.'/' . $this->pluginDirName;
			$this->pluginUrl      = plugins_url('/' . $this->pluginDirName);                                   
            $this->pluginPagesDir = $this->pluginDirPath . '/pages';
			$this->adminCssPath   = plugins_url($this->pluginDirName . '/assets/css/admin.css');
			$this->fontawesomePath= plugins_url($this->pluginDirName . '/assets/vendor/fontawesome/css/fontawesome.min.css');  
			
			$this->dashboardPage = $this->pluginPagesDir . '/dashboard.php';
			$this->reviewsPage   = $this->pluginPagesDir . '/reviews.php';
			$this->settingsPage  = $this->pluginPagesDir . '/settings.php';
			$this->docsPage      = $this->pluginPagesDir . '/documentation.php';
			
			$this->nameDashboard = __('Dashboard', 'klantenvertellen');  
			$this->nameReviews   = __('Reviews', 'klantenvertellen');  
			$this->nameSettings  = __('Settings', 'klantenvertellen');
			$this->nameDocs      = __('Documentation', 'klantenvertellen');  
			
			$this->adminInit();
			$this->addActions();
			$this->wpVersionCore();
			
		}
		
        /**
        * ADD ACTIONS.
        *
        * @since : 1.0.0
        */
        private function addActions()
		{
            add_action('admin_init', array($this, 'adminInit'));
            add_action('admin_menu', array($this, 'registerMenu'));
            add_action('admin_menu', array($this, 'subMenuPageFix'));			
			add_action('admin_enqueue_scripts', array($this, 'addScriptsStylesAdmin'));

        }
        
        /**
        * ADMIN INIT.
        *
        * @since : 1.0.0
        */
        public function adminInit()
		{

            // Localization
            //load_plugin_textdomain($this->mopoName, false, basename(dirname( __FILE__ )).'/languages/');
        }
		
		/**
		* REGISTER SCRIPTS AND STYLES.(ADMIN)
		*
		* @since : 1.0.0
		*/
		public function addScriptsStylesAdmin(){
			wp_enqueue_style('klantenvertellen-core-css', $this->adminCssPath, array(), $this->pluginVersion);			
			 wp_enqueue_style('fontawesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', '', '4.7.0', 'all'); 
		}
		
			
		/**
		* REGISTER/UN-REGISTER MENU/SUBMENU'S.
		*
		* This includes checking and setting(add_ / remove_) the
		* menu and submenus that are available per user(role).
		* These are set on the settings page. 
		*
		* @since : 1.0.0
		*/
		public function registerMenu()
		{
			
			$userLevel = self::userRoleLevel();
			
			// TODO: make this work by using role setting in the plugin(settings page)
			$userLevelDashboard = 0;
			$userLevelSettings  = 0;
			$userLevelDocs      = 0;
			$userLevelReviews   = 0;

			// main page
			add_menu_page($this->pluginName, $this->pluginName, 1, $this->pluginSlug, '', $this->menuIcon);

			// dashboard
			if ($userLevelDashboard <= $userLevel) {
				add_submenu_page($this->pluginSlug, $this->nameDashboard, $this->nameDashboard, 1, $this->dashboardSlug, array($this, 'pageDashboard')); 
			} else {
				remove_submenu_page($this->pluginSlug, $this->dashboardSlug); 
			}

			// settings
			if ($userLevelSettings <= $userLevel) {
				add_submenu_page($this->pluginSlug, $this->nameSettings, $this->nameSettings, 1, $this->settingsSlug, array($this, 'pageSettings'));
			} else {
				remove_submenu_page($this->pluginSlug, $this->settingsSlug); 
			}
			
			// documentation
			if ($userLevelReviews <= $userLevel) { 
				add_submenu_page($this->pluginSlug, $this->nameReviews, $this->nameReviews, 1, $this->reviewsSlug, array($this, 'pageReviews'));  
			} else {
				remove_submenu_page($this->pluginSlug, $this->reviewsSlug); 
			}
			
			// documentation
			if ($userLevelDocs <= $userLevel) { 
				add_submenu_page($this->pluginSlug, $this->nameDocs, $this->nameDocs, 1, $this->docsSlug, 
				array($this, 'pageDocs'));  
			} else {
				remove_submenu_page($this->pluginSlug, $this->docsSlug); 
			}
	
		
		}
		
		/**
		* REMOVE TOPLEVEL FROM MENU.
		*
		* Wordpress ad's the toplevel name to the menu, this is not a 
		* working page AND therefor it must be removed.
		* 
		* @since : 1.0.0
		*/
		public function subMenuPageFix()
		{	
			remove_submenu_page($this->pluginSlug , $this->pluginSlug);
		}
		
		/**
		* WP CORE VERSION CHECK.
		*
		* This checks the wordpress core version, used in this case for dashicons as they
		* are available from 3.8.
		*
		* @since : 1.0.0
		*/
		public function wpVersionCore()
		{

			global $wp_version;

			if ($wp_version >= 3.8) {
				$this->menuIcon = $this->dashIcon;
			} else {
				$this->menuIcon = $this->oldIcon;
			}

		}
		
		/**
		* REQUIRE ONCE 'DASHBOARD' PAGE.
		*
		* @since : 1.0.0
		*/
		public function pageDashboard()
		{
			require_once($this->dashboardPage);
		}
		
		/**
		* REQUIRE ONCE 'SETTINGS' PAGE.
		*
		* @since : 1.0.0
		*/
		public function pageSettings()
		{
			require_once($this->settingsPage);
		}
		
		/**
		* REQUIRE ONCE 'REVIEWS' PAGE.
		*
		* @since : 1.0.0
		*/
		public function pageReviews()
		{
			require_once($this->reviewsPage);
		}
		
		/**
		* REQUIRE ONCE 'DOCS' PAGE.
		*
		* @since : 1.0.0
		*/
		public function pageDocs()
		{
			require_once($this->docsPage);
		}
		
		/**
		* USER ROLE CHECK AND SET.
		*
		* @since  : 1.0.0
		* @return : int/NULL.
		*/
		public static function userRoleLevel()
		{

			global $current_user;

			if (is_user_logged_in()) {
				switch($current_user->roles[0]){
					case 'administrator':
						$userRoleLevel = 5;
					break;
					case 'editor':
						$userRoleLevel = 4;
					break;
					case 'author':
						$userRoleLevel = 3;
					break;
					case 'contributor':
						$userRoleLevel = 2;
					break;
					case 'subscriber':
						$userRoleLevel = 1;
					break;
					default:
						$userRoleLevel = 6;
					break;
				}				
			} else {				
				$userRoleLevel = NULL;				
			}

			return $userRoleLevel;
			
		}
		
        
    }
	
}