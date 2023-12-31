<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup\Settings;

/**
 * Creates a test page for displaying content resulted from api request
 *
 * @package Inpsyde\Setup\Settings
 * @since 1.0.1
 */

class OptionsPage {

        /**
     * Add option page on admin side
     *
     * @param callable $function
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
    * @param string $pageTitle A page title fot the settings page
    * @param string $menuTitle A title for the admin menu
    *
    * @return Setup
    */
    public function addOptionsPage(string $pageTitle, string $menuTitle): Setup
    {
        $this->actionOptionsPage(static function () use ($pageTitle, $menuTitle) {
                add_options_page(
                    $pageTitle,
                    $menuTitle,
                    'manage_options',
                    'inpsyde_settings',
                    [self::class, 'renderOptionsPage']
                );
        });

    }
    public static function renderOptionsPage(): void {
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                settings_fields('inpsyde_user_options');
                do_settings_sections('inpsyde-user-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}