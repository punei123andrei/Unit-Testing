<?php

/**
 * Plugin Name: Inpsyde Users API
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

$composer = __DIR__ . '/vendor/autoload.php';

/** Register The Auto Loader */
if (!file_exists($composer)) {
    wp_die(
        esc_html__(
            'Please run <code>composer install</code>.',
            'inpsyde-users'
        )
    );
}
require $composer;

use Inpsyde\Setup\Activation;
register_activation_hook(__FILE__, [Activation::class, 'activate']);

use Inpsyde\Setup\Deactivate;
register_deactivation_hook(__FILE__, [Deactivate::class, 'deactivate']);

use Inpsyde\Setup\Setup;
$setup = new Setup();
$setup->addStyle('inpsyde-style', plugins_url('build/style-index.css', __FILE__), [], '1.1')
->localizeScript('frontend', plugins_url('build/index.js', __FILE__), ['jquery'], '1.1', true);

use Inpsyde\Ajax\ApiUsersList;
$singleUser = new ApiUsersList();
$singleUser->init();
