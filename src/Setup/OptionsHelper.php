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
 *
 * Helps with setting otions
 *
 * @package Inpsyde\RequestDefinitions
 * @since 1.0.1
 */
class OptionsHelper
{
    /**
     * Renders the content for the options page.
     *
     * @return void
     */
    public static function renderOptionsPage(): void
    {
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

    /**
     * Adds a new options group, settings section + section field
     *
     * @return void
     */
    public static function initSettings(): void
    {
        $self = new self();
        register_setting('inpsyde_user_options', 'inpsyde_api_base');
        add_settings_section(
            'inpsyde_user_section',
            'Inpsyde User Settings',
            [$self, 'sectionCallback'],
            'inpsyde-user-settings'
        );
        add_settings_field(
            'inpsyde_user_input',
            'Inpsyde Option',
            [$self, 'inputCallback'],
            'inpsyde-user-settings',
            'inpsyde_user_section'
        );
    }

    /**
     * Section description
     *
     * @echo string
     */
    public function sectionCallback()
    {
        ?>
        <p><?php esc_html_e('Api Base URL', 'inpsyde'); ?></p>;
        <?php
    }

    /**
     * Section input
     *
     * @echo string
     */
    public function inputCallback()
    {
        $apiBaseValue = get_option('inpsyde_api_base');
        $defaultBase = ApiBase::API_BASE;
        $apiBase = $apiBaseValue ? $apiBaseValue : $defaultBase;
        ?>
        <input type='text' name='inpsyde_api_base' value='<?php echo esc_attr($apiBase); ?>' />
        <?php
    }
}
