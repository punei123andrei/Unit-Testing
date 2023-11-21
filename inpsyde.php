<?php
/**
 * Plugin Name: Inpsyde
 * Plugin URI: https://www.inpsyde.com
 * Description: A plugin for displaying users from https://jsonplaceholder.typicode.com
 * Version: 1.0.0
 * Author: Andrei Punei
 * Author URI: https://www.inpsyde.com
 * Text Domain: inpsyde
 * Domain Path: /languages
 * Network: false
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * WC requires at least: 5.6.0
 * WC tested up to: 6.4.1
 *
 * @author Andrei Punei
 */

namespace Codemnky\Simvoly;


//prevent direct access data leaks
defined( 'ABSPATH' ) || exit;


define(__NAMESPACE__ . '\PREFIX', 'smv');

define(__NAMESPACE__ . '\VERSION', '1.0.0');

define(__NAMESPACE__ . '\NAME', 'Simvoly Connector');

define(__NAMESPACE__ . '\DIR_URL', untrailingslashit(plugin_dir_url(__FILE__)));

define(__NAMESPACE__ . '\DIR_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

define(__NAMESPACE__ . '\DIR_NAME', plugin_basename(DIR_PATH));

define(__NAMESPACE__ . '\DIR_BASENAME', DIR_NAME . '/'.basename(__FILE__));

define(__NAMESPACE__ . '\SETTINGS_TAB_ID', 'simvoly');

define(__NAMESPACE__ . '\SETTINGS_TAB_NAME', 'Simvoly');

define(__NAMESPACE__ . '\SETTINGS_URL', admin_url('/admin.php?page=wc-settings&tab=' . SETTINGS_TAB_ID));

define(__NAMESPACE__ . '\DEBUG', get_option(PREFIX . '_debug') === 'yes' ? true:false);

define(__NAMESPACE__ . '\DEBUG_FILE', DIR_PATH . '/debug.log');


//include files
require_once DIR_PATH . '/vendor/autoload.php';

//init
Module_Core_Hook::init();