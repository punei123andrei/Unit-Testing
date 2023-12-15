<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Common\Utils;

use Inpsyde\Config\Plugin;

/**
 * Utility to show prettified wp_die errors, write debug logs as
 * string or array and to deactivate plugin and print a notice
 *
 * @package Inpsyde\Config
 * @since 1.0.3
 */
class Errors
{

    /**
     * Get the plugin data in static form
     *
     * @return array
     * @since 1.0.3
     */
    public static function getPluginData(): array
    {
        return Plugin::data();
    }

    /**
     * Prettified wp_die error function
     *
     * @param $message : The error message
     * @param string $subtitle : Specified title of the error
     * @param string $source : File source of the error
     * @param string $title : General title of the error
     * @param string $exception
     * @since 1.0.3
     */
    public static function wpDie($message = '', $subtitle = '', $source = '', $exception = '', $title = '')
    {
        if ($message) {
            $plugin = self::getPluginData();
            $title = $title ? $title : $plugin['name'] . ' ' . $plugin['version'] . ' ' . __('&rsaquo; Fatal Error', 'inpsyde');
            Errors::writeLog(
                [
                    'title'     => $title . ' - ' . $subtitle,
                    'message'   => $message,
                    'source'    => $source,
                    'exception' => $exception,
                ]
            );
            $source = $source ? '<code>' .
                sprintf(  /* translators: %s: file path */
                    __('Error source: %s', 'inpsyde'), $source
                ) . '</code><BR><BR>' : '';
            $footer = $source . '<a href="' . $plugin['uri'] . '">' . $plugin['uri'] . '</a>';
            $message = '<p>' . $message . '</p>';
            $message .= $exception ? '<p><strong>Exception: </strong><BR>' . $exception . '</p>' : '';
            $message = "<h1>{$title}<br><small>{$subtitle}</small></h1>{$message}<hr><p>{$footer}</p>";
            wp_die($message, $title);
        } else {
            wp_die();
        }
    }

    /**
     * De-activates the plugin and shows notice error in back-end
     *
     * @param $message : The error message
     * @param string $subtitle : Specified title of the error
     * @param string $source : File source of the error
     * @param string $title : General title of the error
     * @param string $exception
     * @since 1.0.3
     */
    public static function pluginDie($message = '', $subtitle = '', $source = '', $exception = '', $title = '')
    {
        if ($message) {
            $plugin = self::getPluginData();
            $title = $title ? $title : $plugin['name'] . ' ' . $plugin['version'] . ' ' . __('&rsaquo; Plugin Disabled', 'inpsyde');
            Errors::writeLog(
                [
                    'title'     => $title . ' - ' . $subtitle,
                    'message'   => $message,
                    'source'    => $source,
                    'exception' => $exception,
                ]
            );
            $source = $source ? '<small>' .
                sprintf( /* translators: %s: file path */
                    __('Error source: %s', 'inpsyde'), $source
                ) . '</small> - ' : '';
            $footer = $source . '<a href="' . $plugin['uri'] . '"><small>' . $plugin['uri'] . '</small></a>';
            $error = "<strong><h3>{$title}</h3>{$subtitle}</strong><p>{$message}</p><hr><p>{$footer}</p>";
            global $the_plugin_name_die_notice;
            $the_plugin_name_die_notice = $error;
            add_action('admin_notices',
                static function () {
                    global $the_plugin_name_die_notice;
                    echo wp_kses_post(
                        sprintf(
                            '<div class="notice notice-error"><p>%s</p></div>',
                            $the_plugin_name_die_notice
                        )
                    );
                }
            );
        }
        add_action('admin_init',
            static function () {
                deactivate_plugins(plugin_basename(_INPSYDE_PLUGIN_FILE)); // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
            }
        );
    }

    /**
     * Writes a log if wp_debug is enables
     *
     * @param $log
     * @since 1.0.0
     */
    public static function writeLog($log)
    {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {
                error_log(print_r($log, true));
            } else {
                error_log($log);
            }
        }
    }
}
