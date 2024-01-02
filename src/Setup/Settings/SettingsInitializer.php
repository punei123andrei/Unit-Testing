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
use Inpsyde\Ajax\ApiBase;
use Inpsyde\Setup\Settings\Config\SettingsInterface;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Setup\Settings
 * @since 1.0.3
 */

 class SettingsInitializer 
 {

    private $settingsRegistry;

    public function __construct(SettingsInterface $registry) {
        $this->settingsRegistry = $registry;
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
        string $settingsName
        ): void {
        $this->adminInitAction(function() use ($settingsName) {

            $settingsKeys = $this->settingsRegistry->getOptions($settingsName);

            $this->settingsRegistry->registerSetting(
                $settingsKeys->getOptionGroup(),
                $settingsKeys->getOptionName()
            );

            $this->settingsRegistry->addSettingsSection(
                $settingsKeys->getOptionSection(),
                $settingsKeys->getOptionTitle(),
                [$this, 'sectionCallback'],
                $settingsKeys->getPageSlug(),
            );

            $this->settingsRegistry->addSettingsField(
                $settingsKeys->getFieldId(),
                $settingsKeys->getFieldTitle(),
                [$this, 'inputCallback'],
                $settingsKeys->getPageSlug(),
                $settingsKeys->getOptionSection()
            );
        });
    }

    public function sectionCallback() {
        ?>
        <p><?php esc_html_e('Api Base URL', 'inpsyde'); ?></p>
        <?php
    }

    public function inputCallback() {
        $apiBaseValue = get_option('inpsyde_user_option');
        $defaultBase = ApiBase::API_BASE;
        $apiBase = $apiBaseValue ? $apiBaseValue : $defaultBase;
        ?>
        <input type='text' name='inpsyde_user_option' value='<?php echo esc_attr($apiBase); ?>' />
        <?php
    }
}