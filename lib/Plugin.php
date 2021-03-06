<?php

namespace Friendly\Analytics;

class Plugin
{

	/**
	 * @var Loader
	 */
	 public $loader;

	/**
	 * @var Settings
	 */
	public $settings;

	public function run()
	{

		//i18n
		add_action('plugins_loaded', array($this, 'load_textdomain'));

		//opt-out button
		//OptOutButton::init();

		//settings
		$this->settings = new Settings();

		add_action('admin_init', array($this->settings, 'register_settings'));
		add_action('admin_menu', array($this->settings, 'settings_page'));

		//loader
		$this->loader = new Loader();

		//cookie handling
		add_action('admin_enqueue_scripts', array($this->loader, 'load_admin_styles'));
		//add_action('wp_enqueue_scripts', array($this->loader, 'register_public_scripts'));
		//add_action('admin_enqueue_scripts', array($this->loader, 'register_public_scripts'));

		add_action('wp_enqueue_scripts', array($this->loader, 'register_fa_scripts'));





		//additional links to admin plugin page
		add_filter('plugin_row_meta', array($this, 'additional_admin_information_links'), 10, 2);
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'additional_admin_action_links'));

	}


	/**
	 * Adds custom links to wk-google-analytics on admin plugin screen on the RIGHT
	 *
	 * @since 1.6.2
	 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_row_meta
	 *
	 */
	function additional_admin_information_links($links, $file)
	{

		/*if (dirname($file) == basename(WK_GOOGLE_ANALYTICS_DIR)) {
			$links[] = '<a href="http://bit.ly/2jnKboN">' . __('Donate to this plugin', 'wk-google-analytics') . '</a>';
		}
*/
		return $links;

	}


	/**
	 * Sets up the translations in /lang directory
	 *
	 * @since 1.0
	 *
	 */
	function load_textdomain()
	{
		load_plugin_textdomain('friendly-analytics', false, basename(plugin_dir_path(__DIR__)) . '/languages');
	}



}
