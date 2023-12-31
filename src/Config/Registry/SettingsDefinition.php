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

 interface SettingsDefinition
 {
    public function registerSetting(string $optionGroup, string $optionName): void;
    public function addSettingsSection(string $id, string $title, callable $callback, string $pageSlug): void;
    public function addSettingsField(string $fieldId, string $fieldTitle, callable $callback, string $pageSlug, string $id): void;
}