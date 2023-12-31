<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Config;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Config
 * @since 1.0.1
 */

 class SettingsInitializer 
 {



    private UsersByName $byName;

    private string $name;

    public function __construct(
        UsersByName $byName,
        string $name
    ) {
        $this->byName = $byName;
        $this->name = $name; 
    }
    /**
     * Initializes the admin page with the correct settings
     *
     * @param callable $function
     * @return void
     */
    private function adminInitAction(callable $function): void
    {
        add_action('admin_init', static function () use ($function) {
            $function();
        });
    }

    /**
     * Sets up and registers settings for the admin page.
     *
     * This static method is responsible for initializing the settings for the plugin's admin page.
     * It registers the settings group, section, and fields using WordPress's settings API. The
     * method hooks into the 'admin_init' action to ensure that these settings are registered as
     * part of the admin panel initialization process.
     * To be refactored
     */
    
    public function initSettings(
        string $optionGroup, 
        string $optionName,
        string $id,
        string $title,
        string $pageSlug,
        string $fieldId,
        string $fieldTitle
        ): void {
        $this->adminInitAction(function() use ($optionGroup, $optionName, $id, $title, $pageSlug, $fieldId, $fieldTitle) {
            register_setting($optionGroup, $optionName);
            add_settings_section(
                $id,
                $title,
                [self::class, 'sectionCallback'],
                $pageSlug
            );
            add_settings_field(
                $fieldId,
                $fieldTitle,
                [self::class, 'inputCallback'],
                $pageSlug,
                $id
            );
        });
    }

    public static function sectionCallback() {
        ?>
        <p><?php esc_html_e('Api Base URL', 'inpsyde'); ?></p>;
        <?php
    }

    public static function inputCallback() {
        $apiBaseValue = get_option('inpsyde_api_base');
        $defaultBase = ApiBase::API_BASE;
        $apiBase = $apiBaseValue ? $apiBaseValue : $defaultBase;
        ?>
        <input type='text' name='inpsyde_api_base' value='<?php echo esc_attr($apiBase); ?>' />
        <?php
    }
}