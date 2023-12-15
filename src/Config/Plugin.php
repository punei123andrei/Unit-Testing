<?php

/**
 * Inpsyde Users
 *
 * @package   Inpsyde Users
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Config;

/**
 * Plugin data which are used through the plugin, most of them are defined
 * by the root file meta data. The data is being inserted in each class
 * that extends the Base abstract class
 *
 * @see Base
 * @package Inpsyde\Config
 * @since 1.0.3
 */
class Plugin
{
    /**
     * Get the plugin meta data from the root file and include own data
     *
     * @return array
     * @since 1.0.0
     */
    public static function data(): array
    {
        return apply_filters('inpsyde_users_plugin_meta_data',
                get_file_data(INPSYDE_ROOT, // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
                    [
                        'name'         => 'Plugin Name',
                        'uri'          => 'Plugin URI',
                        'description'  => 'Description',
                        'version'      => 'Version',
                        'author'       => 'Author',
                        'author-uri'   => 'Author URI',
                        'text-domain'  => 'Text Domain',
                        'domain-path'  => 'Domain Path',
                        'required-php' => 'Requires PHP',
                        'required-wp'  => 'Requires WP',
                        'namespace'    => 'Namespace',
                    ], 'plugin'
                )
        );
    }


    /**
     * Get the plugin version number
     *
     * @return string
     * @since 1.0.0
     */
    public function version(): string
    {
        return $this->data()['version'];
    }

    /**
     * Get the required minimum PHP version
     *
     * @return string
     * @since 1.0.0
     */
    public function requiredPhp(): string
    {
        return $this->data()['required-php'];
    }

    /**
     * Get the required minimum WP version
     *
     * @return string
     * @since 1.0.0
     */
    public function requiredWp(): string
    {
        return $this->data()['required-wp'];
    }

    /**
     * Get the plugin name
     *
     * @return string
     * @since 1.0.0
     */
    public function name(): string
    {
        return $this->data()['name'];
    }

    /**
     * Get the plugin url
     *
     * @return string
     * @since 1.0.0
     */
    public function uri(): string
    {
        return $this->data()['uri'];
    }

    /**
     * Get the plugin description
     *
     * @return string
     * @since 1.0.0
     */
    public function description(): string
    {
        return $this->data()['description'];
    }

    /**
     * Get the plugin author
     *
     * @return string
     * @since 1.0.0
     */
    public function author(): string
    {
        return $this->data()['author'];
    }

    /**
     * Get the plugin author uri
     *
     * @return string
     * @since 1.0.0
     */
    public function authorUri(): string
    {
        return $this->data()['author-uri'];
    }

    /**
     * Get the plugin text domain
     *
     * @return string
     * @since 1.0.0
     */
    public function textDomain(): string
    {
        return $this->data()['text-domain'];
    }

    /**
     * Get the plugin domain path
     *
     * @return string
     * @since 1.0.0
     */
    public function domainPath(): string
    {
        return $this->data()['domain-path'];
    }

    /**
     * Get the plugin namespace
     *
     * @return string
     * @since 1.0.0
     */
    public function namespace(): string
    {
        return $this->data()['namespace'];
    }
}
