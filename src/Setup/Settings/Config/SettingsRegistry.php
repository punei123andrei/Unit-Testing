<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Setup\Settings\Config;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Setup\Settings\Config
 * @since 1.0.3
 */

 class SettingsRegistry implements SettingsInterface
 {

    public function getOptions($name): OptionKeys 
    {

        $optionKeys = new OptionKeys();

        $settingField = str_replace(' ', '_', $name);

        return $optionKeys
            ->setOptionGroup(strtolower($settingField) . '_options')
            ->setOptionName(strtolower($settingField) . '_option')
            ->setOptionSection(strtolower($settingField) . '_section')
            ->setOptionTitle($name . ' Settings')
            ->setPageSlug(sanitize_title($name) . '-settings')
            ->setFieldId(strtolower($settingField). '_input')
            ->setFieldTitle($name . ' Option');
    }

    public function registerSetting(string $optionGroup, string $optionName): void {
        register_setting($optionGroup, $optionName);
    }

    public function addSettingsSection(string $id, string $title, callable $callback, string $pageSlug): void {
        add_settings_section($id, $title, $callback, $pageSlug);
    }

    public function addSettingsField(string $fieldId, string $fieldTitle, callable $callback, string $pageSlug, string $id): void {
        add_settings_field($fieldId, $fieldTitle, $callback, $pageSlug, $id);
    }
}


