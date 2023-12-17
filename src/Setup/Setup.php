<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup;

use Inpsyde\Ajax\ApiBase;

/**
 * Helps with loading scripts and creating options page
 *
 * @package Inpsyde\RequestDefinitions
 * @since 1.0.0
 */
class Setup
{
    /**
     * Enqueue script on front end
     *
     * @param $function
     * @return void
     */
    private function actionEnqueueScripts(callable $function): void
    {
        add_action('wp_enqueue_scripts', static function () use ($function) {
            $function();
        });
    }

    /**
     * Add option page on admin side
     *
     * @param $function
     * @return void
     */
    private function actionOptionsPage(callable $function): void
    {
        add_action('admin_menu', static function () use ($function) {
            $function();
        });
    }

    /**
    * Adds an options page for the plugin to the WordPress admin menu.
    * @since 1.0.3 Adds Settings Section and settings field
    *
    * @param array $settingsInfo Information with witch to make the options page
    */
    public function addOptionsPage(array $settingsInfo): void
    {
        list($pageTitle, $menuTitle) = $settingsInfo;
        $this->actionOptionsPage(function () use ($pageTitle, $menuTitle) {
                add_options_page(
                    $pageTitle,
                    $menuTitle,
                    'manage_options',
                    'inpsyde_settings',
                    [OptionsHelper::class, 'renderOptionsPage']
                );
        });

        add_action('admin_init', function () use ($settingsInfo) {
            OptionsHelper::initSettings($settingsInfo);
        });
    }

    /**
     * Adds a style sheet for the frontend
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param string $media
     * @return $this
     */
    public function addStyle(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        string $media = 'all'
    ): Setup {

        $this->actionEnqueueScripts(static function () use ($handle, $src, $deps, $ver, $media) {
            wp_enqueue_style($handle, $src, $deps, $ver, $media);
        });

        return $this;
    }

    /**
     * Add Js script to be rendered on the front.
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param false $inFooter
     * @return $this
     */
    public function addScript(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        bool $inFooter = false
    ): Setup {

        $this->actionEnqueueScripts(static function () use ($handle, $src, $deps, $ver, $inFooter) {

            wp_register_script($handle, $src, $deps, $ver, $inFooter);
            wp_enqueue_script($handle);
        });

        return $this;
    }

    /**
     * Enqueues and localizes a script in WordPress.
     *
     * @param string $handle
     * @param string $src
     * @param array $deps
     * @param string|null $ver
     * @param bool $inFooter
     * @return Setup
     */
    public function localizeScript(
        string $handle,
        string $src = '',
        array $deps = [],
        ?string $ver = null,
        bool $inFooter = false,
        ?string $pageSlug = null
    ): Setup {

        $this->actionEnqueueScripts(static function () use (
            $handle,
            $src,
            $deps,
            $ver,
            $inFooter,
            $pageSlug
        ) {

            if (
                ($pageSlug !== null)
                &&
                ($pageSlug !== get_post_field('post_name', get_queried_object_id()))
            ) {
                return;
            }

            wp_register_script($handle, $src, $deps, $ver, $inFooter);

            wp_localize_script(
                $handle,
                'ajax_obj',
                [
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'token' => wp_create_nonce('inpsyde_token'),
                ]
            );

            wp_enqueue_script($handle);
        });

        return $this;
    }
}
