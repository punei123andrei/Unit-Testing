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
    * Initialize the object with option key and value
    *
    * @param string $inputKey   The key of the option
    * @param mixed  $inputValue The value of the option
    */
    public function init(): OptionsHelper
    {
        add_action('admin_init', [$this, 'updateOption']);
        return $this;
    }

    /**
     * Set the value of a specific option
     * @param string $key The key of the option
     * @param mixed $value The value to set
     * @return bool True on success, false on failure
     */
    public function updateOption(string $key): bool
    {

        $nonceField = isset($_POST['nonce'])
        ? sanitize_text_field(wp_unslash($_POST['nonce']))
        : false;
        if ($nonceField) {
            return false;
        }

        if (!isset($_POST[$key])) {
            return false;
        }

        $value = sanitize_text_field(wp_unslash($_POST[$key]));
        if (empty($value)) {
            return false;
        }

        return update_option($key, $value);
    }

    /**
     * Renders the content for the options page.
     *
     * @return void
     */
    public function renderOptionsPage(): void
    {

        $apiBaseValue = get_option('inpsyde_api_base');
        $defaultBase = ApiBase::API_BASE;
        $apiBase = $apiBaseValue ? $apiBaseValue : $defaultBase;

        ?>
        <!-- <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form method="post" action="">
                <?php wp_nonce_field('inpsyde_set_api', 'nonce'); ?>
                <label for="inpsyde_api_base"><?php esc_html_e('Add api:', 'inpsyde') ?></label>
                <input type="text"
                        id="inpsyde_api_base"
                        name="inpsyde_api_base"
                        value="<?php echo esc_attr($apiBase);
                        ?>">
                <?php
                submit_button('Save Settings');
                ?>
            </form>
        </div> -->

        <div class="wrap">
            <h2>Inpsyde Settings</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('your_plugin_options');
                do_settings_sections('your-plugin-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Adds a new options group, settings section + section field
     * 
     * @param array An array of information that defines the labels
     * 
     * @return void
     */
    public static function initSettings($settingsInfo) 
    {

        $self = new Self();
        list($pageTitle, , $optionName) = $settingsInfo;

        $optionGroup = $self->slugName($pageTitle);
        $optionId = $self->slugName($optionName);

        register_setting($optionGroup, $optionName);

        add_settings_section(
            $optionGroup,
            $pageTitle,
            [$self, 'sectionCallback'],
            'inpsyde-settings'
        );
        add_settings_field(
            $optionId,
            'Your Option',
            [$self, 'inputCallback'],
            'inpsyde-settings',
            'inpsyde_plugin_section'
        );
    }
    

    /**
     * Renders the content for the options page.
     *
     * @return void
     */
    public static function sectionCallback(){

    }

    /**
     * Renders the input for the options section.
     *
     * @return void
     */
    public static function inputCallback(){

    }

    /**
     * Set the value of a specific option
     * @param string $name The inputName
     * @return string Formated string
     */
    public static function slugName(string $name): string{
        $slug = str_replace(' ', '_', $name);
        return $slug;
    }
}
