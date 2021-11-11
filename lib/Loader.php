<?php

namespace Friendly\Analytics;

class Loader
{

	/**
	 * Returns if the cookie is present
	 * this cookie is set in the backend for users that select it
	 *
	 * @since 1.2
	 * @return boolean
	 *
	 */





	/**
	 * Registers frontend scripts
	 */
	public function register_fa_scripts()
	{
 


		$fa_tracking_code = get_option('fa_tracking_code');
		$fa_tag_manager_id = get_option('fa_tag_manager_id');

		if (($fa_tracking_code and (!is_user_logged_in() or get_option('track_logged_in'))) or $fa_tag_manager_id) {

			
			
			wp_enqueue_script('friendly-analytics', plugins_url(plugin_basename(FRIENDLY_ANALYTICS_DIR)) . '/js/fa.js', array(), '1.1.8');
			wp_add_inline_script('friendly-analytics', $this->friendly_analytics_script(), 'before');


		}


 
		if ($fa_tracking_code and (!is_user_logged_in() or get_option('track_logged_in'))) {

			add_action( 'wp_footer', array( &$this, 'friendlyFooter' ) );
		
		}




 		

		
	}




	/**
	 * Outputs Site and Tag Manager IDs
	 *
	 *
	 */
	public function friendly_analytics_script()

	{
		$fa_tracking_code = get_option('fa_tracking_code');
		$fa_tag_manager_id = get_option('fa_tag_manager_id');
		$fa_server = get_option('fa_server');

		ob_start();

		if ($fa_tracking_code) {
		?>
var friendlyAnalyticsSiteId="<? echo $fa_tracking_code; ?>";<?php

		}

		if ($fa_tag_manager_id) {
		?>

var friendlyAnalyticsTagManagerId="<? echo $fa_tag_manager_id; ?>";<?php

		}	


		if ($fa_server) {
		?>

var friendlyAnalyticsServer="<? echo $fa_server; ?>";<?php

		}				


		return ob_get_clean();

	}


	



	public function friendlyFooter()
	{



		ob_start();

		$fa_tracking_code = get_option('fa_tracking_code');
		$fa_server = get_option('fa_server');

		if (!$fa_server)
			$fa_server = "app.friendlyanalytics.io";


		if ($fa_tracking_code and (!is_user_logged_in() or get_option('track_logged_in'))) {

		?><noscript><img src="https://<?php echo $fa_server; ?>/fa<?php echo $fa_tracking_code; ?>.gif"/></noscript><? 



		}

		echo ob_get_clean();


	}





	/**
	 * Loads all the admin scripts for settings page
	 *
	 * @since 1.0
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	 * @see https://github.com/js-cookie/js-cookie
	 *
	 */
	public function load_admin_styles($hook)
	{

		if ($hook !== 'settings_page_google_analytics') {
			return;
		}

		// admin styles
		wp_enqueue_style('custom-admin-styles', plugins_url(plugin_basename(WK_GOOGLE_ANALYTICS_DIR)) . '/css/admin-styles.css');

	}

}
