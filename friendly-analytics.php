<?php
/**
 * Plugin Name: Friendly Analytics
 * Plugin URI: https://wordpress.org/plugins/friendly-analytics/
 * Description: Friendly Analytics is  a professional web analytics solution that is friendly to your website visitors by respecting their privacy.
 * Version: 1.0.4
 * Author: Friendly
 * Author URI: https://friendly.ch/analytics
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: friendly-analytics
 * Credit: Based on the GA plugin by Webkinder
 */

define('FRIENDLY_ANALYTICS_DIR', dirname(__FILE__));

$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
	require_once($autoload);
}

Friendly\Analytics\PluginFactory::create()->run();
  
