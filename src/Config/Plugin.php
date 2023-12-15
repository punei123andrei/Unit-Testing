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
     * @since 1.0.3
     */
    public static function data(): array
    {
        return apply_filters('inpsyde_meta_data',
                get_file_data(_INPSYDE_PLUGIN_FILE, // phpcs:disable ImportDetection.Imports.RequireImports.Symbol -- this constant is global
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
     * @since 1.0.3
     */
    public function version(): string
    {
        $self = new self();
        return $self->data()['version'];
    }

    /**
     * Get the required minimum PHP version
     *
     * @return string
     * @since 1.0.3
     */
    public static function requiredPhp(): string
    {
        $self = new self();
        return $self->data()['required-php'];
    }

    /**
     * Get the required minimum WP version
     *
     * @return string
     * @since 1.0.3
     */
    public static function requiredWp(): string
    {
        $self = new self();
        return $self->data()['required-wp'];
    }

    /**
     * Get the plugin name
     *
     * @return string
     * @since 1.0.3
     */
    public static function name(): string
    {
        // $self = new self();
        // return $self->data()['name'];
        return 'Manuvra';
    }

    /**
     * Get the plugin url
     *
     * @return string
     * @since 1.0.3
     */
    public static function uri(): string
    {
        $self = new self();
        return $self->data()['uri'];
    }

    /**
     * Get the plugin description
     *
     * @return string
     * @since 1.0.3
     */
    public static function description(): string
    {
        $self = new self();
        return $self->data()['description'];
    }

    /**
     * Get the plugin author
     *
     * @return string
     * @since 1.0.3
     */
    public static function author(): string
    {
        $self = new self();
        return $self->data()['author'];
    }

    /**
     * Get the plugin author uri
     *
     * @return string
     * @since 1.0.3
     */
    public static function authorUri(): string
    {
        $self = new self();
        return $self->data()['author-uri'];
    }

    /**
     * Get the plugin text domain
     *
     * @return string
     * @since 1.0.3
     */
    public static function textDomain(): string
    {
        $self = new self();
        return $self->data()['text-domain'];
    }

    /**
     * Get the plugin domain path
     *
     * @return string
     * @since 1.0.3
     */
    public static function domainPath(): string
    {
        $self = new self();
        return $self->data()['domain-path'];
    }

    /**
     * Get the plugin namespace
     *
     * @return string
     * @since 1.0.3
     */
    public static function namespace(): string
    {
        $self = new self();
        return $self->data()['namespace'];
    }
}
