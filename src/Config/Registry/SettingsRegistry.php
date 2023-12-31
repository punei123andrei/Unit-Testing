<?php

/**
 * Inpsyde Users API
 *
 * @package   Inpsyde Users API
 * @author    Punei Andrei <punei.andrei@gmail.com>
 * @license   GNU General Public License v3.0
 */

declare(strict_types=1);

namespace Inpsyde\Config\Registry;

/**
 * Manages rewrite rules
 *
 * @package Inpsyde\Config\Registry
 * @since 1.0.1
 */

 class SettingsRegistry implements SettingsDefinition
 {

    // '_options', '_option', '_section', ' Settings', '-settings', '_input', ' Option', 

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


