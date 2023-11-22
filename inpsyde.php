<?php

/**
 * Plugin Name: Inpsyde
 * Plugin URI: https://www.inpsyde.com
 * Description: A plugin for displaying users from jsonplaceholder.
 * Version: 1.0.0
 * Author: Andrei Punei
 * Author URI: https://www.inpsyde.com
 * Text Domain: inpsyde-users
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

declare(strict_types=1);

namespace Inpsyde;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/** Register The Auto Loader */
if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(_e('Please run <code>composer install</code>.', 'the-theme-name-text-domain'));
}
require $composer;

 use Inpsyde\Frontend\Enqueue;

 $enqueue = new Enqueue();

 $enqueue->addScript('frontend', plugins_url('assets/frontend.js', __FILE__), [], microtime(), true);
    //   ->localizeScript('fiald-scripts', get_template_directory_uri() . '/build/index.js', ['jquery'], microtime(), true);
